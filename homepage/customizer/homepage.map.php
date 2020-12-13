<?php
/**
 * Map customizer section
 *
 * @since 2020-11-08
 * @package conversions-extensions
 */

$wp_customize->add_section(
	'conversions_homepage_map',
	[
		'title'      => __( 'Google Map', 'conversions' ),
		'priority'   => 55,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_map_bg',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_map_bg_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Map section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_bg',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_map_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_map_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_map_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_map_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_map_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_map_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_desc',
		'priority'    => 40,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_map_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_map_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_map_content_type',
	[
		'default'           => 'map',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_map_content_type',
		[
			'label'       => __( 'Map type', 'conversions' ),
			'description' => __( 'Select a map type to display.', 'conversions' ),
			'section'     => 'conversions_homepage_map',
			'settings'    => 'conversions_map_content_type',
			'type'        => 'select',
			'choices'     => [
				'map'           => __( 'Regular map', 'conversions' ),
				'map_text'      => __( 'Map and text', 'conversions' ),
				'map_html'      => __( 'Map and HTML', 'conversions' ),
				'map_shortcode' => __( 'Map and shortcode', 'conversions' ),
			],
			'priority'    => '60',
		]
	)
);
$wp_customize->add_setting(
	'conversions_map_map',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_map_map',
	[
		'label'       => __( 'Google Map embed code', 'conversions' ),
		'description' => __( 'Use the following instructions to get the embed code: <a href="https://wordpress.com/support/google-maps/#embedding-a-google-map" target="_blank">Embedding a Google Map</a>', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_map',
		'priority'    => 70,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_map_text',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_map_text',
	[
		'label'       => __( 'Text', 'conversions' ),
		'description' => __( 'Add text to display aside the map.', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_text',
		'priority'    => 80,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_map_html',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_map_html',
	[
		'label'       => __( 'HTML', 'conversions' ),
		'description' => __( 'Add HTML to display aside the map.', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_html',
		'priority'    => 90,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_map_shortcode',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_map_shortcode_control',
	[
		'label'       => __( 'Shortcode', 'conversions' ),
		'description' => __( 'Add a shortcode to display aside the map (ex. contact form).', 'conversions' ),
		'section'     => 'conversions_homepage_map',
		'settings'    => 'conversions_map_shortcode',
		'priority'    => 100,
		'type'        => 'text',
	]
);
