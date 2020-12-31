<?php
/*
Plugin Name:  Braftonium Plugin
Plugin URI:   https://github.com/BraftonSupport/braftonium-plugin/
Description:  Adds Custom Post Types, Custom Widget Areas, and adds Google Analytics
Version:	  .3
Author: Brafton
Author URI: http://www.brafton.com
License:	  GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: braftonium
*/

//stop direct access
if ( ! defined( 'ABSPATH' ) )  exit;

// register_activation_hook( __FILE__, 'pluginprefix_function_to_run' );

// internationalization
// load_plugin_textdomain('braftonium_plugin', false, basename( dirname( __FILE__ ) ) . '/translations' );

// get acf, see if plugin exists
require_once ABSPATH . 'wp-content/plugins/advanced-custom-fields-pro/acf.php';

// Getting the post types file
require_once( 'posttypes.php' );

// make acf options
if(!function_exists("acf_add_local_field_group")){
	_e( "Hey, do you have the ACF plugin? You don\'t need to activate it but it\'ll be nice if it was there.", "braftonium" );
} else {
	acf_add_local_field_group(array(
		'key' => 'group_5a4e8d955ca61',
		'title' => 'Braftonium Plugin Options',
		'fields' => array(
			array(
				'key' => 'field_5a4e8e5a65363',
				'label' => __( "Google Analytics", "braftonium" ),
				'name' => 'google_analytics',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'UA-xxxxxxxx-xx',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array( //this is an otpion that prob should be in the theme not the plugin.
				'key' => 'field_5a7e8e5a75373',
				'label' => __( "Google Map API Key", "braftonium" ),
				'name' => 'google_map_api',
				'type' => 'text',
				'instructions' => 'If you need an API key go to <a href="https://developers.google.com/maps/documentation/embed/get-api-key" target="_blank">this page</a> and get yourself a key. Click the "Get Started" button, click Maps, Routes, Places, and press Continue. Select a new project and follow the instructions to set up your billing information. Copy and paste the API key there.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5a4e8f8065367',
				'label' => __( "Extra Widget Areas", "braftonium" ),
				'name' => 'extra_widget_areas',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'header' => __( "Header", "braftonium" ),
					'page' => __( "Page Sidebar", "braftonium" ),
					'blog' => __( "Blog Sidebar", "braftonium" ),
					'resources' => __( "Resources Sidebar", "braftonium" ),
					'footer' => __( "Footer Widget Area", "braftonium" ),
				),
				'allow_custom' => 1,
				'save_custom' => 1,
				'default_value' => array(
					0 => 'footer',
				),
				'layout' => 'horizontal',
				'toggle' => 0,
				'return_format' => 'value',
			),
			array(
				'key' => 'field_5a8f488bf8df7',
				'label' => __( "Custom Post Types", "braftonium" ),
				'name' => 'custom_post_types',
				'type' => 'checkbox',
				'instructions' => __( 'Adding \'testimonial\', \'event\', and \'team-member\' will automatically add accompanying options.', 'braftonium' ),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'testimonial' => __( 'Testimonial', 'braftonium' ), // @todo need to build default template for testimonials archive rather than use the default archive.php file
					'event' => __( 'Event', 'braftonium' ), // @todo need to build default template for event archive rather than use the default archive.php file
					'team-member' => __( 'Team Member', 'braftonium' ), // @todo need to build default template for team member archive rather than use the default archive.php file
				),
				'allow_custom' => 1,
				'save_custom' => 1,
				'default_value' => array(
				),
				'layout' => 'horizontal',
				'toggle' => 0,
				'return_format' => 'value',
			),
			array(
				'key' => 'field_5a4e8f8665367',
				'label' => __( "Resources - Optional Second Taxonomy", "braftonium" ),
				'name' => 'resource_tax2',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
				),
				'allow_null' => 0,
				'other_choice' => 1,
				'save_other_choice' => 1,
				'default_value' => '',
				'layout' => 'horizontal',
				'return_format' => 'value',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'braftonium_plugin',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	acf_add_local_field_group(array(
		'key' => 'group_5f91eb67e46c6',
		'title' => 'Resources Options',
		'fields' => array(
			array(
				'key' => 'field_5f91eb7562df6',
				'label' => 'Resources Banner',
				'name' => 'resources_banner',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'braftonium_resources_plugin',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
}

// make setting page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> __( 'Braftonium Plugin Options', 'braftonium' ),
		'menu_title'	=> __( 'Braftonium Options', 'braftonium' ),
		'menu_slug' 	=> 'braftonium_plugin',
		'capability'	=> 'edit_posts',
		'parent_slug'	=> 'themes.php',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
        'page_title' 	=> __( 'Braftonium Resource Options', 'braftonium' ),
		'menu_title'	=> __( 'Braftonium Resource Options', 'braftonium' ),
		'menu_slug' 	=> 'braftonium_resources_plugin',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'parent_slug'    => 'edit.php?post_type=resources',
    ));
}

// Add GA
$brafton_ga = sanitize_html_class(get_field('google_analytics', 'option'));
if( !empty($brafton_ga) && !function_exists('braftonium_google_analytics') ) {
function braftonium_google_analytics() {
    global $brafton_ga;
    echo "<!-- Google Analytics -->
	<script async src='https://www.googletagmanager.com/gtag/js?id=${brafton_ga}'\></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', '${brafton_ga}');
	</script>
	<!-- End Google Analytics -->";
}
add_action( 'wp_head', 'braftonium_google_analytics', 10 );
}
function modify_resource_content($content){
	if(is_singular('resources')){
		global $post;
		$display = get_field('display_resource', $post->ID);
		if($display){
			$download_link = get_field('resource_file');
			$url = $download_link['url'];
			$embed = sprintf('<iframe src="%s" class="display-resource"></iframe>', $url);
			$content .= $embed;
		}
	}
	return $content;
}
add_filter('the_content', 'modify_resource_content');
// Add Google map api key
$google_api = sanitize_html_class(get_field('google_map_api', 'option'));
if( !empty($google_api) && !function_exists('my_acf_init') ) {
	function my_acf_init() {
		global $google_api;
		acf_update_setting('google_api_key', $google_api);
	}
	add_action('acf/init', 'my_acf_init');
	function braftonium_google_maps_api() {
		global $google_api;
		echo '<script src="https://maps.googleapis.com/maps/api/js?key='.$google_api.'"></script>';
	}
	add_action( 'wp_head', 'braftonium_google_maps_api', 9 );
}

function braftonium_resource_excerpt($output){
	return $output;
}
/**
 * Register widget areas.
 */

function braftonium_morewidgets_init() {

	$widgetareas = get_field('extra_widget_areas', 'option');
	if( is_array($widgetareas) ):
		if( !in_array('footer', $widgetareas) ):
			unregister_sidebar( 'footer-left' );
			unregister_sidebar( 'footer-middle' );
			unregister_sidebar( 'footer-right' );
			unregister_sidebar( 'footer-last' );
		endif;
		foreach( $widgetareas as $widgetarea ):
			if ($widgetarea !== 'footer'):
				register_sidebar( array(
					'name'		  => ucwords(sanitize_text_field($widgetarea)).' '.__( 'Sidebar', 'braftonium' ),
					'id'			=> sanitize_title($widgetarea).'-sidebar',
					'description'   => ucwords(sanitize_text_field($widgetarea)).' '.__( 'widget area.', 'braftonium' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="h3 widget-title">',
					'after_title'   => '</h2>',
				) );
			endif;
		endforeach;
	endif;
}
add_action( 'widgets_init', 'braftonium_morewidgets_init' );

// register_deactivation_hook?
?>
