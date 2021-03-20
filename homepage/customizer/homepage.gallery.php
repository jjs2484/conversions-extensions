<?php
/**
 * Gallery customizer section
 *
 * @package conversions
 */

$wp_customize->add_section(
	'conversions_homepage_gallery',
	[
		'title'      => __( 'Gallery', 'conversions' ),
		'priority'   => 55,
		'capability' => 'edit_theme_options',
		'panel'      => 'conversions_homepage',
	]
);
$wp_customize->add_setting(
	'conversions_gallery_bg_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_gallery_bg_color_control',
	[
		'label'       => __( 'Background color', 'conversions' ),
		'description' => __( 'Gallery section background color.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_bg_color',
		'priority'    => 10,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_gallery_title',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	]
);
$wp_customize->add_control(
	'conversions_gallery_title_control',
	[
		'label'       => __( 'Title', 'conversions' ),
		'description' => __( 'Add your title.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_title',
		'priority'    => 20,
		'type'        => 'text',
	]
);
$wp_customize->add_setting(
	'conversions_gallery_title_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_gallery_title_color_control',
	[
		'label'       => __( 'Title color', 'conversions' ),
		'description' => __( 'Select a color for the title.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_title_color',
		'priority'    => 30,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_gallery_desc',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_kses_post',
		'capability'        => 'edit_theme_options',
	]
);
$wp_customize->add_control(
	'conversions_gallery_desc',
	[
		'label'       => __( 'Description', 'conversions' ),
		'description' => __( 'Add some description text. HTML is allowed.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_desc',
		'priority'    => 40,
		'type'        => 'textarea',
	]
);
$wp_customize->add_setting(
	'conversions_gallery_desc_color',
	[
		'default'           => '',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]
);
$wp_customize->add_control(
	'conversions_gallery_desc_color_control',
	[
		'label'       => __( 'Description color', 'conversions' ),
		'description' => __( 'Select a color for the description text.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_desc_color',
		'priority'    => 50,
		'type'        => 'color',
	]
);
$wp_customize->add_setting(
	'conversions_gallery_respond',
	[
		'default'           => 'auto',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'conversions_ext_sanitize_select',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
	]
);
$wp_customize->add_control(
	new \WP_Customize_Control(
		$wp_customize,
		'conversions_gallery_respond',
		[
			'label'       => __( 'Responsive', 'conversions' ),
			'description' => __( 'Select auto or manual item breakpoints.', 'conversions' ),
			'section'     => 'conversions_homepage_gallery',
			'settings'    => 'conversions_gallery_respond',
			'type'        => 'select',
			'choices'     => [
				'auto'   => __( 'Auto', 'conversions' ),
				'manual' => __( 'Manual', 'conversions' ),
			],
			'priority'    => '51',
		]
	)
);
$wp_customize->add_setting(
	'conversions_gallery_xs',
	[
		'default'           => '2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_gallery_xs_control',
	[
		'label'       => __( '# of items on extra small screens', 'conversions' ),
		'description' => __( 'Items to show up to 576px. Choose 1-6.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_xs',
		'priority'    => 52,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 6,
		],
	]
);
$wp_customize->add_setting(
	'conversions_gallery_sm',
	[
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_gallery_sm_control',
	[
		'label'       => __( '# of items on small screens', 'conversions' ),
		'description' => __( 'Items to show 576px to 767px. Choose 1-6.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_sm',
		'priority'    => 60,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 6,
		],
	]
);
$wp_customize->add_setting(
	'conversions_gallery_md',
	[
		'default'           => '4',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_gallery_md_control',
	[
		'label'       => __( '# of items on medium screens', 'conversions' ),
		'description' => __( 'Items to show 768px to 991px. Choose 1-6.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_md',
		'priority'    => 70,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 6,
		],
	]
);
$wp_customize->add_setting(
	'conversions_gallery_lg',
	[
		'default'           => '6',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	]
);
$wp_customize->add_control(
	'conversions_gallery_lg_control',
	[
		'label'       => __( '# of items on large screens', 'conversions' ),
		'description' => __( 'Items to show 992px up. Choose 1-6.', 'conversions' ),
		'section'     => 'conversions_homepage_gallery',
		'settings'    => 'conversions_gallery_lg',
		'priority'    => 80,
		'type'        => 'number',
		'input_attrs' => [
			'min' => 1,
			'max' => 6,
		],
	]
);
$wp_customize->add_setting(
	'conversions_gallery_images',
	[
		'default'           => [],
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'wp_parse_id_list',
	]
);
$wp_customize->add_control(
	new \conversions\extensions\gallery\Gallery(
		$wp_customize,
		'conversions_gallery_images',
		[
			'label'    => __( 'Image Gallery', 'conversions' ),
			'section'  => 'conversions_homepage_gallery',
			'priority' => 90,
			'settings' => 'conversions_gallery_images',
			'type'     => 'image_gallery',
		]
	)
);
