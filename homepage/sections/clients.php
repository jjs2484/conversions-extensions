<?php
/**
 * Homepage clients trait.
 *
 * @package conversions-extension
 */

namespace conversions\traits;

trait Clients {

	/**
	 * Return the array of client logos.
	 *
	 * @since 2019-12-19
	 */
	public function get_client_logos() {
		$client_logos         = get_theme_mod( 'conversions_hc_logos' );
		$client_logos_decoded = json_decode( $client_logos );
		if ( ! $client_logos_decoded)
			return false;
		$has_logos = ( $client_logos_decoded[ 0 ]->image_url != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( ! $has_logos )
			return false;
		return $client_logos_decoded;
	}

	/**
	 * Content for the clients section.
	 *
	 * @since 2019-12-19
	 */
	public function clients_content() {
		$client_logos = $this->get_client_logos();
		if ( ! $client_logos )
			return;

		// We want to capture the output so that we can return it.
		ob_start();
		?>
				<div class="col-12">

					<?php
					$chc_max_slides = get_theme_mod( 'conversions_hc_max', '5' );
					$chc_logo_width = ( get_theme_mod( 'conversions_hc_logo_width', '6.2' ) * 16 ) + 40;

					if ( get_theme_mod( 'conversions_hc_respond', 'auto' ) === 'auto' ) {

						$chc_breakpoints = ['768', '576', '375'];

						foreach ( $chc_breakpoints as $s ) {
							$n = floor( $s / $chc_logo_width );
							if ( $n > $chc_max_slides ) {
								$n = $chc_max_slides;
							} elseif ( $n < 1 ) {
								$n = 1;
							}
							$chc_items_to_show[] = $n;
						}
					} else {
						$chc_items_to_show = [
							'' . esc_html( get_theme_mod( 'conversions_hc_lg', '4' ) ) . '',
							'' . esc_html( get_theme_mod( 'conversions_hc_md', '3' ) ) . '',
							'' . esc_html( get_theme_mod( 'conversions_hc_sm', '2' ) ) . '',
						];
					}
					?>

					<!-- Client logos -->
					<div class='c-clients__carousel py-4' data-slick='{"arrows":true,"dots":false,"infinite":true,"slidesToShow":<?php echo esc_attr( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"slidesToScroll":<?php echo esc_attr( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"responsive":[{"breakpoint":992,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[0] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[0] ); ?>}},{"breakpoint":768,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[1] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[1] ); ?>}},{"breakpoint":576,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[2] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[2] ); ?>}}]}'>

						<?php
						$cclient_logo_count = 0;
						foreach ( $client_logos as $chc_logo ) {
							// Retrieve img id.
							$chc_url     = $chc_logo->image_url;
							$chc_logo_id = conversions()->template->conversions_id_by_url( $chc_url );
							// Retrieve the correct img size.
							$chc_logo_med = wp_get_attachment_image_src( $chc_logo_id, 'medium' );
							// Retrieve the alt text.
							$chc_logo_alt = get_post_meta( $chc_logo_id, '_wp_attachment_image_alt', true );

							echo '<div class="c-clients__item px-3" id="c-clients__' . esc_attr( $cclient_logo_count ) . '">
								<img class="client" src="' . esc_url( $chc_logo_med[0] ) . '" alt="' . esc_html( $chc_logo_alt ) . '">
							</div>';

							++$cclient_logo_count;
						}
						?>
					</div>

				</div>
		<?php
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Clients section.
	 *
	 * @since 2019-12-16
	 */
	public function clients() {
		$client_logos = $this->get_client_logos();
		if ( ! $client_logos )
			return;
		?>
	<!-- Clients section -->
	<section class="c-clients">
		<div class="container-fluid">
			<div class="row">

				<?php
					do_action( 'conversions_homepage_before_clients' );
					echo $this->clients_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					do_action( 'conversions_homepage_after_clients' );
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
