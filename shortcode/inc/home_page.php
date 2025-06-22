<?php
// ===============================
// Shortcode: [tgb_hotline]
// Hiển thị số điện thoại cố định
// ===============================
add_shortcode('tgb_hotline', function () {
    return '<div class="tgb-hotline">Hotline: <a href="tel:0909999999">0909 999 999</a></div>';
});

// ===============================
// Shortcode: [tgb_services]
// Hiển thị danh sách dịch vụ cố định
// ===============================
add_shortcode('tgb_services', function () {
    return '
    <ul class="tgb-services">
        <li>Thiết kế website</li>
        <li>Tối ưu SEO</li>
        <li>Quản trị nội dung</li>
    </ul>';
});

// ===============================
// Shortcode: [tgb_banner]
// Hiển thị banner CTA đơn giản
// ===============================
add_shortcode('tgb_banner', function () {
    return '
    <div class="tgb-banner" style="padding:20px;background:#f5f5f5;text-align:center;">
        <h2>🔥 Ưu đãi đặc biệt hôm nay</h2>
        <p>Giảm giá 50% cho khách hàng mới</p>
        <a href="#" class="btn" style="background:#000;color:#fff;padding:10px 20px;text-decoration:none;">Xem ngay</a>
    </div>';
});
