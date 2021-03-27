<?php
/**
 * Homepage icon features trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait icon_features {

	/**
	 * Return an array of icon feature blocks.
	 *
	 * @since 2019-12-19
	 */
	public function get_icon_features() {
		// Get all feature blocks.
		$icon_features         = get_theme_mod( 'conversions_features_icons' );
		$icon_features_decoded = json_decode( $icon_features );
		if ( ! $icon_features_decoded )
			return false;
		$has_icon_features = ( $icon_features_decoded[ 0 ]->icon_value != '' || $icon_features_decoded[ 0 ]->title != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( ! $has_icon_features )
			return false;
		return $icon_features_decoded;
	}

	/**
	 * Return the icon features content.
	 *
	 * @since 2019-12-19
	 */
	public function icon_features_content() {
		$icon_features = $this->get_icon_features();
		if ( ! $icon_features )
			return;

		// We want to capture the output so that we can return it.
		ob_start();
		do_action( 'conversions_before_icon_features' );

		// Array used to convert items per row to bootstrap grid.
		$bs_grid = array(
			'1' => '12',
			'2' => '6',
			'3' => '4',
			'4' => '3',
		);

		// Auto calculate items per row.
		if ( get_theme_mod( 'conversions_features_respond', 'auto' ) === 'auto' ) {

			// Icon block count.
			$total_icon_blocks = count( $icon_features );

			if ( $total_icon_blocks == 0 || $total_icon_blocks == 1 ) {
				// Count is 0 or 1.
				$conversions_icon_features_sm = 1;
				$conversions_icon_features_md = 1;
				$conversions_icon_features_lg = 1;
			} elseif ( $total_icon_blocks == 2 ) {
				// Count is 2.
				$conversions_icon_features_sm = 2;
				$conversions_icon_features_md = 2;
				$conversions_icon_features_lg = 2;
			} elseif ( ! is_float( $total_icon_blocks / 3 ) || $total_icon_blocks / 3 - floor( $total_icon_blocks / 3 ) >= 0.5 ) {
				// Count is evenly divisible by 3 or has a float higher than .5.
				$conversions_icon_features_sm = 2;
				$conversions_icon_features_md = 2;
				$conversions_icon_features_lg = 3;
			} elseif ( ! is_float( $total_icon_blocks / 2 ) || $total_icon_blocks / 2 - floor( $total_icon_blocks / 2 ) >= 0.5 ) {
				// Count is evenly divisible by 2 or has a float higher than .5.
				$conversions_icon_features_sm = 2;
				$conversions_icon_features_md = 2;
				$conversions_icon_features_lg = 2;
			} else {
				// Fallback.
				$conversions_icon_features_sm = 1;
				$conversions_icon_features_md = 1;
				$conversions_icon_features_lg = 1;
			}
		} else { // User decides items per row.

			// How many to show per row.
			$conversions_icon_features_sm = get_theme_mod( 'conversions_features_sm', '2' );
			$conversions_icon_features_md = get_theme_mod( 'conversions_features_md', '2' );
			$conversions_icon_features_lg = get_theme_mod( 'conversions_features_lg', '3' );

		}

		// Block count for HTML IDs.
		$cfeature_block_count = 0;

		// Loop the icon features.
		foreach ( $icon_features as $repeater_item ) {

			// Feature block.
			echo '<div id="c-features__block-' . esc_attr( $cfeature_block_count ) . '" class="c-features__block col-sm-' . esc_attr( $bs_grid[$conversions_icon_features_sm] ) . ' col-md-' . esc_attr( $bs_grid[$conversions_icon_features_md] ) . ' col-lg-' . esc_attr( $bs_grid[$conversions_icon_features_lg] ) . '">';

			echo '<div class="card border-0 h-100"><div class="card-body p-2">';

			if ( ! empty( $repeater_item->icon_value ) ) {
				if ( ! empty( $repeater_item->color ) ) {
					echo '<span class="c-features__block-icon"><i class="' . esc_attr( $repeater_item->icon_value ) . ' mb-3" aria-hidden="true" style="color:' . esc_attr( $repeater_item->color ) . ';"></i></span>';
				} else {
					echo '<span class="c-features__block-icon"><i class="' . esc_attr( $repeater_item->icon_value ) . ' mb-3" aria-hidden="true"></i></span>';
				}
			}

			if ( ! empty( $repeater_item->title ) ) {
				echo '<h3 class="h5">' . esc_html( $repeater_item->title ) . '</h3>';
			}

			if ( ! empty( $repeater_item->text ) ) {
				echo '<p class="c-features__block-desc">' . esc_html( $repeater_item->text ) . '</p>';
			}

			if ( ! empty( $repeater_item->linktext ) ) {
				echo sprintf(
					'<a class="c-features__block-link" href="%s">%s</a>',
					esc_url( $repeater_item->link ),
					esc_html( $repeater_item->linktext )
				);
			}

			echo '</div></div></div>';

			++$cfeature_block_count;
		}

		do_action( 'conversions_after_icon_features' );
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Icon Features section.
	 *
	 * @since 2019-12-16
	 */
	public function features() {
		$icon_features = $this->get_icon_features();
		$title         = get_theme_mod( 'conversions_features_title' );
		$desc          = get_theme_mod( 'conversions_features_desc' );
		if ( ! $icon_features && empty( $title ) && empty( $desc ) )
			return;
		?>
	<!-- Icon Features section -->
	<section class="c-features">
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

				echo $this->icon_features_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
