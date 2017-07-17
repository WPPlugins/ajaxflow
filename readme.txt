=== AjaxFlow ===
Contributors: EkAndreas
Tags: faster, ajax
Requires at least: 3.6
Tested up to: 3.7.1
Stable tag: 1.1

Make faster ajax calls in WordPress with this plugin.

== Description ==

Make faster ajax call in WordPress with this plugin.


Traditional ajax call in WordPress:
http://yourdomain.com/wp-admin/admin-ajax?action=my_hook

With AjaxFlow:
http://yourdomain.com/ajaxflow/my_hook
 

And the execution time for the ajax call becomes faster.

Source code to this plugin is maintained in repo https://github.com/EkAndreas/ajaxflow
To check ajaxflow performance, visit the site http://ajaxflow.flowcom.se or download the theme to try this yourself.
The test theme source is placed in the repo at https://github.com/EkAndreas/ajaxflow-test
You could also remove the plugin header and use this class as an extension to your own project.

If you don\'t like the tag ajaxflow inside your ajax call URL, please consider change this in the DEFINE added in the constructor of the ajaxflow class.

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.