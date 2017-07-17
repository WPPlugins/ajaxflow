<?php
/*
Plugin Name: AjaxFlow
Plugin URI: http://github.com/EkAndreas/ajaxflow/
Description: This plugin helps you create faster and more secure ajax call in WP.
Author: Andreas Ek
Version: 1.1
Author URI: http://www.flowcom.se/
*/
/********************************************************************
 * TODO: Remove the plugin header and include the class in your WP-project
 * if you don't need another plugin activation
 **************************************************************/

/**
 * Class AjaxFlow
 * Version 1.0
 */
class AjaxFlow {

	function __construct() {

		// TODO: change this if you want your own tag for ajax call in the URL
		define( 'AJAXFLOW_TAG', 'ajaxflow' );

		// TODO: force _wpnonce parameter with this definition
		define( 'AJAXFLOW_NONCE', false );

		add_action( 'init', array( &$this, 'init' ) );
		add_action( 'template_redirect', array( &$this, 'template_redirect' ), 1 );
		register_activation_hook( __FILE__, array( $this, 'register_activation_hook' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
	}

	function add_query_vars( $query_vars ) {
		$query_vars[] = AJAXFLOW_TAG;
		return $query_vars;
	}

	function init() {
		add_rewrite_tag( '%' . AJAXFLOW_TAG . '%', '([^&]+)' );
		add_rewrite_rule(
			AJAXFLOW_TAG . '/(.+?)/?$',
				'index.php?' . AJAXFLOW_TAG . '=$matches[1]',
			'top'
		);

		if ( isset( $_REQUEST['q'] ) && strpos( $_REQUEST['q'], AJAXFLOW_TAG ) == 1 ) {
			$this->ajax( str_replace( '/' . AJAXFLOW_TAG . '/', '', $_REQUEST['q'] ) );
		}

	}

	function template_redirect() {
		$action = get_query_var( AJAXFLOW_TAG );
		if ( ! empty( $action ) ) {
			$this->ajax( $action );
			exit;
		}
	}

	function register_activation_hook() {
		$this->init();
		flush_rewrite_rules();
	}

	function ajax( $action ) {
		define( 'DOING_AJAX', true );

		if ( empty( $action ) ) return;

		ini_set( 'html_errors', 0 );
		if ( AJAXFLOW_NONCE ) {
			if ( ! wp_verify_nonce( $action, $_REQUEST['_wpnonce'] ) ) {
				wp_die( 'Security check didn´t pass, please check _wpnonce!', AJAXFLOW_TAG );
			}
		}

		$shortinit = apply_filters( AJAXFLOW_TAG . '_shortinit', false, $action );
		if ( $shortinit || ( isset( $_REQUEST['shortinit'] ) && $_REQUEST['shortinit'] ) ) {
			define( 'SHORTINIT', true );
		}

		require_once( ABSPATH . '/wp-load.php' );

		header( 'Content-Type: text/html' );
		send_nosniff_header();
		header( 'Cache-Control: no-cache' );
		header( 'Pragma: no-cache' );

		do_action( AJAXFLOW_TAG . '_shortinit_load' );

		if ( is_user_logged_in() ) {
			do_action( AJAXFLOW_TAG . '_' . $action );
		}
		else
			do_action( AJAXFLOW_TAG . '_nopriv_' . $action );

		wp_die( 'Your ' . AJAXFLOW_TAG . ' call does not exists or exit is missing in action!', AJAXFLOW_TAG );

		exit;

	}

}

$_ajaxflow = new AjaxFlow();