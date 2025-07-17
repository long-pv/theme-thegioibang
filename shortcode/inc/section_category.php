<?php
// ===============================
// Shortcode: [tgb_section_category]
// ===============================
add_shortcode('tgb_section_category', function ($atts, $content = null) {
    $atts = shortcode_atts([
        'category_id' => '',
        'title'       => '', // Tiêu đề tuỳ chỉnh
        'banner'       => '',
        'url'       => '',
    ], $atts);

    // Lấy category ID
    $cat_id = intval($atts['category_id']);
    $title = !empty($atts['title']) ? $atts['title'] : '';
    $banner = !empty($atts['banner']) ? $atts['banner'] : '';
    $banner_url = !empty($atts['url']) ? $atts['url'] : '';
    if (!$cat_id) return;

    // Lấy tên category
    $cat = get_term($cat_id, 'product_cat');
    $cat_name = $cat ? $cat->name : 'Danh mục';
    $cat_link = get_term_link($cat_id, 'product_cat');

    if (!$title) {
        $title = $cat_name;
    }

    // Query 10 sản phẩm mới nhất trong category này
    $query = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => $banner ? 9 : 10,
        'tax_query'      => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $cat_id,
            ]
        ]
    ]);

    ob_start();
?>
    <div class="tgb_section_category">
        <div class="heading">
            <div class="title">
                <div class="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M23.5754 0H0.422535C0.310472 0 0.202998 0.044517 0.123758 0.123758C0.044517 0.202998 0 0.310472 0 0.422535L0 23.5775C0 23.6895 0.044517 23.797 0.123758 23.8762C0.202998 23.9555 0.310472 24 0.422535 24H23.5775C23.6895 24 23.797 23.9555 23.8762 23.8762C23.9555 23.797 24 23.6895 24 23.5775V0.422535C24 0.310472 23.9555 0.202998 23.8762 0.123758C23.797 0.044517 23.6895 0 23.5775 0M3.45634 6.49225C3.34427 6.49225 3.2368 6.44774 3.15756 6.3685C3.07832 6.28926 3.0338 6.18178 3.0338 6.06972V3.35704C3.0338 3.26476 3.07016 3.17619 3.13502 3.11054C3.19988 3.04489 3.288 3.00745 3.38028 3.00634H20.5394C20.6515 3.00634 20.759 3.05085 20.8382 3.1301C20.9175 3.20934 20.962 3.31681 20.962 3.42887V20.5099C20.962 20.6219 20.9175 20.7294 20.8382 20.8086C20.759 20.8879 20.6515 20.9324 20.5394 20.9324H17.8944C17.7823 20.9324 17.6748 20.8879 17.5956 20.8086C17.5163 20.7294 17.4718 20.6219 17.4718 20.5099V6.8662C17.4465 6.65493 17.3662 6.53451 17.157 6.49225H3.45634ZM3.55141 15.9444H7.71338C7.82544 15.9444 7.93292 15.9889 8.01216 16.0681C8.0914 16.1474 8.13591 16.2548 8.13591 16.3669V20.5289C8.13316 20.6391 8.08743 20.7439 8.00848 20.8208C7.92954 20.8978 7.82364 20.9409 7.71338 20.9408H3.48803C3.39726 20.9408 3.3102 20.9048 3.24602 20.8406C3.18183 20.7764 3.14577 20.6894 3.14577 20.5986V16.3732C3.14291 16.3181 3.15127 16.263 3.17035 16.2112C3.18942 16.1594 3.21881 16.112 3.25674 16.0719C3.29466 16.0318 3.34034 15.9998 3.39099 15.9779C3.44164 15.956 3.49622 15.9446 3.55141 15.9444ZM3.45634 12.9634C3.34427 12.9634 3.2368 12.9189 3.15756 12.8396C3.07832 12.7604 3.0338 12.6529 3.0338 12.5408V9.89789C3.0338 9.78582 3.07832 9.67835 3.15756 9.59911C3.2368 9.51987 3.34427 9.47535 3.45634 9.47535H14.0662C14.1783 9.47535 14.2857 9.51987 14.365 9.59911C14.4442 9.67835 14.4887 9.78582 14.4887 9.89789V20.5796C14.4887 20.6726 14.4518 20.7618 14.386 20.8276C14.3202 20.8933 14.231 20.9303 14.138 20.9303H11.3514C11.2584 20.9303 11.1692 20.8933 11.1034 20.8276C11.0377 20.7618 11.0007 20.6726 11.0007 20.5796V13.3373C10.9754 13.1261 10.8951 13.0056 10.6859 12.9634" fill="#1D3F35" />
                    </svg>
                </div>
                <div class="text">
                    <?php
                    echo $title;
                    ?>
                </div>
            </div>

            <div class="tgb_view_all">
                <a href="<?php echo $cat_link; ?>" class="btn_link">
                    <span class="text">
                        Xem thêm
                    </span>
                    <span class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>

        <div class="list">
            <div class="grid_row">
                <?php if ($banner): ?>
                    <div class="col_custom">
                        <div class="banner">
                            <?php echo $banner_url ? '<a target="_blank" href="' . $banner_url . '">' : ''; ?>
                            <img src="<?php echo $banner; ?>" alt="banner <?php echo $title; ?>">
                            <?php echo $banner_url ? '</a>' : ''; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $product_id = get_the_ID();
                        $item_sale = 0;
                        echo '<div class="col_custom">';
                        include TGB_SHORTCODE_PATH . '/inc/product_loop.php';
                        echo '</div>';
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p>Không có sản phẩm nào.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
