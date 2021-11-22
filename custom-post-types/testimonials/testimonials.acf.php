<?php

//stop direct access
if ( ! defined( 'ABSPATH' ) )  exit;

add_action('acf/init', 'braftonium_testimonial_fields');
function braftonium_testimonial_fields(){
	register_field_group(array (
		'id' => 'acf_testimonials',
		'title' => __( 'Testimonials', 'braftonium' ),
		'fields' => array (
			array (
				'key' => 'field_5925fb3a1d91d',
				'label' => __( 'Name', 'braftonium' ),
				'name' => 'name',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5925fb4e1d91e',
				'label' => __( 'Position', 'braftonium' ),
				'name' => 'position',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5925fb581d91f',
				'label' => __( 'Company', 'braftonium' ),
				'name' => 'company',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5925fb5f1d920',
				'label' => __( 'Location', 'braftonium' ),
				'name' => 'location',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_website',
				'label' => __( 'Website', 'braftonium' ),
				'name' => 'website',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'testimonial',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}