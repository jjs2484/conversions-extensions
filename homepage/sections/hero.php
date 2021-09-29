<?php
/**
 * Homepage hero trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait hero {

	/**
	 * Hero title.
	 *
	 * @since 2021-02-08
	 */
	public function hero_title() {
		// Title.
		$title_type = get_theme_mod( 'conversions_hh_title', 'page' );
		switch ( $title_type ) {
			case 'alt':
				if ( ! empty( get_theme_mod( 'conversions_hh_alt_title' ) ) ) {
					$title = '<h1>' . wp_kses_post( get_theme_mod( 'conversions_hh_alt_title' ) ) . '</h1>';
				}
				break;
			case 'page':
				$title = '<h1>' . esc_html( get_the_title() ) . '</h1>';
				break;
			default:
				$title = '<h1>' . esc_html( get_the_title() ) . '</h1>';
		}

		echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Hero description.
	 *
	 * @since 2021-02-08
	 */
	public function hero_desc() {
		// Description.
		$desc = '';
		if ( ! empty( get_theme_mod( 'conversions_hh_desc' ) ) ) {
			$desc = '<div class="lead c-hero__description">' . wp_kses_post( get_theme_mod( 'conversions_hh_desc' ) ) . '</div>';
		}

		// Apply filter if exists.
		if ( has_filter( 'conversions_hero_description' ) ) {
			$desc = apply_filters( 'conversions_hero_description', $desc );
		}

		echo $desc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Hero buttons.
	 *
	 * @since 2021-02-08
	 */
	public function hero_buttons() {

		// Customizer options.
		$callout = get_theme_mod( 'conversions_hh_button', 'no' );
		$video   = get_theme_mod( 'conversions_hh_vbtn', 'no' );

		if ( $callout === 'no' && $video === 'no' ) {
			return;
		}

		// We want to capture the output so that we can return it.
		ob_start();

		// Button wrapper.
		echo '<p class="lead c-hero__callout">';

		// Callout button.
		if ( $callout !== 'no' ) {
			echo sprintf(
				'<a href="%s" class="btn %s btn-lg c-hero__callout-btn">%s</a>',
				esc_url( get_theme_mod( 'conversions_hh_button_url' ) ),
				esc_attr( get_theme_mod( 'conversions_hh_button' ) ),
				esc_html( get_theme_mod( 'conversions_hh_button_text' ) )
			);
		}

		// Video button.
		if ( $video !== 'no' ) {
			echo sprintf(
				'<a data-bs-src="%1$s" data-bs-toggle="modal" data-bs-target="#c-hero-modal" href="#" class="c-hero__fb-video"><span class="c-hero__video-btn btn btn-%2$s btn--circle"><i class="fa fa-play"></i></span><span class="c-hero__video-text btn btn-link text-%2$s">%3$s</span></a>',
				esc_url( 'https://www.youtube.com/embed/' . get_theme_mod( 'conversions_hh_vbtn_url' ) ),
				esc_attr( get_theme_mod( 'conversions_hh_vbtn' ) ),
				esc_html( get_theme_mod( 'conversions_hh_vbtn_text' ) )
			);
		}

		// Close wrapper.
		echo '</p>';

		// Video modal.
		if ( $video !== 'no' ) {
			?>
			<div class="modal fade" id="c-hero-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							<!-- 16:9 aspect ratio -->
							<div class="ratio ratio-16x9">
								<?php // phpcs:disable WPThemeReview.ThouShallNotUse.ForbiddenIframe.Found ?>
								<iframe src="" id="video" allow="autoplay" allowfullscreen></iframe>
								<?php // phpcs:enable ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Hero split mask type.
	 *
	 * @since 2021-03-01
	 */
	public static function hero_split_mask_type() {

		// Customizer choice.
		$split_shape = get_theme_mod( 'conversions_hh_split_type' );

		// Geometrical shapes that require inline image rather than bg images.
		$geo_shapes = [ 'drop', 'heart', 'diamond', 'hexagon', 'shield', 'star', 'shatter', 'blob-1', 'blob-2', 'blob-3' ];

		if ( in_array( $split_shape, $geo_shapes ) ) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Hero full.
	 *
	 * @since 2021-02-08
	 */
	public function hero_full() {

		// We want to capture the output so that we can return it.
		ob_start();
		?>
		<!-- Hero Section -->
		<section class="c-hero c-hero__full d-flex align-items-center">
			<div class="container-fluid">
				<div class="row">
					<div class="<?php echo esc_attr( get_theme_mod( 'conversions_hh_content_position' ) ); ?>">
						<div class="c-hero__content">
							<?php
							// Title.
							echo $this->hero_title(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

							// Description.
							$desc = $this->hero_desc();
							if ( ! empty( $desc ) ) {
								echo $desc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}

							// Buttons.
							echo $this->hero_buttons(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</div>
					</div>
					<?php do_action( 'conversions_hero_full_after_content' ); ?>
				</div>
			</div>
		</section>
		<?php
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Hero split.
	 *
	 * @since 2021-02-08
	 */
	public function hero_split() {

		// We want to capture the output so that we can return it.
		ob_start();
		?>

		<section class="c-hero c-hero__split">
			<div class="container-fluid px-0">
				<div class="row g-0">
					<div class="col-lg-6 order-lg-2">

						<?php
						$mask_type = $this->hero_split_mask_type();
						if ( $mask_type == true ) {
							echo '<div class="c-hero__split-img c-hero__split-geo"></div>';
						} else {
							echo '<div class="c-hero__split-img"></div>';
						}
						?>

					</div>
					<div class="col-lg-6 d-flex align-items-center">
						<div class="c-hero__content mx-auto me-lg-5 me-xl-7 ps-lg-3 py-lg-3 order-lg-1">
							<?php
							// Title.
							echo $this->hero_title(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

							// Description.
							$desc = $this->hero_desc();
							if ( ! empty( $desc ) ) {
								echo $desc; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}

							// Buttons.
							echo $this->hero_buttons(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Hero section.
	 *
	 * @since 2019-12-16
	 */
	public function hero() {

		if ( get_theme_mod( 'conversions_hh_type', 'full' ) === 'full' ) {

			echo $this->hero_full(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		} elseif ( get_theme_mod( 'conversions_hh_type', 'full' ) === 'split' ) {

			echo $this->hero_split(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		}
	}
}
