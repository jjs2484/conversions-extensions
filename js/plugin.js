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

	// if the element doesn't exist, abort
	if ( jQuery( '.c-counter__block-number' ).length == 0 ) {
		return;
	}
	
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

	// our simple throttle function
	function throttle(callback, limit) {
		var wait = false;                  // Initially, we're not waiting
		return function () {               // We return a throttled function
			if (!wait) {                   // If we're not waiting
				callback.call();           // Execute users function
				wait = true;               // Prevent future invocations
				setTimeout(function () {   // After a period of time
					wait = false;          // And allow future invocations
				}, limit);
			}
		};
	}

	window.addEventListener('scroll', Count); 

	function Count(e) { 
		if( isOnScreen( jQuery( '.c-counter__block-number' ) ) ) {
			jQuery('.c-counter__block-number').each(function () {
				jQuery(this).prop('Counter',0).animate({
					Counter: jQuery(this).text()
				}, {
					duration: 4000,
					easing: 'swing',
					step: function (now) {
						jQuery(this).text(Math.ceil(now));
					}
				});
			});
			// The event is only one time triggered 
			window.removeEventListener('scroll', Count);  
		}	
	}
});