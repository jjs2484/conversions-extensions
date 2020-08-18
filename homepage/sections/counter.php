<?php
/**
 * Homepage icon Counter trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait counter {

	/**
	 * Return an array of counter blocks.
	 *
	 * @since 2020-08-16
	 */
	public function get_counter() {
		// Get all counter blocks.
		$counter         = get_theme_mod( 'conversions_counter_blocks' );
		$counter_decoded = json_decode( $counter );
		if ( ! $counter_decoded )
			return false;
		$has_counter = ( $counter_decoded[ 0 ]->icon_value != '' || $counter_decoded[ 0 ]->subtitle != '' ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( ! $has_counter )
			return false;
		return $counter_decoded;
	}

	/**
	 * Return the counter content.
	 *
	 * @since 2020-08-16
	 */
	public function counter_content() {
		$counter = $this->get_counter();
		if ( ! $counter )
			return;

		// We want to capture the output so that we can return it.
		ob_start();

		$counter_block_count = 0;

		foreach ( $counter as $repeater_item ) {
			// How many to show per row.
			$conversions_counter_sm = get_theme_mod( 'conversions_counter_sm', '2' );
			$conversions_counter_md = get_theme_mod( 'conversions_counter_md', '2' );
			$conversions_counter_lg = get_theme_mod( 'conversions_counter_lg', '3' );

			// # per row to bootstrap grid.
			$cfri = array(
				'1' => '12',
				'2' => '6',
				'3' => '4',
				'4' => '3',
			);

			// Start counter block.
			echo '<div id="c-counter__block-' . esc_attr( $counter_block_count ) . '" class="c-counter__block col-sm-' . esc_attr( $cfri[$conversions_counter_sm] ) . ' col-md-' . esc_attr( $cfri[$conversions_counter_md] ) . ' col-lg-' . esc_attr( $cfri[$conversions_counter_lg] ) . '">';

			echo '<div class="card border-0 h-100"><div class="card-body">';

			// Output icon.
			if ( ! empty( $repeater_item->icon_value ) ) {
				if ( ! empty( $repeater_item->color ) ) {
					echo '<span class="c-counter__block-icon"><i class="' . esc_attr( $repeater_item->icon_value ) . ' mb-3" aria-hidden="true" style="color:' . esc_attr( $repeater_item->color ) . ';"></i></span>';
				} else {
					echo '<span class="c-counter__block-icon"><i class="' . esc_attr( $repeater_item->icon_value ) . ' mb-3" aria-hidden="true"></i></span>';
				}
			}

			// Output counter number.
			if ( ! empty( $repeater_item->subtitle ) ) {

				// Before counter number symbol.
				if ( ! empty( $repeater_item->title ) ) {
					$before_number_symbol = $repeater_item->title;
				} else {
					$before_number_symbol = '';
				}

				// After counter number symbol.
				if ( ! empty( $repeater_item->subtitle2 ) ) {
					$after_number_symbol = $repeater_item->subtitle2;
				} else {
					$after_number_symbol = '';
				}

				if ( get_theme_mod( 'conversions_counter_animation', false ) === true ) {
					$animation_class = 'c-counter__block-animate';
				} else {
					$animation_class = '';
				}

				// Remove whitespace from beginning and end of the counter value.
				$counter_value = trim( $repeater_item->subtitle );

				// Check for shortcode syntax: true if string has opening and closing brackets.
				if ( $counter_value[0] === '[' && $counter_value[-1] === ']' ) {

					// Remove the opening and closing brackets.
					$shortcode_name = substr( $counter_value, 1, -1 );

					// Extract shortcode name.
					$shortcode_name = strtok( $shortcode_name, ' ' );
					$shortcode_name = strtok( $shortcode_name, '=' );
					$shortcode_name = strtok( $shortcode_name, ']' );

					// Check the shortcode name is registered.
					if ( shortcode_exists( $shortcode_name ) ) {
						echo sprintf(
							'<h3 class="c-counter__block-count">%1$s<span class="c-counter__block-number %2$s">%3$s</span>%4$s</h3>',
							esc_html( $before_number_symbol ),
							esc_attr( $animation_class ),
							do_shortcode( '' . $counter_value . '' ),
							esc_html( $after_number_symbol )
						);
					} else {
						echo sprintf(
							'<h3 class="c-counter__block-count">%1$s<span class="c-counter__block-number %2$s">%3$s</span>%4$s</h3>',
							esc_html( $before_number_symbol ),
							esc_attr( $animation_class ),
							wp_kses_post( $counter_value ),
							esc_html( $after_number_symbol )
						);
					}
				} else {
					echo sprintf(
						'<h3 class="c-counter__block-count">%1$s<span class="c-counter__block-number %2$s">%3$s</span>%4$s</h3>',
						esc_html( $before_number_symbol ),
						esc_attr( $animation_class ),
						wp_kses_post( $counter_value ),
						esc_html( $after_number_symbol )
					);
				}
			}

			// Output counter title.
			if ( ! empty( $repeater_item->text ) ) {
				echo '<h4 class="c-counter__block-text">' . esc_html( $repeater_item->text ) . '</h4>';
			}

			echo '</div></div></div>';

			++$counter_block_count;
		}

		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * Counter section.
	 *
	 * @since 2020-08-16
	 */
	public function counter() {
		$counter = $this->get_counter();
		if ( ! $counter )
			return;
		?>
	<!-- Counter section -->
	<section class="c-counter">
		<div class="container-fluid">
			<div class="row">

				<?php

				if ( ! empty( get_theme_mod( 'conversions_counter_title' ) ) || ! empty( get_theme_mod( 'conversions_counter_desc' ) ) ) {
					?>

					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( get_theme_mod( 'conversions_counter_title' ) ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( get_theme_mod( 'conversions_counter_title' ) ) . '</h2>';
							}
							if ( ! empty( get_theme_mod( 'conversions_counter_desc' ) ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( get_theme_mod( 'conversions_counter_desc' ) ) . '</p>';
							}
							?>
						</div>
					</div>

					<?php
				}

				do_action( 'conversions_before_counter' );
				echo $this->counter_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_after_counter' );

				?>

			</div>
		</div>
	</section>
		<?php
	}
}
