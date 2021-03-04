<?php
/**
 * Homepage Hero customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_hero',
	[
		'title'      => __( 'Hero', 'conversions' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_hh_type',
	[
		'default'           => 'full',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_type',
		[
			'label'       => __( 'Hero type', 'conversions' ),
			'description' => __( 'Select the hero display type.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_type',
			'type'        => 'select',
			'choices'     => [
				'full'  => __( 'Full', 'conversions' ),
				'split' => __( 'Split', 'conversions' ),
			],
			'priority'    => '10',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_split_type',
	[
		'default'           => 'square',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_split_type',
		[
			'label'       => __( 'Split hero type', 'conversions' ),
			'description' => __( 'Select the split hero display type.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_split_type',
			'type'        => 'select',
			'choices'     => [
				'square'    => __( 'Square', 'conversions' ),
				'blob-1'    => __( 'Blob 1', 'conversions' ),
				'brush-1'   => __( 'Brush 1', 'conversions' ),
				'brush-2'   => __( 'Brush 2', 'conversions' ),
				'brush-3'   => __( 'Brush 3', 'conversions' ),
				'frame-1'   => __( 'Frame 1', 'conversions' ),
				'frame-2'   => __( 'Frame 2', 'conversions' ),
				'frame-3'   => __( 'Frame 3', 'conversions' ),
				'grunge-1'  => __( 'Grunge 1', 'conversions' ),
				'grunge-2'  => __( 'Grunge 2', 'conversions' ),
				'grunge-3'  => __( 'Grunge 3', 'conversions' ),
				'striped-1' => __( 'Striped 1', 'conversions' ),
				'heart'     => __( 'Heart', 'conversions' ),
				'drop'      => __( 'Drop', 'conversions' ),
				'diamond'   => __( 'Diamond', 'conversions' ),
				'hexagon'   => __( 'Hexagon', 'conversions' ),
			],
			'priority'    => '20',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_img_height',
	[
		'default'           => '72',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_hh_img_height_control',
	[
		'label'       => __( 'Hero image height', 'conversions' ),
		'description' => __( 'Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_img_height',
		'priority'    => 30,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 100,
		],
	]
);
$wp_customize->add_setting(
	'conversions_hh_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hh_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Select a color for the background.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_bg_color',
		'priority'    => 35,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hh_img_color',
	[
		'default'           => '#000000',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hh_img_color_control',
	[
		'label'       => __( 'Image overlay color', 'conversions' ),
		'description' => __( 'Select a color for the image overlay.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_img_color',
		'priority'    => 40,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hh_img_overlay',
	[
		'default'           => '.5',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_img_overlay',
		[
			'label'       => __( 'Image overlay opacity', 'conversions' ),
			'description' => __( 'Lighten or darken the hero image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_img_overlay',
			'type'        => 'select',
			'choices'     => [
				'0'  => __( '0%', 'conversions' ),
				'.1' => __( '10%', 'conversions' ),
				'.2' => __( '20%', 'conversions' ),
				'.3' => __( '30%', 'conversions' ),
				'.4' => __( '40%', 'conversions' ),
				'.5' => __( '50%', 'conversions' ),
				'.6' => __( '60%', 'conversions' ),
				'.7' => __( '70%', 'conversions' ),
				'.8' => __( '80%', 'conversions' ),
				'.9' => __( '90%', 'conversions' ),
				'1'  => __( '100%', 'conversions' ),
			],
			'priority'    => '50',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_content_position',
	[
		'default'           => 'col-lg-6',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_content_position',
		[
			'label'       => __( 'Content position', 'conversions' ),
			'description' => __( 'Select the content display position.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_content_position',
			'type'        => 'select',
			'choices'     => [
				'col-lg-6' => __( 'Left', 'conversions' ),
				'col-lg-10 d-flex flex-column text-center mx-auto' => __( 'Center', 'conversions' ),
			],
			'priority'    => '60',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_title',
	[
		'default'           => 'page',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_title',
		[
			'label'       => __( 'Hero title', 'conversions' ),
			'description' => __( 'Use the default WordPress page title or add a new title.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_title',
			'type'        => 'select',
			'choices'     => [
				'page' => __( 'WordPress page title', 'conversions' ),
				'alt'  => __( 'Add new title', 'conversions' ),
			],
			'priority'    => '70',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_alt_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		'capability'        => 'edit_theme_options',
	]
);
$wp_customize->add_control(
	'conversions_hh_alt_title',
	[
		'label'       => __( 'New hero title', 'conversions' ),
		'description' => __( 'Add a new hero title. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_alt_title',
		'priority'    => 80,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_hh_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hh_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_title_color',
		'priority'    => 90,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hh_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		'capability'        => 'edit_theme_options',
	]
);
$wp_customize->add_control(
	'conversions_hh_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_desc',
		'priority'    => 100,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_hh_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_hh_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_desc_color',
		'priority'    => 110,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_hh_button',
	[
		'default'           => 'no',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_button',
		[
			'label'       => __( 'Callout button', 'conversions' ),
			'description' => __( 'Choose the type of button.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_button',
			'type'        => 'select',
			'choices'     => $conversions_customizer->alt_button_choices,
			'priority'    => '120',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_button_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_hh_button_text_control',
	[
		'label'       => __( 'Callout button text', 'conversions' ),
		'description' => __( 'Add text for button to display.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_button_text',
		'priority'    => 130,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_hh_button_url',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	]
);
$wp_customize->add_control(
	'conversions_hh_button_url_control',
	[
		'label'       => __( 'Callout button URL', 'conversions' ),
		'description' => __( 'Where should the button link to?', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_button_url',
		'priority'    => 140,
		'type'        => 'url',
	]
);
$wp_customize->add_setting(
	'conversions_hh_vbtn',
	[
		'default'           => 'no',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_hh_vbtn',
		[
			'label'       => __( 'Video modal button', 'conversions' ),
			'description' => __( 'Choose the type of button.', 'conversions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_vbtn',
			'type'        => 'select',
			'choices'     => [
				'no'        => __( 'None', 'conversions' ),
				'primary'   => __( 'Primary', 'conversions' ),
				'secondary' => __( 'Secondary', 'conversions' ),
				'success'   => __( 'Success', 'conversions' ),
				'danger'    => __( 'Danger', 'conversions' ),
				'warning'   => __( 'Warning', 'conversions' ),
				'info'      => __( 'Info', 'conversions' ),
				'light'     => __( 'Light', 'conversions' ),
				'dark'      => __( 'Dark', 'conversions' ),
			],
			'priority'    => '150',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_vbtn_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_hh_vbtn_text_control',
	[
		'label'       => __( 'Video button text', 'conversions' ),
		'description' => __( 'Text to display next to the video button.', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_vbtn_text',
		'priority'    => 160,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_hh_vbtn_url',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_hh_vbtn_url_control',
	[
		'label'       => __( 'YouTube Video ID', 'conversions' ),
		'description' => __( 'Example: _sI_Ps7JSEk', 'conversions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_vbtn_url',
		'priority'    => 170,
		'type'        => 'text',
	]
);
