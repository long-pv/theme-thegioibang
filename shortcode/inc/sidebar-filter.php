<?php
// ===============================
// Shortcode: [tgb_sidebar_filter]
// ===============================
add_shortcode('tgb_sidebar_filter', function () {
    ob_start();
?>
    <div class="tgb_sidebar_filter">
        <div class="sidebar-filter">

            <div class="heading">
                <div class="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.38589 5.66687C2.62955 4.82155 2.25138 4.39889 2.23712 4.03968C2.22473 3.72764 2.35882 3.42772 2.59963 3.22889C2.87684 3 3.44399 3 4.57828 3H19.4212C20.5555 3 21.1227 3 21.3999 3.22889C21.6407 3.42772 21.7748 3.72764 21.7624 4.03968C21.7481 4.39889 21.3699 4.82155 20.6136 5.66687L14.9074 12.0444C14.7566 12.2129 14.6812 12.2972 14.6275 12.3931C14.5798 12.4781 14.5448 12.5697 14.5236 12.6648C14.4997 12.7721 14.4997 12.8852 14.4997 13.1113V18.4584C14.4997 18.6539 14.4997 18.7517 14.4682 18.8363C14.4403 18.911 14.395 18.9779 14.336 19.0315C14.2692 19.0922 14.1784 19.1285 13.9969 19.2012L10.5969 20.5612C10.2293 20.7082 10.0455 20.7817 9.89802 20.751C9.76901 20.7242 9.6558 20.6476 9.583 20.5377C9.49975 20.4122 9.49975 20.2142 9.49975 19.8184V13.1113C9.49975 12.8852 9.49975 12.7721 9.47587 12.6648C9.45469 12.5697 9.41971 12.4781 9.37204 12.3931C9.31828 12.2972 9.2429 12.2129 9.09213 12.0444L3.38589 5.66687Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="text">
                    Bộ lọc tìm kiếm
                </div>
            </div>

            <!-- Form lọc sản phẩm -->
            <form method="GET" class="filter_form">
                <!-- Thêm sắp xếp -->
                <input type="hidden" name="orderby" value="<?php echo isset($_GET['orderby']) ? $_GET['orderby'] : '' ?>">

                <!-- Lựa chọn danh mục (Radio Button) -->
                <div class="filter_item">
                    <div class="title">Theo danh mục</div>

                    <div class="content checkboxes">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'parent' => 0,
                        ));
                        $product_cat = isset($_GET['product_cat']) ? $_GET['product_cat'] : [];
                        foreach ($categories as $category):
                            $checked = in_array($category->term_id, $product_cat) ? 'checked' : '';
                        ?>
                            <label>
                                <input type="checkbox" name="product_cat[]" value="<?php echo esc_attr($category->slug); ?>" <?php echo $checked; ?>>
                                <?php echo $category->name; ?> (<?php echo $category->count ?? 0; ?>)
                                <span class="icon"></span>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <a href="javascript:void(0);" class="view_more">
                        <div class="text"> Xem thêm</div>
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L12 15L18 9" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                </div>

                <div class="filter_line"></div>

                <div class="filter_item">
                    <div class="title">Dòng sản phẩm</div>
                    <?php
                    $selected_tags = isset($_GET['product_tags']) ? $_GET['product_tags'] : [];

                    $tags = get_terms([
                        'taxonomy' => 'product_tag',
                        'hide_empty' => true,
                    ]);

                    if (!empty($tags)):
                    ?>
                        <div class="content checkboxes">
                            <?php
                            foreach ($tags as $tag):
                                $checked = in_array($tag->term_id, $selected_tags) ? 'checked' : '';
                            ?>
                                <label>
                                    <input type="checkbox" name="product_tags[]"
                                        value="<?php echo esc_attr($tag->term_id); ?>" <?php echo $checked; ?>>
                                    <?php echo esc_html($tag->name); ?>
                                    (<?php echo $tag->count ?? 0; ?>)
                                    <span class="icon"></span>
                                </label>
                            <?php
                            endforeach;
                            ?>
                        </div>

                        <a href="javascript:void(0);" class="view_more">
                            <div class="text"> Xem thêm</div>
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9L12 15L18 9" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </a>
                    <?php
                    endif;
                    ?>
                </div>

                <div class="filter_line"></div>

                <!-- Khoảng giá (Range Slider) -->
                <!-- <div class="price-slider">
                    <label for="price-range">Price</label>
                    <div id="slider-range-labels">
                        <span id="min-label"></span>
                        <span id="max-label"></span>
                    </div>
                    <div id="slider-range" data-min="0" data-max="1000"></div>
                    <div class="price-range-inputs">
                        <input type="hidden" id="min-price" name="min_price"
                            value="<?php echo !empty($_GET['min_price']) ? $_GET['min_price'] : '0'; ?>">
                        <input type="hidden" id="max-price" name="max_price"
                            value="<?php echo !empty($_GET['max_price']) ? $_GET['max_price'] : '1000'; ?>">
                    </div>
                </div> -->


                <?php
                // Lấy danh sách các thuộc tính
                $attributes = wc_get_attribute_taxonomies();

                if (!empty($attributes)):
                    foreach ($attributes as $attribute):
                        $terms = get_terms(array(
                            'taxonomy' => 'pa_' . $attribute->attribute_name,
                            'hide_empty' => true,
                        ));
                ?>
                        <?php if (!empty($terms)): ?>
                            <div class="filter_item">
                                <div class="title">
                                    <?php echo $attribute->attribute_label; ?>
                                </div>
                                <div class="content checkboxes">
                                    <?php foreach ($terms as $term): ?>
                                        <label>
                                            <input type="checkbox" name="product_attributes[]"
                                                value="<?php echo esc_attr($term->term_id); ?>"
                                                <?php echo (isset($_GET['product_attributes']) && in_array($term->term_id, $_GET['product_attributes'])) ? 'checked' : ''; ?>>
                                            <?php echo esc_html($term->name); ?>
                                            (<?php echo $term->count ?? 0; ?>)
                                            <span class="icon"></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>

                                <a href="javascript:void(0);" class="view_more">
                                    <div class="text"> Xem thêm</div>
                                    <div class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 9L12 15L18 9" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <div class="filter_line"></div>
                <?php
                        endif;
                    endforeach;
                endif; ?>

                <!-- Nút Submit -->
                <button type="submit" class="button btn_apply">Áp dụng</button>
                <?php
                $reset_url = esc_url(
                    remove_query_arg(
                        array(
                            'paging',
                            'title',
                            'product_cat',
                            'min_price',
                            'max_price',
                            'product_tags',
                            'orderby',
                            'product_attributes',
                        )
                    )
                );
                ?>
                <a href="<?php echo $reset_url; ?>" class="button btn_reset" id="reset-filters">
                    Xoá tất cả
                </a>
            </form>
        </div>
    </div>
<?php
    return ob_get_clean();
});
