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
}, 99);

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
