<?php
/**
 * Homepage team trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait team {

	/**
	 * Return the team blocks.
	 *
	 * @since 2020-05-27
	 */
	public function get_team() {
		// Get all team blocks.
		$team = get_theme_mod( 'conversions_team_details' );
		$team = json_decode( $team );

		if ( ! $team )
			return false;

		$has_team = ( $team[ 0 ]->image_url != '' || $team[ 0 ]->title != '' || $team[ 0 ]->subtitle != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

		if ( ! $has_team )
			return false;

		return $team;
	}

	/**
	 * Return the team content.
	 *
	 * @since 2020-05-27
	 */
	public function team_content() {
		$team = $this->get_team();
		if ( ! $team )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		// Array used to convert items per row to bootstrap grid.
		$bs_grid = array(
			'1' => '12',
			'2' => '6',
			'3' => '4',
			'4' => '3',
		);

		// Auto calculate items per row.
		if ( get_theme_mod( 'conversions_team_respond', 'auto' ) === 'auto' ) {

			// Team block count.
			$total_team_blocks = count( $team );

			if ( $total_team_blocks == 0 || $total_team_blocks == 1 ) {
				// Count is 0 or 1.
				$team_block_sm = 1;
				$team_block_md = 1;
				$team_block_lg = 1;
			} elseif ( $total_team_blocks == 2 ) {
				// Count is 2.
				$team_block_sm = 2;
				$team_block_md = 2;
				$team_block_lg = 2;
			} elseif ( ! is_float( $total_team_blocks / 3 ) || $total_team_blocks / 3 - floor( $total_team_blocks / 3 ) >= 0.5 ) {
				// Count is evenly divisible by 3 or has a float higher than .5.
				$team_block_sm = 2;
				$team_block_md = 2;
				$team_block_lg = 3;
			} elseif ( ! is_float( $total_team_blocks / 2 ) || $total_team_blocks / 2 - floor( $total_team_blocks / 2 ) >= 0.5 ) {
				// Count is evenly divisible by 2 or has a float higher than .5.
				$team_block_sm = 2;
				$team_block_md = 2;
				$team_block_lg = 2;
			} else {
				// Fallback.
				$team_block_sm = 1;
				$team_block_md = 1;
				$team_block_lg = 1;
			}
		} else { // User decides items per row.

			// How many to show per row.
			$team_block_sm = get_theme_mod( 'conversions_team_sm', '2' );
			$team_block_md = get_theme_mod( 'conversions_team_md', '2' );
			$team_block_lg = get_theme_mod( 'conversions_team_lg', '3' );

		}

		// Block count for HTML IDs.
		$team_block_count = 0;

		foreach ( $team as $repeater_item ) {

			// Team block html.
			echo '<div id="c-team__block-' . esc_attr( $team_block_count ) . '" class="c-team__block col-sm-' . esc_attr( $bs_grid[$team_block_sm] ) . ' col-md-' . esc_attr( $bs_grid[$team_block_md] ) . ' col-lg-' . esc_attr( $bs_grid[$team_block_lg] ) . '">';

			echo '<div class="card border-0 h-100"><div class="card-body p-2">';

			$img_team_img = $repeater_item->image_url;
			if ( ! empty( $img_team_img ) ) {
				/*
				 * We check below whether the img is in ID or URL form.
				 * IDs will only be numerical.
				 * Before v1.2.0 used URLs, 1.2.0+ use IDs.
				 * Eventually the URL check should be deprecated.
				 */
				if ( is_numeric( $img_team_img ) ) {

					// Grab the team image size.
					$img_team = wp_get_attachment_image_src( $img_team_img, 'conversions-team', false );

					// Retrieve the alt text.
					$img_team_alt = get_post_meta( $img_team_img, '_wp_attachment_image_alt', true );

				} elseif ( filter_var( $img_team_img, FILTER_VALIDATE_URL ) ) {

					// Get the img ID from the img URL.
					$img_team_id = conversions()->template->conversions_id_by_url( $img_team_img );

					// Grab the team image size.
					$img_team = wp_get_attachment_image_src( $img_team_id, 'conversions-team', false );

					// Retrieve the alt text.
					$img_team_alt = get_post_meta( $img_team_id, '_wp_attachment_image_alt', true );

				}
				// Output image.
				echo '<img class="c-team__block-img" loading="lazy" src="' . esc_url( $img_team[0] ) . '" alt="' . esc_html( $img_team_alt ) . '">';
			}

			if ( ! empty( $repeater_item->title ) ) {
				echo '<h3 class="h5">' . esc_html( $repeater_item->title ) . '</h3>';
			}

			if ( ! empty( $repeater_item->subtitle ) ) {
				echo '<h4 class="h6">' . esc_html( $repeater_item->subtitle ) . '</h4>';
			}

			if ( ! empty( $repeater_item->text ) ) {
				echo '<p class="c-team__block-desc">' . esc_html( $repeater_item->text ) . '</p>';
			}

			// Get social icons.
			$social_repeater = json_decode( html_entity_decode( $repeater_item->social_repeater ) );
			if ( ! empty( $social_repeater ) ) {
				echo '<ul class="list-inline">';
				$team_social_count = 0;
				foreach ( $social_repeater as $value ) {
					echo '<li class="list-inline-item">
					<a class="c-team__block-icon ' . esc_attr( $team_social_count ) . '" href="' . esc_url( $value->link ) . '">
					<i class="' . esc_attr( $value->icon ) . '" aria-hidden="true"></i>
					</a>
					</li>';
					++$team_social_count;
				}
				echo '</ul>';
			}

			echo '</div></div></div>';

			++$team_block_count;
		}

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Team section.
	 *
	 * @since 2020-05-27
	 */
	public function team() {
		$team  = $this->get_team();
		$title = get_theme_mod( 'conversions_team_title' );
		$desc  = get_theme_mod( 'conversions_team_desc' );
		if ( ! $team && empty( $title ) && empty( $desc ) )
			return;
		?>

	<!-- Team section -->
	<section class="c-team">
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

				do_action( 'conversions_homepage_before_team' );
				echo $this->team_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_homepage_after_team' );

				?>

			</div>
		</div>
	</section>
		<?php
	}
}
