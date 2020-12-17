<?php
/**
 * Homepage easy digital downloads trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait edd {

	/**
	 * Easy Digital Downloads section.
	 *
	 * @since 2020-01-21
	 */
	public function edd() {
		// Check whether to show EDD section.
		$title        = get_theme_mod( 'conversions_edd_title' );
		$desc         = get_theme_mod( 'conversions_edd_desc' );
		$product_type = get_theme_mod( 'conversions_edd_products' );
		if ( ! class_exists( 'Easy_Digital_Downloads' ) || $product_type === 'no' && empty( $title ) && empty( $desc ) )
			return;
		?>
	<!-- Easy Digital Downloads section -->
	<section class="c-edd">
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

				<?php } ?>

				<?php do_action( 'conversions_homepage_before_edd_products' ); ?>

				<div class="col-12">
					<?php
					if ( $product_type === 'all' ) {
						$product_type = '';
					} elseif ( $product_type === 'category' ) {
						$product_type = 'category="' . esc_attr( get_theme_mod( 'conversions_edd_product_tax' ) ) . '"';
					} elseif ( $product_type === 'tags' ) {
						$product_type = 'tags="' . esc_attr( get_theme_mod( 'conversions_edd_product_tax' ) ) . '"';
					}
					$edd_product_limit   = get_theme_mod( 'conversions_edd_product_limit' );
					$edd_product_columns = get_theme_mod( 'conversions_edd_product_columns' );
					$edd_product_orderby = get_theme_mod( 'conversions_edd_products_orderby' );
					$edd_product_order   = get_theme_mod( 'conversions_edd_products_order' );

					echo do_shortcode( '[downloads pagination="false" number="' . esc_attr( $edd_product_limit ) . '" columns="' . esc_attr( $edd_product_columns ) . '" orderby="' . esc_attr( $edd_product_orderby ) . '" order="' . esc_attr( $edd_product_order ) . '" ' . $product_type . ' ]' );
					?>
				</div>

				<?php do_action( 'conversions_homepage_after_edd_products' ); ?>

			</div>
		</div>
	</section>
		<?php
	}
}
