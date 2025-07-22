(function ($, window) {
	const maxShown = 5; // số mục hiển thị ban đầu
	let lastScrollTop = 0;

	const $menu = $(".tgb_header_mb");

	// Đảm bảo thanh cố định ở dưới cùng
	$menu.css({
		position: "fixed",
		bottom: "0",
		width: "100%",
		transition: "transform 0.3s ease",
	});

	$(window).on("scroll", function () {
		let st = $(this).scrollTop();

		if (st > lastScrollTop) {
			// Scroll xuống => ẩn: trượt xuống ngoài màn hình
			$menu.css("transform", "translateY(100%)");
		} else {
			// Scroll lên => hiện: trượt lên lại vị trí cũ
			$menu.css("transform", "translateY(0)");
		}

		lastScrollTop = st;
	});

	$("#mb_header_item_cat").on("click", function () {
		$(".header_mb_list_cat").toggle();
	});
	$("#header_mb_list_cat_close").on("click", function () {
		$(".header_mb_list_cat").hide();
	});

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
					arrows: true,
					infinite: false,
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

	$(".tgb_section_cat_mb_slider").slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		dots: false,
	});

	$(".tgb_top_seller .list_product").slick({
		slidesToShow: 4,
		slidesToScroll: 2,
		infinite: false,
		arrows: true,
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
					arrows: true,
				},
			},
		],
	});

	$(".related_products_slider").slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		infinite: false,
		arrows: false,
		dots: false,

		// ↓ cấu hình cho màn < 850 px
		responsive: [
			{
				breakpoint: 850,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					arrows: true,
				},
			},
		],
	});

	$(".you_may_like .list_product").slick({
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
					slidesToShow: 2,
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

	$(".tgb_banner_discount_slider").slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		infinite: true,
		arrows: false,
		dots: true,
		autoplay: true,
		autoplaySpeed: 5000,

		responsive: [
			{
				breakpoint: 850,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
				},
			},
		],
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

	let debounceTimer;

	$(document).on("click", function (event) {
		if (!$(event.target).closest(".tgb_search_form").length) {
			$(".tgb_search_wrapper .result").hide();
		}
	});

	var product_suggestions_html = $(".tgb_search_wrapper .result .list").html();
	var product_result_html = "";

	$(document).on("focus", ".tgb_search_input", function () {
		let keyword = $(this).val().trim();
		if (keyword.length < 3) {
			$(".tgb_search_wrapper .result .list").html(product_suggestions_html);
		} else {
			if (product_result_html) {
				$(".tgb_search_wrapper .result .list").html(product_result_html);
			} else {
				$(this).val($(this).val()).trigger("input");
			}
		}
		$(".tgb_search_wrapper .result").show();
	});

	$(document).on("input", ".tgb_search_input", function () {
		let keyword = $(this).val().trim();

		debounceTimer = setTimeout(function () {
			if (keyword.length < 3) {
				$(".tgb_search_wrapper .result .list").html(product_suggestions_html);
				return;
			}

			$(".tgb_search_wrapper .result").show();

			$.ajax({
				url: custom_ajax.ajax_url,
				type: "POST",
				data: {
					action: "tgb_search_suggestion",
					keyword: keyword,
				},
				beforeSend: function () {
					$(".tgb_search_wrapper .result .list").html("<div>Đang tìm kiếm...</div>");
				},
				success: function (response) {
					$(".tgb_search_wrapper .result .list").html(response);
					product_result_html = response;
				},
			});
		}, 300);
	});

	$(".tgb_page_woo_cart .shop_table .button-continue-shopping").text("Tiếp tục xem sản phẩm");

	$(document).on("click", ".tgb_sidebar_filter .btn_filter_mb", function () {
		$("body").toggleClass("filter_open");
	});

	$(document).on("click", ".tgb_sidebar_filter .sidebar-filter .icon_mb", function () {
		$("body").toggleClass("filter_open");
	});

	$(document)
		.find(".hinhanh_tt")
		.on("click", function () {
			$("html, body").animate(
				{
					scrollTop: $(document).find("#tab-reviews").offset().top,
				},
				1000
			);
		});

	$("#pa_khu-vuc").closest(".value").hide();

	$('.filter_form input[type="checkbox"]').on("change", function () {
		let form_filter = $(this).closest("form");
		form_filter.submit();
	});

	$("#show_item").on("change", function () {
		let val_show_item = $(this).val();
		$('.filter_form input[name="show_item"]').val(val_show_item);
		$(".filter_form").submit();
	});
})(jQuery, window);
