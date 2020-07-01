<?php 
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5efcd6049bb9b',
	'title' => 'Resource',
	'fields' => array(
		array(
			'key' => 'field_5efcd61481bd9',
			'label' => 'Resource File',
			'name' => 'resource_file',
			'type' => 'file',
			'instructions' => 'Resource to be downloaded and/or Displayed. You may omit this and simply use a download form or embeed the resource in the content manually.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5efcd66281bda',
			'label' => 'Direct Download',
			'name' => 'direct_download',
			'type' => 'true_false',
			'instructions' => 'Download Resource from Resource Archive page rather than navigating to single resource page via "Download" Button. Clicking on the resource title will still navigate to single resource page for SEO value.',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5efcd61481bd9',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5efcd6fd81bdb',
			'label' => 'Display Resource',
			'name' => 'display_resource',
			'type' => 'true_false',
			'instructions' => 'Display resource on single resource page after page content.',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5efcd61481bd9',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'resources',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
?>