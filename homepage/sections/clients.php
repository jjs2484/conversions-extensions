<?php
/**
 * Homepage clients trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait clients {

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
		do_action( 'conversions_homepage_before_clients' );
		?>
				<div class="col-12">

					<?php

					$chc_logo_width = ( get_theme_mod( 'conversions_hc_logo_width', '8.5' ) * 16 ) + 40;

					if ( get_theme_mod( 'conversions_hc_respond', 'auto' ) === 'auto' ) {

						$total_slides = count( $client_logos );

						if ( $total_slides >= 5 ) {
							$chc_max_slides = '5';
						} elseif ( $total_slides >= 4 ) {
							$chc_max_slides = '4';
						} elseif ( $total_slides >= 3 ) {
							$chc_max_slides = '3';
						} elseif ( $total_slides >= 2 ) {
							$chc_max_slides = '2';
						} else {
							$chc_max_slides = '1';
						}

						$chc_breakpoints = ['768', '576', '375'];

						foreach ( $chc_breakpoints as $breakpoint ) {
							$items_to_show = floor( $breakpoint / $chc_logo_width );
							if ( $items_to_show > $chc_max_slides ) {
								$items_to_show = $chc_max_slides;
							} elseif ( $items_to_show < 1 ) {
								$items_to_show = 1;
							}
							$chc_items_to_show[] = $items_to_show;
						}
					} else {

						$chc_max_slides    = get_theme_mod( 'conversions_hc_max', '5' );
						$chc_items_to_show = [
							'' . esc_html( get_theme_mod( 'conversions_hc_lg', '4' ) ) . '',
							'' . esc_html( get_theme_mod( 'conversions_hc_md', '3' ) ) . '',
							'' . esc_html( get_theme_mod( 'conversions_hc_sm', '2' ) ) . '',
						];
					}
					?>

					<!-- Client logos -->
					<div class='c-clients__carousel py-4' data-slick='{"arrows":true,"dots":false,"infinite":true,"slidesToShow":<?php echo esc_attr( $chc_max_slides ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_max_slides ); ?>,"responsive":[{"breakpoint":992,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[0] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[0] ); ?>}},{"breakpoint":768,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[1] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[1] ); ?>}},{"breakpoint":576,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[2] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[2] ); ?>}}]}'>

						<?php
						$clients_count = 0;
						foreach ( $client_logos as $client_logo ) {

							// Retrieve user img.
							$logo = $client_logo->image_url;
							$logo_url = '';

							/*
							 * We check below whether the img is in ID or URL form.
							 * IDs will only be numerical.
							 * Before v1.2.0 used URLs, 1.2.0+ use IDs.
							 * Eventually the URL check should be deprecated.
							 */
							if ( ! empty( $logo ) && is_numeric( $logo ) ) {

								// Get the medium size image.
								$logo_med = wp_get_attachment_image_src( $logo, 'medium' );
								$logo_url = $logo_med[0];

								// If medium size doesn't exist get the full size.
								if ( empty( $logo_url ) ) {
									$logo_full = wp_get_attachment_image_src( $logo, 'full' );
									$logo_url  = $logo_full[0];
								}

								// Get the alt text.
								$logo_alt = get_post_meta( $logo, '_wp_attachment_image_alt', true );

							} elseif ( ! empty( $logo ) && filter_var( $logo, FILTER_VALIDATE_URL ) ) {

								// Get the img ID from the img URL.
								$logo_id = conversions()->template->conversions_id_by_url( $logo );

								// Get the medium size image.
								$logo_med = wp_get_attachment_image_src( $logo_id, 'medium' );
								$logo_url = $logo_med[0];

								// If medium size doesn't exist get the full size.
								if ( empty( $logo_url ) ) {
									$logo_full = wp_get_attachment_image_src( $logo_id, 'full' );
									$logo_url  = $logo_full[0];
								}

								// Get the alt text.
								$logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
							}

							// Output HTML.
							if ( ! empty( $logo_url ) ) {
								echo '<div class="c-clients__item px-3" id="c-clients__' . esc_attr( $clients_count ) . '">
									<img class="client" loading="lazy" src="' . esc_url( $logo_url ) . '" alt="' . esc_html( $logo_alt ) . '">
								</div>';
							}
							++$clients_count;
						}
						?>
					</div>

				</div>
		<?php
		do_action( 'conversions_homepage_after_clients' );
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
				echo $this->clients_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>

			</div>
		</div>
	</section>
		<?php
		do_action( 'conversions_homepage_after_clients_section' );
	}
}
