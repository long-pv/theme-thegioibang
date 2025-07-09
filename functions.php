<?php
// define
define('NT_DIR_THEM_CHILD_INC', dirname(__FILE__) . '/inc');

//add font-awesome
// function fontawesome() {
//   wp_register_style( 'fontawesome_css', get_stylesheet_directory_uri() . '/assets/fontawesome/css/fontawesome.css', 'all' );
//   wp_enqueue_style( 'fontawesome_css' );

//   wp_register_style( 'brands_css', get_stylesheet_directory_uri() . '/assets/fontawesome/css/brands.css', 'all' );
//   wp_enqueue_style( 'brands_css' );

//   wp_register_style( 'solid_css', get_stylesheet_directory_uri() . '/assets/fontawesome/css/solid.css', 'all' );
//   wp_enqueue_style( 'solid_css' );

//    wp_register_style( 'all_css', get_stylesheet_directory_uri() . '/assets/fontawesome/css/all.css', 'all' );
//   wp_enqueue_style( 'all_css' );
// }
// add_action( 'wp_enqueue_scripts', 'fontawesome' );


add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

// require
require(NT_DIR_THEM_CHILD_INC . "/nt_theme.php");

add_action('woocommerce_archive_description', 'woocommerce_category_image', 2);
function woocommerce_category_image()
{
    if (is_product_category()) {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $image = wp_get_attachment_url($thumbnail_id);
        if ($image) {
            echo '<div class="nt-category-image"><img src="' . $image . '" alt="' . $cat->name . '" /></div>';
        }
    }
}

add_action('woocommerce_archive_description', 'woocommerce_category_sort', 20, 2);
function woocommerce_category_sort()
{
    woocommerce_catalog_ordering();
}

add_filter('woocommerce_empty_price_html', 'custom_for_price');

function custom_for_price()
{
    return '<ins><span class="woocommerce-Price-amount amount">Liên hệ</span></ins>';
}
add_filter('use_block_editor_for_post', '__return_false');


function display_price_in_variation_option_name($term)
{
    global $product;

    if (empty($term)) {
        return $term;
    }
    if (empty($product->id)) {
        return $term;
    }

    $variation_id = $product->get_children();

    foreach ($variation_id as $id) {
        $_product       = new WC_Product_Variation($id);
        $variation_data = $_product->get_variation_attributes();

        foreach ($variation_data as $key => $data) {
            if ($data == $term) {
                $html = $term;
                $html .= ($_product->get_stock_quantity()) ? ' - ' . $_product->get_stock_quantity() : '';
                $html .= ' - ' . wp_kses(woocommerce_price($_product->get_price()), array());
                return $html;
            }
        }
    }

    return $term;
}
add_filter('woocommerce_variation_option_name', 'display_price_in_variation_option_name', 10, 1);


function print_menu_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array('name' => null,), $atts));
    return wp_nav_menu(array('menu' => $name, 'echo' => false));
}
add_shortcode('menu', 'print_menu_shortcode');

// 0đ liên hệ
function devvn_wc_custom_get_price_html($price, $product)
{
    if ($product->get_price() == 0) {
        if ($product->is_on_sale() && $product->get_regular_price()) {
            $regular_price = wc_get_price_to_display($product, array('qty' => 1, 'price' => $product->get_regular_price()));

            $price = wc_format_price_range($regular_price, __('Free!', 'woocommerce'));
        } else {
            $price = '<span class="amount amount_lh">' . __('Liên hệ', 'woocommerce') . '</span>';
?>
            <style type="text/css">
                @media only screen and (min-width: 850px) {
                    p.price.product-page-price {
                        margin-top: 60px;
                        position: absolute;
                    }

                    .row.row-ratingplus {
                        min-height: 75px;
                    }
                }

                @media only screen and (max-width: 850px) {
                    .row.row-ratingplus {
                        min-height: 50px;
                    }

                    p.price.product-page-price {
                        margin-top: 45px;
                        position: absolute;
                    }
                }
            </style>
        <?php
        }
    }
    return $price;
}
add_filter('woocommerce_get_price_html', 'devvn_wc_custom_get_price_html', 10, 2);

// hết hàng ->liên hệ
function devvn_oft_custom_get_price_html($price, $product)
{
    if (!is_admin() && !$product->is_in_stock()) {
        $price = '<span class="amount">' . __('Liên hệ', 'woocommerce') . '</span>';
    }
    return $price;
}
add_filter('woocommerce_get_price_html', 'devvn_oft_custom_get_price_html', 99, 2);

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'  => 'List Hotline + Chống Copy',
        'menu_title'  => 'List Hotline + Chống Copy',
        'menu_slug'   => 'hotline',
        'capability'  => 'edit_posts',
        'icon_url'    => 'dashicons-art',
        'position' => 9,
        'redirect'    => false
    ));
}

function flatsome_editor_text_sizes($initArray)
{
    $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 17px 18px 19px 20px 21px 24px 28px 32px 36px";
    return $initArray;
};

/*
* Remove the default WooCommerce 3 JSON/LD structured data format
*/
function remove_output_structured_data()
{
    remove_action('wp_footer', array(WC()->structured_data, 'output_structured_data'), 10); // Frontend pages
    remove_action('woocommerce_email_order_details', array(WC()->structured_data, 'output_email_structured_data'), 30); // Emails
}
add_action('init', 'remove_output_structured_data');

add_filter('woocommerce_available_variation', function ($available_variations, \WC_Product_Variable $variable, \WC_Product_Variation $variation) {
    if (empty($available_variations['price_html'])) {
        $available_variations['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }

    return $available_variations;
}, 10, 3);


// them huu ich va tam duoc vao bai viet cua caodem
function ip_post_likes($content)
{
    if (is_singular('product') || is_singular('post')) {
        ob_start();
        ?>
        <div class="yes-likes">
            <div class="title-like">Chào <?php echo $current_user->nickname; ?>! Bạn thấy nội dung này thế nào? </div>
            <div class="ok-like">
                <a href="<?php echo add_query_arg('post_action', 'like'); ?>"><i class="far fa-thumbs-up"></i> Hữu ích <?php echo ip_get_like_count('likes') ?></a>
                <!-- <a href="<?php echo add_query_arg('post_action', 'dislike'); ?>"><i class="far fa-thumbs-down"></i> Tạm được <?php echo ip_get_like_count('dislikes') ?></a> -->
            </div>
        </div>
    <?php
        $output = ob_get_clean();
        return $content . $output;
    } else {
        return $content;
    }
}
add_filter('the_content', 'ip_post_likes');

function ip_get_like_count($type = 'likes')
{
    $current_count = get_post_meta(get_the_id(), $type, true);
    return ($current_count ? $current_count : 0);
}
function ip_process_like()
{
    $processed_like = false;
    $redirect = false;
    if (is_singular('product') || is_singular('post')) {
        if (isset($_GET['post_action'])) {
            if ($_GET['post_action'] == 'like') {
                $like_count = get_post_meta(get_the_id(), 'likes', true);
                if ($like_count) {
                    $like_count = $like_count + 1;
                } else {
                    $like_count = 1;
                }
                $processed_like = update_post_meta(get_the_id(), 'likes', $like_count);
            } elseif ($_GET['post_action'] == 'dislike') {
                $dislike_count = get_post_meta(get_the_id(), 'dislikes', true);
                if ($dislike_count) {
                    $dislike_count = $dislike_count + 1;
                } else {
                    $dislike_count = 1;
                }
                $processed_like = update_post_meta(get_the_id(), 'dislikes', $dislike_count);
            }
            if ($processed_like) {
                $redirect = get_the_permalink();
            }
        }
    }
    if ($redirect) {
        wp_redirect($redirect);
        die;
    }
}
add_action('template_redirect', 'ip_process_like');




//
add_shortcode('products-counter', 'products_counter');
function products_counter($atts)
{
    $atts = shortcode_atts([
        'category' => '',
    ], $atts);
    $taxonomy = 'product_cat';
    if (is_numeric($atts['category'])) {
        $cat = get_term($atts['category'], $taxonomy);
    } else {
        $cat = get_term_by('slug', $atts['category'], $taxonomy);
    }
    if ($cat && ! is_wp_error($cat)) {
        return $cat->count;
    }
    return '';
}


add_shortcode('blogs-counter', 'blogs_counter');
function blogs_counter($atts)
{
    $atts = shortcode_atts([
        'category' => '',
    ], $atts);
    $taxonomy = 'category';
    if (is_numeric($atts['category'])) {
        $cat = get_term($atts['category'], $taxonomy);
    } else {
        $cat = get_term_by('slug', $atts['category'], $taxonomy);
    }
    if ($cat && ! is_wp_error($cat)) {
        return $cat->count;
    }
    return '';
}


add_action('init', 'hide_notice');
function hide_notice()
{
    remove_action('admin_notices', 'flatsome_maintenance_admin_notice');
}

// add button dang ky tu van
add_action('woocommerce_after_add_to_cart_button', 'nt_add_button_dang_ky_tu_van', 2);
function nt_add_button_dang_ky_tu_van()
{
    $link_zalo_oa = get_field('link_zalo_oa', 'option') ?? '';
    ?>
    <?php if ($link_zalo_oa) : ?>
        <a target="_blank" href="<?php echo $link_zalo_oa; ?>" class="button primary nt-dang-ky-tu-van">Tư vấn sản phẩm</a>
    <?php endif; ?>
    <a href="#tab-reviews" class="button secondary hinhanh_tt">Xem ảnh thực tế</a>
<?php
}

require get_theme_file_path('shortcode/index.php');
