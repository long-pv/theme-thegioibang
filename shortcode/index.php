<?php
// 1. Define paths
define('TGB_SHORTCODE_URL', get_stylesheet_directory_uri() . '/shortcode');
define('TGB_SHORTCODE_PATH', get_stylesheet_directory() . '/shortcode');
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
