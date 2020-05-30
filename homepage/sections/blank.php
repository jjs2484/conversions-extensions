<?php
/**
 * Homepage blank trait.
 *
 * @package conversions-extension
 */

namespace conversions\traits;

trait Blank {

	/**
	 * Blank section html.
	 *
	 * @since 2020-03-25
	 */
	public function blank() {
		$content   = get_theme_mod( 'conversions_blank_content' );
		$shortcode = get_theme_mod( 'conversions_blank_shortcode' );
		if ( empty( $content ) && empty( $shortcode ) )
			return;
		?>
	<!-- Blank Section -->
	<section class="c-blank">
		<div class="container-fluid">
			<div class="row">

				<?php do_action( 'conversions_homepage_before_blank' ); ?>

				<div class="col-12">
					<div class="c-blank__items d-flex flex-column">
						<?php
						// Content.
						if ( ! empty( $content ) ) {
							echo wp_kses_post( $content );
						}
						// Shortcode.
						if ( ! empty( $shortcode ) ) {
							echo do_shortcode( wp_kses_post( $shortcode ) );
						}
						?>
					</div>
				</div>

				<?php do_action( 'conversions_homepage_after_blank' ); ?>

			</div>
		</div>
	</section>
		<?php
	}
}
