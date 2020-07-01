<?php
/* Custom Post Types */
//stop direct access
if ( ! defined( 'ABSPATH' ) )  exit;

/**
 * Register Post Types.
 */
if (function_exists ('get_field')){
	$custom_post_types = get_field('custom_post_types', 'option');
	if(!is_array($custom_post_types)){
		$custom_post_types = [];
	}
	$custom_post_types[] = 'resources';
}
function braftonium_posttypes_init() {
	global $custom_post_types;
	if( $custom_post_types ):
	foreach( $custom_post_types as $custom_post_type ):
		//replace any whitespaces with dashes for machine slug
		$custom_post_slug = sanitize_html_class(strtolower(str_replace(' ', '-', $custom_post_type)));
		//replace any dashes(-) with whitespace
		$custom_post_santype = ucwords(str_replace('-', ' ', $custom_post_slug));
		//replace any underscores(_) with whitespace
		$custom_post_santype = ucwords(str_replace('_', ' ', $custom_post_santype));
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
				'show_in_rest'		=> true,
				'rewrite'			=> array(
					'with_front'	=> false
				),
				'show_in_nav_menus' => true,
				'hierarchical'		=> true,
				'publicly_queryable' => true,
				'supports'			=> array( 'title', 'excerpt', 'editor', 'thumbnail', 'revisions', )
			);
			$posttypes_args = apply_filters('braftonium_modify_custom_post_type',$posttypes_args, $custom_post_type);
			register_post_type($custom_post_slug, $posttypes_args);
		endforeach;
	endif;
}
add_action( 'init', 'braftonium_posttypes_init' );

function resources_tax() {
	$labels = array(
		'name' => _x( 'Resource Types', 'taxonomy general name' ),
		'singular_name' => _x( 'Resource Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Resource Types', 'taxonomy search items' ),
		'all_items' => __( 'All Resource Types', 'taxonomy all items' ),
		'edit_item' => __( 'Edit Resource Type', 'taxonomy edit item' ), 
		'update_item' => __( 'Update Resource Type', 'taxonomy update item' ),
		'add_new_item' => __( 'Add New Resource Type', 'taxonomy add new' ),
		'new_item_name' => __( 'New Resource Type', 'taxonomy new item' ),
	);
	register_taxonomy('resource-type', 'resources', array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest'	=> true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'resource-type' ),
	));
	register_taxonomy_for_object_type( 'resource-type', 'resources' );
	if (function_exists ('get_field')){
		$resource_tax2 = sanitize_html_class(get_field('resource_tax2', 'option'));
	}
	if (!empty($resource_tax2)):
		$labels = array(
			'name' => ucwords($resource_tax2),
		);
		register_taxonomy($resource_tax2, 'resources', array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_rest'		=> true,
			'query_var' => true,
			'rewrite' => array( 'slug' => $resource_tax2 ),
		));
		register_taxonomy_for_object_type( $resource_tax2, 'resources' );
	endif;
}
add_action( 'init', 'resources_tax' );

function template_chooser($template) {
  if( $_GET['post_type']=='resources' ) {
    $template = dirname( __FILE__ ) . '/custom-post-types/resources/archive-resources.php';
  }   
  return $template;   
}
add_filter('template_include', 'template_chooser');  

function get_custom_post_type_template( $archive_template ) {
	global $post;
	if ( is_post_type_archive ( 'resources' ) && !file_exists(get_theme_file_path('archive-resources.php')) ) {
		
			 $archive_template = dirname( __FILE__ ) . '/custom-post-types/resources/archive-resources.php';
	}
	return $archive_template;
}
add_filter( 'archive_template', 'get_custom_post_type_template' ) ;

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


if ( is_array($custom_post_types) && in_array('testimonial', $custom_post_types) ) {
	require_once 'custom-post-types/testimonials/testimonials.acf.php';
	wp_enqueue_style( 'style', plugin_dir_url( __FILE__ ).'custom-post-types/testimonials/style.css');
}
if ( is_array($custom_post_types) &&  in_array('event', $custom_post_types) ) {
	require_once 'custom-post-types/events/events.acf.php';
}
if ( is_array($custom_post_types) &&  in_array('team-member', $custom_post_types) ) {
	require_once 'custom-post-types/team/team.acf.php';
}

if ( is_array($custom_post_types) && in_array('resources', $custom_post_types) ) {
	wp_enqueue_style( 'style', plugin_dir_url( __FILE__ ).'custom-post-types/resources/style.css');
	require_once 'custom-post-types/resources/resources.acf.php';

}