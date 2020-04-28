<?php
/**
 * Navbar customizer section
 *
 * @package conversions
 */

// Create our settings.
$wp_customize->add_setting(
	'conversions_nav_layout',
	[
		'default'           => 'right',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_nav_layout',
		[
			'label'       => __( 'Navbar layout', 'conversions' ),
			'description' => __( 'Select the Navbar layout.', 'conversions' ),
			'section'     => 'conversions_nav',
			'settings'    => 'conversions_nav_layout',
			'type'        => 'select',
			'choices'     => [
				'right' => __( 'Logo left, navbar right', 'conversions' ),
				'below' => __( 'Logo left, navbar below', 'conversions' ),
			],
			'priority'    => '7',
		]
	)
);
$wp_customize->add_setting(
	'conversions_branding_tbpadding',
	[
		'default'           => '.5',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_sanitize_float',
	]
);
$wp_customize->add_control(
	'conversions_branding_tbpadding_control',
	[
		'label'       => __( 'Branding padding', 'conversions' ),
		'description' => __( 'Top and bottom padding in rem.', 'conversions' ),
		'section'     => 'conversions_nav',
		'settings'    => 'conversions_branding_tbpadding',
		'priority'    => 21,
		'type'        => 'number',
		'input_attrs' => [
			'min'  => 0,
			'max'  => 100,
			'step' => 0.1,
		],
	]
);
