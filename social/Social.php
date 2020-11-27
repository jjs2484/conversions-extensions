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
	/**
	 * Class constructor.
	 *
	 * @since 2020-11-23
	 */
	public function __construct() {
		add_action( 'conversions_footer_info', [ $this, 'footer_social_icons' ], 20 );
	}

	/**
	 * Return the social icon array.
	 *
	 * @since 2020-11-23
	 */
	public function get_social_icons() {
		$social_icons = get_theme_mod( 'conversions_social_icons' );
		$social_icons = json_decode( $social_icons );

		if ( ! $social_icons )
			return false;

		$has_social_icons = ( $social_icons[ 0 ]->icon_value != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

		if ( ! $has_social_icons )
			return false;

		return $social_icons;
	}

	/**
	 * Social icons output.
	 *
	 * @since 2020-11-23
	 */
	public function social_icons_content() {

		$social_icons = $this->get_social_icons();
		if ( ! $social_icons )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		// get option values and decode.
		$conversions_si         = get_theme_mod( 'conversions_social_icons' );
		$conversions_si_decoded = json_decode( $conversions_si );

		echo '<ul class="list-inline">';

		foreach ( $conversions_si_decoded as $repeater_item ) {

			// remove prefixes for titles and screen reader text.
			$find  = [ '/\bfas \b/', '/\bfab \b/', '/\bfar \b/', '/\bfa-\b/' ];
			$title = preg_replace( $find, '', $repeater_item->icon_value );

			// output the icon and link.
			echo sprintf(
				'<li class="list-inline-item"><a title="%1$s" href="%2$s" target="_blank"><i aria-hidden="true" class="%3$s"></i><span class="sr-only">%1$s</span></a></li>',
				esc_attr( $title ),
				esc_url( $repeater_item->link ),
				esc_attr( $repeater_item->icon_value )
			);
		}

		echo '</ul>';

		$content = ob_get_contents();
		ob_clean();
		return $content;
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
		$footer_social_icons .= $this->social_icons_content();
		$footer_social_icons .= '</div>';

		// Apply filter if exists.
		if ( has_filter( 'conversions_footer_social_icons' ) ) {
			$footer_social_icons = apply_filters( 'conversions_footer_social_icons', $footer_social_icons );
		}

		echo $footer_social_icons; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in social_icons_content

	}
}
