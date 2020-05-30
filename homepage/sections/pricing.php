<?php
/**
 * Homepage pricing trait.
 *
 * @package conversions-extension
 */

namespace conversions\sections;

trait pricing {

	/**
	 * Return the pricing blocks.
	 *
	 * @since 2019-12-19
	 */
	public function get_pricing() {
		// Get all pricing tables.
		$pricing = get_theme_mod( 'conversions_pricing_repeater' );
		$pricing = json_decode( $pricing );

		if ( ! $pricing )
			return false;

		$has_pricing = ( $pricing[ 0 ]->title != '' || $pricing[ 0 ]->subtitle != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

		if ( ! $has_pricing )
			return false;

		return $pricing;
	}

	/**
	 * Return the pricing content.
	 *
	 * @since 2019-12-19
	 */
	public function pricing_content() {
		$pricing = $this->get_pricing();
		if ( ! $pricing )
			return;

		// We want to capture the output so that we can return it.
		ob_start();
		if ( get_theme_mod( 'conversions_pricing_respond', 'auto' ) === 'auto' ) {
			// Count pricing tables in loop.
			$cpt_total_count = count( $pricing );
			// Auto calc columns.
			$conversions_pricing_sm = 12;
			$conversions_pricing_md = 12;
			$conversions_pricing_lg = conversions()->template->auto_col_calc( $cpt_total_count );
		} else {
			// # per row to bootstrap grid.
			$cpri = array(
				'1' => '12',
				'2' => '5',
				'3' => '4',
				'4' => '3',
			);
			// manual options per row.
			$conversions_pricing_sm = $cpri[get_theme_mod( 'conversions_pricing_sm', '1' )];
			$conversions_pricing_md = $cpri[get_theme_mod( 'conversions_pricing_md', '1' )];
			$conversions_pricing_lg = $cpri[get_theme_mod( 'conversions_pricing_lg', '3' )];
		}

		$cpricing_table_count = 0;

		foreach ( $pricing as $repeater_item ) {

			// Pricing table.
			echo '<div id="c-pricing__table-' . esc_attr( $cpricing_table_count ) . '" class="c-pricing__table col-sm-' . esc_attr( $conversions_pricing_sm ) . ' col-md-' . esc_attr( $conversions_pricing_md ) . ' col-lg-' . esc_attr( $conversions_pricing_lg ) . '">';
			?>

				<div class="card shadow h-100">
					<header class="card-header">
						<h4 class="h5 text-secondary mb-3">
							<?php
								// Plan title.
								echo esc_html( $repeater_item->title );
							?>
						</h4>
						<span class="d-block">
							<span class="display-4">
								<?php
									// Plan price.
									echo esc_html( $repeater_item->subtitle );
								?>
							</span>
							<span class="d-block text-secondary">
								<?php
									// Plan duration.
									echo esc_html( $repeater_item->subtitle2 );
								?>
							</span>
						</span>
					</header>
					<div class="card-body">
						<ul class="list-unstyled mb-4">
							<?php
							// Get all plan features.
							$feature_repeater = json_decode( html_entity_decode( $repeater_item->feature_repeater ) );
							if ( ! empty( $feature_repeater ) ) {
								$cpricing_feature_count = 0;
								foreach ( $feature_repeater as $value ) {
									// Output each feature.
									echo sprintf(
										'<li id="c-pricing__t%1$s-f%2$s">%3$s</li>',
										esc_attr( $cpricing_table_count ),
										esc_attr( $cpricing_feature_count ),
										esc_html( $value->feature )
									);
									++$cpricing_feature_count;
								}
							}
							?>
						</ul>
						<?php
							// Plan button and link.
							echo sprintf(
								'<a href="%1$s" class="btn btn-block btn-primary">%2$s</a>',
								esc_url( $repeater_item->link ),
								esc_html( $repeater_item->linktext )
							);
						?>
					</div>
				</div>
			</div>

			<?php
			++$cpricing_table_count;
		}
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Pricing section.
	 *
	 * @since 2019-12-16
	 */
	public function pricing() {
		$pricing = $this->get_pricing();
		if ( ! $pricing )
			return;
		?>
	<!-- Pricing section -->
	<section class="c-pricing">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_pricing_title' ) ) || ! empty( get_theme_mod( 'conversions_pricing_desc' ) ) ) { ?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_pricing_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_pricing_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_pricing_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_pricing_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

					<?php
				}

				do_action( 'conversions_homepage_before_pricing' );
				echo $this->pricing_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_homepage_after_pricing' );
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
