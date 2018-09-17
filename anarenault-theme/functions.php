<?php

function ar_setup() {
	add_theme_support('title-tag');
  register_nav_menu('sidebar', 'Sidebar');
}

add_action('after_setup_theme', 'ar_setup');

/************************
	Scripts & styles
************************/

function ar_scripts_styles() {
	wp_enqueue_script("ar-lightbox-script", get_template_directory_uri() . "/assets/js/lightbox.js", array("jquery"), "", true);
	wp_localize_script('ar-lightbox-script', 'wpThemeUrl', get_template_directory_uri());
}

add_action("wp_enqueue_scripts", "ar_scripts_styles");


/************************
	Admin
************************/

if(is_admin()) {

	/************************
		Admin scripts & styles
	************************/

	function ar_admin_scripts_styles() {
		wp_enqueue_media();
		wp_enqueue_script("ar-admin-script", get_template_directory_uri() . "/assets/js/admin-functions.js", array("jquery"), "", true);
		wp_enqueue_style("ar-admin-style", get_template_directory_uri() . "/assets/css/admin-style.css");
	}

	add_action("admin_enqueue_scripts", "ar_admin_scripts_styles");

	/************************
		Admin menu pages
	************************/

	function include_ar_gallery_options() {
		include("gallery-options.php");
	}

	function ar_options_pages() {
		add_menu_page( 'Galerien', 'Galerien', 'manage_options', 'ar-gallery-options', 'include_ar_gallery_options', 'dashicons-format-gallery', 2);
	}

	add_action( 'admin_menu', 'ar_options_pages' );

	/************************
		Add settings
	************************/

	function ar_options() {
		add_settings_field("ar_galleries", "Galerien", "", "ar-gallery-options");
		register_setting("ar-gallery-options", "ar_galleries");
	}
	
	add_action('admin_init', 'ar_options');

}
