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
		?>
		<!-- FAQ -->
		<div class="col-12">
			<!-- Accordion -->
			<div class="accordion w-md-95 w-lg-90 mx-auto shadow" id="c-faq__accordion">

				<?php
				$faq_count = 0;
				foreach ( $faq as $conversions_faq ) {
					if ( ! empty( $conversions_faq->title ) ) {

						if ( $faq_count > '0' ) {
							$faq_show      = '';
							$faq_collapsed = 'collapsed';
						} else {
							$faq_show      = 'show';
							$faq_collapsed = '';
						}
						?>

						<!-- FAQ card -->
						<div class="card">
							<div class="card-header" id="c-faq__heading-<?php echo esc_attr( $faq_count ); ?>">
								<h4 class="clearfix mb-0">
									<a class="btn btn-link <?php echo esc_attr( $faq_collapsed ); ?>" data-toggle="collapse" data-target="#c-faq__collapse-<?php echo esc_attr( $faq_count ); ?>" aria-expanded="true" aria-controls="c-faq__collapse-<?php echo esc_attr( $faq_count ); ?>">
										<i class="fas fa-plus-square"></i><?php echo esc_html( $conversions_faq->title ); ?>
									</a>									
								</h4>
							</div>
							<div id="c-faq__collapse-<?php echo esc_attr( $faq_count ); ?>" class="collapse <?php echo esc_attr( $faq_show ); ?>" aria-labelledby="c-faq__heading-<?php echo esc_attr( $faq_count ); ?>" data-parent="#c-faq__accordion">
								<div class="card-body">
									<?php
									if ( ! empty( $conversions_faq->text ) ) {
										echo esc_html( $conversions_faq->text );
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
		$faq = $this->get_faq();
		if ( ! $faq )
			return;
		?>
	<!-- Testimonial Section -->
	<section class="c-faq">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_faq_title' ) ) || ! empty( get_theme_mod( 'conversions_faq_desc' ) ) ) { ?>
					<!-- Title -->
					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_faq_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_faq_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_faq_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_faq_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>
				<?php } ?>


				<?php
					do_action( 'conversions_homepage_before_faq' );
					echo $this->faq_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					do_action( 'conversions_homepage_after_faq' );
				?>

			</div>
		</div>
	</section>
		<?php
	}
}