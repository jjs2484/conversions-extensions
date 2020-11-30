<?php
/**
 * Social icons customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_social',
	[
		'title'      => __( 'Social Icons', 'conversions' ),
		'priority'   => 48,
		'capability' => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_social_navbar',
	[
		'default'           => false,
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_sanitize_checkbox',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_social_navbar',
		[
			'label'       => __( 'Show in navbar?', 'conversions' ),
			'description' => __( 'Check to add social icons to the navbar.', 'conversions' ),
			'section'     => 'conversions_social',
			'settings'    => 'conversions_social_navbar',
			'type'        => 'checkbox',
			'priority'    => '8',
		]
	)
);
$wp_customize->add_setting(
	'conversions_social_footer',
	[
		'default'           => false,
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_sanitize_checkbox',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_social_footer',
		[
			'label'       => __( 'Show in footer?', 'conversions' ),
			'description' => __( 'Check to add social icons to the footer.', 'conversions' ),
			'section'     => 'conversions_social',
			'settings'    => 'conversions_social_footer',
			'type'        => 'checkbox',
			'priority'    => '9',
		]
	)
);
$wp_customize->add_setting(
	'conversions_social_size',
	[
		'default'           => '1.5',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_sanitize_float',
	]
);
$wp_customize->add_control(
	'conversions_social_size_control',
	[
		'label'       => __( 'Social icon size', 'conversions' ),
		'description' => __( 'Icon size in rem', 'conversions' ),
		'section'     => 'conversions_social',
		'settings'    => 'conversions_social_size',
		'priority'    => 10,
		'type'        => 'number',
		'input_attrs' => [
			'min'  => 0,
			'max'  => 100,
			'step' => 0.1,
		],
	]
);
$wp_customize->add_setting(
	'conversions_social_icons',
	[
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \conversions\extensions\repeater\Repeater(
		$wp_customize,
		'conversions_social_icons',
		[
			'label'                            => __( 'Icons', 'conversions' ),
			'section'                          => 'conversions_social',
			'priority'                         => 20,
			'customizer_repeater_icon_control' => true,
			'customizer_repeater_link_control' => true,
		]
	)
);
