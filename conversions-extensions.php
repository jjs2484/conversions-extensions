<?php
/**
 * Plugin Name: Conversions Extensions
 * Description: Adds homepage sections, setup wizard, and other extensions to Conversions WordPress theme.
 * Version: 2.2.4
 * Author: uniquelylost
 * Author URI: https://conversionswp.com
 * Text Domain: conversions
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package conversions-extensions
 */

namespace conversions\extensions {

	// Keep in sync with the version above.
	define( 'CONVERSIONS_EXTENSIONS_VERSION', '2.2.4' );

	/**
	 * Class Conversions_Extensions
	 */
	class Conversions_Extensions {

		/**
		 * The instance of the OCDI class.
		 *
		 * @since 2020-12-27
		 */
		public static $__ocdi;

		/**
		 * Class constructor.
		 *
		 * @since 2020-03-25
		 */
		public function __construct() {

			if ( ! static::theme_check() )
				return;

			add_action( 'conversions_customize_register', [ $this, 'conversions_customize_register' ] );
			add_action( 'wp_head', [ $this, 'wp_head' ], 99 );
			add_action( 'init', [ $this, 'setup' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
			add_action( 'customize_controls_enqueue_scripts', [ $this, 'customize_controls_enqueue_scripts' ] );
			add_filter( 'wp_kses_allowed_html', [ $this, 'allow_iframes_filter' ], 10, 2 );

			static::$__ocdi = new ocdi\OCDI();
		}

		/**
		 * Theme check.
		 *
		 * @since 2020-03-27
		 */
		public static function theme_check() {
			// Gets the current theme.
			$theme = wp_get_theme();

			// Check if Conversions is active or parent theme.
			if ( 'Conversions' == $theme->name || 'Conversions' == $theme->parent_theme ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
				return true;
			}
			return false;
		}

		/**
		 * Setup some theme options.
		 *
		 * @since 2019-08-18
		 */
		public function setup() {

			// Check if settings are set, if not set defaults.
			$defaults = [
				'conversions_social_footer'        => true,
				'conversions_social_size'          => '1.5',
				'conversions_hh_split_type'        => 'grunge-1',
				'conversions_hh_img_height'        => '72',
				'conversions_hh_content_position'  => 'col-lg-6',
				'conversions_hh_title'             => 'page',
				'conversions_hh_button'            => 'no',
				'conversions_hh_vbtn'              => 'no',
				'conversions_hc_logo_width'        => '8.5',
				'conversions_hc_respond'           => 'auto',
				'conversions_hc_sm'                => '2',
				'conversions_hc_md'                => '3',
				'conversions_hc_lg'                => '4',
				'conversions_hc_max'               => '5',
				'conversions_features_respond'     => 'auto',
				'conversions_features_sm'          => '2',
				'conversions_features_md'          => '2',
				'conversions_features_lg'          => '3',
				'conversions_img_features_respond' => 'auto',
				'conversions_img_features_sm'      => '2',
				'conversions_img_features_md'      => '2',
				'conversions_img_features_lg'      => '3',
				'conversions_team_respond'         => 'auto',
				'conversions_team_sm'              => '2',
				'conversions_team_md'              => '2',
				'conversions_team_lg'              => '3',
				'conversions_text_section_align'   => 'center',
				'conversions_pricing_respond'      => 'auto',
				'conversions_pricing_sm'           => '1',
				'conversions_pricing_md'           => '1',
				'conversions_pricing_lg'           => '3',
				'conversions_news_mposts'          => '2',
				'conversions_woo_products'         => 'no',
				'conversions_woo_product_limit'    => '8',
				'conversions_woo_product_columns'  => '4',
				'conversions_woo_products_order'   => 'popularity',
				'conversions_edd_products'         => 'no',
				'conversions_edd_product_limit'    => '6',
				'conversions_edd_product_columns'  => '3',
				'conversions_edd_products_orderby' => 'post_date',
				'conversions_edd_products_order'   => 'DESC',
				'conversions_counter_respond'      => 'auto',
				'conversions_counter_xs'           => '1',
				'conversions_counter_sm'           => '2',
				'conversions_counter_md'           => '2',
				'conversions_counter_lg'           => '4',
				'conversions_counter_animation'    => true,
				'conversions_map_content_type'     => 'map',
				'conversions_gallery_respond'      => 'auto',
				'conversions_gallery_xs'           => '2',
				'conversions_gallery_sm'           => '3',
				'conversions_gallery_md'           => '4',
				'conversions_gallery_lg'           => '6',
				'conversions_testimonials_random'  => 'yes',
			];

			foreach ( $defaults as $c => $v ) {
				if ( 'unset' == get_theme_mod( $c, 'unset' ) ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
					set_theme_mod( $c, $v );
				}
			}

			new homepage\Homepage();
			new navbar\Navbar_Variants();
			new shortcodes\Shortcodes();
			new social\Social();
		}

		/**
		 * Customize register function.
		 *
		 * @since 2020-03-25
		 *
		 * @param object $conversions_customizer The Customizer object.
		 */
		public function conversions_customize_register( $conversions_customizer ) {

			$wp_customize = $conversions_customizer->wp_customize;

			// -----------------------------------------------------
			// Register gallery control
			// -----------------------------------------------------
			$wp_customize->register_control_type( '\conversions\extensions\gallery\Gallery' );

			// -----------------------------------------------------
			// Include customizer sections
			// -----------------------------------------------------
			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require_once __DIR__ . '/homepage/customizer/homepage.php';
			require_once __DIR__ . '/homepage/customizer/homepage.hero.php';
			require_once __DIR__ . '/homepage/customizer/homepage.clients.php';
			require_once __DIR__ . '/homepage/customizer/homepage.counter.php';
			require_once __DIR__ . '/homepage/customizer/homepage.faq.php';
			require_once __DIR__ . '/homepage/customizer/homepage.gallery.php';
			require_once __DIR__ . '/homepage/customizer/homepage.icon-features.php';
			require_once __DIR__ . '/homepage/customizer/homepage.img-features.php';
			require_once __DIR__ . '/homepage/customizer/homepage.single-feature.php';
			require_once __DIR__ . '/homepage/customizer/homepage.map.php';
			require_once __DIR__ . '/homepage/customizer/homepage.pricing.php';
			require_once __DIR__ . '/homepage/customizer/homepage.team.php';
			require_once __DIR__ . '/homepage/customizer/homepage.testimonials.php';
			require_once __DIR__ . '/homepage/customizer/homepage.text.php';
			require_once __DIR__ . '/homepage/customizer/homepage.news.php';
			require_once __DIR__ . '/homepage/customizer/homepage.woocommerce.php';
			require_once __DIR__ . '/homepage/customizer/homepage.edd.php';
			require_once __DIR__ . '/homepage/customizer/homepage.blank.php';
			require_once __DIR__ . '/social/social-customizer.php';
			require_once __DIR__ . '/navbar/navbar-variants-customizer.php';
			// phpcs:enable
		}

		/**
		 * Customizer options styles added to wp_head inline.
		 *
		 * @since 2019-08-15
		 */
		public function wp_head() {

			// fixed navbar height calc variables.
			$nav_height = conversions()->customizer->fixed_navbar_height_calc();

			// Nav color scheme for social icons.
			$nav_color_scheme = get_theme_mod( 'conversions_nav_colors', 'white' );
			switch ( $nav_color_scheme ) {
				case 'dark':
					$nav_icon_btn = 'btn-dark';
					break;
				case 'light':
					$nav_icon_btn = 'btn-light';
					break;
				case 'white':
					$nav_icon_btn = 'btn-dark';
					break;
				case 'primary':
					$nav_icon_btn = 'btn-primary';
					break;
				case 'secondary':
					$nav_icon_btn = 'btn-secondary';
					break;
				case 'success':
					$nav_icon_btn = 'btn-success';
					break;
				case 'danger':
					$nav_icon_btn = 'btn-danger';
					break;
				case 'warning':
					$nav_icon_btn = 'btn-warning';
					break;
				case 'info':
					$nav_icon_btn = 'btn-info';
					break;
				default:
					$nav_icon_btn = 'btn-dark';
			}

			// Bootstrap button colors.
			$bs_btn_colors = \conversions\Conversions::bootstrap_btn_colors();

			$mods = [
				[ '.page-template-homepage section.c-hero h1', 'color', get_theme_mod( 'conversions_hh_title_color' ) ],
				[ '.page-template-homepage section.c-hero .c-hero__description', 'color', get_theme_mod( 'conversions_hh_desc_color' ) ],
				[ '.page-template-homepage section.c-clients', 'background-color', get_theme_mod( 'conversions_hc_bg_color' ) ],
				[ 'section.c-clients img.client', 'max-width', get_theme_mod( 'conversions_hc_logo_width' ), 'rem' ],
				[ '.page-template-homepage section.c-news', 'background-color', get_theme_mod( 'conversions_news_bg_color' ) ],
				[ '.page-template-homepage section.c-news h2', 'color', get_theme_mod( 'conversions_news_title_color' ) ],
				[ '.page-template-homepage section.c-news p.subtitle', 'color', get_theme_mod( 'conversions_news_desc_color' ) ],
				[ '.page-template-homepage section.c-testimonials', 'background-color', get_theme_mod( 'conversions_testimonials_bg_color' ) ],
				[ '.page-template-homepage section.c-testimonials h2', 'color', get_theme_mod( 'conversions_testimonials_title_color' ) ],
				[ '.page-template-homepage section.c-testimonials p.subtitle', 'color', get_theme_mod( 'conversions_testimonials_desc_color' ) ],
				[ '.page-template-homepage section.c-pricing', 'background-color', get_theme_mod( 'conversions_pricing_bg_color' ) ],
				[ '.page-template-homepage section.c-pricing h2', 'color', get_theme_mod( 'conversions_pricing_title_color' ) ],
				[ '.page-template-homepage section.c-pricing p.subtitle', 'color', get_theme_mod( 'conversions_pricing_desc_color' ) ],
				[ '.page-template-homepage section.c-features', 'background-color', get_theme_mod( 'conversions_features_bg_color' ) ],
				[ '.page-template-homepage section.c-features h2, section.c-features .card h3', 'color', get_theme_mod( 'conversions_features_title_color' ) ],
				[ '.page-template-homepage section.c-features p.subtitle, section.c-features .card .c-features__block-desc', 'color', get_theme_mod( 'conversions_features_desc_color' ) ],
				[ '.c-social-icons ul li.list-inline-item i', 'font-size', get_theme_mod( 'conversions_social_size' ), 'rem' ],
				[ '.c-hero.c-hero__full, .c-hero.c-hero__split .c-hero__split-img', 'min-height', get_theme_mod( 'conversions_hh_img_height' ), 'vh' ],
				[ '.c-hero.c-hero__split', 'background-color', get_theme_mod( 'conversions_hh_bg_color' ) ],
				[ '.page-template-homepage section.c-woo', 'background-color', get_theme_mod( 'conversions_woo_bg_color' ) ],
				[ '.page-template-homepage section.c-woo h2', 'color', get_theme_mod( 'conversions_woo_title_color' ) ],
				[ '.page-template-homepage section.c-woo p.subtitle', 'color', get_theme_mod( 'conversions_woo_desc_color' ) ],
				[ '.page-template-homepage section.c-edd', 'background-color', get_theme_mod( 'conversions_edd_bg_color' ) ],
				[ '.page-template-homepage section.c-edd h2', 'color', get_theme_mod( 'conversions_edd_title_color' ) ],
				[ '.page-template-homepage section.c-edd p.subtitle', 'color', get_theme_mod( 'conversions_edd_desc_color' ) ],
				[ '.navbar-below .navbar-below-menu .nav-link', 'padding-top', get_theme_mod( 'conversions_nav_tbpadding' ), 'rem' ],
				[ '.navbar-below .navbar-below-menu .nav-link', 'padding-bottom', get_theme_mod( 'conversions_nav_tbpadding' ), 'rem' ],
				[ '.navbar-below .navbar-below-branding', 'padding-top', get_theme_mod( 'conversions_branding_tbpadding' ), 'rem' ],
				[ '.navbar-below .navbar-below-branding', 'padding-bottom', get_theme_mod( 'conversions_branding_tbpadding' ), 'rem' ],
				[ '.page-template-homepage section.c-img-features', 'background-color', get_theme_mod( 'conversions_img_features_bg' ) ],
				[ '.page-template-homepage section.c-img-features h2, section.c-img-features .card h3', 'color', get_theme_mod( 'conversions_img_features_title_color' ) ],
				[ '.page-template-homepage section.c-img-features p.subtitle, section.c-img-features .card .c-img-features__block-desc', 'color', get_theme_mod( 'conversions_img_features_desc_color' ) ],
				[ '.page-template-homepage .c-blank', 'background-color', get_theme_mod( 'conversions_blank_bg_color' ) ],
				[ '.page-template-homepage .c-blank .c-blank__items', 'align-items', get_theme_mod( 'conversions_blank_content_position' ) ],
				[ '.c-img-features__block a.card:hover', 'border-color', get_theme_mod( 'conversions_link_hcolor' ) ],
				[ '.page-template-homepage section.c-team', 'background-color', get_theme_mod( 'conversions_team_bg_color' ) ],
				[ '.page-template-homepage section.c-team h2, section.c-team .card h3', 'color', get_theme_mod( 'conversions_team_title_color' ) ],
				[ '.page-template-homepage section.c-team p.subtitle, section.c-team .card .c-team__block-desc', 'color', get_theme_mod( 'conversions_team_desc_color' ) ],
				[ '.page-template-homepage section.c-text', 'background-color', get_theme_mod( 'conversions_text_bg_color' ) ],
				[ '.page-template-homepage section.c-text h2', 'color', get_theme_mod( 'conversions_text_title_color' ) ],
				[ '.page-template-homepage section.c-text p.subtitle', 'color', get_theme_mod( 'conversions_text_desc_color' ) ],
				[ '.page-template-homepage .c-text .c-text__items', 'text-align', get_theme_mod( 'conversions_text_section_align' ) ],
				[ '.page-template-homepage section.c-counter', 'background-color', get_theme_mod( 'conversions_counter_bg_color' ) ],
				[ '.page-template-homepage section.c-counter h2, section.c-counter .card h3', 'color', get_theme_mod( 'conversions_counter_title_color' ) ],
				[ '.page-template-homepage section.c-counter p.subtitle, section.c-counter .card h4.c-counter__block-text', 'color', get_theme_mod( 'conversions_counter_desc_color' ) ],
				[ '.page-template-homepage section.c-faq', 'background-color', get_theme_mod( 'conversions_faq_bg_color' ) ],
				[ '.page-template-homepage section.c-faq h2', 'color', get_theme_mod( 'conversions_faq_title_color' ) ],
				[ '.page-template-homepage section.c-faq p.subtitle', 'color', get_theme_mod( 'conversions_faq_desc_color' ) ],
				[ '.page-template-homepage section.c-single-feature', 'background-color', get_theme_mod( 'conversions_single_feature_bg' ) ],
				[ '.page-template-homepage section.c-single-feature h2', 'color', get_theme_mod( 'conversions_single_feature_title_color' ) ],
				[ '.page-template-homepage section.c-single-feature p', 'color', get_theme_mod( 'conversions_single_feature_desc_color' ) ],
				[ '.page-template-homepage section.c-map', 'background-color', get_theme_mod( 'conversions_map_bg' ) ],
				[ '.page-template-homepage section.c-map h2', 'color', get_theme_mod( 'conversions_map_title_color' ) ],
				[ '.page-template-homepage section.c-map p', 'color', get_theme_mod( 'conversions_map_desc_color' ) ],
				[ '.page-template-homepage section.c-gallery', 'background-color', get_theme_mod( 'conversions_gallery_bg_color' ) ],
				[ '.page-template-homepage section.c-gallery h2', 'color', get_theme_mod( 'conversions_gallery_title_color' ) ],
				[ '.page-template-homepage section.c-gallery p', 'color', get_theme_mod( 'conversions_gallery_desc_color' ) ],
			];
			?>

			<style>
				<?php
				foreach ( $mods as $key => $value ) {
					if ( ! empty( $value[2] ) ) {
						echo esc_html( $value[0] );
						echo '{';
						echo esc_html( $value[1] );
						echo ':';
						echo esc_html( $value[2] );
						if ( ! empty( $value[3] ) ) {
							echo esc_html( $value[3] );
						}
						echo ';}';
					}
				}

				// Homepage hero.
				if ( get_theme_mod( 'conversions_hh_type', 'full' ) === 'split' && get_theme_mod( 'conversions_hh_split_type', 'square' ) !== 'square' ) {
					$mask_dir  = plugin_dir_url( __FILE__ ) . 'homepage/images/';
					$mask_file = get_theme_mod( 'conversions_hh_split_type' );
					$mask_svg  = $mask_dir . $mask_file . '.svg';
					$mask_type = homepage\Homepage::hero_split_mask_type();

					if ( $mask_type == true ) {
						echo '.c-hero__split-img {
							-webkit-mask-image: url(' . esc_url( $mask_svg ) . ');
							mask-image: url(' . esc_url( $mask_svg ) . ');
							-webkit-mask-repeat: no-repeat;
							mask-repeat: no-repeat;
							-webkit-mask-size: contain;
							mask-size: contain;
							mask-position: center;
							-webkit-mask-position: center;
						}';
					} else {
						echo '.c-hero__split-img {
							-webkit-mask-image: url(' . esc_url( $mask_svg ) . ');
							mask-image: url(' . esc_url( $mask_svg ) . ');
							-webkit-mask-repeat: no-repeat;
							mask-repeat: no-repeat;
							-webkit-mask-size: cover;
							mask-size: cover;
						}';
					}
				}
				// Homepage news.
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 1 ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__1,
						section.c-news #c-news__2 {
							display: none;
						}
					}';
				}
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 2 ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__2 {
							display: none;
						}
					}';
				}
				// Fixed navbar below height.
				if ( get_theme_mod( 'conversions_nav_position', 'fixed-top' ) === 'fixed-top' ) {
					if ( get_theme_mod( 'conversions_nav_layout', 'right' ) == 'below' ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
						// Content margin.
						echo '.content-wrapper {
							margin-top: ' . esc_html( $nav_height[0] ) . 'rem;
						}';
						// Anchor link padding.
						echo 'html {
							scroll-padding-top: ' . esc_html( $nav_height[0] ) . 'rem;
						}';
						// Desktop screen.
						echo '@media screen and (min-width: 992px) {
							.content-wrapper {
								margin-top: ' . esc_html( $nav_height[1] ) . 'rem;
							}
							html {
								scroll-padding-top: ' . esc_html( $nav_height[1] ) . 'rem;
							}
						}';
					}
				}
				// Navbar below icon size.
				if ( get_theme_mod( 'conversions_nav_layout', 'right' ) === 'below' ) {
					echo '@media screen and (min-width: 992px) {
						#wrapper-navbar .navbar.navbar-below .c-nav__social-icon i {
							font-size: ' . esc_html( get_theme_mod( 'conversions_social_size' ) ) . 'rem;
							color: ' . esc_html( $bs_btn_colors[$nav_icon_btn]['btn_bg'] ) . ';
							margin-right: 1rem;
						}
					}';
				}
				if ( get_theme_mod( 'conversions_nav_layout', 'right' ) === 'below' ) {
					echo '@media screen and (min-width: 992px) {
						#wrapper-navbar .navbar.navbar-below .c-nav__social-icon i:hover {
							color: ' . esc_html( $bs_btn_colors[$nav_icon_btn]['btn_bg_hover'] ) . ';
						}
					}';
				}
				?>
			</style>
			<?php
		}

		/**
		 * Enqueue scripts and styles for the frontend.
		 *
		 * @since 2019-08-16
		 */
		public function wp_enqueue_scripts() {
			// CSS.
			wp_enqueue_style(
				'conversions-ext-styles',
				plugin_dir_url( __FILE__ ) . 'build/plugin.min.css',
				array(),
				CONVERSIONS_EXTENSIONS_VERSION
			);
			// RTL.
			if ( is_rtl() ) {
				wp_enqueue_style(
					'conversions-ext-styles-rtl',
					plugin_dir_url( __FILE__ ) . 'build/plugin.rtl.min.css',
					array(),
					CONVERSIONS_EXTENSIONS_VERSION
				);
				wp_dequeue_style( 'conversions-ext-styles' );
			}

			// Javascript.
			wp_enqueue_script(
				'conversions-ext-scripts',
				plugin_dir_url( __FILE__ ) . 'build/plugin.min.js',
				[ 'jquery' ],
				CONVERSIONS_EXTENSIONS_VERSION,
				true
			);
		}

		/**
		 * Enqueue scripts and styles for the customizer.
		 *
		 * @since 2019-12-25
		 */
		public function customize_controls_enqueue_scripts() {
			// Styles.
			wp_enqueue_style(
				'conversions-ext-customizer-css',
				plugin_dir_url( __FILE__ ) . 'build/conversions-customizer.min.css',
				array(),
				CONVERSIONS_EXTENSIONS_VERSION
			);

			// Scripts.
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_enqueue_script(
				'conversions-ext-customizer-js',
				plugin_dir_url( __FILE__ ) . 'build/conversions-customizer.min.js',
				[ 'jquery', 'jquery-ui-draggable', 'wp-color-picker', 'customize-controls' ],
				CONVERSIONS_EXTENSIONS_VERSION,
				true
			);
		}

		/**
		 * Allow iframes: prevent wp_kses from removing iframe embeds.
		 *
		 * @since 2020-11-07
		 *
		 * @param array  $tags Allowed tags, attributes, and/or entities.
		 * @param string $context Context to judge allowed tags by. Allowed values are 'post'.
		 */
		public function allow_iframes_filter( $tags, $context ) {

			if ( 'post' === $context ) {

				// Allow iframes and the following attributes.
				$tags['iframe'] = array(
					'align'           => true,
					'width'           => true,
					'height'          => true,
					'frameborder'     => true,
					'name'            => true,
					'src'             => true,
					'id'              => true,
					'class'           => true,
					'style'           => true,
					'scrolling'       => true,
					'marginwidth'     => true,
					'marginheight'    => true,
					'allowfullscreen' => true,
					'aria-hidden'     => true,
					'tabindex'        => true,
					'loading'         => true,
				);
			}

			return $tags;
		}

	}
}

namespace
{

	require_once __DIR__ . '/vendor/autoload.php';

	/**
	 * Sanitize select option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Select input.
	 * @param string $setting ID.
	 */
	function conversions_ext_sanitize_select( $input, $setting ) {
		$control = $setting->manager->get_control( $setting->id );
		$valid   = $control->choices;

		// return input if valid or return default option.
		return ( array_key_exists( $input, $valid ) ? $input : $setting->default );
	}

	/**
	 * Sanitize checkbox option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Checkbox input.
	 */
	function conversions_ext_sanitize_checkbox( $input ) {
		return ( $input === true ) ? true : false;
	}

	/**
	 * Sanitize float option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Float input.
	 */
	function conversions_ext_sanitize_float( $input ) {
		$input = filter_var( $input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		return $input;
	}

	/**
	 * Sanitize repeater option input.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $input Repeater input.
	 */
	function conversions_ext_repeater_sanitize( $input ) {
		$input_decoded = json_decode( $input, true );
		if ( ! empty( $input_decoded ) ) {
			foreach ( $input_decoded as $boxk => $box ) {
				foreach ( $box as $key => $value ) {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}
			}
			return json_encode( $input_decoded );
		}
		return $input;
	}

	/**
	 * Filter to modify input label for repeater controls.
	 *
	 * @since 2019-08-15
	 *
	 * @param string $string String.
	 * @param string $id Control ID.
	 * @param string $control Control name.
	 */
	function conversions_ext_repeater_labels( $string, $id, $control ) {

		// Testimonial repeater label changes.
		if ( $id === 'conversions_testimonials_repeater' ) {
			if ( $control === 'customizer_repeater_title_control' ) {
				return esc_html__( 'Full name', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Company name', 'conversions' );
			}
			if ( $control === 'customizer_repeater_text_control' ) {
				return esc_html__( 'Testimonial text', 'conversions' );
			}
		}

		// Pricing table repeater label changes.
		if ( $id === 'conversions_pricing_repeater' ) {
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Price', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle2_control' ) {
				return esc_html__( 'Duration', 'conversions' );
			}
		}

		// Image features repeater label changes.
		if ( $id === 'conversions_img_features_imgs' ) {
			if ( $control === 'customizer_repeater_linktext_control' ) {
				return esc_html__( 'Link text (not required)', 'conversions' );
			}
		}

		// Team repeater label changes.
		if ( $id === 'conversions_team_details' ) {
			if ( $control === 'customizer_repeater_title_control' ) {
				return esc_html__( 'Full name', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Job title', 'conversions' );
			}
			if ( $control === 'customizer_repeater_text_control' ) {
				return esc_html__( 'Short summary', 'conversions' );
			}
		}

		// Counter repeater label changes.
		if ( $id === 'conversions_counter_blocks' ) {
			if ( $control === 'customizer_repeater_color_control' ) {
				return esc_html__( 'Icon color', 'conversions' );
			}
			if ( $control === 'customizer_repeater_title_control' ) {
				return esc_html__( 'Before counter symbol ($, €, +, -, etc)', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Counter number - text or shortcode', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle2_control' ) {
				return esc_html__( 'After counter symbol (+, -, etc)', 'conversions' );
			}
			if ( $control === 'customizer_repeater_text_control' ) {
				return esc_html__( 'Title', 'conversions' );
			}
		}

		// FAQ repeater label changes.
		if ( $id === 'conversions_faq_repeater' ) {
			if ( $control === 'customizer_repeater_title_control' ) {
				return esc_html__( 'Question', 'conversions' );
			}
			if ( $control === 'customizer_repeater_text_control' ) {
				return esc_html__( 'Answer', 'conversions' );
			}
		}

		return $string;
	}
	add_filter( 'conversions_repeater_labels_filter', 'conversions_ext_repeater_labels', 10, 3 );

	$conversions_extensions = new conversions\extensions\Conversions_Extensions();
}
