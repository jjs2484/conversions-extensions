<?php
/**
 * Homepage customizer section
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wp_customize->add_panel(
	'conversions_homepage',
	[
		'priority'    => 43,
		'title'       => __( 'Homepage Design', 'conversions-extensions' ),
		'description' => __( 'Settings for the Homepage template', 'conversions-extensions' ),
		'capability'  => 'edit_theme_options',
	]
);
