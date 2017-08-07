<?php

/**
 * WP Add Template
 *
 * @package     ChewToolbox
 * @author      Geoffrey Stein
 * @copyright   2017 Chewbacode
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: WP Add Template
 * Plugin URI:  https://wp.chewbacode.com/plugins/wp-add-template
 * Description: Add a simple function wp_add_template to assume a page template file wherever you want in your project
 * Version:     1.0.0
 * Author:      Geoffrey Stein
 * Author URI:  https://www.chewbacode.com/geo
 * Text Domain: wp-add-template
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

function wp_add_template($path){

	add_action('wp', function() use ($path){

		// Check if the file exists
		if( ! file_exists($path) ){
			return false;
		}

		// Check if the file is using the WP template file header
		$fileDatas = get_file_data($path, ['TemplateName' => 'Template Name']);

		if( empty($fileDatas) || empty($fileDatas['TemplateName']) ){
			return false;
		}

		$filename = basename($path);
		$templateName = $fileDatas['TemplateName'];

		// Add Custom template to the Templates list
		add_filter('theme_page_templates', function($templates) use ($filename, $templateName){
			$templates[$filename] = $templateName;
			return $templates;
		});

		// Finally use the template when the page is loaded
		add_filter('page_template', function($template) use ($path, $filename){
			if( ! is_page_template($filename) ){
				return $template;
			}
			return $path;
		});
	});
}

if( ! ( defined('WP_ADD_TEMPLATE__LITE') && true === WP_ADD_TEMPLATE__LITE ) ){
	wp_add_template( plugin_dir_path(__FILE__) . 'tpl/my-template.php');
}

