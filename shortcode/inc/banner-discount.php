<?php
// ===============================
// Shortcode: [tgb_banner_discount]
// ===============================
add_shortcode('tgb_banner_discount', function () {
    ob_start();

    $banner_discount = get_field('banner_discount', 'option') ?? [];
    if ($banner_discount) :
?>
        <div class="tgb_banner_discount">
            <div class="grid_row grid_row_1">
                <?php
                foreach ($banner_discount as $item) :
                ?>
                    <div class="grid_col-6">
                        <div class="item">
                            <div class="img_wrap">
                                <img src="<?php echo $item['image'] ?? ''; ?>" alt="">
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
<?php
    endif;
    return ob_get_clean();
});
