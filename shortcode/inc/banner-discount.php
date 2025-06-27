<?php
// ===============================
// Shortcode: [tgb_banner_discount]
// ===============================
add_shortcode('tgb_banner_discount', function () {
    ob_start();
?>
    <div class="tgb_banner_discount">
        <div class="grid_row grid_row_1">
            <div class="grid_col-6">
                <div class="item">
                    <div class="img_wrap">
                        <img src="<?php echo TGB_IMG_URL . 'img4.png'; ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="grid_col-6">
                <div class="item">
                    <div class="img_wrap">
                        <img src="<?php echo TGB_IMG_URL . 'img5.png'; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
