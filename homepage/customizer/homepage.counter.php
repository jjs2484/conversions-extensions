<?php
/**
 * Homepage Counter customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_counter',
	[
		'title'      => __( 'Counter', 'conversions' ),
		'priority'   => 30,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_counter_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_counter_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Counter section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_counter_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_counter_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_counter_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_counter_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_counter_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		'capability'        => 'edit_theme_options',
	]
);
$wp_customize->add_control(
	'conversions_counter_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_desc',
		'priority'    => 40,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_counter_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_counter_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_counter_sm',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_counter_sm_control',
	[
		'label'       => __( '# of items on small screens', 'conversions' ),
		'description' => __( 'Items to show 576px to 767px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_sm',
		'priority'    => 60,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_counter_md',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_counter_md_control',
	[
		'label'       => __( '# of items on medium screens', 'conversions' ),
		'description' => __( 'Items to show 768px to 991px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_md',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_counter_lg',
	[
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_counter_lg_control',
	[
		'label'       => __( '# of items on large screens', 'conversions' ),
		'description' => __( 'Items to show 992px up. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_counter',
		'settings'    => 'conversions_counter_lg',
		'priority'    => 80,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_counter_animation',
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
		'conversions_counter_animation',
		[
			'label'       => __( 'Add counter animation', 'conversions' ),
			'description' => __( 'Check to add count up animation when elements are in the viewport.', 'conversions' ),
			'section'     => 'conversions_homepage_counter',
			'settings'    => 'conversions_counter_animation',
			'type'        => 'checkbox',
			'priority'    => '85',
		]
	)
);
$wp_customize->add_setting(
	'conversions_counter_blocks',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \conversions\extensions\repeater\Repeater(
		$wp_customize,
		'conversions_counter_blocks',
		[
			'label'                                 => __( 'Counter block', 'conversions' ),
			'section'                               => 'conversions_homepage_counter',
			'priority'                              => 90,
			'customizer_repeater_icon_control'      => true,
			'customizer_repeater_color_control'     => true,
			'customizer_repeater_title_control'     => true,
			'customizer_repeater_subtitle_control'  => true,
			'customizer_repeater_subtitle2_control' => true,
			'customizer_repeater_text_control'      => true,
		]
	)
);
