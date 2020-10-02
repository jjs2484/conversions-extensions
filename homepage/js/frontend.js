/**
 * Initialize Slick client section
*/
jQuery(document).ready(function() {
	jQuery('.c-clients__carousel').slick();
});

/**
 * Initialize Slick testimonial section
*/
jQuery(document).ready(function() {
	jQuery('.c-testimonials__carousel').slick({
		arrows: true,
		prevArrow: jQuery('.fa-chevron-left'),
		nextArrow: jQuery('.fa-chevron-right'),
		infinite: true,
		fade: true,
		adaptiveHeight: true,
		touchThreshold: 14
	});
});

/**
 * Counter homepage section count up animation
*/
jQuery(document).ready(function() {

	// If the element doesn't exist along with animation class return
	if ( jQuery( '.c-counter__block-number.c-counter__block-animate' ).length == 0 ) {
		return;
	}
	
	// Detect if the counter elements are in the viewport
	function isOnScreen(elem) {
		var $window = jQuery(window);
		var viewport_top = $window.scrollTop();
		var viewport_height = $window.height();
		var viewport_bottom = viewport_top + viewport_height;
		var $elem = jQuery(elem);
		var top = $elem.offset().top;
		var height = $elem.height();
		var bottom = top + height;

		return (top >= viewport_top && top < viewport_bottom) ||
		(bottom > viewport_top && bottom <= viewport_bottom) ||
		(height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
	}

	// Setup a timer
	var timeout;

	// Scroll event throttler
	var countListener = function() {
		// If timer is null, reset it to 100ms and run counter function.
		// Otherwise, wait until timer is cleared
		if ( !timeout ) {
			timeout = setTimeout(function() {

				// Reset timeout
				timeout = null;

				// Run our count function
				Count();

			}, 100);
		}
	};

	// Add scroll event listener 
	window.addEventListener( 'load', countListener ); 
	window.addEventListener( 'scroll', countListener ); 

	// Count up animation when in viewport, then remove event listener
	function Count(e) { 
		if( isOnScreen( jQuery( '.c-counter__block-number' ) ) ) {

			var counterUp = window.counterUp["default"]; // import counterUp from "counterup2"
    
			var $counters = jQuery('.c-counter__block-number');
    
			// Start counting
			$counters.each(function (ignore, counter) {
				counterUp(counter, {
					duration: 4000,
					delay: 16
				});
			});

			// The event is only one time triggered
			window.removeEventListener( 'load', countListener ); 
			window.removeEventListener( 'scroll', countListener ); 
		}	
	}
});

/**
 * FAQ homepage section accordion icon animation
*/
jQuery(document).ready(function() {
	// Add minus icon for collapse element which is open by default
	jQuery('#c-faq__accordion .collapse.show i').removeClass('fa-plus-square').addClass('fa-minus-square');

	jQuery( '#c-faq__accordion .collapse.show' ).each(function() {
		jQuery(this).siblings( '.card-header' ).find( '.btn i' ).removeClass('fa-plus-square').addClass('fa-minus-square');
	});
	
	// Toggle plus minus icon on show hide of collapse element
	jQuery( '#c-faq__accordion .collapse' ).on( 'show.bs.collapse', function() {
		jQuery(this).parent().find( '.card-header .btn i' ).removeClass('fa-plus-square').addClass('fa-minus-square');
	}).on( 'hide.bs.collapse', function() {
		jQuery(this).parent().find( '.card-header .btn i' ).removeClass('fa-minus-square').addClass('fa-plus-square');
	});
});