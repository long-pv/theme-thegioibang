<?php
// ===============================
// Shortcode: [tgb_top_deal]
// ===============================
add_shortcode('tgb_top_deal', function () {
    ob_start();

    $title = get_field('top_deal_title', 'option') ?? '';
    $button_link = get_field('top_deal_button_link', 'option') ?? [];
    $product_list = get_field('top_deal_product_list', 'option') ?? [];
?>
    <div class="tgb_top_deal">
        <div class="grid_row">
            <div class="grid_col-lg-3">
                <div class="heading">
                    <div class="sub_title">
                        <span class="text">
                            Top deal
                        </span>
                        <span class="dot"></span>
                        <span class="text">
                            Siêu rẻ
                        </span>
                    </div>

                    <h2 class="title">
                        <?php echo $title; ?>
                    </h2>

                    <?php if ($button_link && $button_link['title'] && $button_link['url']) : ?>
                        <a href="<?php echo $button_link['url']; ?>" class="btn_link">
                            <?php echo $button_link['title']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid_col-lg-9">
                <div class="product_slider">
                    <?php
                    if ($product_list):
                        foreach ($product_list as $product_id):
                            $item_sale = 1;
                            echo '<div>';
                            include TGB_SHORTCODE_PATH . '/inc/product_loop.php';
                            echo '</div>';
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
