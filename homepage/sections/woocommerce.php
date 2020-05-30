<?php
/**
 * Homepage woocommerce trait.
 *
 * @package conversions-extension
 */

namespace conversions\sections;

trait woocommerce {

	/**
	 * WooCommerce section.
	 *
	 * @since 2019-12-16
	 */
	public function woocommerce() {
		// Check whether to show Woo section.
		if ( ! class_exists( 'woocommerce' ) )
			return;
		if ( get_theme_mod( 'conversions_woo_products' ) === 'no' )
			return;
		?>
	<!-- WooCommerce section -->
	<section class="c-woo">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( get_theme_mod( 'conversions_woo_title' ) ) || ! empty( get_theme_mod( 'conversions_woo_desc' ) ) ) { ?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_woo_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_woo_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_woo_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_woo_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

				<?php } ?>

				<?php do_action( 'conversions_homepage_before_woo_products' ); ?>

				<div class="col-12">
					<?php
					$c_product_type = get_theme_mod( 'conversions_woo_products' );
					if ( $c_product_type === 'all' ) {
						$c_product_type = '';
					} else {
						$c_product_type = esc_attr( $c_product_type ) . '="true"';
					}
					$c_product_limit   = get_theme_mod( 'conversions_woo_product_limit' );
					$c_product_columns = get_theme_mod( 'conversions_woo_product_columns' );
					$c_product_order   = get_theme_mod( 'conversions_woo_products_order' );

					echo do_shortcode( '[products limit="' . esc_attr( $c_product_limit ) . '" columns="' . esc_attr( $c_product_columns ) . '" orderby="' . esc_attr( $c_product_order ) . '" ' . $c_product_type . ' ]' );
					?>
				</div>

				<?php do_action( 'conversions_homepage_after_woo_products' ); ?>

			</div>
		</div>
	</section>
		<?php
	}
}
