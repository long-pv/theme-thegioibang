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
                        foreach ($product_list as $product_id) :
                            $product = wc_get_product($product_id);
                            if (!$product) continue;

                            $product_link = get_permalink($product_id);
                            $product_img = get_the_post_thumbnail_url($product_id, 'medium') ?: TGB_IMG_URL . 'img2.png';
                            $product_title = $product->get_name();

                            // Chỉ lấy số, không HTML
                            if ($product->is_type('variable')) {
                                $regular_price = floatval($product->get_variation_regular_price('min', true));
                                $sale_price = floatval($product->get_variation_sale_price('min', true));
                            } else {
                                $regular_price = floatval($product->get_regular_price());
                                $sale_price = floatval($product->get_sale_price());
                            }
                            $percent = 0;
                            if ($product->is_on_sale() && $regular_price > 0 && $sale_price > 0) {
                                $percent = round(100 - ($sale_price * 100 / $regular_price));
                            }
                    ?>
                            <div>
                                <div class="product_item product_item_sale">
                                    <img class="icon_sale" src="<?php echo TGB_IMG_URL . 'icon_sale.png'; ?>" alt="">
                                    <a href="<?php echo $product_link; ?>" class="img_wrap">
                                        <img src="<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>">
                                    </a>
                                    <div class="content">
                                        <a href="<?php echo $product_link; ?>" class="d-block" data-mh="title">
                                            <h3 class="title line-2"><?php echo $product_title; ?></h3>
                                        </a>
                                        <div class="price">
                                            <?php
                                            if ($percent > 0) {
                                                echo  wc_price($sale_price);
                                            } else {
                                                echo $regular_price > 0 ?  wc_price($regular_price) : 'Liên hệ';
                                            }
                                            ?>
                                        </div>
                                        <?php if ($percent > 0) : ?>
                                            <div class="discount">
                                                <div class="cent">-<?php echo $percent; ?>%</div>
                                                <div class="old_price"><?php echo wc_price($regular_price); ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                    <?php
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
