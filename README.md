AjaxFlow
========

Make faster ajax call in WordPress with this plugin.

Traditional ajax call in WordPress:
http://yourdomain.com/wp-admin/admin-ajax?action=my_hook

With AjaxFlow:
http://yourdomain.com/ajaxflow/my_hook

And the execution time for the ajax call becomes faster.

Source code to this plugin is maintained in [https://github.com/EkAndreas/ajaxflow](https://github.com/EkAndreas/ajaxflow)

To check ajaxflow performance, visit the site [http://ajaxflow.flowcom.se](http://ajaxflow.flowcom.se) or download the theme to try this yourself. The theme source is in [https://github.com/EkAndreas/ajaxflow-test](https://github.com/EkAndreas/ajaxflow-test)

You could also remove the plugin header and use this class as an extension to your own project.

If you don't like the tag ajaxflow inside your ajax call URL, please consider change this in the DEFINE added in the constructor of the ajaxflow class.
