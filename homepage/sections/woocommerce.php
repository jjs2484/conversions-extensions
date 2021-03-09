<?php
/**
 * Homepage woocommerce trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait woocommerce {

	/**
	 * WooCommerce section.
	 *
	 * @since 2019-12-16
	 */
	public function woocommerce() {
		// Check whether to show Woo section.
		$title        = get_theme_mod( 'conversions_woo_title' );
		$desc         = get_theme_mod( 'conversions_woo_desc' );
		$product_type = get_theme_mod( 'conversions_woo_products' );
		if ( ! class_exists( 'woocommerce' ) || $product_type === 'no' && empty( $title ) && empty( $desc ) )
			return;
		?>

	<!-- WooCommerce section -->
	<section class="c-woo">
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

				<?php do_action( 'conversions_homepage_before_woo_products' ); ?>

				<?php if ( $product_type !== 'no' ) { ?>
					<div class="col-12">
						<?php
						if ( $product_type === 'all' ) {
							$product_type = '';
						} else {
							$product_type = esc_attr( $product_type ) . '="true"';
						}
						$product_limit   = get_theme_mod( 'conversions_woo_product_limit' );
						$product_columns = get_theme_mod( 'conversions_woo_product_columns' );
						$product_order   = get_theme_mod( 'conversions_woo_products_order' );

						echo do_shortcode( '[products limit="' . esc_attr( $product_limit ) . '" columns="' . esc_attr( $product_columns ) . '" orderby="' . esc_attr( $product_order ) . '" ' . $product_type . ' ]' );
						?>
					</div>
				<?php } ?>

				<?php do_action( 'conversions_homepage_after_woo_products' ); ?>

			</div>
		</div>
	</section>
		<?php
	}
}
