<?php
/**
 * Team customizer section
 *
 * @since 2020-05-24
 * @package conversions-extensions
 */

$wp_customize->add_section(
	'conversions_homepage_team',
	[
		'title'      => __( 'Team', 'conversions' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_team_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_team_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Team section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_team_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_team_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_team_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_team_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_team_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_team_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_desc',
		'priority'    => 40,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_team_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_team_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_team_sm',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_team_sm_control',
	[
		'label'       => __( '# of items on small screens', 'conversions' ),
		'description' => __( 'Items to show 576px to 767px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_sm',
		'priority'    => 60,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_team_md',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_team_md_control',
	[
		'label'       => __( '# of items on medium screens', 'conversions' ),
		'description' => __( 'Items to show 768px to 991px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_md',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_team_lg',
	[
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_team_lg_control',
	[
		'label'       => __( '# of items on large screens', 'conversions' ),
		'description' => __( 'Items to show 992px up. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_team',
		'settings'    => 'conversions_team_lg',
		'priority'    => 80,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_team_details',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'conversions_ext_repeater_sanitize',
	]
);
$wp_customize->add_control(
	new \Conversions_Repeater(
		$wp_customize,
		'conversions_team_details',
		[
			'label'                                => __( 'Team block', 'conversions' ),
			'section'                              => 'conversions_homepage_team',
			'priority'                             => 90,
			'customizer_repeater_image_control'    => true,
			'customizer_repeater_title_control'    => true,
			'customizer_repeater_subtitle_control' => true,
			'customizer_repeater_text_control'     => true,
			'customizer_social_repeater_control'   => true,
		]
	)
);
