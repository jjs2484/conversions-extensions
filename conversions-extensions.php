<?php
/**
 * Plugin Name: Conversions Extensions
 * Description: Adds homepage sections and other extensions to Conversions WordPress theme.
 * Version: 1.0.0
 * Author: uniquelylost
 * Author URI: https://conversionswp.com
 * Text Domain: conversions
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package conversions-extensions
 */

namespace conversions {
	/**
	 * Class Conversions_Extensions
	 */
	class Conversions_Extensions {

		/**
		 * Class constructor.
		 *
		 * @since 2020-03-25
		 */
		public function __construct() {
			add_action( 'conversions_footer_info', [ $this, 'conversions_footer_social' ], 20 );
			add_action( 'conversions_customize_register', [ $this, 'conversions_customize_register' ] );
			add_action( 'wp_head', [ $this, 'wp_head' ], 99 );
			add_action( 'init', [ $this, 'setup' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
			add_action( 'customize_controls_enqueue_scripts', [ $this, 'customize_controls_enqueue_scripts' ] );
		}

		/**
		 * Setup some theme options.
		 *
		 * @since 2019-08-18
		 */
		public function setup() {

			// Check if settings are set, if not set defaults.
			$defaults = [
				'conversions_social_size'          => '1.5',
				'conversions_hh_content_position'  => 'col-lg-6',
				'conversions_hh_img_height'        => '72',
				'conversions_hh_img_color'         => '#000000',
				'conversions_hh_img_overlay'       => '.5',
				'conversions_hh_button'            => 'no',
				'conversions_hh_vbtn'              => 'no',
				'conversions_hc_logo_width'        => '6.2',
				'conversions_hc_respond'           => 'auto',
				'conversions_hc_sm'                => '2',
				'conversions_hc_md'                => '3',
				'conversions_hc_lg'                => '4',
				'conversions_hc_max'               => '5',
				'conversions_features_sm'          => '2',
				'conversions_features_md'          => '2',
				'conversions_features_lg'          => '3',
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
			];

			foreach ( $defaults as $c => $v ) {
				if ( 'unset' == get_theme_mod( $c, 'unset' ) ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
					set_theme_mod( $c, $v );
				}
			}

			require_once __DIR__ . '/homepage/class-homepage.php';
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
			// Include customizer sections
			// -----------------------------------------------------

			// require customizer repeater.
			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require_once __DIR__ . '/repeater/class-conversions-repeater.php';
			// phpcs:enable

			// -----------------------------------------------------
			// Include customizer sections
			// -----------------------------------------------------
			// phpcs:disable WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require_once __DIR__ . '/homepage/customizer/homepage.php';
			require_once __DIR__ . '/homepage/customizer/homepage.hero.php';
			require_once __DIR__ . '/homepage/customizer/homepage.clients.php';
			require_once __DIR__ . '/homepage/customizer/homepage.features.php';
			require_once __DIR__ . '/homepage/customizer/homepage.pricing.php';
			require_once __DIR__ . '/homepage/customizer/homepage.testimonials.php';
			require_once __DIR__ . '/homepage/customizer/homepage.news.php';
			require_once __DIR__ . '/homepage/customizer/homepage.woocommerce.php';
			require_once __DIR__ . '/homepage/customizer/homepage.edd.php';
			require_once __DIR__ . '/footer/customizer/social-icons.php';
			// phpcs:enable
		}

		/**
		 * Footer social icons output.
		 *
		 * @since 2019-08-15
		 */
		public function conversions_footer_social() {

			// get option values and decode.
			$conversions_si         = get_theme_mod( 'conversions_social_icons' );
			$conversions_si_decoded = json_decode( $conversions_si );

			if ( ! empty( $conversions_si_decoded ) ) {

				echo '<div class="social-media-icons col-md"><ul class="list-inline">';

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

				echo '</ul></div>';

			}

		}

		/**
		 * Customizer options styles added to wp_head inline.
		 *
		 * @since 2019-08-15
		 */
		public function wp_head() {

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
				[ '#wrapper-footer .social-media-icons ul li.list-inline-item i', 'font-size', get_theme_mod( 'conversions_social_size' ), 'rem' ],
				[ '.page-template-homepage section.c-hero', 'min-height', get_theme_mod( 'conversions_hh_img_height' ), 'vh' ],
				[ '.page-template-homepage section.c-woo', 'background-color', get_theme_mod( 'conversions_woo_bg_color' ) ],
				[ '.page-template-homepage section.c-woo h2', 'color', get_theme_mod( 'conversions_woo_title_color' ) ],
				[ '.page-template-homepage section.c-woo p.subtitle', 'color', get_theme_mod( 'conversions_woo_desc_color' ) ],
				[ '.page-template-homepage section.c-edd', 'background-color', get_theme_mod( 'conversions_edd_bg_color' ) ],
				[ '.page-template-homepage section.c-edd h2', 'color', get_theme_mod( 'conversions_edd_title_color' ) ],
				[ '.page-template-homepage section.c-edd p.subtitle', 'color', get_theme_mod( 'conversions_edd_desc_color' ) ],
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
				if ( get_theme_mod( 'conversions_hh_img_parallax', false ) === true ) {
					echo '.page-template-homepage section.c-hero {
						background-attachment: fixed;
					}';
				}
				// Homepage news.
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 1 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__1,
						section.c-news #c-news__2 {
							display: none;
						}
					}';
				}
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 2 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__2 {
							display: none;
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
			$ext_styles_ver = gmdate( 'ymd-Gis', filemtime( plugin_dir_path( __FILE__ ) . 'build/plugin.min.css' ) );
			wp_enqueue_style(
				'conversions-ext-styles',
				plugin_dir_url( __FILE__ ) . 'build/plugin.min.css',
				array(),
				$ext_styles_ver
			);
			// RTL.
			if ( is_rtl() ) {
				$ext_rtl_styles_ver = gmdate( 'ymd-Gis', filemtime( plugin_dir_path( __FILE__ ) . 'build/plugin.rtl.min.css' ) );
				wp_enqueue_style(
					'conversions-ext-styles-rtl',
					plugin_dir_url( __FILE__ ) . 'build/plugin.rtl.min.css',
					array(),
					$ext_rtl_styles_ver
				);
				wp_dequeue_style( 'conversions-ext-styles' );
			}

			// Javascript.
			$ext_scripts_ver = gmdate( 'ymd-Gis', filemtime( plugin_dir_path( __FILE__ ) . 'build/plugin.min.js' ) );
			wp_enqueue_script(
				'conversions-ext-scripts',
				plugin_dir_url( __FILE__ ) . 'build/plugin.min.js',
				array(),
				$ext_scripts_ver,
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
			$ext_styles_ver = gmdate( 'ymd-Gis', filemtime( plugin_dir_path( __FILE__ ) . 'build/conversions-customizer.min.css' ) );
			wp_enqueue_style(
				'conversions-ext-customizer-css',
				plugin_dir_url( __FILE__ ) . 'build/conversions-customizer.min.css',
				array(),
				$ext_styles_ver
			);

			// Scripts.
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );

			$ext_scripts_ver = gmdate( 'ymd-Gis', filemtime( plugin_dir_path( __FILE__ ) . 'build/conversions-customizer.min.js' ) );
			wp_enqueue_script(
				'conversions-ext-customizer-js',
				plugin_dir_url( __FILE__ ) . 'build/conversions-customizer.min.js',
				array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ),
				$ext_scripts_ver,
				true
			);
		}

	}
}

namespace
{
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

		// testimonial repeater labels.
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

		// pricing table repeater labels.
		if ( $id === 'conversions_pricing_repeater' ) {
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Price', 'conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle2_control' ) {
				return esc_html__( 'Duration', 'conversions' );
			}
		}

		return $string;
	}
	add_filter( 'conversions_repeater_labels_filter', 'conversions_ext_repeater_labels', 10, 3 );


	$conversions_extensions = new conversions\Conversions_Extensions();
}

