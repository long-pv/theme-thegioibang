(function ($, window) {
	// ...
	$(".livestream_slider").slick({
		slidesToShow: 3.3,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		dots: false,
	});
	$(".product_slider").slick({
		slidesToShow: 5,
		slidesToScroll: 3,
		infinite: true,
		arrows: false,
		dots: false,
	});
})(jQuery, window);
