(function ($, window) {
	// ...
	$(".livestream_slider").slick({
		slidesToShow: 3.3,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		dots: false,

		// ↓ cấu hình cho màn < 850 px
		responsive: [
			{
				breakpoint: 850,
				settings: {
					slidesToShow: 2.2,
					slidesToScroll: 1,
					arrows: false,
				},
			},
		],
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

	$(".tgb_banner_main .banner_main_slider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		arrows: true,
		dots: true,
		autoplay: true, // tự chạy
		autoplaySpeed: 5000, // 5 giây
	});
})(jQuery, window);
