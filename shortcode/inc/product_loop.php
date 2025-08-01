<?php
if (function_exists('wc_get_product') && did_action('woocommerce_init')) {
    $product = wc_get_product($product_id ?? 0);
} else {
    return;
}

if (! $product) return;

$product_link = get_permalink($product_id);
$product_img = get_the_post_thumbnail_url($product_id, 'medium') ?: TGB_IMG_URL . 'img2.png';
$product_title = $product->get_name();

// lấy ảnh hover
$use_2_images = get_field('use_2_images', $product_id) ?? false;

// Chỉ lấy số, không HTML
if ($product->is_type('variable')) {
    // Lấy giá trị từ cookie 'attribute'
    $selected_attribute = isset($_COOKIE['attribute']) ? sanitize_text_field($_COOKIE['attribute']) : '';

    if ($selected_attribute) {
        // Có giá trị cookie → lọc theo khu vực
        $matched_regular_prices = [];
        $matched_sale_prices = [];

        foreach ($product->get_children() as $variation_id) {
            $variation = wc_get_product($variation_id);

            if (! $variation || ! $variation->is_purchasable()) {
                continue;
            }

            $attributes = $variation->get_attributes();

            if (isset($attributes['pa_khu-vuc']) && $attributes['pa_khu-vuc'] === $selected_attribute) {
                $regular = floatval($variation->get_regular_price());
                $sale    = floatval($variation->get_sale_price());

                if ($regular) $matched_regular_prices[] = $regular;
                if ($sale) $matched_sale_prices[] = $sale;
            }
        }

        if (! empty($matched_regular_prices)) {
            $regular_price = min($matched_regular_prices);
            $sale_price = ! empty($matched_sale_prices) ? min($matched_sale_prices) : $regular_price;
        } else {
            // Không tìm thấy biến thể phù hợp → fallback mặc định
            $regular_price = floatval($product->get_variation_regular_price('min', true));
            $sale_price = floatval($product->get_variation_sale_price('min', true));
        }
    } else {
        // Không có cookie hoặc cookie rỗng → fallback mặc định
        $regular_price = floatval($product->get_variation_regular_price('min', true));
        $sale_price = floatval($product->get_variation_sale_price('min', true));
    }
} else {
    // Sản phẩm đơn
    $regular_price = floatval($product->get_regular_price());
    $sale_price = floatval($product->get_sale_price());
}

// tính % giảm giá
$percent = 0;
if ($product->is_on_sale() && $regular_price > 0 && $sale_price > 0) {
    $percent = round(100 - ($sale_price * 100 / $regular_price));
}
?>

<div class="product_item <?php echo $item_sale == 1 ? 'product_item_sale' : ''; ?>" data-mh="product_item">
    <?php if ($item_sale == 1) : ?>
        <img class="icon_sale" src="<?php echo TGB_IMG_URL . 'icon_sale.png'; ?>" alt="">
    <?php endif; ?>

    <a href="<?php echo $product_link; ?>" class="img_wrap">
        <?php
        if ($use_2_images) :
            $image_main = get_field('list_image_image_main', $product_id) ?? '';
            $image_hover = get_field('list_image_image_hover', $product_id) ?? '';
        ?>
            <img class="list_image_image_main" src="<?php echo $image_main; ?>" alt="<?php echo $product_title; ?>">
            <img class="list_image_image_hover" src="<?php echo $image_hover; ?>" alt="<?php echo $product_title; ?>">
        <?php else : ?>
            <img src="<?php echo $product_img; ?>" alt="<?php echo $product_title; ?>">
        <?php endif; ?>
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
<?php
wp_reset_postdata();
