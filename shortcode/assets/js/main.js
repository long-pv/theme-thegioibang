(function ($, window) {
	const maxShown = 5; // số mục hiển thị ban đầu
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

		// ↓ cấu hình cho màn < 850 px
		responsive: [
			{
				breakpoint: 850,
				settings: {
					slidesToShow: 2.1,
					slidesToScroll: 1,
					arrows: false,
				},
			},
		],
	});
	$(".tgb_featured .list_product").slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		dots: false,

		// ↓ cấu hình cho màn < 850 px
		responsive: [
			{
				breakpoint: 850,
				settings: {
					slidesToShow: 2.1,
					slidesToScroll: 1,
					arrows: false,
				},
			},
		],
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

	$(".filter_item").each(function () {
		const $wrapper = $(this);
		const $labels = $wrapper.find(".content.checkboxes > label");
		const $btn = $wrapper.find(".view_more");
		const $btnText = $btn.find(".text");

		// ẩn bớt khi vượt quá giới hạn
		if ($labels.length > maxShown) {
			$labels.slice(maxShown).hide();
			$btnText.text("Xem thêm");
		} else {
			$btn.hide(); // đủ ít mục thì khỏi cần nút
			return;
		}

		// bật / tắt
		$btn.on("click", function (e) {
			e.preventDefault();

			const $hiddenItems = $labels.slice(maxShown);

			if ($hiddenItems.is(":visible")) {
				// đang “mở rộng” ⇒ thu lại
				$hiddenItems.slideUp(200);
				$btnText.text("Xem thêm");
			} else {
				// đang “thu gọn” ⇒ mở ra
				$hiddenItems.slideDown(200);
				$btnText.text("Rút gọn");
			}
		});
	});
})(jQuery, window);
