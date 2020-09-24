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
				$single_feature_media = get_theme_mod( 'conversions_single_feature_img' );
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
				$single_feature_media = get_theme_mod( 'conversions_single_feature_img' );
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

		// Single feature text.
		echo '<div class="col-12 col-md-6 c-single-feature__text">';
		if ( ! empty( get_theme_mod( 'conversions_single_feature_title' ) ) || ! empty( get_theme_mod( 'conversions_single_feature_desc' ) ) ) {

			if ( ! empty( get_theme_mod( 'conversions_single_feature_title' ) ) ) {
				// Title.
				echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_single_feature_title' ) ) . '</h2>';
			}
			if ( ! empty( get_theme_mod( 'conversions_single_feature_desc' ) ) ) {
				// Description.
				echo '<p>' . wp_kses_post( get_theme_mod( 'conversions_single_feature_desc' ) ) . '</p>';
			}
		}
		echo '</div>';

		// Single feature media.
		echo '<div class="col-12 col-md-6 c-single-feature__media">';

		$single_feature_media_type = get_theme_mod( 'conversions_single_feature_media_type', 'image' );

		switch ( $single_feature_media_type ) {
			case 'image':
				// Get image URL.
				$single_feature_media_img = get_theme_mod( 'conversions_single_feature_img' );

				if ( ! empty( $single_feature_media_img ) ) {
					// Get image ID from URL.
					$single_feature_img_id = conversions()->template->conversions_id_by_url( $single_feature_media_img );
					// Get the alt text.
					$single_feature_img_alt = get_post_meta( $single_feature_img_id, '_wp_attachment_image_alt', true );
					// Get the large image size.
					$single_feature_img_lg = wp_get_attachment_image_src( $single_feature_img_id, 'large', false );
					// Create image HTML.
					$single_feature_media = '<img class="c-single-feature__image" src="' . esc_url( $single_feature_img_lg[0] ) . '" alt="' . esc_attr( $single_feature_img_alt ) . '"/>';
				}
				break;
			case 'youtube':
				// Get Youtube ID.
				$single_feature_media_youtube = get_theme_mod( 'conversions_single_feature_youtube' );

				if ( ! empty( $single_feature_media_youtube ) ) {
					$single_feature_media  = '<div class="embed-responsive embed-responsive-16by9 c-single-feature__youtube">';
					$single_feature_media .= '<iframe class="embed-responsive-item" loading="lazy" src="https://www.youtube.com/embed/' . esc_attr( $single_feature_media_youtube ) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
					$single_feature_media .= '</div>';
				}
				break;
			case 'vimeo':
				// Get Vimeo ID.
				$single_feature_media_vimeo = get_theme_mod( 'conversions_single_feature_vimeo' );

				if ( ! empty( $single_feature_media_vimeo ) ) {
					$single_feature_media  = '<div class="embed-responsive embed-responsive-16by9 c-single-feature__vimeo">';
					$single_feature_media .= '<iframe class="embed-responsive-item" loading="lazy" src="https://player.vimeo.com/video/' . esc_attr( $single_feature_media_vimeo ) . '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
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
				// Get image URL.
				$single_feature_media_img = get_theme_mod( 'conversions_single_feature_img' );

				if ( ! empty( $single_feature_media_img ) ) {
					// Get image ID from URL.
					$single_feature_img_id = conversions()->template->conversions_id_by_url( $single_feature_media_img );
					// Get the alt text.
					$single_feature_img_alt = get_post_meta( $single_feature_img_id, '_wp_attachment_image_alt', true );
					// Get the large image size.
					$single_feature_img_lg = wp_get_attachment_image_src( $single_feature_img_id, 'large', false );
					// Create image HTML.
					$single_feature_media = '<img class="c-single-feature__image" src="' . esc_url( $single_feature_img_lg[0] ) . '" alt="' . esc_attr( $single_feature_img_alt ) . '"/>';
				}
				break;
		}

		if ( ! empty( $single_feature_media ) ) {
			echo $single_feature_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		echo '</div>';

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

				do_action( 'conversions_before_single_feature' );
				echo $this->single_feature_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_after_single_feature' );

				?>

			</div>
		</div>
	</section>
		<?php
	}
}
