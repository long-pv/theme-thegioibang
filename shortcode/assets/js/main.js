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

	$(".tgb_top_seller .list_product").slick({
		slidesToShow: 4,
		slidesToScroll: 2,
		infinite: true,
		arrows: false,
		dots: false,
		autoplay: true, // tự chạy
		autoplaySpeed: 3000, // 5 giây

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

		// các label vượt ngưỡng
		const $hiddenItems = $labels.slice(maxShown);
		const hasCheckedInHidden = $hiddenItems.find("input:checked").length > 0;

		// 1) nếu vượt quá maxShown
		if ($labels.length > maxShown) {
			if (!hasCheckedInHidden) {
				// không có ô đã chọn trong phần ẩn ⇒ gập như cũ
				$hiddenItems.hide();
				$btnText.text("Xem thêm");
			} else {
				// có ô đã chọn ⇒ mở sẵn
				$btnText.text("Rút gọn");
			}
		} else {
			// 2) ít hơn hoặc bằng maxShown ⇒ khỏi cần nút
			$btn.hide();
			return;
		}

		// 3) toggle
		$btn.on("click", function (e) {
			e.preventDefault();

			if ($hiddenItems.is(":visible")) {
				$hiddenItems.slideUp(200);
				$btnText.text("Xem thêm");
			} else {
				$hiddenItems.slideDown(200);
				$btnText.text("Rút gọn");
			}
		});
	});
})(jQuery, window);
