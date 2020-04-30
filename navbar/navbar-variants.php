<?php
/**
 * Navbar Variants functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Navbar Variants class.
 *
 * Contains Navbar functions.
 *
 * @since 2020-04-26
 */
class Navbar_Variants {
	/**
	 * Class constructor.
	 *
	 * @since 2020-04-26
	 */
	public function __construct() {
		add_filter( 'conversions_nav_open_wrapper', [ $this, 'navbar_open_filter' ] );
		add_filter( 'conversions_nav_close_wrapper', [ $this, 'navbar_close_filter' ] );
		add_filter( 'conversions_nav_branding_output', [ $this, 'navbar_branding_filter' ] );
	}

	/**
	 * Navbar opening divs filter.
	 *
	 * @since 2020-04-26
	 * @param string $navbar_open navbar opening divs.
	 */
	public function navbar_open_filter( $navbar_open ) {
		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) != 'right' ) {
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
		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) != 'right' ) {
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

		if ( get_theme_mod( 'conversions_nav_layout', 'right' ) != 'right' ) {

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
					$navbar_branding .= Navbar::conversions_navbar_toggler(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= '</div>';
					$navbar_branding .= '</div>';
				} else {
					$navbar_branding  = '<div class="navbar-below-branding">';
					$navbar_branding .= '<div class="container-fluid">';
					$navbar_branding .= $brand_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= $this->navbar_below_extras(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= Navbar::conversions_navbar_toggler(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$navbar_branding .= '</div>';
					$navbar_branding .= '</div>';
				}
			} else {
				$navbar_branding  = '<div class="navbar-below-branding">';
				$navbar_branding .= '<div class="container-fluid">';
				$navbar_branding .= get_custom_logo();
				$navbar_branding .= $this->navbar_below_extras(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$navbar_branding .= Navbar::conversions_navbar_toggler(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$navbar_branding .= '</div>';
				$navbar_branding .= '</div>';
			}
		}

		return $navbar_branding;
	}

	/**
	 * Navbar below cart, search, button, etc.
	 *
	 * @since 2020-04-26
	 */
	public function navbar_below_extras() {

		// Is woocommerce is active?
		if ( class_exists( 'woocommerce' ) ) {

			// Append WooCommerce Cart icon?
			if ( get_theme_mod( 'conversions_wc_cart_nav', true ) === true ) {
				// output the cart icon with item count.
				$cart_link = sprintf(
					'<li class="cart list-inline-item">%s</li>',
					WooCommerce::get_cart_nav_html()
				);
				// Add the cart icon to the end of the menu.
				$items = $cart_link;
			}

			// Append WooCommerce Account icon?
			if ( get_theme_mod( 'conversions_wc_account', false ) === true ) {

				if ( is_user_logged_in() ) {
					$wc_al = __( 'My Account', 'conversions' );
				} else {
					$wc_al = __( 'Login / Register', 'conversions' );
				}
				// output the account icon if active.
				$wc_account_link = sprintf(
					'<li class="account-icon list-inline-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
					esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ),
					$wc_al
				);

				// Add the account to the end of the menu.
				$items .= $wc_account_link;
			}
		}

		// Is Easy Digital Downloads active?
		if ( class_exists( 'Easy_Digital_Downloads' ) ) {

			// Append Easy Digital Downloads Cart icon?
			if ( get_theme_mod( 'conversions_edd_nav_cart', true ) === true ) {

				$edd_cart_totals = sprintf(
					'<span class="header-cart edd-cart-quantity">%s</span><span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>',
					edd_get_cart_quantity()
				);

				// output the cart icon with item count.
				$edd_cart_link = sprintf(
					'<li class="cart list-inline-item"><a title="' . __( 'View your shopping cart', 'conversions' ) . '" class="cart-customlocation nav-link" href="%s"><i aria-hidden="true" class="fas fa-shopping-cart"></i>%s</a></li>',
					esc_url( edd_get_checkout_uri() ),
					$edd_cart_totals
				);

				// Add the cart icon to the end of the menu.
				$items .= $edd_cart_link;
			}

			// Append Easy Digital Downloads Account icon?
			if ( get_theme_mod( 'conversions_edd_nav_account', false ) === true ) {

				if ( is_user_logged_in() ) {
					$edd_al = __( 'My Account', 'conversions' );
				} else {
					$edd_al = __( 'Login / Register', 'conversions' );
				}
				// output the account icon if active.
				$edd_account_link = sprintf(
					'<li class="account-icon list-inline-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
					esc_url( edd_get_user_verification_page() ),
					$edd_al
				);

				// Add the account to the end of the menu.
				$items .= $edd_account_link;
			}
		}

		// Append Search Icon to nav? Separate function coversions_nav_search_modal adds modal html to footer.
		if ( get_theme_mod( 'conversions_nav_search_icon', false ) === true ) {
			$nav_search = sprintf(
				'<li class="search-icon list-inline-item"><a href="#csearchModal" data-toggle="modal" class="nav-link" title="%1$s"><i aria-hidden="true" class="fas fa-search"></i><span class="sr-only">%1$s</span></a></li>',
				__( 'Search', 'conversions' )
			);

			// Add the nav button to the end of the menu.
			$items .= $nav_search;
		}

		// Append Navigation Button?
		if ( get_theme_mod( 'conversions_nav_button', 'no' ) !== 'no' ) {

			$nav_btn_text = get_theme_mod( 'conversions_nav_button_text' );
			if ( empty( $nav_btn_text ) ) {
				$nav_btn_text = '';
			}
			$nav_btn_url = get_theme_mod( 'conversions_nav_button_url' );
			if ( empty( $nav_btn_url ) ) {
				$nav_btn_url = '';
			}

			$nav_button = sprintf(
				'<li class="nav-callout-button list-inline-item"><a title="%1$s" href="%2$s" class="btn %3$s">%1$s</a></li>',
				esc_html( $nav_btn_text ),
				esc_url( $nav_btn_url ),
				esc_attr( get_theme_mod( 'conversions_nav_button' ) )
			);

			// Add the nav button to the end of the menu.
			$items .= $nav_button;
		}

		// Check for filter.
		if ( has_filter( 'conversions_navbar_below_extras' ) ) {
			$items = apply_filters( 'conversions_navbar_below_extras', $items );
		}

		// If not empty add wrapper.
		if ( ! empty( $items ) ) {
			$items = '<ul class="list-inline nav-extras">' . $items . '</ul>';
		}

		return $items;
	}
}
new Navbar_Variants();
