<?php
/**
 * Homepage Testimonials customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_testimonials',
	[
		'title'      => __( 'Testimonials', 'conversions' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_testimonials_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_testimonials_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Testimonials section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_testimonials',
		'settings'    => 'conversions_testimonials_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_testimonials_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_testimonials_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_testimonials',
		'settings'    => 'conversions_testimonials_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_testimonials_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_testimonials_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_testimonials',
		'settings'    => 'conversions_testimonials_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_testimonials_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		'capability'        => 'edit_theme_options',
	]
);
$wp_customize->add_control(
	'conversions_testimonials_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_testimonials',
		'settings'    => 'conversions_testimonials_desc',
		'priority'    => 40,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_testimonials_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_testimonials_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_testimonials',
		'settings'    => 'conversions_testimonials_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_testimonials_random',
	[
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_testimonials_random',
		[
			'label'       => __( 'Shuffle', 'conversions' ),
			'description' => __( 'Select yes or no to shuffle the testimonial output on each page load.', 'conversions' ),
			'section'     => 'conversions_homepage_testimonials',
			'settings'    => 'conversions_testimonials_random',
			'type'        => 'select',
			'choices'     => [
				'yes' => __( 'Yes', 'conversions' ),
				'no'  => __( 'No', 'conversions' ),
			],
			'priority'    => '55',
		]
	)
);
$wp_customize->add_setting(
	'conversions_testimonials_repeater',
	[
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \conversions\extensions\repeater\Repeater(
		$wp_customize,
		'conversions_testimonials_repeater',
		[
			'label'                                => __( 'Testimonials', 'conversions' ),
			'section'                              => 'conversions_homepage_testimonials',
			'priority'                             => 60,
			'customizer_repeater_title_control'    => true,
			'customizer_repeater_subtitle_control' => true,
			'customizer_repeater_text_control'     => true,
		]
	)
);
