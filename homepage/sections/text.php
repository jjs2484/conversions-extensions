<?php
/**
 * Homepage text trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait text {

	/**
	 * Text section html.
	 *
	 * @since 2020-06-27
	 */
	public function text() {
		$title     = get_theme_mod( 'conversions_text_title' );
		$paragraph = get_theme_mod( 'conversions_text_desc' );
		if ( empty( $title ) && empty( $paragraph ) )
			return;
		?>
	<!-- Text Section -->
	<section class="c-text">
		<div class="container-fluid">
			<div class="row">

				<?php do_action( 'conversions_homepage_before_text' ); ?>

				<div class="col-12 c-intro">
					<div class="c-text__items">
						<?php
						// Title.
						if ( ! empty( $title ) ) {
							echo '<h2 class="h3">' . esc_html( $title ) . '</h2>';
						}
						// Paragraph.
						if ( ! empty( $paragraph ) ) {
							echo '<p class="subtitle">' . wp_kses_post( $paragraph ) . '</p>';
						}
						?>
					</div>
				</div>

				<?php do_action( 'conversions_homepage_after_text' ); ?>

			</div>
		</div>
	</section>
		<?php
	}
}
