<?php
/**
 * Homepage FAQ customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_faq',
	[
		'title'      => __( 'FAQ', 'conversions' ),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_faq_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_faq_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'faq section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_faq',
		'settings'    => 'conversions_faq_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_faq_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_faq_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_faq',
		'settings'    => 'conversions_faq_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_faq_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_faq_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_faq',
		'settings'    => 'conversions_faq_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_faq_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_faq_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_faq',
		'settings'    => 'conversions_faq_desc',
		'priority'    => 40,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_faq_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_faq_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_faq',
		'settings'    => 'conversions_faq_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_faq_repeater',
	[
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \conversions\extensions\repeater\Repeater(
		$wp_customize,
		'conversions_faq_repeater',
		[
			'label'                             => __( 'FAQ', 'conversions' ),
			'section'                           => 'conversions_homepage_faq',
			'priority'                          => 60,
			'customizer_repeater_title_control' => true,
			'customizer_repeater_text_control'  => true,
		]
	)
);
