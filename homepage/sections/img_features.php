<?php
/**
 * Homepage image features trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait img_features {

	/**
	 * Return an array of image feature blocks.
	 *
	 * @since 2020-05-14
	 */
	public function get_img_features() {
		// Get all image feature blocks.
		$img_features         = get_theme_mod( 'conversions_img_features_imgs' );
		$img_features_decoded = json_decode( $img_features );
		if ( ! $img_features_decoded )
			return false;
		$has_img_features = ( $img_features_decoded[ 0 ]->image_url != '' || $img_features_decoded[ 0 ]->title != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( ! $has_img_features )
			return false;
		return $img_features_decoded;
	}

	/**
	 * Return the image features content.
	 *
	 * @since 2020-05-14
	 */
	public function img_features_content() {
		$img_features = $this->get_img_features();
		if ( ! $img_features )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		$img_feature_block_count = 0;

		foreach ( $img_features as $repeater_item ) {
			// How many to show per row.
			$img_features_block_sm = get_theme_mod( 'conversions_img_features_sm', '2' );
			$img_features_block_md = get_theme_mod( 'conversions_img_features_md', '2' );
			$img_features_block_lg = get_theme_mod( 'conversions_img_features_lg', '3' );

			// # per row to bootstrap grid.
			$cfri = array(
				'1' => '12',
				'2' => '6',
				'3' => '4',
				'4' => '3',
			);

			// Feature image block html.
			echo '<div id="c-img-features__block-' . esc_attr( $img_feature_block_count ) . '" class="c-img-features__block col-sm-' . esc_attr( $cfri[$img_features_block_sm] ) . ' col-md-' . esc_attr( $cfri[$img_features_block_md] ) . ' col-lg-' . esc_attr( $cfri[$img_features_block_lg] ) . '">';

			// If link available wrap image.
			if ( ! empty( $repeater_item->link ) ) {
				echo '<a class="card h-100" href="' . esc_url( $repeater_item->link ) . '">';
			} else {
				echo '<div class="card h-100">';
			}

			// Retrieve user img.
			$img_feat_img = $repeater_item->image_url;
			if ( ! empty( $img_feat_img ) ) {
				/*
				 * We check below whether the img is in ID or URL form.
				 * IDs will only be numerical.
				 * Before v1.2.0 used URLs, 1.2.0+ use IDs.
				 * Eventually the URL check should be deprecated.
				 */
				if ( is_numeric( $img_feat_img ) ) {

					// Get the image sizes.
					$img_feat_md = wp_get_attachment_image_src( $img_feat_img, 'medium', false );
					$img_feat_lg = wp_get_attachment_image_src( $img_feat_img, 'large', false );

					// If large size doesn't exist get the full size.
					if ( empty( $img_feat_lg ) ) {
						$img_feat_lg = wp_get_attachment_image_src( $img_feat_img, 'full', false );
					}

					// Get the alt text.
					$img_feat_alt = get_post_meta( $img_feat_img, '_wp_attachment_image_alt', true );

				} elseif ( filter_var( $img_feat_img, FILTER_VALIDATE_URL ) ) {

					// Get the img ID from the img URL.
					$img_feat_id = conversions()->template->conversions_id_by_url( $img_feat_img );

					// Get the image sizes.
					$img_feat_md = wp_get_attachment_image_src( $img_feat_id, 'medium', false );
					$img_feat_lg = wp_get_attachment_image_src( $img_feat_id, 'large', false );

					// If large size doesn't exist get the full size.
					if ( empty( $img_feat_lg ) ) {
						$img_feat_lg = wp_get_attachment_image_src( $img_feat_id, 'full', false );
					}

					// Get the alt text.
					$img_feat_alt = get_post_meta( $img_feat_id, '_wp_attachment_image_alt', true );

				}
				// Output image.
				echo '<img class="card-img-top" src="' . esc_url( $img_feat_lg[0] ) . '" alt="' . esc_html( $img_feat_alt ) . '" srcset="' . esc_url( $img_feat_md[0] ) . ' 300w, ' . esc_url( $img_feat_lg[0] ) . ' 1024w">';
			}

			echo '<div class="card-body">';

			if ( ! empty( $repeater_item->title ) ) {
				echo '<h3 class="h5">' . esc_html( $repeater_item->title ) . '</h3>';
			}

			if ( ! empty( $repeater_item->text ) ) {
				echo '<p class="c-img-features__block-desc">' . esc_html( $repeater_item->text ) . '</p>';
			}

			if ( ! empty( $repeater_item->linktext ) ) {
				echo '<span class="c-img-features__block-link">' . esc_html( $repeater_item->linktext ) . '</span>';
			}

			if ( ! empty( $repeater_item->link ) ) {
				echo '</div></a></div>';
			} else {
				echo '</div></div></div>';
			}

			++$img_feature_block_count;
		}

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Image features section.
	 *
	 * @since 2020-05-14
	 */
	public function img_features() {
		$img_features = $this->get_img_features();
		$title        = get_theme_mod( 'conversions_img_features_title' );
		$desc         = get_theme_mod( 'conversions_img_features_desc' );
		if ( ! $img_features && empty( $title ) && empty( $desc ) )
			return;
		?>
	<!-- Features section -->
	<section class="c-img-features">
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

				do_action( 'conversions_before_img_features' );
				echo $this->img_features_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_after_img_features' );

				?>

			</div>
		</div>
	</section>
		<?php
	}
}
