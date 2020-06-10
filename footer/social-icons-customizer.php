<?php
/**
 * Footer social customizer options
 *
 * @package conversions
 */

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
		'section'     => 'conversions_footer',
		'settings'    => 'conversions_social_size',
		'priority'    => 70,
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
			'section'                          => 'conversions_footer',
			'priority'                         => 80,
			'customizer_repeater_icon_control' => true,
			'customizer_repeater_link_control' => true,
		]
	)
);
