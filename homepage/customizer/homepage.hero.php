<?php
/**
 * Homepage Hero customizer section
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wp_customize->add_section(
	'conversions_homepage_hero',
	[
		'title'      => __( 'Hero', 'conversions-extensions' ),
		'priority'   => 11,
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
			'label'       => __( 'Hero type', 'conversions-extensions' ),
			'description' => __( 'Select the hero display type.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_type',
			'type'        => 'select',
			'choices'     => [
				'full'  => __( 'Full', 'conversions-extensions' ),
				'split' => __( 'Split', 'conversions-extensions' ),
			],
			'priority'    => '10',
		]
	)
);
$wp_customize->add_setting(
	'conversions_hh_split_type',
	[
		'default'           => 'grunge-1',
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
			'label'       => __( 'Split hero type', 'conversions-extensions' ),
			'description' => __( 'Select the split hero display type.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_split_type',
			'type'        => 'select',
			'choices'     => [
				'square'    => __( 'Square', 'conversions-extensions' ),
				'blob-1'    => __( 'Blob 1', 'conversions-extensions' ),
				'blob-2'    => __( 'Blob 2', 'conversions-extensions' ),
				'blob-3'    => __( 'Blob 3', 'conversions-extensions' ),
				'brush-1'   => __( 'Brush 1', 'conversions-extensions' ),
				'brush-2'   => __( 'Brush 2', 'conversions-extensions' ),
				'diamond'   => __( 'Diamond', 'conversions-extensions' ),
				'drop'      => __( 'Drop', 'conversions-extensions' ),
				'frame-1'   => __( 'Frame 1', 'conversions-extensions' ),
				'frame-2'   => __( 'Frame 2', 'conversions-extensions' ),
				'frame-3'   => __( 'Frame 3', 'conversions-extensions' ),
				'frame-4'   => __( 'Frame 4', 'conversions-extensions' ),
				'grunge-1'  => __( 'Grunge 1', 'conversions-extensions' ),
				'grunge-2'  => __( 'Grunge 2', 'conversions-extensions' ),
				'heart'     => __( 'Heart', 'conversions-extensions' ),
				'hexagon'   => __( 'Hexagon', 'conversions-extensions' ),
				'liquid-1'  => __( 'Liquid 1', 'conversions-extensions' ),
				'shatter'   => __( 'Shatter', 'conversions-extensions' ),
				'shield'    => __( 'Shield', 'conversions-extensions' ),
				'star'      => __( 'Star', 'conversions-extensions' ),
				'striped-1' => __( 'Striped 1', 'conversions-extensions' ),
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
		'label'       => __( 'Hero image height', 'conversions-extensions' ),
		'description' => __( 'Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions-extensions' ),
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
		'label'       => __( 'Background color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the background.', 'conversions-extensions' ),
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
		'label'       => __( 'Image overlay color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the image overlay.', 'conversions-extensions' ),
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
			'label'       => __( 'Image overlay opacity', 'conversions-extensions' ),
			'description' => __( 'Lighten or darken the hero image overlay. Set the contrast high enough so the text is readable.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_img_overlay',
			'type'        => 'select',
			'choices'     => [
				'0'  => __( '0%', 'conversions-extensions' ),
				'.1' => __( '10%', 'conversions-extensions' ),
				'.2' => __( '20%', 'conversions-extensions' ),
				'.3' => __( '30%', 'conversions-extensions' ),
				'.4' => __( '40%', 'conversions-extensions' ),
				'.5' => __( '50%', 'conversions-extensions' ),
				'.6' => __( '60%', 'conversions-extensions' ),
				'.7' => __( '70%', 'conversions-extensions' ),
				'.8' => __( '80%', 'conversions-extensions' ),
				'.9' => __( '90%', 'conversions-extensions' ),
				'1'  => __( '100%', 'conversions-extensions' ),
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
			'label'       => __( 'Content position', 'conversions-extensions' ),
			'description' => __( 'Select the content display position.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_content_position',
			'type'        => 'select',
			'choices'     => [
				'col-lg-6' => __( 'Left', 'conversions-extensions' ),
				'col-lg-10 d-flex flex-column text-center mx-auto' => __( 'Center', 'conversions-extensions' ),
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
			'label'       => __( 'Hero title', 'conversions-extensions' ),
			'description' => __( 'Use the default WordPress page title or add a new title.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_title',
			'type'        => 'select',
			'choices'     => [
				'page' => __( 'WordPress page title', 'conversions-extensions' ),
				'alt'  => __( 'Add new title', 'conversions-extensions' ),
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
		'label'       => __( 'New hero title', 'conversions-extensions' ),
		'description' => __( 'Add a new hero title. HTML is allowed.', 'conversions-extensions' ),
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
		'label'       => __( 'Title color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the title.', 'conversions-extensions' ),
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
		'label'       => __( 'Description', 'conversions-extensions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions-extensions' ),
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
		'label'       => __( 'Description color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the description text.', 'conversions-extensions' ),
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
			'label'       => __( 'Callout button', 'conversions-extensions' ),
			'description' => __( 'Choose the type of button.', 'conversions-extensions' ),
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
		'label'       => __( 'Callout button text', 'conversions-extensions' ),
		'description' => __( 'Add text for button to display.', 'conversions-extensions' ),
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
		'label'       => __( 'Callout button URL', 'conversions-extensions' ),
		'description' => __( 'Where should the button link to?', 'conversions-extensions' ),
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
			'label'       => __( 'Video modal button', 'conversions-extensions' ),
			'description' => __( 'Choose the type of button.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_hero',
			'settings'    => 'conversions_hh_vbtn',
			'type'        => 'select',
			'choices'     => [
				'no'        => __( 'None', 'conversions-extensions' ),
				'primary'   => __( 'Primary', 'conversions-extensions' ),
				'secondary' => __( 'Secondary', 'conversions-extensions' ),
				'success'   => __( 'Success', 'conversions-extensions' ),
				'danger'    => __( 'Danger', 'conversions-extensions' ),
				'warning'   => __( 'Warning', 'conversions-extensions' ),
				'info'      => __( 'Info', 'conversions-extensions' ),
				'light'     => __( 'Light', 'conversions-extensions' ),
				'dark'      => __( 'Dark', 'conversions-extensions' ),
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
		'label'       => __( 'Video button text', 'conversions-extensions' ),
		'description' => __( 'Text to display next to the video button.', 'conversions-extensions' ),
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
		'label'       => __( 'YouTube Video ID', 'conversions-extensions' ),
		'description' => __( 'Example: _sI_Ps7JSEk', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_hero',
		'settings'    => 'conversions_hh_vbtn_url',
		'priority'    => 170,
		'type'        => 'text',
	]
);
