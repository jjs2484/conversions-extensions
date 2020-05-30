<?php
/**
 * Homepage easy digital downloads trait.
 *
 * @package conversions-extension
 */

namespace conversions\sections;

trait edd {

	/**
	 * Easy Digital Downloads section.
	 *
	 * @since 2020-01-21
	 */
	public function edd() {
		// Check whether to show EDD section.
		if ( ! class_exists( 'Easy_Digital_Downloads' ) )
			return;
		if ( get_theme_mod( 'conversions_edd_products' ) === 'no' )
			return;
		?>
	<!-- Easy Digital Downloads section -->
	<section class="c-edd">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_edd_title' ) ) || ! empty( get_theme_mod( 'conversions_edd_desc' ) ) ) { ?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_edd_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_edd_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_edd_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_edd_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

				<?php } ?>

				<?php do_action( 'conversions_homepage_before_edd_products' ); ?>

				<div class="col-12">
					<?php
					$edd_product_type = get_theme_mod( 'conversions_edd_products' );
					if ( $edd_product_type === 'all' ) {
						$edd_product_type = '';
					} elseif ( $edd_product_type === 'category' ) {
						$edd_product_type = 'category="' . esc_attr( get_theme_mod( 'conversions_edd_product_tax' ) ) . '"';
					} elseif ( $edd_product_type === 'tags' ) {
						$edd_product_type = 'tags="' . esc_attr( get_theme_mod( 'conversions_edd_product_tax' ) ) . '"';
					}
					$edd_product_limit   = get_theme_mod( 'conversions_edd_product_limit' );
					$edd_product_columns = get_theme_mod( 'conversions_edd_product_columns' );
					$edd_product_orderby = get_theme_mod( 'conversions_edd_products_orderby' );
					$edd_product_order   = get_theme_mod( 'conversions_edd_products_order' );

					echo do_shortcode( '[downloads pagination="false" number="' . esc_attr( $edd_product_limit ) . '" columns="' . esc_attr( $edd_product_columns ) . '" orderby="' . esc_attr( $edd_product_orderby ) . '" order="' . esc_attr( $edd_product_order ) . '" ' . $edd_product_type . ' ]' );
					?>
				</div>

				<?php do_action( 'conversions_homepage_after_edd_products' ); ?>

			</div>
		</div>
	</section>
		<?php
	}
}
