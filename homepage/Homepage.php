<?php
/**
 * Homepage template functions.
 *
 * @package conversions
 */

namespace conversions\extensions\homepage;

/**
 * Class Homepage
 *
 * - Handles the display of the various homepage sections.
 *
 * @since 2019-12-16
 */
class Homepage {

	use sections\blank;
	use sections\clients;
	use sections\counter;
	use sections\edd;
	use sections\hero;
	use sections\icon_features;
	use sections\img_features;
	use sections\news;
	use sections\pricing;
	use sections\team;
	use sections\testimonials;
	use sections\text;
	use sections\woocommerce;

	/**
	 * The sections available.
	 *
	 * @since 2019-12-16
	 * @var array $sections
	 */
	public static $sections;

	/**
	 * The key where we store our data.
	 *
	 * @since 2019-12-16
	 * @var string $theme_mod_key
	 */
	public static $theme_mod_key = 'conversions_homepage_sorting';

	/**
	 * Class constructor.
	 *
	 * @since 2019-12-16
	 */
	public function __construct() {
		static::$sections = [
			'hero'         => [
				'title' => __( 'Hero', 'conversions' ),
			],
			'clients'      => [
				'title' => __( 'Clients', 'conversions' ),
			],
			'counter'      => [
				'title' => __( 'Counter', 'conversions' ),
			],
			'features'     => [
				'title' => __( 'Icon features', 'conversions' ),
			],
			'img_features' => [
				'title' => __( 'Image features', 'conversions' ),
			],
			'woocommerce'  => [
				'title' => __( 'WooCommerce', 'conversions' ),
			],
			'edd'          => [
				'title' => __( 'Easy Digital Downloads', 'conversions' ),
			],
			'pricing'      => [
				'title' => __( 'Pricing', 'conversions' ),
			],
			'team'         => [
				'title' => __( 'Team', 'conversions' ),
			],
			'testimonials' => [
				'title' => __( 'Testimonials', 'conversions' ),
			],
			'text'         => [
				'title' => __( 'Text', 'conversions' ),
			],
			'news'         => [
				'title' => __( 'News', 'conversions' ),
			],
			'blank'        => [
				'title' => __( 'Blank', 'conversions' ),
			],
		];

		if ( ! class_exists( 'woocommerce' ) ) {
			unset( static::$sections[ 'woocommerce' ] );
		}

		if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
			unset( static::$sections[ 'edd' ] );
		}

		$this->add_sections();
		add_action( 'get_header', [ $this, 'add_sections' ] );
		add_filter( 'customize_register', [ $this, 'customize_register' ] );
	}

	/**
	 * Adds the homepage sections to the homepage action.
	 *
	 * @since 2019-12-16
	 */
	public function add_sections() {
		remove_all_actions( 'homepage' );

		$sections = static::get_sorted_sections();
		$counter  = 1;
		foreach ( $sections as $section_id => $section ) {
			if ( isset( $section[ 'disabled' ] ) )
				continue;
			$cc = $this;
			if ( isset( $section[ 'callback_class' ] ) )
				$cc = $section[ 'callback_class' ];
			add_action( 'homepage', [ $cc, $section_id ], $counter * 100 );
			$counter++;
		}
	}

	/**
	 * Add ourselves to the customizer.
	 *
	 * @since 2019-12-16
	 *
	 * @param object $wp_customize The Customizer object.
	 */
	public function customize_register( $wp_customize ) {
		$wp_customize->add_section(
			static::$theme_mod_key,
			[
				'panel'    => 'conversions_homepage',
				'priority' => 1,
				'title'    => __( 'Homepage Sorting', 'conversions' ),
			]
		);

		$wp_customize->add_setting(
			static::$theme_mod_key,
			[
				'capability'        => 'edit_theme_options',
				'default'           => get_theme_mod( static::$theme_mod_key ),
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			]
		);

		// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require_once __DIR__ . '/class-homepage-sorting-customizer-control.php';
		// phpcs:enable

		$theme = wp_get_theme();

		$wp_customize->add_control(
			new Homepage_Sorting_Customizer_Control(
				$wp_customize,
				static::$theme_mod_key,
				[
					'priority' => 10,
					'section'  => static::$theme_mod_key,
					'settings' => static::$theme_mod_key,
					'type'     => 'hidden',
				]
			)
		);
	}

	/**
	 * Return all available sections.
	 *
	 * @since 2020-03-28
	 */
	public static function get_sections() {
		$sections = static::$sections;
		$sections = apply_filters( 'conversions_get_sections', $sections );
		return $sections;
	}

	/**
	 * Return the sections array but sorted as per the user's sorting.
	 *
	 * @since 2019-12-16
	 */
	public static function get_sorted_sections() {
		$sections = static::get_sections();
		$options  = get_theme_mod( static::$theme_mod_key );

		if ( $options != '' ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
			$options      = explode( ',', $options );
			$new_sections = [];
			foreach ( $options as $section ) {
				if ( isset( $sections[ $section ] ) ) {
					$new_sections[ $section ] = $sections[ $section ];
					unset( $sections[ $section ] );
				}
			}

			// Add whatever sections are left as disabled at the end.
			foreach ( $sections as $section_id => $section ) {
				$section[ 'disabled' ]       = true;
				$new_sections[ $section_id ] = $section;
			}
			$sections = $new_sections;
		}

		return $sections;
	}
}
