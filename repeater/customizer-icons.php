<?php
/**
 * List of icons for customizer
 *
 * @package conversions
 */

// Load all of the FA icons directly from their json.
$json = file_get_contents( __DIR__ . '/icons.json' );
$json = json_decode( $json );

?>
<div class="iconpicker-popover popover bottomLeft">
	<div class="arrow"></div>
	<div class="popover-title">
		<input type="search" class="form-control iconpicker-search" placeholder="Type to filter">
	</div>
	<div class="popover-content">
		<div class="iconpicker">
			<div class="iconpicker-items">

				<?php
				foreach ( $json as $icon_id => $data ) {

					// Assume empty search terms.
					$search_terms = '';
					if ( isset( $data->search->terms ) )
						$search_terms = implode( $data->search->terms, " " );

					foreach ( $data->styles as $style ) {
						$style = $style[ 0 ];
						echo sprintf(
							'<i data-type="iconpicker-item" title=".fa-%s" class="fa%s fa-%s" data-search_terms="%s"></i>%s',
							esc_attr( $icon_id ),
							esc_attr( $style ),
							esc_attr( $icon_id ),
							esc_attr( $search_terms ),
							"\n"
						);
					}
				}
				?>

			</div> <!-- /.iconpicker-items -->
		</div> <!-- /.iconpicker -->
	</div> <!-- /.popover-content -->
</div> <!-- /.iconpicker-popover -->
