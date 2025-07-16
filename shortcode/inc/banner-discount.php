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
            <div class="tgb_banner_discount_slider">
                <?php
                foreach ($banner_discount as $item) :
                ?>
                    <div>
                        <div class="tgb_banner_discount_item">
                            <div class="img_wrap">
                                <?php echo $item['url'] ? '<a target="_blank" href="' . $item['url'] . '">' : ''; ?>
                                <img src="<?php echo $item['image'] ?? ''; ?>" alt="">
                                <?php echo $item['url'] ? '</a>' : ''; ?>
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
