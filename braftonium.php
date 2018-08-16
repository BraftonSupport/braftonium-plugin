<?php
/*
Plugin Name:  Braftonium Plugin
Plugin URI:   https://github.com/BraftonSupport/braftonium-plugin/
Description:  Adds Custom Post Types, Custom Widget Areas, and adds Google Analytics
Version:	  .2
Author: Brafton
Author URI: http://www.brafton.com
License:	  GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: braftonium
*/

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
					'testimonial' => __( 'Testimonial', 'braftonium' ),
					'event' => __( 'Event', 'braftonium' ),
					'team_member' => __( 'Team Member', 'braftonium' ),
				),
				'allow_custom' => 1,
				'save_custom' => 1,
				'default_value' => array(
				),
				'layout' => 'horizontal',
				'toggle' => 0,
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
}

// Add GA
$brafton_ga = sanitize_html_class(get_field('google_analytics', 'option'));
if( isset($brafton_ga) && !function_exists('braftonium_google_analytics') ) {
function braftonium_google_analytics() {
    global $brafton_ga;
    echo "<!-- Google Analytics -->
	<script>
		window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
		ga('create', '". $brafton_ga ."', 'auto');
		ga('send', 'pageview');
	</script>
	<script async src='https://www.google-analytics.com/analytics.js'></script>
	<!-- End Google Analytics -->";
}
add_action( 'wp_head', 'braftonium_google_analytics', 10 );
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
		endif;
		foreach( $widgetareas as $widgetarea ):
			if ($widgetarea !== 'footer'):
				register_sidebar( array(
					'name'		  => ucwords(sanitize_title($widgetarea)).' '.__( 'Sidebar', 'braftonium' ),
					'id'			=> sanitize_title($widgetarea).'-sidebar',
					'description'   => ucwords(sanitize_title($widgetarea)).' '.__( 'widget area.', 'braftonium' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );
			endif;
		endforeach;
	endif;
}
add_action( 'widgets_init', 'braftonium_morewidgets_init' );

// register_deactivation_hook?
?>