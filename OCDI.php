<?php
/**
 * Handles One Click Demo Import stuff.
 *
 * @package conversions
 */

namespace conversions\extensions;

/**
 * Class ODCI
 *
 * @since 2020-12-27
 */
class OCDI {
	/**
	 * Constructor.
	 *
	 * @since 2020-12-27
	 */
	public function __construct() {
		add_filter( 'pt-ocdi/import_files', [ $this, 'ocdi_import_files' ] );
		add_action( 'pt-ocdi/after_import', [ $this, 'ocdi_after_import' ] );
		add_action( 'pt-ocdi/before_content_import', [ $this, 'ocdi_before_content_import' ] );
		add_action( 'pt-ocdi/before_widgets_import', [ $this, 'ocdi_before_widgets_import' ] );
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
		add_filter( 'pt-ocdi/plugin_intro_text', [ $this, 'ocdi_plugin_intro_text' ] );
		add_filter( 'gettext', [ $this, 'ocdi_success_notice_text' ], 999, 3 );
	}

	/**
	 * One Click Demo Import before widgets import execute code.
	 *
	 * @since 2020-12-28
	 *
	 * @param array $selected_import Import demos.
	 */
	public function ocdi_before_widgets_import( $selected_import ) {

		// Get all sidebar widgets.
		$sidebars_widgets = get_option( 'sidebars_widgets' );

		// Theme sidebar IDs.
		$sidebar_id = [ 1, 2, 3, 4, 5, 6 ];

		// Make active widgets inactive.
		foreach ( $sidebar_id as $v ) {
			$sidebars_widgets['wp_inactive_widgets']  = array_merge( $sidebars_widgets['wp_inactive_widgets'], $sidebars_widgets[ 'sidebar-' . $v . '' ] );
			$sidebars_widgets[ 'sidebar-' . $v . '' ] = [];
		}

		// Update sidebar widgets.
		update_option( 'sidebars_widgets', $sidebars_widgets );
	}

	/**
	 * One Click Demo Import after import execute code.
	 *
	 * @since 2020-12-21
	 *
	 * @param array $selected_import Import demos.
	 */
	public function ocdi_after_import( $selected_import ) {

		switch ( $selected_import['import_file_name'] ) {
			case 'Blog Demo':
				// Assign menu to location.
				$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
				set_theme_mod(
					'nav_menu_locations',
					[
						'primary' => $main_menu->term_id,
					]
				);
				break;
			case 'Business Demo':
				// Assign menu to location.
				$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
				set_theme_mod(
					'nav_menu_locations',
					[
						'primary' => $main_menu->term_id,
					]
				);

				// Assign posts page (blog page).
				if ( get_page_by_title( 'Blog' ) != null ) {
					$blog_page_id = get_page_by_title( 'Blog' );
					update_option( 'page_for_posts', $blog_page_id->ID );
				}

				// Assign front page business demo.
				if ( get_page_by_title( 'NextGen Business Solutions' ) != null ) {
					$business_front_page_id = get_page_by_title( 'NextGen Business Solutions' );
					update_option( 'show_on_front', 'page' );
					update_option( 'page_on_front', $business_front_page_id->ID );
				}
				break;
		}
	}

	/**
	 * One Click Demo Import before import execute code.
	 *
	 * @since 2020-12-21
	 *
	 * @param array $selected_import Import demos.
	 */
	public function ocdi_before_content_import( $selected_import ) {

		// Handle the download and activation of all plugins.
		if ( isset( $selected_import[ 'required_plugins' ] ) ) {
			foreach ( $selected_import[ 'required_plugins' ] as $plugin_id ) {
				$plugin_data = static::get_plugin_data( $plugin_id );
				$this->replace_plugin( $plugin_data );
			}
		}
	}

	/**
	 * Return the base OCDI import files data.
	 *
	 * @since 2020-12-27
	 */
	public static function get_ocdi_import_files() {
		return [
			[
				'import_file_name'             => 'Blog Demo',
				'categories'                   => [ 'Blog', 'Free' ],
				'local_import_file'            => trailingslashit( __DIR__ ) . 'demos/blog.xml',
				'local_import_widget_file'     => trailingslashit( __DIR__ ) . 'demos/blog-widgets.wie',
				'local_import_customizer_file' => trailingslashit( __DIR__ ) . 'demos/blog-customizer.dat',
				'import_preview_image_url'     => plugins_url( 'demos/blog-preview.png', __FILE__ ),
				'preview_url'                  => 'https://blog.conversionswp.com/',
				'required_plugins'             => [ 'contact_form_7', 'disable_gutenberg', ],
			],
			[
				'import_file_name'             => 'Business Demo',
				'categories'                   => [ 'Business', 'Free' ],
				'local_import_file'            => trailingslashit( __DIR__ ) . 'demos/business.xml',
				'local_import_widget_file'     => trailingslashit( __DIR__ ) . 'demos/business-widgets.wie',
				'local_import_customizer_file' => trailingslashit( __DIR__ ) . 'demos/business-customizer.dat',
				'import_preview_image_url'     => plugins_url( 'demos/business-preview.png', __FILE__ ),
				'preview_url'                  => 'https://business.conversionswp.com/',
				'required_plugins'             => [ 'ninja_forms', 'disable_gutenberg', ],
			],
		];
	}

	/**
	 * Retrieve the plugin data.
	 *
	 * @since 2020-12-27
	 *
	 * @param string $plugin_id Plugin ID and array key.
	 */
	public static function get_plugin_data( $plugin_id = false ) {
		$data = (object) [
			'disable_gutenberg' => (object) [
				'name' => 'Disable Gutenberg',
				'zip'  => 'https://downloads.wordpress.org/plugin/disable-gutenberg.2.3.zip',
				'slug' => 'disable-gutenberg/disable-gutenberg.php',
				'url'  => 'https://wordpress.org/plugins/disable-gutenberg/',
			],
			'contact_form_7'    => (object) [
				'name' => 'Contact Form 7',
				'zip'  => 'https://downloads.wordpress.org/plugin/contact-form-7.5.3.2.zip',
				'slug' => 'contact-form-7/wp-contact-form-7.php',
				'url'  => 'https://wordpress.org/plugins/contact-form-7/',
			],
			'ninja_forms'       => (object) [
				'name' => 'Ninja Forms',
				'zip'  => 'https://downloads.wordpress.org/plugin/ninja-forms.3.4.33.zip',
				'slug' => 'ninja-forms/ninja-forms.php',
				'url'  => 'https://wordpress.org/plugins/ninja-forms/',
			],
		];

		// Do we return a specific plugin?
		if ( $plugin_id )
			return $data->$plugin_id;

		return $data;
	}

	/**
	 * One Click Demo Import local files.
	 *
	 * @since 2020-12-21
	 */
	public function ocdi_import_files() {
		$data = static::get_ocdi_import_files();
		foreach ( $data as $index => $import_data ) {
			// We are only interested in imports that define required_plugins.
			if ( ! isset( $import_data[ 'required_plugins' ] ) )
				continue;

			$import_notice = __( 'The following plugins will be installed and activated if they are not already:', 'conversions' );

			$import_notice .= '<br>';
			$import_notice .= '<ul>';

			foreach ( $import_data[ 'required_plugins' ] as $plugin_id ) {
				$plugin_data    = static::get_plugin_data( $plugin_id );
				$import_notice .= sprintf( '<li><a href="%s">%s</a></li>', $plugin_data->url, $plugin_data->name );
			}

			$import_notice .= '</ul>';

			$data[ $index ][ 'import_notice' ] = $import_notice;
		}

		return $data;
	}

	/**
	 * One Click Demo Import intro text.
	 *
	 * @since 2020-12-21
	 *
	 * @param string $default_text Intro text string.
	 */
	public function ocdi_plugin_intro_text( $default_text ) {

		// Plugin notice.
		$default_text = sprintf(
			'<div class="ocdi__intro-notice notice notice-warning is-dismissible"><p>%s</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">%s</span></button></div>',
			__( 'Before you begin, make sure all the required plugins are activated.', 'conversions' ),
			__( 'Dismiss this notice.', 'conversions' )
		);

		// Intro description.
		$default_text .= sprintf(
			'<div class="ocdi__intro-text"><p class="about-description">%s</p></div>',
			__( 'Importing demo data (posts, pages, images, theme settings...) is the easiest way to setup your theme. Quickly set everything up instead of editing from scratch.', 'conversions' )
		);

		return $default_text;
	}

	/**
	 * Update the OCDI Success Notice
	 *
	 * @since 2020-12-21
	 *
	 * @param string $translated Translated text.
	 * @param string $text Text.
	 * @param string $domain Domain.
	 */
	public function ocdi_success_notice_text( $translated, $text, $domain ) {

		// New text.
		$newtext = sprintf(
			'%s <a class="button button-primary" href="%s">%s</a>',
			'The demo import has finished. Check your site to see everything imported correctly',
			esc_url( home_url() ),
			'Visit site'
		);

		// String to replace.
		$translated = str_ireplace( 'The demo import has finished. Please check your page and make sure that everything has imported correctly. If it did, you can deactivate the %3$sOne Click Demo Import%4$s plugin, because it has done its job.', $newtext, $translated );

		return $translated;
	}

	/**
	 * Replace_plugin
	 *
	 * @since 2020-12-27
	 *
	 * @param array $plugin_data Plugin data.
	 */
	public function replace_plugin( $plugin_data ) {
		// Check if plugin is already installed.
		if ( $this->is_plugin_installed( $plugin_data->slug ) ) {
			$this->upgrade_plugin( $plugin_data->slug );
			$installed = true;
		} else {
			// Installing.
			$installed = $this->install_plugin( $plugin_data->zip );
		}

		$activate = activate_plugin( $plugin_data->slug );
	}

	/**
	 * Is plugin installed
	 *
	 * @since 2020-12-27
	 *
	 * @param string $slug Plugin slug.
	 */
	public function is_plugin_installed( $slug ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$all_plugins = get_plugins();

		if ( ! empty( $all_plugins[$slug] ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Install plugin
	 *
	 * @since 2020-12-27
	 *
	 * @param string $plugin_zip Plugin zip.
	 */
	public function install_plugin( $plugin_zip ) {
		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		wp_cache_flush();

		$upgrader       = new \Plugin_Upgrader();
		$upgrader->skin = new OCDI_Skin();
		$installed      = $upgrader->install( $plugin_zip );

		return $installed;
	}

	/**
	 * Upgrade plugin
	 *
	 * @since 2020-12-27
	 *
	 * @param string $plugin_slug Plugin slug.
	 */
	public function upgrade_plugin( $plugin_slug ) {
		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		wp_cache_flush();

		$upgrader       = new \Plugin_Upgrader();
		$upgrader->skin = new OCDI_Skin();
		$upgraded       = $upgrader->upgrade( $plugin_slug );

		return $upgraded;
	}

}
