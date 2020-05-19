<?php
/**
 * Image Features customizer section
 *
 * @since 2020-05-09
 * @package conversions_addon_pack
 */

$wp_customize->add_section(
	'conversions_homepage_img_features',
	[
		'title'      => __( 'Image features', 'conversions' ),
		'priority'   => 31,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_img_features_bg',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_img_features_bg_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Image features section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_bg',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_img_features_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_filter_nohtml_kses',
	]
);
$wp_customize->add_control(
	'conversions_img_features_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_img_features_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_img_features_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_img_features_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_img_features_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_desc',
		'priority'    => 40,
		'type'        => 'textarea',
		'capability'  => 'edit_theme_options',
	]
);
$wp_customize->add_setting(
	'conversions_img_features_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_img_features_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_img_features_sm',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_img_features_sm_control',
	[
		'label'       => __( '# of items on small screens', 'conversions' ),
		'description' => __( 'Items to show 576px to 767px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_sm',
		'priority'    => 60,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_img_features_md',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_img_features_md_control',
	[
		'label'       => __( '# of items on medium screens', 'conversions' ),
		'description' => __( 'Items to show 768px to 991px. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_md',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_img_features_lg',
	[
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_img_features_lg_control',
	[
		'label'       => __( '# of items on large screens', 'conversions' ),
		'description' => __( 'Items to show 992px up. Choose 1-4.', 'conversions' ),
		'section'     => 'conversions_homepage_img_features',
		'settings'    => 'conversions_img_features_lg',
		'priority'    => 80,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 4,
		],
	]
);
$wp_customize->add_setting(
	'conversions_img_features_imgs',
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
		'conversions_img_features_imgs',
		[
			'label'                                => __( 'Icon block', 'conversions' ),
			'section'                              => 'conversions_homepage_img_features',
			'priority'                             => 90,
			'customizer_repeater_image_control'    => true,
			'customizer_repeater_title_control'    => true,
			'customizer_repeater_text_control'     => true,
			'customizer_repeater_linktext_control' => true,
			'customizer_repeater_link_control'     => true,
		]
	)
);
