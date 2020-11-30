<?php
/**
 * Navbar Variants functions
 *
 * @package conversions
 */

namespace conversions\extensions\navbar;

/**
 * Navbar Variants class.
 *
 * Contains Navbar functions.
 *
 * @since 2020-04-26
 */
class Navbar_Variants {

	// Use the social icons trait.
	use \conversions\extensions\social\social_icons;

	/**
	 * Class constructor.
	 *
	 * @since 2020-04-26
	 */
	public function __construct() {
		add_filter( 'conversions_nav_open_wrapper', [ $this, 'navbar_open_filter' ] );
		add_filter( 'conversions_nav_close_wrapper', [ $this, 'navbar_close_filter' ] );
		add_filter( 'conversions_nav_branding_output', [ $this, 'navbar_branding_filter' ] );
		add_filter( 'conversions_navbar_menu', [ $this, 'navbar_menu_filter' ] );
	}

	/**
	 * Navbar opening divs filter.
	 *
	 * @since 2020-04-26
	 * @param string $navbar_open navbar opening divs.
	 */
	public function navbar_open_filter( $navbar_open ) {
		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) !== 'right' ) {
			$navbar_open = '<nav class="navbar navbar-expand-lg navbar-below navbar-light bg-white">';
		}

		return $navbar_open;
	}

	/**
	 * Navbar closing divs filter.
	 *
	 * @since 2020-04-26
	 * @param string $navbar_close navbar closing divs.
	 */
	public function navbar_close_filter( $navbar_close ) {
		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) !== 'right' ) {
			$navbar_close = '</nav>';
		}

		return $navbar_close;
	}

	/**
	 * Navbar branding output filter.
	 *
	 * @since 2020-04-26
	 * @param string $navbar_branding navbar branding HTML.
	 */
	public function navbar_branding_filter( $navbar_branding ) {

		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) !== 'right' ) {

			// Navbar brand text if blog is homepage.
			$brand_blog_home = sprintf(
				'<h1 class="navbar-brand mb-0"><a rel="home" href="%s" title="%s" itemprop="url">%s</a></h1>',
				esc_url( home_url( '/' ) ),
				esc_attr( get_bloginfo( 'name', 'display' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);

			// Navbar brand text.
			$brand_text = sprintf(
				'<a class="navbar-brand" rel="home" href="%s" title="%s" itemprop="url">%s</a>',
				esc_url( home_url( '/' ) ),
				esc_attr( get_bloginfo( 'name', 'display' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);

			// If no custom logo output blog name.
			if ( ! has_custom_logo() ) {
				if ( is_front_page() && is_home() ) {
					$navbar_branding  = '<div class="navbar-below-branding">';
					$navbar_branding .= '<div class="container-fluid">';
					$navbar_branding .= $brand_blog_home; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= $this->navbar_below_extras(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= \conversions\Navbar::conversions_navbar_toggler(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= '</div>';
					$navbar_branding .= '</div>';
				} else {
					$navbar_branding  = '<div class="navbar-below-branding">';
					$navbar_branding .= '<div class="container-fluid">';
					$navbar_branding .= $brand_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= $this->navbar_below_extras(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= \conversions\Navbar::conversions_navbar_toggler(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= '</div>';
					$navbar_branding .= '</div>';
				}
			} else {
				$navbar_branding  = '<div class="navbar-below-branding">';
				$navbar_branding .= '<div class="container-fluid">';
				$navbar_branding .= get_custom_logo();
				$navbar_branding .= $this->navbar_below_extras(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$navbar_branding .= \conversions\Navbar::conversions_navbar_toggler(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$navbar_branding .= '</div>';
				$navbar_branding .= '</div>';
			}
		}

		return $navbar_branding;
	}

	/**
	 * Navbar menu filter.
	 *
	 * @since 2020-11-28
	 * @param string $menu navbar menu.
	 */
	public function navbar_menu_filter( $menu ) {

		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) !== 'right' ) {

			$navbar_color_scheme = implode( ' ', \conversions\Navbar::conversions_navbar_color() );
			$open                = '<div class="' . esc_attr( $navbar_color_scheme ) . ' navbar-below-menu">';
			$open               .= '<div class="container-fluid">';
			$close               = '</div>';
			$close              .= '</div>';

			$menu = $open . $menu . $close;
		}

		return $menu;
	}

	/**
	 * Navbar below cart, search, button, etc.
	 *
	 * @since 2020-04-26
	 */
	public function navbar_below_extras() {

		// Create empty string variable to add active elements to.
		$items = '';

		$woocommerce = \conversions\Navbar::conversions_navbar_woocommerce();
		$edd         = \conversions\Navbar::conversions_navbar_edd();
		$bbpress     = \conversions\Navbar::conversions_navbar_bbp();
		$search      = \conversions\Navbar::conversions_navbar_search();
		$button      = \conversions\Navbar::conversions_navbar_button();

		if ( ! empty( $woocommerce ) ) {
			$items .= $woocommerce;
		}

		if ( ! empty( $edd ) ) {
			$items .= $edd;
		}

		if ( ! empty( $bbpress ) ) {
			$items .= $bbpress;
		}

		if ( ! empty( $search ) ) {
			$items .= $search;
		}

		if ( get_theme_mod( 'conversions_social_navbar', false ) === true ) {
			$navbar_social_icons = $this->social_icons_content();
			$navbar_social_icons = str_replace( 'list-inline-item', 'c-social-icons--navbar list-inline-item', $navbar_social_icons );
			$navbar_social_icons = str_replace( '<a title=', '<a class="nav-link" title=', $navbar_social_icons );

			if ( ! empty( $navbar_social_icons ) ) {
				$items .= $navbar_social_icons;
			}
		}

		if ( ! empty( $button ) ) {
			$items .= $button;
		}

		// If not empty change item classes and add wrapper.
		if ( ! empty( $items ) ) {
			$items = str_replace( 'menu-item nav-item', 'list-inline-item', $items );
			$items = '<ul class="list-inline nav-extras">' . $items . '</ul>';
		}

		// Check for filter before output.
		if ( has_filter( 'conversions_navbar_below_extras' ) ) {
			$items = apply_filters( 'conversions_navbar_below_extras', $items );
		}

		return $items;
	}
}
