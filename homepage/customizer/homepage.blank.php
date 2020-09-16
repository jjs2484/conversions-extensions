<?php
/**
 * Blank section customizer section
 *
 * @since 2020-03-25
 * @package conversions-extensions
 */

$wp_customize->add_section(
	'conversions_homepage_blank',
	[
		'title'      => __( 'HTML or Shortcode', 'conversions' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_blank_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_blank_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Blank section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_blank',
		'settings'    => 'conversions_blank_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_blank_content_position',
	[
		'default'           => 'flex-start',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_blank_content_position',
		[
			'label'       => __( 'Content alignment', 'conversions' ),
			'description' => __( 'Select the content alignment.', 'conversions' ),
			'section'     => 'conversions_homepage_blank',
			'settings'    => 'conversions_blank_content_position',
			'type'        => 'select',
			'choices'     => [
				'flex-start' => __( 'Left', 'conversions' ),
				'center'     => __( 'Center', 'conversions' ),
				'flex-end'   => __( 'Right', 'conversions' ),
			],
			'priority'    => '15',
		]
	)
);
$wp_customize->add_setting(
	'conversions_blank_content',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_blank_content',
	[
		'label'       => __( 'Content', 'conversions' ),
		'description' => __( 'Add some content. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_blank',
		'settings'    => 'conversions_blank_content',
		'priority'    => 20,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_blank_shortcode',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_blank_shortcode_control',
	[
		'label'       => __( 'Shortcode', 'conversions' ),
		'description' => __( 'Add your shortcode.', 'conversions' ),
		'section'     => 'conversions_homepage_blank',
		'settings'    => 'conversions_blank_shortcode',
		'priority'    => 30,
		'type'        => 'text',
	]
);
