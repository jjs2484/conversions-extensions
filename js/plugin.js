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
