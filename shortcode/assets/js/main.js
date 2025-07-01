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

	if ($(".filter_form").length > 0) {
		const $priceTo = $('input[name="price_to"]'); // ô “Từ”
		const $priceFrom = $('input[name="price_from"]'); // ô “Đến”
		const $errorMsg = $(".error_msg");

		/* ---------- 1. Chỉ cho nhập số ---------- */
		$priceTo.add($priceFrom).on("input", function () {
			this.value = this.value.replace(/[^0-9]/g, ""); // gỡ mọi ký tự không phải số
		});

		/* ---------- Hàm hiển thị / ẩn lỗi ---------- */
		function showError(msg) {
			$errorMsg.text(msg).show();
		}
		function hideError() {
			$errorMsg.hide();
		}

		/* ---------- 2,3,4. Kiểm tra logic ---------- */
		function validate() {
			const toVal = $priceTo.val().trim();
			const fromVal = $priceFrom.val().trim();

			// (2) Một ô nhập – ô kia bắt buộc
			if ((toVal && !fromVal) || (fromVal && !toVal)) {
				showError("Vui lòng nhập cả hai ô hoặc xoá ô đã nhập.");
				return false;
			}

			// Nếu cả hai ô đều có giá trị, kiểm tra (4) From < To
			if (toVal && fromVal) {
				if (parseInt(fromVal, 10) <= parseInt(toVal, 10)) {
					showError("Giá Đến phải lớn hơn Giá Từ.");
					return false;
				}
			}

			hideError(); // Không có lỗi
			return true;
		}

		$priceTo
			.add($priceFrom)
			.on("blur", validate) // Kiểm tra khi rời ô
			.on("input", validate); // Kiểm tra realtime (tuỳ thích)

		/* ---------- Chặn submit nếu chưa hợp lệ ---------- */
		$(".filter_form").on("submit", function (e) {
			if (!validate()) e.preventDefault();
		});
	}
})(jQuery, window);
