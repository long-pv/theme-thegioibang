<?php
// ===============================
// Shortcode: [tgb_banner_main]
// ===============================
add_shortcode('tgb_banner_main', function () {
    ob_start();
?>
    <div class="tgb_banner_main">
        <div class="grid_row">
            <div class="grid_col-8">
                <div class="img_wrap large">
                    <img src="<?php echo TGB_IMG_URL . 'img6.png'; ?>" alt="">
                </div>
            </div>
            <div class="grid_col-4">
                <div class="grid_row">
                    <div class="grid_col-12">
                        <div class="img_wrap small">
                            <img src="<?php echo TGB_IMG_URL . 'img7.png'; ?>" alt="">
                        </div>
                    </div>
                    <div class="grid_col-12">
                        <div class="img_wrap small">
                            <img src="<?php echo TGB_IMG_URL . 'img8.png'; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
