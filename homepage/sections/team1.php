<?php
/**
 * Homepage team trait.
 *
 * @package conversions-extension
 */

namespace conversions\sections;

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

		$team_block_count = 0;

		foreach ( $team as $repeater_item ) {
			// How many to show per row.
			$team_block_sm = get_theme_mod( 'conversions_team_sm', '2' );
			$team_block_md = get_theme_mod( 'conversions_team_md', '2' );
			$team_block_lg = get_theme_mod( 'conversions_team_lg', '3' );

			// # per row to bootstrap grid.
			$cfri = array(
				'1' => '12',
				'2' => '6',
				'3' => '4',
				'4' => '3',
			);

			// Team block html.
			echo '<div id="c-team__block-' . esc_attr( $team_block_count ) . '" class="c-team__block col-sm-' . esc_attr( $cfri[$team_block_sm] ) . ' col-md-' . esc_attr( $cfri[$team_block_md] ) . ' col-lg-' . esc_attr( $cfri[$team_block_lg] ) . '">';

			echo '<div class="card border-0 h-100"><div class="card-body p-2">';

			if ( ! empty( $repeater_item->image_url ) ) {
				$img_team_url = $repeater_item->image_url;
				$img_team_id  = conversions()->template->conversions_id_by_url( $img_team_url );
				// Retrieve the alt text.
				$img_team_alt = get_post_meta( $img_team_id, '_wp_attachment_image_alt', true );

				// Grab the team image size.
				$img_team = wp_get_attachment_image_src( $img_team_id, 'conversions-team', false );

				echo '<img class="c-team__block-img" src="' . esc_url( $img_team[0] ) . '" alt="' . esc_html( $img_team_alt ) . '">';
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
		$team = $this->get_team();
		if ( ! $team )
			return;
		?>
	<!-- Team section -->
	<section class="c-team">
		<div class="container-fluid">
			<div class="row">

				<?php

				if ( ! empty( get_theme_mod( 'conversions_team_title' ) ) || ! empty( get_theme_mod( 'conversions_team_desc' ) ) ) {
					?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_team_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_team_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_team_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_team_desc' ) ) . '</p>';
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
