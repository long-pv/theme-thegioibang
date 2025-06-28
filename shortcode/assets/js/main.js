(function ($, window) {
	// ...
	$(".livestream_slider").slick({
		slidesToShow: 3.3,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		dots: false,
	});
	$(".tgb_top_deal .product_slider").slick({
		slidesToShow: 5,
		slidesToScroll: 3,
		infinite: true,
		arrows: false,
		dots: false,
	});
	$(".tgb_featured .list_product").slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		dots: false,
	});
})(jQuery, window);
