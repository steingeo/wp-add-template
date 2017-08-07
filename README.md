# WP Add Template

This WordPress plugin allows you to add a template file wherever you want inside your project, not only in the root of your theme.

To add a template file, simply use this function directly in your code or in a init action :

    // Use in a plugin
    wp_add_template( plugin_dir_path(__FILE__) . 'tpl/my-template.php');

    // Use in a subfolder of your theme
    wp_add_template(get_template_directory() . '/long/path/to/the/template/my-template.php');

Feel free to use it to improve your own plugin and to contribute to improve it.
