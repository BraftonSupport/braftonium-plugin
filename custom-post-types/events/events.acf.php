<?php
	register_field_group(array (
		'id' => 'acf_events',
		'title' => __( 'Events', 'braftonium' ),
		'fields' => array (
			array (
				'key' => 'field_5925f6ba0e510',
				'label' => __( 'Start Date', 'braftonium' ),
				'name' => 'start_date',
				'type' => 'date_picker',
				'instructions' => __( 'If both start date and end date are left blank, you have the choice of "TBD" or "Various Dates".', 'braftonium' ),
				'date_format' => 'yymmdd',
				'display_format' => 'mm/dd/yy',
				'first_day' => 0,
			),
			array (
				'key' => 'field_597a6e194269f',
				'label' => __( 'End Date', 'braftonium' ),
				'name' => 'end_date',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'mm/dd/yy',
				'first_day' => 0,
			),
			array (
				'key' => 'field_597f75fe4d7bd',
				'label' => __( 'Date Text', 'braftonium' ),
				'name' => 'date_text',
				'type' => 'radio',
				'choices' => array (
					'tbd' => __( 'TBD', 'braftonium' ),
					'various' => __( 'Various Dates', 'braftonium' ),
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5925f7ba0e511',
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
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
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