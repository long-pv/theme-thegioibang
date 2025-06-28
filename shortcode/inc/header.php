<?php
// ===============================================
// Shortcode: [tgb_search_ui]
// ===============================================
add_shortcode('tgb_search_ui', function () {
    ob_start();

    $header_settings = get_field('header_settings', 'option') ?? [];
    $featured_categories = $header_settings['featured_categories'] ?? null;
?>
    <div class="tgb_search_wrapper">
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="tgb_search_form">
            <span class="tgb_search_icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L15.0001 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <input
                type="text"
                name="s"
                class="tgb_search_input"
                placeholder="Nhập tên hoặc danh mục bạn muốn tìm kiếm" />
            <button type="submit" class="tgb_search_button">Tìm kiếm</button>

            <div class="result">
                <div class="title">
                    Từ khoá gợi ý
                </div>

                <div class="list">
                    <?php
                    for ($i = 0; $i < 6; $i++):
                    ?>
                        <div class="item">
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 21L15.0001 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text">
                                bảng trắng
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </form>

        <?php
        if ($featured_categories) :
        ?>
            <div class="tgb_search_suggestions">
                <?php
                foreach ($featured_categories as $cat_id) :
                    $term = get_term($cat_id, 'product_cat');
                    if ($term && !is_wp_error($term)) :
                        $cat_link = get_term_link($term);
                ?>
                        <a href="<?php echo $cat_link; ?>" class="tgb_search_link">
                            <?php echo $term->name; ?>
                        </a>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        <?php endif; ?>

        <script>
            jQuery(function($) {
                $('.tgb_search_input').on('input', function() {
                    var value = $(this).val().trim();
                    if (value.length > 0) {
                        $('.result').show();
                    } else {
                        $('.result').hide();
                    }
                });
                $(document).on('click', function(event) {
                    if (!$(event.target).closest('.tgb_search_form').length) {
                        $('.result').hide();
                    }
                });
            });
        </script>
    </div>
<?php
    return ob_get_clean();
});


// ===============================================
// Shortcode: [tgb_header_bottom]
// ===============================================
add_shortcode('tgb_header_bottom', function () {
    ob_start();

    $header_settings = get_field('header_settings', 'option') ?? [];
    $menu = $header_settings['menu'] ?? null;
    $menu_bottom = $header_settings['menu_bottom'] ?? null;
?>
    <div class="tgb_header_bottom">
        <div class="list">
            <div class="item" id="main_product_cat">
                <div class="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.4 3H4.6C4.03995 3 3.75992 3 3.54601 3.10899C3.35785 3.20487 3.20487 3.35785 3.10899 3.54601C3 3.75992 3 4.03995 3 4.6V8.4C3 8.96005 3 9.24008 3.10899 9.45399C3.20487 9.64215 3.35785 9.79513 3.54601 9.89101C3.75992 10 4.03995 10 4.6 10H8.4C8.96005 10 9.24008 10 9.45399 9.89101C9.64215 9.79513 9.79513 9.64215 9.89101 9.45399C10 9.24008 10 8.96005 10 8.4V4.6C10 4.03995 10 3.75992 9.89101 3.54601C9.79513 3.35785 9.64215 3.20487 9.45399 3.10899C9.24008 3 8.96005 3 8.4 3Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M19.4 3H15.6C15.0399 3 14.7599 3 14.546 3.10899C14.3578 3.20487 14.2049 3.35785 14.109 3.54601C14 3.75992 14 4.03995 14 4.6V8.4C14 8.96005 14 9.24008 14.109 9.45399C14.2049 9.64215 14.3578 9.79513 14.546 9.89101C14.7599 10 15.0399 10 15.6 10H19.4C19.9601 10 20.2401 10 20.454 9.89101C20.6422 9.79513 20.7951 9.64215 20.891 9.45399C21 9.24008 21 8.96005 21 8.4V4.6C21 4.03995 21 3.75992 20.891 3.54601C20.7951 3.35785 20.6422 3.20487 20.454 3.10899C20.2401 3 19.9601 3 19.4 3Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M19.4 14H15.6C15.0399 14 14.7599 14 14.546 14.109C14.3578 14.2049 14.2049 14.3578 14.109 14.546C14 14.7599 14 15.0399 14 15.6V19.4C14 19.9601 14 20.2401 14.109 20.454C14.2049 20.6422 14.3578 20.7951 14.546 20.891C14.7599 21 15.0399 21 15.6 21H19.4C19.9601 21 20.2401 21 20.454 20.891C20.6422 20.7951 20.7951 20.6422 20.891 20.454C21 20.2401 21 19.9601 21 19.4V15.6C21 15.0399 21 14.7599 20.891 14.546C20.7951 14.3578 20.6422 14.2049 20.454 14.109C20.2401 14 19.9601 14 19.4 14Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.4 14H4.6C4.03995 14 3.75992 14 3.54601 14.109C3.35785 14.2049 3.20487 14.3578 3.10899 14.546C3 14.7599 3 15.0399 3 15.6V19.4C3 19.9601 3 20.2401 3.10899 20.454C3.20487 20.6422 3.35785 20.7951 3.54601 20.891C3.75992 21 4.03995 21 4.6 21H8.4C8.96005 21 9.24008 21 9.45399 20.891C9.64215 20.7951 9.79513 20.6422 9.89101 20.454C10 20.2401 10 19.9601 10 19.4V15.6C10 15.0399 10 14.7599 9.89101 14.546C9.79513 14.3578 9.64215 14.2049 9.45399 14.109C9.24008 14 8.96005 14 8.4 14Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="text">
                    <?php _e('Danh mục'); ?>
                </div>
                <div class="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9L12 15L18 9" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <?php
                if ($menu) :
                ?>
                    <div class="main_product_cat_show">
                        <div class="container">
                            <ul class="list_menu">
                                <?php
                                foreach ($menu as $item):
                                    $title = $item['link']['title'] ?? '';
                                    $url = $item['link']['url'] ?? '';
                                    $show_submenu = $item['show_submenu'] ?? '';
                                ?>
                                    <li>
                                        <a href="<?php echo $url; ?>">
                                            <?php echo $title; ?>
                                        </a>

                                        <?php
                                        if ($show_submenu):
                                            $sub_menu = $item['sub_menu'] ?? [];
                                        ?>
                                            <ul class="sub_menu">
                                                <?php
                                                foreach ($sub_menu as $item_2) :
                                                    $title = $item_2['link']['title'] ?? '';
                                                    $url = $item_2['link']['url'] ?? '';
                                                    $products = $item_2['products'] ?? null;
                                                ?>
                                                    <li>
                                                        <a href="<?php echo $url; ?>">
                                                            <?php echo $title; ?>
                                                        </a>

                                                        <?php
                                                        if ($products && is_array($products)):
                                                            $args = array(
                                                                'post_type' => 'product',
                                                                'post__in' => $products,
                                                                'orderby' => 'post__in',
                                                                'posts_per_page' => -1
                                                            );
                                                            $query = new WP_Query($args);
                                                        ?>
                                                            <div class="list_product">
                                                                <div class="title">
                                                                    <?php echo $title; ?>
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M9 18L15 12L9 6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                </div>
                                                                <div class="grid_row">
                                                                    <?php
                                                                    while ($query->have_posts()): $query->the_post();
                                                                        global $product;
                                                                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                                                    ?>
                                                                        <div class="col_custom">
                                                                            <a href="#" class="item">
                                                                                <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                                                                                <div class="text">
                                                                                    <?php the_title(); ?>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    <?php
                                                                    endwhile;
                                                                    wp_reset_postdata();
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            if ($menu_bottom):
                foreach ($menu_bottom as $item):
                    $link = $item['link'] ?? [];
                    $prefix = $item['prefix'] ?? '';
                    $icon_svg = $item['icon_svg'] ?? '';
                    $title = ($link && $link['title']) ? $link['title'] : '';
                    $url = ($link && $link['url']) ? $link['url'] : '';

                    if ($title && $url) :
            ?>
                        <div class="line"></div>

                        <a href="<?php echo $url; ?>" class="item">
                            <?php if ($prefix) : ?>
                                <div class="text">
                                    <?php echo $prefix; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($icon_svg) : ?>
                                <div class="icon">
                                    <?php echo $icon_svg; ?>
                                </div>
                            <?php endif; ?>
                            <div class="text">
                                <?php echo $title; ?>
                            </div>
                        </a>
            <?php
                    endif;
                endforeach;
            endif;
            ?>
        </div>
    </div>
<?php
    return ob_get_clean();
});


// Shortcode hiển thị icon giỏ hàng và cập nhật số lượng realtime (jQuery)
function custom_wc_cart_icon_shortcode()
{
    ob_start();

    $header_settings = get_field('header_settings', 'option') ?? [];
    $promotional_offers = $header_settings['promotional_offers'] ?? null; // array(3) { ["title"]=> string(24) "Ưu đãi Khuyến mại" ["url"]=> string(1) "#" ["target"]=> string(0) "" }
?>
    <div class="tgb_header_right">
        <?php
        if (
            $promotional_offers
            && $promotional_offers['title']
            && $promotional_offers['url']
        ) :
        ?>
            <a href="<?php echo $promotional_offers['url']; ?>" class="promotion">
                <div class="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 6V22M12 6H8.46429C7.94332 6 7.4437 5.78929 7.07533 5.41421C6.70695 5.03914 6.5 4.53043 6.5 4C6.5 3.46957 6.70695 2.96086 7.07533 2.58579C7.4437 2.21071 7.94332 2 8.46429 2C11.2143 2 12 6 12 6ZM12 6H15.5357C16.0567 6 16.5563 5.78929 16.9247 5.41421C17.293 5.03914 17.5 4.53043 17.5 4C17.5 3.46957 17.293 2.96086 16.9247 2.58579C16.5563 2.21071 16.0567 2 15.5357 2C12.7857 2 12 6 12 6ZM20 11V18.8C20 19.9201 20 20.4802 19.782 20.908C19.5903 21.2843 19.2843 21.5903 18.908 21.782C18.4802 22 17.9201 22 16.8 22L7.2 22C6.07989 22 5.51984 22 5.09202 21.782C4.71569 21.5903 4.40973 21.2843 4.21799 20.908C4 20.4802 4 19.9201 4 18.8V11M2 7.6L2 9.4C2 9.96005 2 10.2401 2.10899 10.454C2.20487 10.6422 2.35785 10.7951 2.54601 10.891C2.75992 11 3.03995 11 3.6 11L20.4 11C20.9601 11 21.2401 11 21.454 10.891C21.6422 10.7951 21.7951 10.6422 21.891 10.454C22 10.2401 22 9.96005 22 9.4V7.6C22 7.03995 22 6.75992 21.891 6.54601C21.7951 6.35785 21.6422 6.20487 21.454 6.10899C21.2401 6 20.9601 6 20.4 6L3.6 6C3.03995 6 2.75992 6 2.54601 6.10899C2.35785 6.20487 2.20487 6.35785 2.10899 6.54601C2 6.75992 2 7.03995 2 7.6Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="text">
                    <?php echo html_entity_decode($promotional_offers['title']); ?>
                </div>
            </a>
            <div class="line"></div>
        <?php endif; ?>

        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart_icon">
            <div class="icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.00014 14H18.1359C19.1487 14 19.6551 14 20.0582 13.8112C20.4134 13.6448 20.7118 13.3777 20.9163 13.0432C21.1485 12.6633 21.2044 12.16 21.3163 11.1534L21.9013 5.88835C21.9355 5.58088 21.9525 5.42715 21.9031 5.30816C21.8597 5.20366 21.7821 5.11697 21.683 5.06228C21.5702 5 21.4155 5 21.1062 5H4.50014M2 2H3.24844C3.51306 2 3.64537 2 3.74889 2.05032C3.84002 2.09463 3.91554 2.16557 3.96544 2.25376C4.02212 2.35394 4.03037 2.48599 4.04688 2.7501L4.95312 17.2499C4.96963 17.514 4.97788 17.6461 5.03456 17.7462C5.08446 17.8344 5.15998 17.9054 5.25111 17.9497C5.35463 18 5.48694 18 5.75156 18H19M7.5 21.5H7.51M16.5 21.5H16.51M8 21.5C8 21.7761 7.77614 22 7.5 22C7.22386 22 7 21.7761 7 21.5C7 21.2239 7.22386 21 7.5 21C7.77614 21 8 21.2239 8 21.5ZM17 21.5C17 21.7761 16.7761 22 16.5 22C16.2239 22 16 21.7761 16 21.5C16 21.2239 16.2239 21 16.5 21C16.7761 21 17 21.2239 17 21.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <span class="count" id="custom-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </a>
    </div>
    <script>
        jQuery(function($) {
            function updateCartCount() {
                $.get('<?php echo admin_url('admin-ajax.php?action=get_cart_count'); ?>', function(count) {
                    $('#custom-cart-count').text(count);
                });
            }

            // Khi thêm vào giỏ hàng
            $('body').on('added_to_cart', updateCartCount);

            // Khi cập nhật số lượng ở trang giỏ hàng (AJAX)
            // WooCommerce sẽ trigger event 'updated_cart_totals' sau khi cập nhật xong
            $('body').on('updated_cart_totals', updateCartCount);
        });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('tgb_wc_cart_icon', 'custom_wc_cart_icon_shortcode');

// AJAX Handler để trả về số lượng sản phẩm trong giỏ
add_action('wp_ajax_get_cart_count', 'custom_wc_cart_count_ajax');
add_action('wp_ajax_nopriv_get_cart_count', 'custom_wc_cart_count_ajax');
function custom_wc_cart_count_ajax()
{
    echo WC()->cart->get_cart_contents_count();
    wp_die();
}

// ===============================
// Shortcode: [tgb_header_mb]
// ===============================
add_shortcode('tgb_header_mb', function () {
    ob_start();
?>
    <div class="tgb_header_mb">
        <div class="container">
            <div class="list">
                <div class="grid_row">
                    <div class="col_custom">
                        <div class="item">
                            <div class="icon">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.5 21V13.6C9.5 13.0399 9.5 12.7599 9.60899 12.546C9.70487 12.3578 9.85785 12.2049 10.046 12.109C10.2599 12 10.5399 12 11.1 12H13.9C14.4601 12 14.7401 12 14.954 12.109C15.1422 12.2049 15.2951 12.3578 15.391 12.546C15.5 12.7599 15.5 13.0399 15.5 13.6V21M11.5177 2.764L4.73539 8.03912C4.28202 8.39175 4.05534 8.56806 3.89203 8.78886C3.74737 8.98444 3.6396 9.20478 3.57403 9.43905C3.5 9.70352 3.5 9.9907 3.5 10.5651V17.8C3.5 18.9201 3.5 19.4801 3.71799 19.908C3.90973 20.2843 4.21569 20.5903 4.59202 20.782C5.01984 21 5.57989 21 6.7 21H18.3C19.4201 21 19.9802 21 20.408 20.782C20.7843 20.5903 21.0903 20.2843 21.282 19.908C21.5 19.4801 21.5 18.9201 21.5 17.8V10.5651C21.5 9.9907 21.5 9.70352 21.426 9.43905C21.3604 9.20478 21.2526 8.98444 21.108 8.78886C20.9447 8.56806 20.718 8.39175 20.2646 8.03913L13.4823 2.764C13.131 2.49075 12.9553 2.35412 12.7613 2.3016C12.5902 2.25526 12.4098 2.25526 12.2387 2.3016C12.0447 2.35412 11.869 2.49075 11.5177 2.764Z" stroke="#C0C0C0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text">
                                <?php _e('Trang chủ'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col_custom">
                        <div class="item">
                            <div class="icon">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.9 3H5.1C4.53995 3 4.25992 3 4.04601 3.10899C3.85785 3.20487 3.70487 3.35785 3.60899 3.54601C3.5 3.75992 3.5 4.03995 3.5 4.6V8.4C3.5 8.96005 3.5 9.24008 3.60899 9.45399C3.70487 9.64215 3.85785 9.79513 4.04601 9.89101C4.25992 10 4.53995 10 5.1 10H8.9C9.46005 10 9.74008 10 9.95399 9.89101C10.1422 9.79513 10.2951 9.64215 10.391 9.45399C10.5 9.24008 10.5 8.96005 10.5 8.4V4.6C10.5 4.03995 10.5 3.75992 10.391 3.54601C10.2951 3.35785 10.1422 3.20487 9.95399 3.10899C9.74008 3 9.46005 3 8.9 3Z" stroke="#1D3F35" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M19.9 3H16.1C15.5399 3 15.2599 3 15.046 3.10899C14.8578 3.20487 14.7049 3.35785 14.609 3.54601C14.5 3.75992 14.5 4.03995 14.5 4.6V8.4C14.5 8.96005 14.5 9.24008 14.609 9.45399C14.7049 9.64215 14.8578 9.79513 15.046 9.89101C15.2599 10 15.5399 10 16.1 10H19.9C20.4601 10 20.7401 10 20.954 9.89101C21.1422 9.79513 21.2951 9.64215 21.391 9.45399C21.5 9.24008 21.5 8.96005 21.5 8.4V4.6C21.5 4.03995 21.5 3.75992 21.391 3.54601C21.2951 3.35785 21.1422 3.20487 20.954 3.10899C20.7401 3 20.4601 3 19.9 3Z" stroke="#1D3F35" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M19.9 14H16.1C15.5399 14 15.2599 14 15.046 14.109C14.8578 14.2049 14.7049 14.3578 14.609 14.546C14.5 14.7599 14.5 15.0399 14.5 15.6V19.4C14.5 19.9601 14.5 20.2401 14.609 20.454C14.7049 20.6422 14.8578 20.7951 15.046 20.891C15.2599 21 15.5399 21 16.1 21H19.9C20.4601 21 20.7401 21 20.954 20.891C21.1422 20.7951 21.2951 20.6422 21.391 20.454C21.5 20.2401 21.5 19.9601 21.5 19.4V15.6C21.5 15.0399 21.5 14.7599 21.391 14.546C21.2951 14.3578 21.1422 14.2049 20.954 14.109C20.7401 14 20.4601 14 19.9 14Z" stroke="#1D3F35" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.9 14H5.1C4.53995 14 4.25992 14 4.04601 14.109C3.85785 14.2049 3.70487 14.3578 3.60899 14.546C3.5 14.7599 3.5 15.0399 3.5 15.6V19.4C3.5 19.9601 3.5 20.2401 3.60899 20.454C3.70487 20.6422 3.85785 20.7951 4.04601 20.891C4.25992 21 4.53995 21 5.1 21H8.9C9.46005 21 9.74008 21 9.95399 20.891C10.1422 20.7951 10.2951 20.6422 10.391 20.454C10.5 20.2401 10.5 19.9601 10.5 19.4V15.6C10.5 15.0399 10.5 14.7599 10.391 14.546C10.2951 14.3578 10.1422 14.2049 9.95399 14.109C9.74008 14 9.46005 14 8.9 14Z" stroke="#1D3F35" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text">
                                <?php _e('Danh mục'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col_custom">
                        <div class="item">
                            <div class="icon">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5 6V22M12.5 6H8.96429C8.44332 6 7.9437 5.78929 7.57533 5.41421C7.20695 5.03914 7 4.53043 7 4C7 3.46957 7.20695 2.96086 7.57533 2.58579C7.9437 2.21071 8.44332 2 8.96429 2C11.7143 2 12.5 6 12.5 6ZM12.5 6H16.0357C16.5567 6 17.0563 5.78929 17.4247 5.41421C17.793 5.03914 18 4.53043 18 4C18 3.46957 17.793 2.96086 17.4247 2.58579C17.0563 2.21071 16.5567 2 16.0357 2C13.2857 2 12.5 6 12.5 6ZM20.5 11V18.8C20.5 19.9201 20.5 20.4802 20.282 20.908C20.0903 21.2843 19.7843 21.5903 19.408 21.782C18.9802 22 18.4201 22 17.3 22L7.7 22C6.57989 22 6.01984 22 5.59202 21.782C5.21569 21.5903 4.90973 21.2843 4.71799 20.908C4.5 20.4802 4.5 19.9201 4.5 18.8V11M2.5 7.6L2.5 9.4C2.5 9.96005 2.5 10.2401 2.60899 10.454C2.70487 10.6422 2.85785 10.7951 3.04601 10.891C3.25992 11 3.53995 11 4.1 11L20.9 11C21.4601 11 21.7401 11 21.954 10.891C22.1422 10.7951 22.2951 10.6422 22.391 10.454C22.5 10.2401 22.5 9.96005 22.5 9.4V7.6C22.5 7.03995 22.5 6.75992 22.391 6.54601C22.2951 6.35785 22.1422 6.20487 21.954 6.10899C21.7401 6 21.4601 6 20.9 6L4.1 6C3.53995 6 3.25992 6 3.04601 6.10899C2.85785 6.20487 2.70487 6.35785 2.60899 6.54601C2.5 6.75992 2.5 7.03995 2.5 7.6Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text">
                                <?php _e('Khuyến mại'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col_custom">
                        <div class="item">
                            <div class="icon">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.0399 16.54C15.8433 16.5394 15.6511 16.4808 15.4876 16.3715C15.3241 16.2623 15.1964 16.1073 15.1205 15.9258C15.0446 15.7444 15.0239 15.5446 15.061 15.3515C15.0981 15.1583 15.1913 14.9804 15.3289 14.84C16.0789 14.0863 16.5 13.0663 16.5 12.003C16.5 10.9397 16.0789 9.91967 15.3289 9.16597C15.1475 8.9764 15.0479 8.72313 15.0516 8.46078C15.0552 8.19844 15.1618 7.94803 15.3484 7.76356C15.5349 7.57909 15.7865 7.47533 16.0489 7.47466C16.3113 7.47399 16.5634 7.57646 16.7509 7.75997C17.8712 8.88793 18.5 10.4132 18.5 12.003C18.5 13.5928 17.8712 15.118 16.7509 16.246C16.6577 16.3395 16.5469 16.4136 16.4248 16.4641C16.3028 16.5145 16.172 16.5403 16.0399 16.54ZM9.66292 16.251C9.85146 16.0645 9.95821 15.8108 9.95971 15.5456C9.96121 15.2805 9.85733 15.0256 9.67092 14.837C8.92091 14.0833 8.49987 13.0633 8.49987 12C8.49987 10.9367 8.92091 9.91667 9.67092 9.16297C9.76576 9.07015 9.84118 8.95938 9.89278 8.83712C9.94438 8.71486 9.97113 8.58355 9.97147 8.45085C9.97181 8.31814 9.94573 8.1867 9.89476 8.06417C9.84378 7.94165 9.76893 7.8305 9.67457 7.73719C9.5802 7.64389 9.46821 7.5703 9.34511 7.52071C9.22202 7.47113 9.09029 7.44654 8.9576 7.44838C8.82491 7.45023 8.69391 7.47846 8.57224 7.53144C8.45057 7.58442 8.34066 7.66109 8.24892 7.75697C7.1286 8.88493 6.49985 10.4102 6.49985 12C6.49985 13.5898 7.1286 15.115 8.24892 16.243C8.43538 16.4315 8.6891 16.5383 8.95426 16.5398C9.21943 16.5413 9.47433 16.4374 9.66292 16.251ZM19.9319 18.671C21.5847 16.8422 22.4998 14.465 22.4998 12C22.4998 9.53497 21.5847 7.15774 19.9319 5.32897C19.754 5.13231 19.5052 5.0144 19.2403 5.00118C18.9754 4.98796 18.7161 5.08051 18.5194 5.25847C18.3228 5.43643 18.2049 5.68523 18.1916 5.95012C18.1784 6.21502 18.271 6.47431 18.4489 6.67097C19.769 8.13199 20.4998 10.0309 20.4998 12C20.4998 13.969 19.769 15.868 18.4489 17.329C18.271 17.5256 18.1784 17.7849 18.1916 18.0498C18.2049 18.3147 18.3228 18.5635 18.5194 18.7415C18.7161 18.9194 18.9754 19.012 19.2403 18.9988C19.5052 18.9855 19.754 18.8676 19.9319 18.671ZM6.47992 18.741C6.6765 18.5631 6.79441 18.3144 6.80773 18.0497C6.82104 17.7849 6.72867 17.5257 6.55092 17.329C5.23088 15.868 4.50008 13.969 4.50008 12C4.50008 10.0309 5.23088 8.13199 6.55092 6.67097C6.63904 6.5736 6.70711 6.45982 6.75126 6.33614C6.7954 6.21245 6.81475 6.08128 6.80821 5.95012C6.80166 5.81896 6.76934 5.69037 6.7131 5.5717C6.65686 5.45302 6.57779 5.34659 6.48042 5.25847C6.38304 5.17035 6.26927 5.10228 6.14558 5.05813C6.0219 5.01399 5.89073 4.99464 5.75957 5.00118C5.49467 5.0144 5.24588 5.13231 5.06792 5.32897C3.41509 7.15774 2.5 9.53497 2.5 12C2.5 14.465 3.41509 16.8422 5.06792 18.671C5.24593 18.8674 5.49465 18.9851 5.75943 18.9983C6.0242 19.0114 6.28335 18.9188 6.47992 18.741ZM12.4999 10.5C12.2032 10.5 11.9132 10.5879 11.6666 10.7528C11.4199 10.9176 11.2276 11.1519 11.1141 11.4259C11.0006 11.7 10.9709 12.0016 11.0287 12.2926C11.0866 12.5836 11.2295 12.8509 11.4393 13.0606C11.649 13.2704 11.9163 13.4133 12.2073 13.4712C12.4983 13.529 12.7999 13.4993 13.0739 13.3858C13.348 13.2723 13.5823 13.08 13.7471 12.8333C13.9119 12.5867 13.9999 12.2966 13.9999 12C13.9999 11.6021 13.8419 11.2206 13.5606 10.9393C13.2793 10.658 12.8977 10.5 12.4999 10.5Z" fill="#818181" />
                                </svg>
                            </div>
                            <div class="text">
                                <?php _e('Livestream'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col_custom">
                        <div class="item">
                            <div class="icon">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.50014 14H18.6359C19.6487 14 20.1551 14 20.5582 13.8112C20.9134 13.6448 21.2118 13.3777 21.4163 13.0432C21.6485 12.6633 21.7044 12.16 21.8163 11.1534L22.4013 5.88835C22.4355 5.58088 22.4525 5.42715 22.4031 5.30816C22.3597 5.20366 22.2821 5.11697 22.183 5.06228C22.0702 5 21.9155 5 21.6062 5H5.00014M2.5 2H3.74844C4.01306 2 4.14537 2 4.24889 2.05032C4.34002 2.09463 4.41554 2.16557 4.46544 2.25376C4.52212 2.35394 4.53037 2.48599 4.54688 2.7501L5.45312 17.2499C5.46963 17.514 5.47788 17.6461 5.53456 17.7462C5.58446 17.8344 5.65998 17.9054 5.75111 17.9497C5.85463 18 5.98694 18 6.25156 18H19.5M8 21.5H8.01M17 21.5H17.01M8.5 21.5C8.5 21.7761 8.27614 22 8 22C7.72386 22 7.5 21.7761 7.5 21.5C7.5 21.2239 7.72386 21 8 21C8.27614 21 8.5 21.2239 8.5 21.5ZM17.5 21.5C17.5 21.7761 17.2761 22 17 22C16.7239 22 16.5 21.7761 16.5 21.5C16.5 21.2239 16.7239 21 17 21C17.2761 21 17.5 21.2239 17.5 21.5Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text">
                                <?php _e(' Giỏ hàng'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
});
