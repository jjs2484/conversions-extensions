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
