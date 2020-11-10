<?php
/**
 * Homepage map trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait map {

	/**
	 * Check Map content exists before displaying.
	 *
	 * @since 2020-11-06
	 */
	public function check_map() {

		$title       = get_theme_mod( 'conversions_map_title' );
		$description = get_theme_mod( 'conversions_map_desc' );
		$map         = get_theme_mod( 'conversions_map_map' );

		$map_content_type = get_theme_mod( 'conversions_map_content_type', 'map' );
		switch ( $map_content_type ) {
			case 'map_text':
				$map_content = get_theme_mod( 'conversions_map_text' );
				break;
			case 'map_html':
				$map_content = get_theme_mod( 'conversions_map_html' );
				break;
			case 'map_shortcode':
				$map_content = get_theme_mod( 'conversions_map_shortcode' );
				break;
			default:
				$map_content = '';
		}

		$has_map = ( $title != '' || $description != '' || $map != '' || $map_content != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( ! $has_map )
			return false;
		return $has_map;
	}

	/**
	 * Return the map content.
	 *
	 * @since 2020-11-06
	 */
	public function map_content() {
		$map = $this->check_map();
		if ( ! $map )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		// Get the map content.
		$map              = get_theme_mod( 'conversions_map_map' );
		$map_content_type = get_theme_mod( 'conversions_map_content_type', 'map' );
		switch ( $map_content_type ) {
			case 'map_text':
				$map_content = get_theme_mod( 'conversions_map_text' );
				$map_content = esc_html( $map_content );
				break;
			case 'map_html':
				$map_content = get_theme_mod( 'conversions_map_html' );
				$map_content = wp_kses_post( $map_content );
				break;
			case 'map_shortcode':
				$map_content = get_theme_mod( 'conversions_map_shortcode' );
				$map_content = do_shortcode( wp_kses_post( $map_content ) );
				break;
			default:
				$map_content = '';
		}

		// Check map content exists before outputting any HTML.
		if ( ! empty( $map ) || ! empty( $map_content ) ) :

			// Open map container.
			echo '<div class="c-map__map">';

			// Regular map output.
			if ( $map_content_type == 'map' ) {
				if ( ! empty( $map ) ) {
					echo '<div class="c-map__map-responsive c-map__map-regular">';
					echo wp_kses_post( $map );
					echo '</div>';
				}
			}

			// Map with content output.
			if ( $map_content_type != 'map' ) {

				echo '<div class="container-fluid">';
				echo '<div class="row">';

				if ( ! empty( $map ) ) {
					echo '<div class="c-map__map-responsive c-map__map-with-content col-12 col-md-6">';
					echo wp_kses_post( $map );
					echo '</div>';
				}

				// Map content output.
				if ( ! empty( $map_content ) ) {
					echo '<div class="c-map__map-content col-12 col-md-6">';
					echo $map_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
					echo '</div>';
				}

				echo '</div>';
				echo '</div>';
			}

			// Close map container.
			echo '</div>';

		endif;

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Map section.
	 *
	 * @since 2020-11-08
	 */
	public function map() {
		$map = $this->check_map();
		if ( ! $map )
			return;
		?>

		<!-- Map section -->
		<section class="c-map">
			<div class="container-fluid">

				<div class="row">

					<?php if ( ! empty( get_theme_mod( 'conversions_map_title' ) ) || ! empty( get_theme_mod( 'conversions_map_desc' ) ) ) { ?>

						<div class="col-12 c-intro">
							<div class="w-md-80 w-lg-60 c-intro__inner">
								<?php
								if ( ! empty( get_theme_mod( 'conversions_map_title' ) ) ) {
									// Title.
									echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_map_title' ) ) . '</h2>';
								}
								if ( ! empty( get_theme_mod( 'conversions_map_desc' ) ) ) {
									// Description.
									echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_map_desc' ) ) . '</p>';
								}
								?>
							</div>
						</div>

					<?php } ?>

				</div>

			</div>

			<?php
			do_action( 'conversions_homepage_before_map' );
			echo $this->map_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			do_action( 'conversions_homepage_after_map' );
			?>

		</section>
		<?php
	}
}
