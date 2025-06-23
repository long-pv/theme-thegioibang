<?php
// ===============================
// Shortcode: [tgb_hotline]
// ===============================
add_shortcode('tgb_hotline', function () {
    ob_start();
?>
    <div class="tgb-hotline">Hotline: <a href="tel:0909999999">0909 999 999</a></div>
<?php
    return ob_get_clean();
});

// ===============================
// Shortcode: [tgb_footer_main]
// ===============================
add_shortcode('tgb_footer_main', function () {
    ob_start();
?>
    <img src="<?php echo TGB_IMG_URL . 'logo_footer.svg'; ?>" alt="">
<?php
    return ob_get_clean();
});
