<?php
/* Custom Post Types */
//stop direct access
if ( ! defined( 'ABSPATH' ) )  exit;

/**
 * Register Post Types.
 */
if (function_exists ('get_field')){
	$custom_post_types = get_field('custom_post_types', 'option');
}
function braftonium_posttypes_init() {
	global $custom_post_types;
	if( $custom_post_types ):
	foreach( $custom_post_types as $custom_post_type ):
		$custom_post_santype = ucfirst(sanitize_text_field($custom_post_type));
		$custom_post_slug = str_replace(' ', '-', $custom_post_santype);
			$posttypes_labels = array(
				'name'				=> $custom_post_santype,
				'singular_name'		=> $custom_post_santype,
				'menu_name'			=> $custom_post_santype,
				'add_new_item'		=> __( 'Add New', 'braftonium' ).' '.$custom_post_santype,
			);
			$posttypes_args = array(
				'labels'			=> $posttypes_labels,
				'menu_icon'			=> 'dashicons-star-filled',
				'public'			=> true,
				'capability_type'	=> 'page',
				'has_archive'		=> true,
				'hierarchical'		=> true,
				'supports'			=> array( 'title', 'excerpt', 'editor', 'thumbnail', 'revisions', )
			);
			register_post_type($custom_post_slug, $posttypes_args);
			
			if ( $custom_post_type=='testimonial' ) {
				include_once '/custom-post-types/testimonials/testimonials.acf.php';
				wp_enqueue_style( 'style', plugin_dir_path().'/custom-post-types/testimonials/style.css', false, '1.0.0' );
			}
			if ( $custom_post_type=='event' ) {
				include_once '/custom-post-types/events/events.acf.php';
			}
			if ( $custom_post_type=='team_member' ) {
				include_once '/custom-post-types/team/team.acf.php';
			}

		endforeach;
	endif;
}
add_action( 'init', 'braftonium_posttypes_init' );


function braftonium_posttypes_install() {
	// trigger our function that registers the custom post type
	braftonium_posttypes_init();
 
	// clear the permalinks after the post type has been registered
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'braftonium_posttypes_install' );


// // register_deactivation_hook( __FILE__, 'pluginprefix_function_to_run' );
function braftonium_deactivation() {
	// unregister the post type, so the rules are no longer in memory
	
	global $custom_post_types;
	if( $custom_post_types ):
	foreach( $custom_post_types as $custom_post_type ):
		unregister_post_type( $custom_post_type );
	endforeach;
	endif;
	// clear the permalinks to remove our post type's rules from the database
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'braftonium_deactivation' );