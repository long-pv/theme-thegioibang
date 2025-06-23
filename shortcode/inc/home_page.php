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
