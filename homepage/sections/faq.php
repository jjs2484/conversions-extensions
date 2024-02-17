<?php
/**
 * Homepage faq trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait faq {

	/**
	 * Return the FAQ array.
	 *
	 * @since 2020-09-04
	 */
	public function get_faq() {
		$faq = get_theme_mod( 'conversions_faq_repeater' );
		$faq = json_decode( $faq );

		if ( ! $faq )
			return false;

		$has_faq = ( $faq[ 0 ]->title != '' || $faq[ 0 ]->text != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

		if ( ! $has_faq )
			return false;

		return $faq;
	}

	/**
	 * Return the FAQ content.
	 *
	 * @since 2020-09-04
	 */
	public function faq_content() {
		$faq = $this->get_faq();
		if ( ! $faq )
			return;
		ob_start();
		do_action( 'conversions_homepage_before_faq' );
		?>
		<!-- FAQ -->
		<div class="col-12">
			<!-- Accordion -->
			<div class="accordion w-md-95 w-lg-90 mx-auto shadow" id="c-faq__accordion">

				<?php
				$faq_count = 0;
				foreach ( $faq as $conversions_faq ) {
					if ( ! empty( $conversions_faq->title ) ) {

						if ( $faq_count > 0 ) {
							$faq_start_btn_class  = 'accordion-button collapsed';
							$faq_start_body_class = 'accordion-collapse collapse';
						} else {
							$faq_start_btn_class  = 'accordion-button';
							$faq_start_body_class = 'accordion-collapse collapse show';
						}
						?>

						<!-- FAQ card -->
						<div class="accordion-item">
							<h4 class="accordion-header" id="c-faq__heading-<?php echo esc_attr( $faq_count ); ?>">
								<button class="<?php echo esc_attr( $faq_start_btn_class ); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#c-faq__collapse-<?php echo esc_attr( $faq_count ); ?>" aria-expanded="true" aria-controls="c-faq__collapse-<?php echo esc_attr( $faq_count ); ?>">
									<?php echo wp_kses_post( $conversions_faq->title ); ?>
								</button>									
							</h4>
							<div id="c-faq__collapse-<?php echo esc_attr( $faq_count ); ?>" class="<?php echo esc_attr( $faq_start_body_class ); ?>" aria-labelledby="c-faq__heading-<?php echo esc_attr( $faq_count ); ?>" data-bs-parent="#c-faq__accordion">
								<div class="accordion-body">
									<?php
									if ( ! empty( $conversions_faq->text ) ) {
										echo wp_kses_post( $conversions_faq->text );
									}
									?>
								</div>
							</div>
						</div>

						<?php
						++$faq_count;
					}
				}
				?>

			</div><!-- End FAQ -->
		</div>

		<?php
		do_action( 'conversions_homepage_after_faq' );
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * FAQ section.
	 *
	 * @since 2020-09-04
	 */
	public function faq() {
		$faq   = $this->get_faq();
		$title = get_theme_mod( 'conversions_faq_title' );
		$desc  = get_theme_mod( 'conversions_faq_desc' );
		if ( ! $faq && empty( $title ) && empty( $desc ) )
			return;
		?>
	<!-- Testimonial Section -->
	<section class="c-faq">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( $title ) || ! empty( $desc ) ) { ?>
					<!-- Title -->
					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( $title ) ) {
								// Title.
								echo '<h2 class="h3">' . wp_kses_post( $title ) . '</h2>';
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
				echo $this->faq_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
