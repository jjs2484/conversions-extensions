<?php
/**
 * Social icon functions
 *
 * @package conversions
 */

namespace conversions\extensions\social;

/**
 * Social class.
 *
 * Contains Social icon functions.
 *
 * @since 2020-11-22
 */
class Social {

	// Use the social icons trait.
	use social_icons;

	/**
	 * Class constructor.
	 *
	 * @since 2020-11-23
	 */
	public function __construct() {
		add_action( 'conversions_footer_info', [ $this, 'footer_social_icons' ], 20 );
	}

	/**
	 * Footer social icons output.
	 *
	 * @since 2020-11-23
	 */
	public function footer_social_icons() {

		$social_icons = $this->get_social_icons();
		if ( ! $social_icons || get_theme_mod( 'conversions_social_footer', false ) !== true )
			return;

		$footer_social_icons  = '<div class="c-social-icons social-media-icons col-md">';
		$footer_social_icons .= '<ul class="list-inline">';
		$footer_social_icons .= $this->social_icons_content();
		$footer_social_icons .= '</ul>';
		$footer_social_icons .= '</div>';

		// Apply filter if exists.
		if ( has_filter( 'conversions_footer_social_icons' ) ) {
			$footer_social_icons = apply_filters( 'conversions_footer_social_icons', $footer_social_icons );
		}

		echo $footer_social_icons; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in social_icons_content

	}
}
