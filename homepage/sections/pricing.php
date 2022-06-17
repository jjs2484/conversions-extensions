<?php
/**
 * Homepage pricing trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

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

		$has_pricing = ( $pricing[ 0 ]->title != '' || $pricing[ 0 ]->subtitle != '' || $pricing[ 0 ]->subtitle2 != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

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

		do_action( 'conversions_homepage_before_pricing' );

		if ( get_theme_mod( 'conversions_pricing_respond', 'auto' ) === 'auto' ) {

			// Count pricing tables.
			$cpt_total_count = count( $pricing );

			if ( 1 == $cpt_total_count ) {
				$col = 5;
			} elseif ( is_int( $cpt_total_count / 3 ) ) {
				$col = 4;
			} elseif ( is_int( $cpt_total_count / 2 ) ) {
				$col = 5;
			} else {
				// prime numbers test divided by three.
				$get_float = $cpt_total_count / 3;
				$integer   = floor( $get_float );
				$float     = $get_float - $integer;

				// Does it fill up atleast a half column?
				if ( $float >= 0.5 ) {
					$col = 4;
				} else { // if not than revert to 2 items per column.
					$col = 5;
				}
			}
			// Auto calc columns.
			$conversions_pricing_sm = 12;
			$conversions_pricing_md = 12;
			$conversions_pricing_lg = $col;
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
						<h3 class="h5 text-secondary mb-3">
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
						if ( ! empty( $repeater_item->link ) || ! empty( $repeater_item->linktext ) ) {
							echo sprintf(
								'<div class="d-grid gap-2"><a href="%1$s" class="btn btn-primary">%2$s</a></div>',
								esc_url( $repeater_item->link ),
								esc_html( $repeater_item->linktext )
							);
						}
						?>
					</div>
				</div>
			</div>

			<?php
			++$cpricing_table_count;
		}

		do_action( 'conversions_homepage_after_pricing' );

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
		$title   = get_theme_mod( 'conversions_pricing_title' );
		$desc    = get_theme_mod( 'conversions_pricing_desc' );
		if ( ! $pricing && empty( $title ) && empty( $desc ) )
			return;
		?>

	<!-- Pricing section -->
	<section class="c-pricing">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( $title ) || ! empty( $desc ) ) { ?>

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

				echo $this->pricing_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
