<?php
/**
 * Homepage gallery trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait gallery {

	/**
	 * Return an array of gallery blocks.
	 *
	 * @since 2021-03-17
	 */
	public function get_gallery() {

		// Get all gallery blocks.
		$gallery_array = get_theme_mod( 'conversions_gallery_images' );
		if ( ! is_array( $gallery_array ) || empty( $gallery_array ) )
			return false;

		return $gallery_array;
	}

	/**
	 * Return the gallery content.
	 *
	 * @since 2021-03-17
	 */
	public function gallery_content() {
		$gallery = $this->get_gallery();
		if ( ! $gallery )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		// Array used to convert items per row to bootstrap grid.
		$bs_grid = array(
			'1' => '12',
			'2' => '6',
			'3' => '4',
			'4' => '3',
			'5' => '2',
			'6' => '2',
		);

		// Auto calculate items per row.
		if ( get_theme_mod( 'conversions_gallery_respond', 'auto' ) === 'auto' ) {

			// Image block count.
			$total_gallery_blocks = count( $gallery );

			if ( $total_gallery_blocks < 2 ) {
				// Count is 0 or 1.
				$gallery_block_xs = 1;
				$gallery_block_sm = 1;
				$gallery_block_md = 1;
				$gallery_block_lg = 1;
			} elseif ( $total_gallery_blocks == 13 || $total_gallery_blocks == 25 || $total_gallery_blocks == 37 || $total_gallery_blocks == 49 || $total_gallery_blocks == 61 || $total_gallery_blocks == 73 || $total_gallery_blocks == 85 ) {
				// Count is an oddball number.
				$gallery_block_xs = 2;
				$gallery_block_sm = 3;
				$gallery_block_md = 4;
				$gallery_block_lg = 6;
			} elseif ( ! is_float( $total_gallery_blocks / 6 ) || $total_gallery_blocks / 6 >= 1 && $total_gallery_blocks / 6 - floor( $total_gallery_blocks / 6 ) >= 0.5 ) {
				// Count is evenly divisible by 6 or is greater than 1.5.
				$gallery_block_xs = 2;
				$gallery_block_sm = 3;
				$gallery_block_md = 3;
				$gallery_block_lg = 6;
			} elseif ( ! is_float( $total_gallery_blocks / 4 ) || $total_gallery_blocks / 4 >= 1 && $total_gallery_blocks / 4 - floor( $total_gallery_blocks / 4 ) >= 0.5 ) {
				// Count is evenly divisible by 4 or is greater than 1.5.
				$gallery_block_xs = 2;
				$gallery_block_sm = 2;
				$gallery_block_md = 4;
				$gallery_block_lg = 4;
			} elseif ( ! is_float( $total_gallery_blocks / 3 ) || $total_gallery_blocks / 3 >= 1 && $total_gallery_blocks / 3 - floor( $total_gallery_blocks / 3 ) >= 0.5 ) {
				// Count is evenly divisible by 3 or is greater than 1.5.
				$gallery_block_xs = 2;
				$gallery_block_sm = 3;
				$gallery_block_md = 3;
				$gallery_block_lg = 3;
			} elseif ( ! is_float( $total_gallery_blocks / 2 ) || $total_gallery_blocks / 2 >= 1 && $total_gallery_blocks / 2 - floor( $total_gallery_blocks / 2 ) >= 0.5 ) {
				// Count is evenly divisible by 2 or is greater than 1.5.
				$gallery_block_xs = 2;
				$gallery_block_sm = 2;
				$gallery_block_md = 2;
				$gallery_block_lg = 2;
			} else {
				// Fallback.
				$gallery_block_xs = 1;
				$gallery_block_sm = 1;
				$gallery_block_md = 1;
				$gallery_block_lg = 1;
			}
		} else { // User decides items per row.

			// How many to show per row.
			$gallery_block_xs = get_theme_mod( 'conversions_gallery_xs', '2' );
			$gallery_block_sm = get_theme_mod( 'conversions_gallery_sm', '3' );
			$gallery_block_md = get_theme_mod( 'conversions_gallery_md', '4' );
			$gallery_block_lg = get_theme_mod( 'conversions_gallery_lg', '6' );

		}

		// Block count for HTML IDs.
		$gallery_block_count = 0;

		echo '<div class="row">';

		// Loop the image features.
		foreach ( $gallery as $image ) {

			// Feature image block html.
			echo '<div id="c-gallery__image-' . esc_attr( $gallery_block_count ) . '" class="c-gallery__image col-' . esc_attr( $bs_grid[$gallery_block_xs] ) . ' col-sm-' . esc_attr( $bs_grid[$gallery_block_sm] ) . ' col-md-' . esc_attr( $bs_grid[$gallery_block_md] ) . ' col-lg-' . esc_attr( $bs_grid[$gallery_block_lg] ) . '">';

			// Get the gallery image size.
			$image_gal = wp_get_attachment_image_src( $image, 'conversions-gallery', false );

			// Get the large size.
			$image_lg = wp_get_attachment_image_src( $image, 'large', false );
			// If large size doesn't exist get the full size.
			if ( empty( $image_lg ) ) {
				$image_lg = wp_get_attachment_image_src( $image, 'full', false );
			}

			// Get the alt text.
			$image_alt = get_post_meta( $image, '_wp_attachment_image_alt', true );

			// Output image.
			echo '<a href="' . esc_url( $image_lg[0] ) . '" data-lightbox="conversions-gallery"><img loading="lazy" src="' . esc_url( $image_gal[0] ) . '" alt="' . esc_html( $image_alt ) . '"></a>';

			echo '</div>';

			++$gallery_block_count;
		}

		echo '</div>';

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Gallery section.
	 *
	 * @since 2021-03-18
	 */
	public function gallery() {
		$gallery = $this->get_gallery();
		$title   = get_theme_mod( 'conversions_gallery_title' );
		$desc    = get_theme_mod( 'conversions_gallery_desc' );
		if ( ! $gallery && empty( $title ) && empty( $desc ) )
			return;
		?>
		<!-- Features section -->
		<section class="c-gallery">
			<div class="container-fluid">
				<div class="row">

					<?php
					if ( ! empty( $title ) || ! empty( $desc ) ) {
						?>

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

						<?php 
					}
					?>

				</div>

				<?php
				do_action( 'conversions_before_gallery' );
				echo $this->gallery_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_after_gallery' );
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
