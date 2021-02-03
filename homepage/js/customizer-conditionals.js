/**
 * Customizer conditionals
 */

/* 
 * Buttons and other options
 */
jQuery(document).ready(function($) {

	var conditionalOptions = [
		[ '#customize-control-conversions_hh_button_text_control, #customize-control-conversions_hh_button_url_control', '#customize-control-conversions_hh_button', 'no'],
		[ '#customize-control-conversions_hh_vbtn_text_control, #customize-control-conversions_hh_vbtn_url_control', '#customize-control-conversions_hh_vbtn', 'no'],
		[ '#customize-control-conversions_hc_sm_control, #customize-control-conversions_hc_md_control, #customize-control-conversions_hc_lg_control', '#customize-control-conversions_hc_respond', 'auto'],
		[ '#customize-control-conversions_pricing_sm_control, #customize-control-conversions_pricing_md_control, #customize-control-conversions_pricing_lg_control', '#customize-control-conversions_pricing_respond', 'auto'],
		[ '#customize-control-conversions_branding_tbpadding_control', '#customize-control-conversions_nav_layout', 'right'],
		[ '#customize-control-conversions_hh_alt_title', '#customize-control-conversions_hh_title', 'page'],
		[ '#customize-control-conversions_features_sm_control, #customize-control-conversions_features_md_control, #customize-control-conversions_features_lg_control', '#customize-control-conversions_features_respond', 'auto'],
		[ '#customize-control-conversions_img_features_sm_control, #customize-control-conversions_img_features_md_control, #customize-control-conversions_img_features_lg_control', '#customize-control-conversions_img_features_respond', 'auto'],
		[ '#customize-control-conversions_team_sm_control, #customize-control-conversions_team_md_control, #customize-control-conversions_team_lg_control', '#customize-control-conversions_team_respond', 'auto'],
		[ '#customize-control-conversions_counter_sm_control, #customize-control-conversions_counter_md_control, #customize-control-conversions_counter_lg_control', '#customize-control-conversions_counter_respond', 'auto'],
	];
	
	conditionalOptions.forEach( function( conditionalOptionsArray ) {
		var $conditionalSelectors = conditionalOptionsArray[ 0 ];
		var $mainOption = ( conditionalOptionsArray[ 1 ] + ' select' );
		var $selectOption = conditionalOptionsArray[ 2 ];

		// On page load hide or show options.
		if( $( $mainOption ).val() == $selectOption ){
			$( $conditionalSelectors ).hide();
		}
		else {
			$( $conditionalSelectors ).show();
		}

		// On change hide or show options.
		$( $mainOption ).change(function() {
			if( $(this).val() == $selectOption ) {
				$( $conditionalSelectors ).hide();
			} else {
				$( $conditionalSelectors ).show();
			}
		});
	});
});

/*
 * EDD product options
 */
jQuery(document).ready(function($) {

	// Option selectors.
	var $eddProductTypeTax = $( '#customize-control-conversions_edd_product_tax_control' );
	var $eddProductTypeChoice = $( '#customize-control-conversions_edd_products select' );

	// On page load hide or show options.
	if( $( $eddProductTypeChoice ).val() == 'no' || $( $eddProductTypeChoice ).val() == 'all' ) {
		$( $eddProductTypeTax ).hide();
	}

	// On change hide or show options.
	$( $eddProductTypeChoice ).change(function() {
		if ( $(this).val() == 'category' || $(this).val() == 'tags' ) {
			$( $eddProductTypeTax ).show();
		} 
		else if ( $(this).val() == 'no' || $(this).val() == 'all' ) {
			$( $eddProductTypeTax ).hide();
		}
	});
});

/*
 * Single feature options
 */
jQuery(document).ready(function($) {
	
	// Option selectors.
	var $image = $( '#customize-control-conversions_single_feature_img_id' );
	var $youtube = $( '#customize-control-conversions_single_feature_youtube_control' );
	var $vimeo = $( '#customize-control-conversions_single_feature_vimeo' );
	var $shortcode = $( '#customize-control-conversions_single_feature_shortcode_control' );
	var $choice = $( '#customize-control-conversions_single_feature_media_type select' );

	// On page load hide or show options.
	if( $( $choice ).val() == 'image' ) {
		$( $image ).show();
		$( $youtube ).hide();
		$( $vimeo ).hide();
		$( $shortcode ).hide();
	} else if ( $( $choice ).val() == 'youtube' ) {
		$( $image ).hide();
		$( $youtube ).show();
		$( $vimeo ).hide();
		$( $shortcode ).hide();
	} else if ( $( $choice ).val() == 'vimeo' ) {
		$( $image ).hide();
		$( $youtube ).hide();
		$( $vimeo ).show();
		$( $shortcode ).hide();
	} else if ( $( $choice ).val() == 'shortcode' ) {
		$( $image ).hide();
		$( $youtube ).hide();
		$( $vimeo ).hide();
		$( $shortcode ).show();
	}

	// On change hide or show options.
	$( $choice ).change(function() {
		if ( $(this).val() == 'image' ) {
			$( $image ).show();
			$( $youtube ).hide();
			$( $vimeo ).hide();
			$( $shortcode ).hide();
		} else if ( $(this).val() == 'youtube' ) {
			$( $image ).hide();
			$( $youtube ).show();
			$( $vimeo ).hide();
			$( $shortcode ).hide();
		} else if ( $(this).val() == 'vimeo' ) {
			$( $image ).hide();
			$( $youtube ).hide();
			$( $vimeo ).show();
			$( $shortcode ).hide();
		} else if ( $(this).val() == 'shortcode' ) {
			$( $image ).hide();
			$( $youtube ).hide();
			$( $vimeo ).hide();
			$( $shortcode ).show();
		}
	});
});

/*
 * Map options
 */
jQuery(document).ready(function($) {
	
	// Option selectors.
	var $map = $( '#customize-control-conversions_map_map' );
	var $mapText = $( '#customize-control-conversions_map_text' );
	var $mapHtml = $( '#customize-control-conversions_map_html' );
	var $mapShortcode = $( '#customize-control-conversions_map_shortcode_control' );
	var $choice = $( '#customize-control-conversions_map_content_type select' );

	// On page load hide or show options.
	if( $( $choice ).val() == 'map' ) {
		$( $map ).show();
		$( $mapText ).hide();
		$( $mapHtml ).hide();
		$( $mapShortcode ).hide();
	} else if ( $( $choice ).val() == 'map_text' ) {
		$( $map ).show();
		$( $mapText ).show();
		$( $mapHtml ).hide();
		$( $mapShortcode ).hide();
	} else if ( $( $choice ).val() == 'map_html' ) {
		$( $map ).show();
		$( $mapText ).hide();
		$( $mapHtml ).show();
		$( $mapShortcode ).hide();
	} else if ( $( $choice ).val() == 'map_shortcode' ) {
		$( $map ).show();
		$( $mapText ).hide();
		$( $mapHtml ).hide();
		$( $mapShortcode ).show();
	}

	// On change hide or show options.
	$( $choice ).change(function() {
		if ( $(this).val() == 'map' ) {
			$( $map ).show();
			$( $mapText ).hide();
			$( $mapHtml ).hide();
			$( $mapShortcode ).hide();
		} else if ( $(this).val() == 'map_text' ) {
			$( $map ).show();
			$( $mapText ).show();
			$( $mapHtml ).hide();
			$( $mapShortcode ).hide();
		} else if ( $(this).val() == 'map_html' ) {
			$( $map ).show();
			$( $mapText ).hide();
			$( $mapHtml ).show();
			$( $mapShortcode ).hide();
		} else if ( $(this).val() == 'map_shortcode' ) {
			$( $map ).show();
			$( $mapText ).hide();
			$( $mapHtml ).hide();
			$( $mapShortcode ).show();
		}
	});
});