<?php
// ===============================
// Shortcode: [tgb_featured]
// ===============================
add_shortcode('tgb_featured', function () {
    ob_start();

?>
    <div class="tgb_featured">
        <div class="grid_row grid_row_1">
            <div class="grid_col-lg-6">
                <?php
                $best_selling_products = get_field('best_selling_products', 'option') ?? null;
                $title = $best_selling_products['title'] ?? 'Sản phẩm bán chạy';
                $description = $best_selling_products['description'] ?? '';
                $url = $best_selling_products['url'] ?? '#';
                $product_list = $best_selling_products['product_list'] ?? [];
                ?>

                <div class="featured_inner">
                    <img class="pattern" src="<?php echo TGB_IMG_URL . 'pt_1.png'; ?>" alt="">
                    <div class="heading">
                        <h2 class="title"><?php echo esc_html($title); ?></h2>
                        <div class="desc"><?php echo esc_html($description); ?></div>
                        <a href="<?php echo esc_url($url); ?>" class="btn_link">
                            <span class="text">Xem thêm</span>
                            <span class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div class="list_product">
                        <?php
                        if (!empty($product_list)):
                            foreach ($product_list as $product_id) :
                                $product = wc_get_product($product_id);
                                if (!$product) continue;

                                $product_link = get_permalink($product_id);
                                $product_img = get_the_post_thumbnail_url($product_id, 'medium') ?: TGB_IMG_URL . 'img2.png';
                                $product_title = $product->get_name();

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
                                    <div class="product_item">
                                        <a href="<?php echo $product_link; ?>" class="img_wrap">
                                            <img src="<?php echo $product_img; ?>" alt="<?php echo esc_attr($product_title); ?>">
                                        </a>
                                        <div class="content">
                                            <a href="<?php echo $product_link; ?>" class="d-block" data-mh="title">
                                                <h3 class="title line-2"><?php echo esc_html($product_title); ?></h3>
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
                        else:
                            echo '<div>Không có sản phẩm bán chạy.</div>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <div class="grid_col-lg-6">
                <?php
                $new_product = get_field('new_product', 'option') ?? null;
                $title = $new_product['title'] ?? 'Sản phẩm bán chạy';
                $description = $new_product['description'] ?? '';
                $url = $new_product['url'] ?? '#';
                $product_list = $new_product['product_list'] ?? [];
                ?>

                <div class="featured_inner featured_inner_even">
                    <img class="pattern" src="<?php echo TGB_IMG_URL . 'pt_2.png'; ?>" alt="">
                    <div class="heading">
                        <h2 class="title"><?php echo esc_html($title); ?></h2>
                        <div class="desc"><?php echo esc_html($description); ?></div>
                        <a href="<?php echo esc_url($url); ?>" class="btn_link">
                            <span class="text">Xem thêm</span>
                            <span class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <div class="list_product">
                        <?php
                        if (!empty($product_list)):
                            foreach ($product_list as $product_id) :
                                $product = wc_get_product($product_id);
                                if (!$product) continue;

                                $product_link = get_permalink($product_id);
                                $product_img = get_the_post_thumbnail_url($product_id, 'medium') ?: TGB_IMG_URL . 'img2.png';
                                $product_title = $product->get_name();

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
                                    <div class="product_item">
                                        <a href="<?php echo $product_link; ?>" class="img_wrap">
                                            <img src="<?php echo $product_img; ?>" alt="<?php echo esc_attr($product_title); ?>">
                                        </a>
                                        <div class="content">
                                            <a href="<?php echo $product_link; ?>" class="d-block" data-mh="title">
                                                <h3 class="title line-2"><?php echo esc_html($product_title); ?></h3>
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
                        else:
                            echo '<div>Không có sản phẩm bán chạy.</div>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
