<?php
/**
 * Social icons trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\social;

trait social_icons {

	/**
	 * Return the social icon array.
	 *
	 * @since 2020-11-23
	 */
	public static function get_social_icons() {
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
	public static function social_icons_content() {

		$social_icons = static::get_social_icons();
		if ( ! $social_icons )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		// get option values and decode.
		$conversions_si         = get_theme_mod( 'conversions_social_icons' );
		$conversions_si_decoded = json_decode( $conversions_si );

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

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}
}
