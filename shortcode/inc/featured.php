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
                        <div class="tgb_view_all">
                            <a href="<?php echo esc_url($url); ?>" class="btn_link">
                                <span class="text">Xem thêm</span>
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="list_product">
                        <?php
                        if (!empty($product_list)):
                            foreach ($product_list as $product_id) :
                                $item_sale = 0;
                                echo '<div>';
                                include TGB_SHORTCODE_PATH . '/inc/product_loop.php';
                                echo '</div>';
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

                        <div class="tgb_view_all">
                            <a href="<?php echo esc_url($url); ?>" class="btn_link">
                                <span class="text">Xem thêm</span>
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="list_product">
                        <?php
                        if (!empty($product_list)):
                            foreach ($product_list as $product_id) :
                                $item_sale = 0;
                                echo '<div>';
                                include TGB_SHORTCODE_PATH . '/inc/product_loop.php';
                                echo '</div>';
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
