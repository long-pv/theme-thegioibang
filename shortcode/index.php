<?php
// 1. Define paths
define('TGB_SHORTCODE_URL', get_stylesheet_directory_uri() . '/shortcode');
define('TGB_SHORTCODE_PATH', get_stylesheet_directory() . '/shortcode');
define('TGB_IMG_URL', get_stylesheet_directory_uri() . '/shortcode/assets/images/');
define('TGB_SHORTCODE_VER', '1.0.0');

// 2. Auto load all PHP files in /inc
$inc_files = glob(TGB_SHORTCODE_PATH . '/inc/*.php');
if (!empty($inc_files)) {
    foreach ($inc_files as $file) {
        require_once $file;
    }
}

// The function "write_log" is used to write debug logs to a file in PHP.
function write_log($log = null, $title = 'Debug')
{
    if ($log) {
        if (is_array($log) || is_object($log)) {
            $log = print_r($log, true);
        }

        $timestamp = date('Y-m-d H:i:s');
        $text = '[' . $timestamp . '] : ' . $title . ' - Log: ' . $log . "\n";
        $log_file = WP_CONTENT_DIR . '/debug.log';
        $file_handle = fopen($log_file, 'a');
        fwrite($file_handle, $text);
        fclose($file_handle);
    }
}

// 3. Enqueue assets
add_action('wp_enqueue_scripts', function () {
    // matchHeight
    wp_enqueue_script('tgb-script-matchHeight', TGB_SHORTCODE_URL . '/assets/js/jquery.matchHeight.js', array('jquery'), '1.0.0', true);
    // slick
    wp_enqueue_style('tgb-style-slick-theme', TGB_SHORTCODE_URL . '/assets/slick/slick-theme.css', array(), '1.0.0');
    wp_enqueue_style('tgb-style-slick', TGB_SHORTCODE_URL . '/assets/slick/slick.css', array(), '1.0.0');
    wp_enqueue_script('tgb-script-slick', TGB_SHORTCODE_URL . '/assets/slick/slick.min.js', array('jquery'), '1.0.0', true);

    $css_path = TGB_SHORTCODE_PATH . '/assets/css/main.css';
    $js_path  = TGB_SHORTCODE_PATH . '/assets/js/main.js';

    wp_enqueue_style(
        'tgb-shortcode-style',
        TGB_SHORTCODE_URL . '/assets/css/main.css',
        [],
        file_exists($css_path) ? filemtime($css_path) : time()
    );

    wp_enqueue_script(
        'tgb-shortcode-script',
        TGB_SHORTCODE_URL . '/assets/js/main.js',
        ['jquery'],
        file_exists($js_path) ? filemtime($js_path) : time(),
        true
    );

    // ajax admin
    wp_localize_script('tgb-shortcode-script', 'custom_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}, 999);

// Đăng ký Theme Settings Panel với các menu con
if (function_exists('acf_add_options_page')) {

    // Trang chính: Theme Settings
    acf_add_options_page([
        'page_title'  => 'Theme Settings',
        'menu_title'  => 'Theme Settings',
        'menu_slug'   => 'tgb-theme-settings',
        'capability'  => 'edit_theme_options',
        'redirect'    => false,
        'position'    => 80,
        'icon_url'    => 'dashicons-admin-generic'
    ]);

    // Sub page: Header Settings
    acf_add_options_sub_page([
        'page_title'  => 'Header Settings',
        'menu_title'  => 'Header',
        'parent_slug' => 'tgb-theme-settings',
    ]);

    // Sub page: Footer Settings
    acf_add_options_sub_page([
        'page_title'  => 'Footer Settings',
        'menu_title'  => 'Footer',
        'parent_slug' => 'tgb-theme-settings',
    ]);

    // Sub page: Home page
    acf_add_options_sub_page([
        'page_title'  => 'Home page',
        'menu_title'  => 'Home page',
        'parent_slug' => 'tgb-theme-settings',
    ]);
}


function tgb_redirect_product_cat_to_shop()
{
    // Đừng can thiệp trong admin, AJAX, hay nếu đã ở trang Shop
    if (is_admin() || wp_doing_ajax() || is_shop()) {
        return;
    }

    // Chỉ xử lý cho taxonomy product_cat
    if (is_product_category()) {

        $term = get_queried_object();                   // Lấy term hiện tại
        if (empty($term->term_id)) {
            return;                                     // Phòng hờ edge case
        }

        $shop_url = wc_get_page_permalink('shop');    // URL trang Shop
        $target   = add_query_arg(
            array('prod_cat' => array($term->term_id)),
            $shop_url
        );

        wp_safe_redirect($target, 301);               // 301 cho SEO
        exit;
    }
}
add_action('template_redirect', 'tgb_redirect_product_cat_to_shop', 0);


add_action('wp_ajax_tgb_search_suggestion', 'tgb_search_suggestion');
add_action('wp_ajax_nopriv_tgb_search_suggestion', 'tgb_search_suggestion');
function tgb_search_suggestion()
{
    global $wpdb;
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
    if (strlen($keyword) < 2) wp_die();

    // Tách từ khoá thành các từ riêng
    $keywords = preg_split('/\s+/', $keyword);
    $keywords = array_filter($keywords); // loại bỏ khoảng trắng thừa

    // Tạo mảng điều kiện LIKE
    $like_clauses = [];
    foreach ($keywords as $word) {
        $like = '%' . $wpdb->esc_like($word) . '%';
        $like_clauses[] = $wpdb->prepare("post_title LIKE %s", $like);
    }

    // Gộp điều kiện bằng AND
    $where_like = implode(' AND ', $like_clauses);

    // Tạo câu truy vấn hoàn chỉnh
    $sql = "
        SELECT ID FROM $wpdb->posts
        WHERE post_type = 'product'
        AND post_status = 'publish'
        AND $where_like
        LIMIT 15
    ";

    // Thực thi truy vấn
    $product_ids = $wpdb->get_col($sql);

    // 2. Danh mục sản phẩm WooCommerce (product_cat) - chỉ taxonomy sản phẩm
    $all_cats = get_terms([
        'taxonomy'   => 'product_cat',   // <-- Chỉ product_cat
        'hide_empty' => true,
    ]);
    $matched_cats = [];
    foreach ($all_cats as $cat) {
        if (mb_stripos($cat->name, $keyword) !== false) {
            $matched_cats[] = $cat;
            if (count($matched_cats) >= 10) break;
        }
    }

    $shop_url = get_permalink(wc_get_page_id('shop'));

    // 3. Render HTML

    // --- Sản phẩm ---
    if (!empty($product_ids)) {
        foreach ($product_ids as $product_id) {
            $title = get_the_title($product_id);

            $pattern = '/' . implode('|', array_map(function ($word) {
                return preg_quote($word, '/');
            }, $keywords)) . '/iu';

            $highlighted = preg_replace(
                $pattern,
                '<span class="highlight">$0</span>',
                $title
            );

            $url = add_query_arg('search', $title, $shop_url);
?>
            <a href="<?php echo $url; ?>" class="item item-product">
                <div class="icon"></div>
                <div class="text">
                    <?php echo $highlighted; ?>
                </div>
            </a>
        <?php
        }
    }

    // --- Danh mục sản phẩm Woo ---
    if (!empty($matched_cats)) {
        foreach ($matched_cats as $cat) {
            $cat_name = $cat->name;
            $highlighted_cat = preg_replace(
                '/' . preg_quote($keyword, '/') . '/iu',
                '<span class="highlight">$0</span>',
                $cat_name
            );
            $cat_url = add_query_arg('prod_cat[]', $cat->term_id, $shop_url);
        ?>
            <a href="<?php echo $cat_url; ?>" class="item item-category">
                <div class="icon"></div>
                <div class="text">
                    <?php echo $highlighted_cat; ?>
                </div>
            </a>
<?php
        }
    }

    if (empty($product_ids) && empty($matched_cats)) {
        echo '<div class="item"><div class="text">Không tìm thấy kết quả nào</div></div>';
    }

    wp_die();
}

add_filter('body_class', function ($classes) {
    if (is_cart()) {
        $classes[] = 'tgb_page_woo_cart';
    }

    if (is_singular('product')) {
        $classes[] = 'tgb_single_product';
    }

    if (is_singular('post')) {
        $classes[] = 'tgb_single_post';
    }

    return $classes;
}, 99);

function register_my_custom_menu()
{
    register_nav_menu('menu-right', __('Menu right'));
}
add_action('after_setup_theme', 'register_my_custom_menu');
