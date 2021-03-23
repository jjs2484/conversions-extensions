<?php
/**
 * Homepage testimonials trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait testimonials {

	/**
	 * Return the testimonials array.
	 *
	 * @since 2019-12-19
	 */
	public function get_testimonials() {
		$testimonials = get_theme_mod( 'conversions_testimonials_repeater' );
		$testimonials = json_decode( $testimonials );

		if ( ! $testimonials )
			return false;

		$has_testimonials = ( $testimonials[ 0 ]->title != '' || $testimonials[ 0 ]->text != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

		if ( ! $has_testimonials )
			return false;

		return $testimonials;
	}

	/**
	 * Return the testimonials content.
	 *
	 * @since 2019-12-19
	 */
	public function testimonials_content() {
		$testimonials = $this->get_testimonials();
		if ( ! $testimonials )
			return;
		ob_start();
		?>
		<!-- Testimonials -->
		<div class="col-12">
			<!-- Slick Carousel -->
			<div class="c-testimonials__carousel">

				<?php

				$shuffle = get_theme_mod( 'conversions_testimonials_random', 'yes' );

				if ( $shuffle == 'yes' ) {

					// Convert from an object to an array.
					$testimonials = (array) $testimonials;

					// Shuffle array.
					shuffle( $testimonials );

					// Convert back to an object.
					$testimonials = (object) $testimonials;
				}

				$testimonials_count = 0;

				foreach ( $testimonials as $conversions_testimonial ) {
					?>

					<!-- Testimonial -->
					<div class="c-testimonials__item" id="c-testimonials__<?php echo esc_attr( $testimonials_count ); ?>">
						<blockquote class="c-testimonials__quote shadow w-md-95 w-lg-90 mx-auto">

							<?php
							if ( ! empty( $conversions_testimonial->text ) ) {
								echo '<p>' . esc_html( $conversions_testimonial->text ) . '</p>';
							}
							?>

							<div class="d-flex flex-column flex-sm-row justify-content-sm-between">
								<cite>

									<?php
									if ( ! empty( $conversions_testimonial->title ) ) {
										echo '<span class="d-block">' . esc_html( $conversions_testimonial->title ) . '</span>';
									}

									if ( ! empty( $conversions_testimonial->subtitle ) ) {
										echo '<span class="d-block">' . esc_html( $conversions_testimonial->subtitle ) . '</span>';
									}

									for ( $i = 0; $i < 5; $i++ ) {
										echo '<i class="fas fa-star" aria-hidden="true"></i>';
									}
									?>

								</cite>
								<div class="c-testimonials__nav align-self-end ml-sm-auto">
									<i class="fas fa-chevron-left slick-arrow mr-2" aria-hidden="true" title="<?php esc_attr_e( 'Previous', 'conversions' ); ?>"></i>
									<i class="fas fa-chevron-right slick-arrow" aria-hidden="true" title="<?php esc_attr_e( 'Next', 'conversions' ); ?>"></i>
								</div>
							</div>
						</blockquote>
					</div>

					<?php
					++$testimonials_count;
				}
				?>

			</div> <!-- End Slick Carousel -->
		</div>
		<?php
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Testimonials section.
	 *
	 * @since 2019-12-16
	 */
	public function testimonials() {
		$testimonials = $this->get_testimonials();
		$title        = get_theme_mod( 'conversions_testimonials_title' );
		$desc         = get_theme_mod( 'conversions_testimonials_desc' );
		if ( ! $testimonials && empty( $title ) && empty( $desc ) )
			return;
		?>

	<!-- Testimonial Section -->
	<section class="c-testimonials">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( $title ) || ! empty( $desc ) ) { ?>
					<!-- Title -->
					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( $title ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( $title ) . '</h2>';
							}
							if ( ! empty( $desc ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( $desc ) . '</p>';
							}
							?>
						</div>
					</div>
				<?php } ?>


				<?php
					do_action( 'conversions_homepage_before_testimonials' );
					echo $this->testimonials_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					do_action( 'conversions_homepage_after_testimonials' );
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
