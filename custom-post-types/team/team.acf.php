<?php

//stop direct access
if ( ! defined( 'ABSPATH' ) )  exit;
add_action('acf/init', 'braftonium_team_fields');
function braftonium_team_fields(){
	acf_add_local_field_group(array(
		'key' => 'group_5a905e927edba',
		'title' => __( 'Team Member Details', 'braftonium' ),
		'fields' => array(
			array(
				'key' => 'field_5a905f64f0245',
				'label' => __( 'Job Title', 'braftonium' ),
				'name' => 'job_title',
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
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team-member',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
}