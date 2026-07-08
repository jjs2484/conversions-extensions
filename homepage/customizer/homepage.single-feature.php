<?php
/**
 * Single Feature customizer section
 *
 * @since 2020-09-16
 * @package conversions-extensions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wp_customize->add_section(
	'conversions_homepage_single_feature',
	[
		'title'      => __( 'Single feature', 'conversions-extensions' ),
		'priority'   => 81,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_bg',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_bg_control',
	[
		'label'       => __( 'Background color', 'conversions-extensions' ),
		'description' => __( 'Single feature section background color.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_bg',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_title_control',
	[
		'label'       => __( 'Title', 'conversions-extensions' ),
		'description' => __( 'Add your title.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the title.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_desc',
	[
		'label'       => __( 'Description', 'conversions-extensions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_desc',
		'priority'    => 40,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions-extensions' ),
		'description' => __( 'Select a color for the description text.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_desc_color',
		'priority'    => 45,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_media_type',
	[
		'default'           => 'image',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_single_feature_media_type',
		[
			'label'       => __( 'Media type', 'conversions-extensions' ),
			'description' => __( 'Select to display an image, youtube video, vimeo, or shortcode.', 'conversions-extensions' ),
			'section'     => 'conversions_homepage_single_feature',
			'settings'    => 'conversions_single_feature_media_type',
			'type'        => 'select',
			'choices'     => [
				'image'     => __( 'Image', 'conversions-extensions' ),
				'youtube'   => __( 'YouTube Video ID', 'conversions-extensions' ),
				'vimeo'     => __( 'Vimeo Video ID', 'conversions-extensions' ),
				'shortcode' => __( 'Shortcode', 'conversions-extensions' ),
			],
			'priority'    => '50',
		]
	)
);
$wp_customize->add_setting(
	'conversions_single_feature_img_id',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	new WP_Customize_Media_Control(
		$wp_customize,
		'conversions_single_feature_img_id',
		[
			'label'     => __( 'Upload image', 'conversions-extensions' ),
			'section'   => 'conversions_homepage_single_feature',
			'settings'  => 'conversions_single_feature_img_id',
			'priority'  => 50,
			'mime_type' => 'image',
		]
	)
);
$wp_customize->add_setting(
	'conversions_single_feature_youtube',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_youtube_control',
	[
		'label'       => __( 'YouTube Video ID', 'conversions-extensions' ),
		'description' => __( 'Example: _sI_Ps7JSEk', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_youtube',
		'priority'    => 60,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_vimeo',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_vimeo',
	[
		'label'       => __( 'Vimeo Video ID', 'conversions-extensions' ),
		'description' => __( 'Example: 361687086', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_vimeo',
		'priority'    => 70,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_single_feature_shortcode',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
	]
);
$wp_customize->add_control(
	'conversions_single_feature_shortcode_control',
	[
		'label'       => __( 'Shortcode', 'conversions-extensions' ),
		'description' => __( 'Add your shortcode.', 'conversions-extensions' ),
		'section'     => 'conversions_homepage_single_feature',
		'settings'    => 'conversions_single_feature_shortcode',
		'priority'    => 80,
		'type'        => 'text',
	]
);
