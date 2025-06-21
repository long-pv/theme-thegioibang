<?php
$column = $columns + $columns;
$count = $products->current_post;
$arrdem = $this->ntLoopItem($column, 0);
$arrtru = $this->ntLoopItem($column, 1);
 
    foreach ($arrdem as $value) :
        if($count == $value ): ?> 
            <div class="col" <?php echo $animate;?>>
                <div class="col-inner">
                <div class="<?php echo 'row large-columns-'.$columns.' medium-columns-'.$columns__md . ' small-columns-'.$columns__sm;?> ">
                    
        <?php   endif;
    endforeach;
?> 
    <div class="col product-small product">
    <div class="col-inner">
        <?php woocommerce_show_product_loop_sale_flash(); ?>
        <div class="product-small box has-hover box-overlay box-text-bottom">
            <div class="box-image" <?php echo get_shortcode_inline_css($css_args_img); ?>>
                <div class="image-zoom image-overlay-add <?php echo implode(' ', $classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                    <a href="<?php echo get_the_permalink(); ?>">
                        <?php
                            if($back_image) flatsome_woocommerce_get_alt_product_thumbnail($image_size);
                            echo woocommerce_get_product_thumbnail($image_size);
                        ?>
                    </a>
                    <div class="overlay fill" style="background-color: rgba(255, 255, 255, 0.6)">
						<div><i class="icon-search"></i> <?php _e( 'Chi tiết', 'flatsome' ); ?></div>
					</div>
                </div>
                <div class="image-tools top right show-on-hover">
                    <?php //do_action('flatsome_product_box_tools_top'); ?>
                </div>
                <?php if($style !== 'shade' && $style !== 'overlay') { ?>
                    <div class="image-tools <?php echo flatsome_product_box_actions_class(); ?>">
                        <?php  do_action('flatsome_product_box_actions'); ?>
                    </div>
                <?php } ?>
                <?php if($out_of_stock) { ?><div class="out-of-stock-label"><?php _e( 'Out of stock', 'woocommerce' ); ?></div><?php }?>
            </div>

            <div class="box-text show-on-hover hover-slide text-left" <?php echo get_shortcode_inline_css($css_args); ?>>
                <?php
                    do_action( 'woocommerce_before_shop_loop_item_title' );

                    echo '<div class="title-wrapper">';
                    do_action( 'woocommerce_shop_loop_item_title' );
                    echo '</div>';

                    echo '<div class="price-wrapper">';
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    echo '</div>';

                    if($style == 'shade' || $style == 'overlay') {
                    echo '<div class="overlay-tools">';
                        do_action('flatsome_product_box_actions');
                    echo '</div>';
                    }

                    do_action( 'flatsome_product_box_after' );

                ?>
            </div>
        </div>
    </div>
    </div>

    <?php  
    foreach ($arrtru as $value) :
        if($count == $value ): ?>
                </div> 
                </div> 
            </div>
    <?php endif;
   
    endforeach;
?> 

