<?php
/**
 * Text section customizer section
 *
 * @since 2020-06-27
 * @package conversions-extensions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wp_customize->add_section(
	'conversions_homepage_text',
	[
		'title'      => __( 'Text', 'conversions-extensions' ),
		'priority'   => 130,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_text_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_text_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions-extensions' ),
		'description' => __( 'Text section background color.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_text',
		'settings'    => 'conversions_text_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_text_section_align',
	[
		'default'           => 'center',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_text_section_align',
		[
			'label'       => __( 'Text alignment', 'conversions-extensions' ),
			'description' => __( 'Select the text alignment.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_text',
			'settings'    => 'conversions_text_section_align',
			'type'        => 'select',
			'choices'     => [
				'left'   => __( 'Left', 'conversions-extensions' ),
				'center' => __( 'Center', 'conversions-extensions' ),
				'right'  => __( 'Right', 'conversions-extensions' ),
			],
			'priority'    => '15',
		]
	)
);
$wp_customize->add_setting(
	'conversions_text_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_text_title_control',
	[
		'label'       => __( 'Title', 'conversions-extensions' ),
		'description' => __( 'Add your title.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_text',
		'settings'    => 'conversions_text_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_text_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_text_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the title.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_text',
		'settings'    => 'conversions_text_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_text_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		'capability'        => 'edit_theme_options',
	]
);
$wp_customize->add_control(
	'conversions_text_desc',
	[
		'label'       => __( 'Description', 'conversions-extensions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_text',
		'settings'    => 'conversions_text_desc',
		'priority'    => 40,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_text_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_text_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the description text.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_text',
		'settings'    => 'conversions_text_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
