<?php
// ===============================
// Shortcode: [tgb_menu_right]
// ===============================
add_shortcode('tgb_menu_right', function () {
    ob_start();
?>
    <div class="tgb_menu_right">
        <?php
        if (has_nav_menu('menu-right')) {
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-right',
                    'container' => 'nav',
                    'container_class' => 'menu_right',
                    'depth' => 3,
                )
            );
        }
        ?>
    </div>
<?php
    return ob_get_clean();
});
