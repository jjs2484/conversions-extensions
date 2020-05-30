<?php
/**
 * Homepage hero trait.
 *
 * @package conversions-extension
 */

namespace conversions\sections;

trait hero {
	/**
	 * Hero section.
	 *
	 * @since 2019-12-16
	 */
	public function hero() {
		?>
	<!-- Hero Section -->
	<section class="c-hero d-flex align-items-center">
		<div class="container-fluid">
			<div class="row">
				<div class="<?php echo esc_attr( get_theme_mod( 'conversions_hh_content_position' ) ); ?>">

					<!-- Title -->
					<h1><?php echo esc_html( get_the_title() ); ?></h1>

					<?php
					if ( ! empty( get_theme_mod( 'conversions_hh_desc' ) ) ) {
						echo '<p class="lead c-hero__description">' . wp_kses_post( get_theme_mod( 'conversions_hh_desc' ) ) . '</p>';
					}

					if ( ( get_theme_mod( 'conversions_hh_button', 'no' ) !== 'no' ) || ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) !== 'no' ) ) :

						// Button links.
						echo '<p class="lead">';

						// callout button.
						if ( get_theme_mod( 'conversions_hh_button', 'no' ) !== 'no' ) {
							echo sprintf(
								'<a href="%s" class="btn %s btn-lg c-hero__callout-btn">%s</a>',
								esc_url( get_theme_mod( 'conversions_hh_button_url' ) ),
								esc_attr( get_theme_mod( 'conversions_hh_button' ) ),
								esc_html( get_theme_mod( 'conversions_hh_button_text' ) )
							);
						}

						// video modal.
						if ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) !== 'no' ) {

							echo sprintf(
								'<a data-src="%1$s" data-toggle="modal" data-target="#c-hero-modal" href="#" class="c-hero__fb-video"><span class="c-hero__video-btn btn btn-%2$s btn--circle"><i class="fa fa-play"></i></span><span class="c-hero__video-text btn btn-link text-%2$s">%3$s</span></a>',
								esc_url( 'https://www.youtube.com/embed/' . get_theme_mod( 'conversions_hh_vbtn_url' ) ),
								esc_attr( get_theme_mod( 'conversions_hh_vbtn' ) ),
								esc_html( get_theme_mod( 'conversions_hh_vbtn_text' ) )
							);
							?>

							<!-- Modal -->
							<div class="modal fade" id="c-hero-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<!-- 16:9 aspect ratio -->
											<div class="embed-responsive embed-responsive-16by9">
												<?php // phpcs:disable WPThemeReview.ThouShallNotUse.ForbiddenIframe.Found ?>
												<iframe class="embed-responsive-item" src="" id="video" allow="autoplay" allowfullscreen></iframe>
												<?php // phpcs:enable ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}

						echo '</p>';

					endif;
					?>

				</div>
			</div>
		</div>
	</section>
		<?php
	}
}
