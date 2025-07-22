<?php
// ===============================
// Shortcode: [tgb_sidebar_filter]
// ===============================
add_shortcode('tgb_sidebar_filter', function () {
    ob_start();
?>
    <div class="tgb_sidebar_filter">
        <div class="btn_filter_inner_mb">
            <a href="javascript:void(0);" class="btn_filter_mb">
                <div class="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.38589 5.66687C2.62955 4.82155 2.25138 4.39889 2.23712 4.03968C2.22473 3.72764 2.35882 3.42772 2.59963 3.22889C2.87684 3 3.44399 3 4.57828 3H19.4212C20.5555 3 21.1227 3 21.3999 3.22889C21.6407 3.42772 21.7748 3.72764 21.7624 4.03968C21.7481 4.39889 21.3699 4.82155 20.6136 5.66687L14.9074 12.0444C14.7566 12.2129 14.6812 12.2972 14.6275 12.3931C14.5798 12.4781 14.5448 12.5697 14.5236 12.6648C14.4997 12.7721 14.4997 12.8852 14.4997 13.1113V18.4584C14.4997 18.6539 14.4997 18.7517 14.4682 18.8363C14.4403 18.911 14.395 18.9779 14.336 19.0315C14.2692 19.0922 14.1784 19.1285 13.9969 19.2012L10.5969 20.5612C10.2293 20.7082 10.0455 20.7817 9.89802 20.751C9.76901 20.7242 9.6558 20.6476 9.583 20.5377C9.49975 20.4122 9.49975 20.2142 9.49975 19.8184V13.1113C9.49975 12.8852 9.49975 12.7721 9.47587 12.6648C9.45469 12.5697 9.41971 12.4781 9.37204 12.3931C9.31828 12.2972 9.2429 12.2129 9.09213 12.0444L3.38589 5.66687Z" stroke="#818181" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="text">
                    Bộ lọc
                </div>
            </a>
        </div>
        <div class="sidebar-filter">
            <div class="heading">
                <div class="icon icon_pc">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.38589 5.66687C2.62955 4.82155 2.25138 4.39889 2.23712 4.03968C2.22473 3.72764 2.35882 3.42772 2.59963 3.22889C2.87684 3 3.44399 3 4.57828 3H19.4212C20.5555 3 21.1227 3 21.3999 3.22889C21.6407 3.42772 21.7748 3.72764 21.7624 4.03968C21.7481 4.39889 21.3699 4.82155 20.6136 5.66687L14.9074 12.0444C14.7566 12.2129 14.6812 12.2972 14.6275 12.3931C14.5798 12.4781 14.5448 12.5697 14.5236 12.6648C14.4997 12.7721 14.4997 12.8852 14.4997 13.1113V18.4584C14.4997 18.6539 14.4997 18.7517 14.4682 18.8363C14.4403 18.911 14.395 18.9779 14.336 19.0315C14.2692 19.0922 14.1784 19.1285 13.9969 19.2012L10.5969 20.5612C10.2293 20.7082 10.0455 20.7817 9.89802 20.751C9.76901 20.7242 9.6558 20.6476 9.583 20.5377C9.49975 20.4122 9.49975 20.2142 9.49975 19.8184V13.1113C9.49975 12.8852 9.49975 12.7721 9.47587 12.6648C9.45469 12.5697 9.41971 12.4781 9.37204 12.3931C9.31828 12.2972 9.2429 12.2129 9.09213 12.0444L3.38589 5.66687Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="icon icon_mb">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 7L7 17M7 7L17 17" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="text">
                    Bộ lọc tìm kiếm
                </div>
            </div>

            <!-- Form lọc sản phẩm -->
            <form method="GET" class="filter_form">
                <?php
                $show_item = isset($_GET['show_item']) ? $_GET['show_item'] : 16;
                ?>
                <input type="hidden" name="show_item" value="<?php echo $show_item; ?>">
                <!-- Lựa chọn danh mục (Radio Button) -->
                <div class="filter_item">
                    <div class="title">Theo danh mục</div>

                    <div class="content checkboxes">
                        <?php
                        $filter_categories = get_field('filter_categories', 'option') ?? [];
                        if ($filter_categories) {
                            $categories = $filter_categories;
                        } else {
                            $categories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => true,
                            ));
                        }

                        $prod_cat = isset($_GET['prod_cat']) ? $_GET['prod_cat'] : [];
                        $count_cat = count($prod_cat) ?? 0;
                        foreach ($categories as $category):
                            if (($count_cat == 1 && $prod_cat[0] == $category->term_id) || $count_cat > 1 || $count_cat == 0) :
                                $checked = in_array($category->term_id, $prod_cat) ? 'checked' : '';
                        ?>
                                <label>
                                    <input type="checkbox" class="filter_cat" name="prod_cat[]" value="<?php echo $category->term_id; ?>" <?php echo $checked; ?>>
                                    <?php echo $category->name; ?> (<?php echo $category->count ?? 0; ?>)
                                    <span class="icon"></span>
                                </label>
                        <?php
                            endif;
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
                </div>

                <div class="filter_line"></div>

                <div class="filter_item">
                    <div class="title">Dòng sản phẩm</div>
                    <?php
                    $selected_tags = isset($_GET['prod_tags']) ? $_GET['prod_tags'] : [];

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
                                    <input type="checkbox" name="prod_tags[]"
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

                <?php
                $price_to = isset($_GET['price_to']) ? htmlspecialchars($_GET['price_to']) : '';
                $price_from = isset($_GET['price_from']) ? htmlspecialchars($_GET['price_from']) : '';
                ?>
                <div class="filter_item">
                    <div class="title">Khoảng giá</div>
                    <div class="price_range">
                        <input type="text" name="price_to" placeholder="đ Từ" value="<?= $price_to ?>">
                        <span class="separator"></span>
                        <input type="text" name="price_from" placeholder="đ Đến" value="<?= $price_from ?>">
                    </div>
                    <div class="error_msg" style="display: none;"></div>
                </div>
                <div class="filter_line"></div>

                <?php
                $attributes = wc_get_attribute_taxonomies();

                if (!empty($attributes)) :
                    foreach ($attributes as $attribute) :
                        $taxonomy = 'pa_' . $attribute->attribute_name;
                        $terms = get_terms([
                            'taxonomy'   => $taxonomy,
                            'hide_empty' => true,
                        ]);

                        if (empty($terms)) continue;
                ?>
                        <div class="filter_item">
                            <div class="title"><?php echo $attribute->attribute_label; ?></div>
                            <div class="content checkboxes">
                                <?php foreach ($terms as $term) :
                                    $checked = isset($_GET['prod_attr'][$taxonomy]) && in_array($term->term_id, $_GET['prod_attr'][$taxonomy]);
                                ?>
                                    <label>
                                        <input type="checkbox"
                                            name="prod_attr[<?php echo $taxonomy; ?>][]"
                                            value="<?php echo $term->term_id; ?>"
                                            <?php if ($checked) echo 'checked'; ?>>
                                        <?php echo $term->name; ?> (<?php echo $term->count; ?>)
                                        <span class="icon"></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>

                            <a href="javascript:void(0);" class="view_more">
                                <div class="text">Xem thêm</div>
                                <div class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9L12 15L18 9" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="filter_line"></div>
                <?php
                    endforeach;
                endif;
                ?>

                <!-- Nút Submit -->
                <button type="submit" class="button btn_apply">Áp dụng</button>
                <?php
                $reset_url = esc_url(
                    remove_query_arg(
                        array(
                            'paging',
                            'title',
                            'prod_cat',
                            'min_price',
                            'max_price',
                            'prod_tags',
                            'orderby',
                            'prod_attr',
                            'price_to',
                            'price_from',
                            'search'
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
