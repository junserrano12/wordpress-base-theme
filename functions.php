<?php 
add_action('after_setup_theme','theme_setup', 15);
function theme_setup() {
    add_action('init', 'basetheme_head_cleanup');
	add_action('init', 'basetheme_setup_pages');
	add_action('init', 'basetheme_update_options');
	add_action('init', 'basetheme_navigation_menus');
	add_action('init', 'basetheme_custom_image_size');	
    add_action('wp_head', 'basetheme_remove_recent_comments_style', 1);
    add_action('init','basetheme_add_style');
	add_action('wp_enqueue_scripts', 'basetheme_add_scripts');
    add_action('widgets_init', 'basetheme_register_sidebars');
	add_action('widgets_init', 'basetheme_unregister_default_widgets', 11);
	add_action('admin_init', 'settings_init');
	add_action('admin_menu', 'settings_add_page');	
	add_action('wp_head', 'style_inline_hook');	
	add_action('admin_enqueue_scripts', 'settings_enqueue_scripts');	
	add_action('admin_footer', 'settings_script');
	add_action('add_meta_boxes', 'settings_add_custom_box');
	add_action('save_post', 'header_save_postdata');
	add_action('save_post', 'page_save_postdata');
	add_action('wp_ajax_header_form_content', 'header_form_content_callback');
	add_filter('wp_title', 'basetheme_wp_title', 10, 2 );
	add_filter('image_size_names_choose', 'basetheme_display_custom_image_size', 11, 1);
    add_filter('the_generator', 'basetheme_rss_version');
    add_filter('wp_head', 'basetheme_remove_wp_widget_recent_comments_style', 1 );
    add_filter('gallery_style', 'basetheme_gallery_style');
	add_filter('get_search_form', 'basetheme_wpsearch' );
    add_filter('the_content', 'basetheme_filter_ptags_on_images');
    add_filter('excerpt_more', 'basetheme_excerpt_more');	
	add_filter('upload_mimes', 'basetheme_custom_upload_mimes');
	add_filter('image_send_to_editor', 'basetheme_wrap_image', 10, 8);
	add_filter("attachment_fields_to_save", "rt_image_attachment_fields_to_save", null , 2);

	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'post-thumbnails' ); 
	add_theme_support( 'custom-header' ); 
	add_editor_style( 'css/editor-style.css' );
}

/********************************************************************/
/* MODULE 															*/
/********************************************************************/

/*Settings*/
include('module/settings.php');

/*General Settings*/
include('module/general-settings.php');

/*Style Settngs*/
include('module/style-settings.php');

/*Page Custom Field*/
include('module/page-custom-field.php');

/*Header Slider*/
include('module/header-slider.php');

/*Short Code*/
include('module/shortcode.php');

/*Sidebar Hooks*/
include('module/sidebar-hooks.php');

/*Widget*/
include('module/widget.php');

/*Login Page*/
include('module/login-page.php');

/*theme styles*/
include('module/theme-styles.php');

/*end of functions.php*/
?>
