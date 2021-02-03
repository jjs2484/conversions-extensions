/**
 * Customizer repeater script
 */
function media_upload(button_class) {
	'use strict';
	jQuery('body').on('click', button_class, function () {
		var button_id = '#' + jQuery(this).attr('id');
		var display_field = jQuery(this).parent().children('input:hidden');
		var preview_field = jQuery(this).parent().children('.customizer-repeater-image-preview');
		var _custom_media = true;

		// eslint-disable-next-line no-undef
		wp.media.editor.send.attachment = function (props, attachment) {

			if (_custom_media) {
				display_field.val(attachment.id);
				display_field.trigger('change');
				preview_field.attr('src', attachment.url);
				preview_field.trigger('change');
				_custom_media = false;
			} else {
				// eslint-disable-next-line no-undef
				return wp.media.editor.send.attachment(button_id, [props, attachment]);
			}
		};
		// eslint-disable-next-line no-undef
		wp.media.editor.open(button_class);
		window.send_to_editor = function (html) {

		};
		return false;
	});
}

/**
 * Generate unique id
 */
function customizer_repeater_uniqid(prefix, more_entropy) {
	'use strict';
	if (typeof prefix === 'undefined') {
		prefix = '';
	}

	var retId;
	var php_js;
	var formatSeed = function (seed, reqWidth) {
		seed = parseInt(seed, 10)
			.toString(16); // to hex str.
		if (reqWidth < seed.length) { // so long we split.
			return seed.slice(seed.length - reqWidth);
		}
		if (reqWidth > seed.length) { // so short we pad.
			return new Array(1 + (reqWidth - seed.length))
				.join('0') + seed;
		}
		return seed;
	};

	// BEGIN REDUNDANT.
	if (!php_js) {
		php_js = {};
	}
	// END REDUNDANT.
	if (!php_js.uniqidSeed) { // init seed with big random int.
		php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
	}
	php_js.uniqidSeed++;

	retId = prefix; // start with prefix, add current milliseconds hex string.
	retId += formatSeed(parseInt(new Date()
		.getTime() / 1000, 10), 8);
	retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string.
	if (more_entropy) {
		// for more entropy we add a float lower to 10.
		retId += (Math.random() * 10)
			.toFixed(8)
			.toString();
	}

	return retId;
}

/**
 * Feature Repeater
 */
function customizer_repeater_refresh_features(th) {
	'use strict';
	var features_repeater_values = [];
	th.find('.customizer-repeater-feature-repeater-container').each(function () {
		var feature = jQuery(this).find('.customizer-repeater-feature-repeater-text').val();
		var id = jQuery(this).find('.customizer-repeater-feature-repeater-id').val();

		if (!id) {
			id = 'customizer-repeater-feature-repeater-' + customizer_repeater_uniqid();
			jQuery(this).find('.customizer-repeater-feature-repeater-id').val(id);
		}

		if (feature !== '') {
			features_repeater_values.push({
				'feature': feature,
				'id': id
			});
		}
	});

	th.find('.feature-repeater-features-repeater-collector').val(JSON.stringify(features_repeater_values));
	customizer_repeater_refresh_general_control_values();
}

/**
 * Social Repeater
 */
function customizer_repeater_refresh_social(th) {
	'use strict';
	var icons_repeater_values = [];
	th.find('.customizer-repeater-social-repeater-container').each(function () {
		var icon = jQuery(this).find('.icp').val();
		var link = jQuery(this).find('.customizer-repeater-social-repeater-link').val();
		var id = jQuery(this).find('.customizer-repeater-social-repeater-id').val();

		if (!id) {
			id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
			jQuery(this).find('.customizer-repeater-social-repeater-id').val(id);
		}

		if (icon !== '' || link !== '') {
			icons_repeater_values.push({
				'icon': icon,
				'link': link,
				'id': id
			});
		}
	});

	th.find('.social-repeater-socials-repeater-collector').val(JSON.stringify(icons_repeater_values));
	customizer_repeater_refresh_general_control_values();
}

function customizer_repeater_refresh_general_control_values() {
	'use strict';
	jQuery('.customizer-repeater-general-control-repeater').each(function () {
		var values = [];
		var th = jQuery(this);
		th.find('.customizer-repeater-general-control-repeater-container').each(function () {

			var icon_value = jQuery(this).find('.icp').val();
			var text = jQuery(this).find('.customizer-repeater-text-control').val();
			var linktext = jQuery(this).find('.customizer-repeater-linktext-control').val();
			var link = jQuery(this).find('.customizer-repeater-link-control').val();
			var color = jQuery(this).find('input.customizer-repeater-color-control').val();
			var image_url = jQuery(this).find('.custom-media-url').val();
			var choice = jQuery(this).find('.customizer-repeater-image-choice').val();
			var title = jQuery(this).find('.customizer-repeater-title-control').val();
			var subtitle = jQuery(this).find('.customizer-repeater-subtitle-control').val();
			var subtitle2 = jQuery(this).find('.customizer-repeater-subtitle2-control').val();
			var id = jQuery(this).find('.social-repeater-box-id').val();
			if (!id) {
				id = 'social-repeater-' + customizer_repeater_uniqid();
				jQuery(this).find('.social-repeater-box-id').val(id);
			}
			var feature_repeater = jQuery(this).find('.feature-repeater-features-repeater-collector').val();
			var social_repeater = jQuery(this).find('.social-repeater-socials-repeater-collector').val();

			if (text !== '' || image_url !== '' || title !== '' || subtitle !== '' || subtitle2 !== '' || icon_value !== '' || linktext !== '' || link !== '' || choice !== '' || feature_repeater !== '' || social_repeater !== '' || color !== '') {
				values.push({
					'icon_value': (choice === 'customizer_repeater_none' ? '' : icon_value),
					'color': color,
					'text': escapeHtml(text),
					'linktext': escapeHtml(linktext),
					'link': link,
					'image_url': (choice === 'customizer_repeater_none' ? '' : image_url),
					'choice': choice,
					'title': escapeHtml(title),
					'subtitle': escapeHtml(subtitle),
					'subtitle2': escapeHtml(subtitle2),
					'feature_repeater': escapeHtml(feature_repeater),
					'social_repeater': escapeHtml(social_repeater),
					'id': id
				});
			}

		});
		th.find('.customizer-repeater-collector').val(JSON.stringify(values));
		th.find('.customizer-repeater-collector').trigger('change');
	});
}

jQuery(document).ready(function () {
	'use strict';
	var theme_controls = jQuery('#customize-theme-controls');
	theme_controls.on('click', '.customizer-repeater-customize-control-title', function () {
		jQuery(this).next().slideToggle('medium', function () {
			if (jQuery(this).is(':visible')){
				jQuery(this).prev().addClass('repeater-expanded');
				jQuery(this).css('display', 'block');
			} else {
				jQuery(this).prev().removeClass('repeater-expanded');
			}
		});
	});

	theme_controls.on('change paste', '.icp', function() {
		var $icp = jQuery( this );
		setTimeout( function()
		{
			var value = $icp.val();
			var $icon_container = $icp.closest( '.social-repeater-general-control-icon' );
			jQuery( '.input-group-addon .cr__icon', $icon_container ).attr( 'class', value );
			customizer_repeater_refresh_general_control_values();
		} );
	});

	theme_controls.on('change', '.customizer-repeater-image-choice', function () {
		if (jQuery(this).val() === 'customizer_repeater_image') {
			jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
			jQuery(this).parent().parent().find('.customizer-repeater-image-control').show();
		}
		if (jQuery(this).val() === 'customizer_repeater_icon') {
			jQuery(this).parent().parent().find('.social-repeater-general-control-icon').show();
			jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
		}
		if (jQuery(this).val() === 'customizer_repeater_none') {
			jQuery(this).parent().parent().find('.social-repeater-general-control-icon').hide();
			jQuery(this).parent().parent().find('.customizer-repeater-image-control').hide();
		}

		customizer_repeater_refresh_general_control_values();
		return false;
	});
	media_upload('.customizer-repeater-custom-media-button');
	jQuery('.custom-media-url').on('change', function () {
		customizer_repeater_refresh_general_control_values();
		return false;
	});

	var color_options = {
		change: function(event, ui){
			customizer_repeater_refresh_general_control_values();
		}
	};

	/**
	 * This adds a new box to repeater
	 */
	theme_controls.on('click', '.customizer-repeater-new-field', function () {
		var th = jQuery(this).parent();
		var id = 'customizer-repeater-' + customizer_repeater_uniqid();
		if (typeof th !== 'undefined') {
			// Clone the first box.
			var field = th.find('.customizer-repeater-general-control-repeater-container:first').clone( true, true );

			if (typeof field !== 'undefined') {
				// Set the default value for choice between image and icon to icon.
				field.find('.customizer-repeater-image-choice').val('customizer_repeater_icon');

				// Show icon selector.
				field.find('.social-repeater-general-control-icon').show();

				// Hide image selector.
				if (field.find('.social-repeater-general-control-icon').length > 0) {
					field.find('.customizer-repeater-image-control').hide();
				}

				// Show delete box button because it's not the first box.
				field.find('.social-repeater-general-control-remove-field').show();

				// Empty control for icon.
				field.find('.input-group-addon').find('.cr__icon').attr('class', 'cr__icon');

				// Remove all feature repeater fields except first one.
				field.find('.customizer-repeater-feature-repeater').find('.customizer-repeater-feature-repeater-container').not(':first').remove();
				field.find('.customizer-repeater-feature-repeater-text').val('');
				field.find('.feature-repeater-features-repeater-collector').val('');
				
				// Remove all social repeater fields except first one.
				field.find('.customizer-repeater-social-repeater').find('.customizer-repeater-social-repeater-container').not(':first').remove();
				field.find('.customizer-repeater-social-repeater-link').val('');
				field.find('.social-repeater-socials-repeater-collector').val('');

				// Remove value from icon field.
				field.find('.icp').val('');

				// Remove value from text field.
				field.find('.customizer-repeater-text-control').val('');

				// Remove value from linktext field.
				field.find('.customizer-repeater-linktext-control').val('');

				// Remove value from link field.
				field.find('.customizer-repeater-link-control').val('');

				// Set box id.
				field.find('.social-repeater-box-id').val(id);

				// Remove value from media field.
				field.find('.custom-media-url').val('');
				field.find('.customizer-repeater-image-preview').attr('src', '');

				// Remove value from title field.
				field.find('.customizer-repeater-title-control').val('');

				// Remove value from color field.
				field.find('div.customizer-repeater-color-control .wp-picker-container').replaceWith('<input type="text" class="customizer-repeater-color-control ' + id + '">');
				field.find('input.customizer-repeater-color-control').wpColorPicker(color_options);

				// Remove value from subtitle field.
				field.find('.customizer-repeater-subtitle-control').val('');

				// Remove value from subtitle2 field.
				field.find('.customizer-repeater-subtitle2-control').val('');

				// Append new box.
				th.find('.customizer-repeater-general-control-repeater-container:first').parent().append(field);

				// Refresh values.
				customizer_repeater_refresh_general_control_values();
			}

		}
		return false;
	});

	theme_controls.on('click', '.social-repeater-general-control-remove-field', function () {
		if (typeof    jQuery(this).parent() !== 'undefined') {
			jQuery(this).parent().hide(500, function(){
				jQuery(this).parent().remove();
				customizer_repeater_refresh_general_control_values();

			});
		}
		return false;
	});

	theme_controls.on('keyup input paste', '.customizer-repeater-title-control', function () {
		customizer_repeater_refresh_general_control_values();
	});
	
	jQuery('input.customizer-repeater-color-control').on( 'change input paste', function() {
		var $the_color_picker = jQuery( this );
		setTimeout( function()
		{
			// Get the value.
			var value = $the_color_picker.val();
			// And tell the wpcolorpicker control to set it to the control.
			$the_color_picker.wpColorPicker('color', value);
		}, 500 );
	} ).wpColorPicker(color_options);

	theme_controls.on('keyup input paste', '.customizer-repeater-subtitle-control', function () {
		customizer_repeater_refresh_general_control_values();
	});

	theme_controls.on('keyup input paste', '.customizer-repeater-subtitle2-control', function () {
		customizer_repeater_refresh_general_control_values();
	});

	theme_controls.on('keyup input paste', '.customizer-repeater-text-control', function () {
		customizer_repeater_refresh_general_control_values();
	});

	theme_controls.on('keyup input paste', '.customizer-repeater-linktext-control', function () {
		customizer_repeater_refresh_general_control_values();
	});

	theme_controls.on('keyup input paste', '.customizer-repeater-link-control', function () {
		customizer_repeater_refresh_general_control_values();
	});

	// Drag and drop to change icons order.
	jQuery('.customizer-repeater-general-control-droppable').sortable({
		axis: 'y',
		update: function () {
			customizer_repeater_refresh_general_control_values();
		}
	});


	// Feature Repeater.
	theme_controls.on('click', '.feature-repeater-add-feature-item', function (event) {
		event.preventDefault();
		var th = jQuery(this).parent();
		var id = 'customizer-repeater-feature-repeater-' + customizer_repeater_uniqid();
		if (typeof th !== 'undefined') {
			var field = th.find('.customizer-repeater-feature-repeater-container:first').clone( true, true );
			if (typeof field !== 'undefined') {
				field.find('.feature-repeater-remove-feature-item').show();
				field.find('.customizer-repeater-feature-repeater-text').val('');
				field.find('.customizer-repeater-feature-repeater-id').val(id);
				th.find('.customizer-repeater-feature-repeater-container:first').parent().append(field);
			}
		}
		return false;
	});

	theme_controls.on('click', '.feature-repeater-remove-feature-item', function (event) {
		event.preventDefault();
		var th = jQuery(this).parent();
		var repeater = jQuery(this).parent().parent();
		th.remove();
		customizer_repeater_refresh_features(repeater);
		return false;
	});

	theme_controls.on('keyup', '.customizer-repeater-feature-repeater-text', function (event) {
		event.preventDefault();
		var repeater = jQuery(this).parent().parent();
		customizer_repeater_refresh_features(repeater);
		return false;
	});

	theme_controls.on('paste', '.customizer-repeater-feature-repeater-text', function () {
		var repeater = jQuery(this).parent().parent();
		setTimeout( function()
		{
			customizer_repeater_refresh_features(repeater);
		} );
	});
	
	// Social Repeater.
	theme_controls.on('click', '.social-repeater-add-social-item', function (event) {
		event.preventDefault();
		var th = jQuery(this).parent();
		var id = 'customizer-repeater-social-repeater-' + customizer_repeater_uniqid();
		if (typeof th !== 'undefined') {
			var field = th.find('.customizer-repeater-social-repeater-container:first').clone( true, true );
			if (typeof field !== 'undefined') {
				field.find( '.icp' ).val('');
				field.find( '.input-group-addon' ).find('.fa').attr('class','fa');
				field.find('.social-repeater-remove-social-item').show();
				field.find('.customizer-repeater-social-repeater-link').val('');
				field.find('.customizer-repeater-social-repeater-id').val(id);
				th.find('.customizer-repeater-social-repeater-container:first').parent().append(field);
			}
		}
		return false;
	});

	theme_controls.on('click', '.social-repeater-remove-social-item', function (event) {
		event.preventDefault();
		var th = jQuery(this).parent();
		var repeater = jQuery(this).parent().parent();
		th.remove();
		customizer_repeater_refresh_social(repeater);
		return false;
	});
	
	theme_controls.on('keyup', '.customizer-repeater-social-repeater-link', function (event) {
		event.preventDefault();
		var repeater = jQuery(this).parent().parent();
		customizer_repeater_refresh_social(repeater);
		return false;
	});

	theme_controls.on('paste', '.customizer-repeater-social-repeater-link', function () {
		var repeater = jQuery(this).parent().parent();
		setTimeout( function()
		{
			customizer_repeater_refresh_social(repeater);
		} );
	});

	theme_controls.on('change', '.customizer-repeater-social-repeater-container .icp', function (event) {
		event.preventDefault();
		var repeater = jQuery(this).parent().parent().parent();
		customizer_repeater_refresh_social(repeater);
		return false;
	});

	theme_controls.on('paste', '.customizer-repeater-social-repeater-container .icp', function () {
		var repeater = jQuery(this).parent().parent().parent();
		setTimeout( function()
		{
			customizer_repeater_refresh_social(repeater);
		} );
	});

});

var entityMap = {
	'&': '&amp;',
	'<': '&lt;',
	'>': '&gt;',
	'"': '&quot;',
	'\'': '&#39;',
	'/': '&#x2F;'
};

function escapeHtml(string) {
	'use strict';
	//noinspection JSUnresolvedFunction.
	string = String(string).replace(new RegExp('\r?\n', 'g'), '<br />');
	string = String(string).replace(/\\/g, '&#92;');
	return String(string).replace(/[&<>"'\/]/g, function (s) {
		return entityMap[s];
	});
}

/**
 * Fontawesome iconpicker control for the repeater
 */
/**
 * Fontawesome iconpicker control for the repeater
 */
( function($) {
	'use strict';
	wp.customizerRepeater = {

		init: function() {
			$( '.iconpicker-items>i' ).on(
				'click', function() {
					var iconClass = $( this ).attr( 'class' ).toString();
					var classInput = $( this ).
						parents( '.iconpicker-popover' ).
						prev().
						find( '.icp' );

					classInput.val( iconClass );
					classInput.attr( 'value', iconClass );

					var iconPreview = classInput.next( '.input-group-addon' );
					var iconElement = '<i class="' + iconClass + '"><\/i>';
					iconPreview.empty();
					iconPreview.append( iconElement );

					classInput.trigger( 'change' );
					return false;
				}
			);
		},
		search: function($searchField) {
			var itemsList = $searchField.parent().next().find( '.iconpicker-items' );
			var searchTerm = $searchField.val().toLowerCase();
			if ( searchTerm.length > 0 ) {
				itemsList.children().each(
					function() {
						var $icon = $ ( this );

						// Search for the term in the title.
						var show = $icon.attr( 'title' ).indexOf( searchTerm ) > -1;

						// And if not found in the title, try the search terms.
						if ( ! show )
							show = $icon.data( 'search_terms' ).indexOf( searchTerm ) > -1;

						if ( show ) {
							$icon.show();
						} else {
							$icon.hide();
						}
					}
				);
			} else {
				itemsList.children().show();
			}
		},
		iconPickerToggle: function($input) {
			var iconPicker = $input.parent().next();
			iconPicker.addClass( 'iconpicker-visible' );
		}
	};

	$( document ).ready(
		function() {
			wp.customizerRepeater.init();

			var iconpicker_searching = false;

			$( '.iconpicker-search' ).on( 'keyup', function() {
				// Wait for the user to finish typing before searching, so as to not such too often.
				clearTimeout( iconpicker_searching );
				var $input = $( this );
				iconpicker_searching = setTimeout( function()
				{
					console.log( 'Searching icons...' );
					wp.customizerRepeater.search( $input );
				}, 500 );
			} );

			$( '.icp-auto' ).on( 'click', function() {
				wp.customizerRepeater.iconPickerToggle( $( this ) );
			} );

			$( document ).mouseup(
				function(e) {
					var container = $( '.iconpicker-popover' );

					if ( !container.is( e.target ) && container.has( e.target ).length === 0 ) {
						container.removeClass( 'iconpicker-visible' );
					}
				}
			);
		}
	);
} )( jQuery );

jQuery(document).ready(function($) {
	$( '.conversions_homepage_sorting' ).sortable();
	$( '.conversions_homepage_sorting' ).disableSelection();

	$( '.conversions_homepage_sorting' ).bind( 'sortstop', function ( e, ui )
	{
		var components = new Array();
		var disabled = '[disabled]';

		$( e.target ).find( 'li' ).each( function ( i, e )
		{
			if ( $( this ).hasClass( 'disabled' ) )
				return;
			// Only push non-disabled components.
			components.push( $( this ).attr( 'id' ) );
		} );

		components = components.join( ',' );

		console.log( 'new components', components );

		$r = $( 'input[data-customize-setting-link="conversions_homepage_sorting"]' ).attr( 'value', components ).trigger( 'change' );
		console.log( 'sortstop', $r.attr( 'value' ) );
	});

	$( '.conversions_homepage_sorting .visibility' ).bind( 'click', function ( e ) {
		var components = new Array();
		var disabled = '[disabled]';

		$( this ).parent( 'li' ).toggleClass( 'disabled' );

		$( this ).parents( '.conversions_homepage_sorting' ).find( 'li' ).each( function ( i, e )
		{
			if ( $( this ).hasClass( 'disabled' ) )
				return;
			// Only push non-disabled components.
			components.push( $( this ).attr( 'id' ) );
		} );

		components = components.join( ',' );

		console.log( 'new components', components );

		$r = $( 'input[data-customize-setting-link="conversions_homepage_sorting"]' ).attr( 'value', components ).trigger( 'change' );
		console.log( 'click', $r.attr( 'value' ) );
	});
});

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