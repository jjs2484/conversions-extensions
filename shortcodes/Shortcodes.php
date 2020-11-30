<?php
/**
 * Shortcodes functions
 *
 * @package conversions
 */

namespace conversions\extensions\shortcodes;

/**
 * Shortcodes class.
 *
 * Contains Shortcodes functions.
 *
 * @since 2020-08-22
 */
class Shortcodes {

	// Use the social icons trait.
	use \conversions\extensions\social\social_icons;

	/**
	 * Class constructor.
	 *
	 * @since 2020-08-22
	 */
	public function __construct() {
		add_shortcode( 'conversions_clients', [ $this, 'conversions_clients_shortcode' ] );
		add_shortcode( 'conversions_counter', [ $this, 'conversions_counter_shortcode' ] );
		add_shortcode( 'conversions_faq', [ $this, 'conversions_faq_shortcode' ] );
		add_shortcode( 'conversions_google_map', [ $this, 'conversions_google_map_shortcode' ] );
		add_shortcode( 'conversions_icon_features', [ $this, 'conversions_icon_features_shortcode' ] );
		add_shortcode( 'conversions_img_features', [ $this, 'conversions_img_features_shortcode' ] );
		add_shortcode( 'conversions_single_feature', [ $this, 'conversions_single_feature_shortcode' ] );
		add_shortcode( 'conversions_pricing', [ $this, 'conversions_pricing_shortcode' ] );
		add_shortcode( 'conversions_social', [ $this, 'conversions_social_shortcode' ] );
		add_shortcode( 'conversions_team', [ $this, 'conversions_team_shortcode' ] );
		add_shortcode( 'conversions_testimonials', [ $this, 'conversions_testimonials_shortcode' ] );
	}

	/**
	 * Create clients carousel shortcode.
	 *
	 * Shortcode: [conversions_clients]
	 *
	 * @since 2020-08-22
	 */
	public function conversions_clients_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-clients c-shortcode mt-4 mb-4"><div class="row">' . $homepage->clients_content() . '</div></section>';
	}

	/**
	 * Create counter shortcode.
	 *
	 * Shortcode: [conversions_counter]
	 *
	 * @since 2020-08-22
	 */
	public function conversions_counter_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-counter c-shortcode mt-4 mb-2"><div class="row">' . $homepage->counter_content() . '</div></section>';
	}

	/**
	 * Create FAQ shortcode.
	 *
	 * Shortcode: [conversions_faq]
	 *
	 * @since 2020-09-06
	 */
	public function conversions_faq_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-faq c-shortcode mt-4 mb-2"><div class="row">' . $homepage->faq_content() . '</div></section>';
	}

	/**
	 * Create Map shortcode.
	 *
	 * Shortcode: [conversions_google_map]
	 *
	 * @since 2020-11-10
	 */
	public function conversions_google_map_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-map c-shortcode mt-4 mb-4">' . $homepage->map_content() . '</section>';
	}

	/**
	 * Create icon features shortcode.
	 *
	 * Shortcode: [conversions_icon_features]
	 *
	 * @since 2020-08-22
	 */
	public function conversions_icon_features_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-features c-shortcode mt-4 mb-2"><div class="row">' . $homepage->icon_features_content() . '</div></section>';
	}

	/**
	 * Create image features shortcode.
	 *
	 * Shortcode: [conversions_img_features]
	 *
	 * @since 2020-08-22
	 */
	public function conversions_img_features_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-img-features c-shortcode mt-4 mb-2"><div class="row">' . $homepage->img_features_content() . '</div></section>';
	}

	/**
	 * Create single feature shortcode.
	 *
	 * Shortcode: [conversions_single_feature]
	 *
	 * @since 2020-09-30
	 */
	public function conversions_single_feature_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-single-feature c-shortcode mt-4 mb-4"><div class="row">' . $homepage->single_feature_content() . '</div></section>';
	}

	/**
	 * Create pricing tables shortcode.
	 *
	 * Shortcode: [conversions_pricing]
	 *
	 * @since 2020-08-22
	 */
	public function conversions_pricing_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-pricing c-shortcode mt-4 mb-2"><div class="row">' . $homepage->pricing_content() . '</div></section>';
	}

	/**
	 * Create social icon shortcode.
	 *
	 * Shortcode: [conversions_social]
	 *
	 * @since 2020-11-23
	 */
	public function conversions_social_shortcode() {
		return '<div class="row c-social c-shortcode mt-4 mb-4"><div class="col-12 c-social-icons"><ul class="list-inline">' . $this->social_icons_content() . '</ul></div></div>';
	}

	/**
	 * Create team shortcode.
	 *
	 * Shortcode: [conversions_team]
	 *
	 * @since 2020-08-22
	 */
	public function conversions_team_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-team c-shortcode mt-4 mb-2"><div class="row">' . $homepage->team_content() . '</div></section>';
	}

	/**
	 * Create testimonials shortcode.
	 *
	 * Shortcode: [conversions_testimonials]
	 *
	 * @since 2020-08-22
	 */
	public function conversions_testimonials_shortcode() {
		$homepage = new \conversions\extensions\homepage\Homepage();
		return '<section class="c-testimonials c-shortcode mt-4 mb-2"><div class="row">' . $homepage->testimonials_content() . '</div></section>';
	}
}
