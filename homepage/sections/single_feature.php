<?php
/**
 * Homepage single feature trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait single_feature {

	/**
	 * Check Single feature content exists before displaying.
	 *
	 * @since 2020-09-18
	 */
	public function check_single_feature() {

		$title       = get_theme_mod( 'conversions_single_feature_title' );
		$description = get_theme_mod( 'conversions_single_feature_desc' );

		$single_feature_media_type = get_theme_mod( 'conversions_single_feature_media_type', 'image' );
		switch ( $single_feature_media_type ) {
			case 'image':
				$single_feature_media = get_theme_mod( 'conversions_single_feature_img_id' );
				break;
			case 'youtube':
				$single_feature_media = get_theme_mod( 'conversions_single_feature_youtube' );
				break;
			case 'vimeo':
				$single_feature_media = get_theme_mod( 'conversions_single_feature_vimeo' );
				break;
			case 'shortcode':
				$single_feature_media = get_theme_mod( 'conversions_single_feature_shortcode' );
				break;
			default:
				$single_feature_media = get_theme_mod( 'conversions_single_feature_img_id' );
		}

		$has_single_feature = ( $title != '' || $description != '' || $single_feature_media != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( ! $has_single_feature )
			return false;
		return $has_single_feature;
	}

	/**
	 * Return the single feature content.
	 *
	 * @since 2020-09-18
	 */
	public function single_feature_content() {
		$single_feature = $this->check_single_feature();
		if ( ! $single_feature )
			return;

		// We want to capture the output so that we can return it.
		ob_start();
		do_action( 'conversions_before_single_feature' );

		// Single feature text.
		echo '<div class="col-12 col-md-6 c-single-feature__text">';
		if ( ! empty( get_theme_mod( 'conversions_single_feature_title' ) ) || ! empty( get_theme_mod( 'conversions_single_feature_desc' ) ) ) {

			if ( ! empty( get_theme_mod( 'conversions_single_feature_title' ) ) ) {
				// Title.
				echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_single_feature_title' ) ) . '</h2>';
			}
			if ( ! empty( get_theme_mod( 'conversions_single_feature_desc' ) ) ) {
				// Description.
				echo wp_kses_post( get_theme_mod( 'conversions_single_feature_desc' ) );
			}
		}
		echo '</div>';

		// Single feature media.
		echo '<div class="col-12 col-md-6 c-single-feature__media">';

		$single_feature_media_type = get_theme_mod( 'conversions_single_feature_media_type', 'image' );

		switch ( $single_feature_media_type ) {
			case 'image':
				// Get image ID.
				$single_feature_media_img = get_theme_mod( 'conversions_single_feature_img_id' );

				if ( ! empty( $single_feature_media_img ) ) {
					// Get the alt text.
					$single_feature_img_alt = get_post_meta( $single_feature_media_img, '_wp_attachment_image_alt', true );
					// Get the large image size.
					$single_feature_img_lg = wp_get_attachment_image_src( $single_feature_media_img, 'large', false );
					// If large size doesn't exist get the full size.
					if ( empty( $single_feature_img_lg ) ) {
						$single_feature_img_lg = wp_get_attachment_image_src( $single_feature_media_img, 'full', false );
					}
					// Create image HTML.
					$single_feature_media = '<img class="c-single-feature__image" loading="lazy" src="' . esc_url( $single_feature_img_lg[0] ) . '" alt="' . esc_attr( $single_feature_img_alt ) . '"/>';
				}
				break;
			case 'youtube':
				// Get Youtube ID.
				$single_feature_media_youtube = get_theme_mod( 'conversions_single_feature_youtube' );

				if ( ! empty( $single_feature_media_youtube ) ) {
					$single_feature_media  = '<div class="ratio ratio-16x9 c-single-feature__youtube">';
					$single_feature_media .= '<iframe loading="lazy" src="https://www.youtube.com/embed/' . esc_attr( $single_feature_media_youtube ) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
					$single_feature_media .= '</div>';
				}
				break;
			case 'vimeo':
				// Get Vimeo ID.
				$single_feature_media_vimeo = get_theme_mod( 'conversions_single_feature_vimeo' );

				if ( ! empty( $single_feature_media_vimeo ) ) {
					$single_feature_media  = '<div class="ratio ratio-16x9 c-single-feature__vimeo">';
					$single_feature_media .= '<iframe loading="lazy" src="https://player.vimeo.com/video/' . esc_attr( $single_feature_media_vimeo ) . '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
					$single_feature_media .= '</div>';
				}
				break;
			case 'shortcode':
				// Get shortcode.
				$single_feature_media_shortcode = get_theme_mod( 'conversions_single_feature_shortcode' );

				if ( ! empty( $single_feature_media_shortcode ) ) {
					$single_feature_media = do_shortcode( wp_kses_post( $single_feature_media_shortcode ) );
				}
				break;
			default:
				// Get image ID.
				$single_feature_media_img = get_theme_mod( 'conversions_single_feature_img_id' );

				if ( ! empty( $single_feature_media_img ) ) {
					// Get the alt text.
					$single_feature_img_alt = get_post_meta( $single_feature_media_img, '_wp_attachment_image_alt', true );
					// Get the large image size.
					$single_feature_img_lg = wp_get_attachment_image_src( $single_feature_media_img, 'large', false );
					// If large size doesn't exist get the full size.
					if ( empty( $single_feature_img_lg ) ) {
						$single_feature_img_lg = wp_get_attachment_image_src( $single_feature_media_img, 'full', false );
					}
					// Create image HTML.
					$single_feature_media = '<img class="c-single-feature__image" loading="lazy" src="' . esc_url( $single_feature_img_lg[0] ) . '" alt="' . esc_attr( $single_feature_img_alt ) . '"/>';
				}
		}

		if ( has_filter( 'conversions_single_feature_media' ) ) {
			$single_feature_media = apply_filters( 'conversions_single_feature_media', $single_feature_media );
		}

		if ( ! empty( $single_feature_media ) ) {
			echo $single_feature_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		echo '</div>';

		do_action( 'conversions_after_single_feature' );
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Single feature section.
	 *
	 * @since 2020-09-18
	 */
	public function single_feature() {
		$single_feature = $this->check_single_feature();
		if ( ! $single_feature )
			return;
		?>
	<!-- Features section -->
	<section class="c-single-feature">
		<div class="container-fluid">
			<div class="row">

				<?php
				echo $this->single_feature_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
