<?php
// define
define('NT_DIR', WP_CONTENT_DIR . '/themes/flatsome/inc/builder/shortcodes');
define('NT_THUM', get_stylesheet_directory_uri() . '/inc/thumbnails/');

//call file
require( NT_DIR_THEM_CHILD_INC ."/ntsliderproductrow/nt_slider_product_row.php");
require( NT_DIR_THEM_CHILD_INC ."/ntprofile/ntprofile.php");
require( NT_DIR_THEM_CHILD_INC ."/breadcrumb/breadcrumb.php");
require( NT_DIR_THEM_CHILD_INC ."/ntlocation/ntlocation.php");
require( NT_DIR_THEM_CHILD_INC ."/ntpost/ntpost.php");
new ntPost();


// show Categories
if ( ! function_exists( 'flatsome_woocommerce_shop_loop_category' ) ) {
	/**
	 * Add and/or Remove Categories
	 */
	function flatsome_woocommerce_shop_loop_category() {
		?>
		<p class="category uppercase is-smaller no-text-overflow product-cat op-7">
			<?php
			$terms = get_the_terms( get_the_ID(), 'product_tag' );;

			if( count($terms) > 0 ){
				foreach($terms as $term){
					$term_id = $term->term_id; // Product tag Id
					$term_name = $term->name; // Product tag Name
					$term_slug = $term->slug; // Product tag slug
					$term_link = get_term_link( $term, 'product_tag' ); // Product tag link

					// Set the product tag names in an array
					echo '<a href="'.$term_link.'"><span>'.$term_name.'</span></a>';
				}
				
			}
			?>
		</p>
	<?php
	}
}


//To change variable price to min price
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2); 

function custom_variation_price( $price, $product ) {
	$price = '';
	$price .= wc_price($product->get_price()); 

	 return $price;
}

add_action( 'woocommerce_before_single_product', 'my_remove_variation_price' );
function my_remove_variation_price() {
  global $product;
  if ( $product->is_type( 'variable' ) ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price' );
  }
}

// To change VND to đ
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
 
function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch( $currency ) {
		case 'VND': $currency_symbol = 'đ'; break;
	}
	return $currency_symbol;
}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Mua Ngay', 'woocommerce' ); 
}

// add address title product
function nt_link_product( $woocommerce_template_loop_product_title ) { 
    // call address
	global $product;
	$id = $product->id;
	
	$shopee = get_post_meta( $id, 'shopee', true );
	$lazada = get_post_meta( $id, 'lazada', true );
	$tiki = get_post_meta( $id, 'tiki', true );
	
	if(!empty($shopee) || !empty($tiki) || !empty($lazada) ):

		
	?>
	<div class="row row-ratingplus">
		<div class="col text-left ">
			<?php
			global $woocommerce, $product;
			$average = $product->get_average_rating();
			
			?>
			<div class="woocommerce-product-rating devvn_single_rating cusstomszie">
                <span class="devvn_average_rate"><?= $average      = $product->get_average_rating(); ?></span>
                	<div class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                		<span style="width:<?= 100*$average / 5 ?>%"> 
                			<strong class="rating"><?= $average = $product->get_average_rating(); ?></strong> trên <?= $rating_count = $product->get_rating_count(); ?> dựa trên 
                			<span class="rating"><?= $review_count = $product->get_review_count(); ?></span> đánh giá
                		</span>
                	</div>                                                                   
                	<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span class="count"><?= $review_count = $product->get_review_count(); ?></span>)</a>
                	<?php 
			 $units_sold = get_post_meta( $product->get_id(), 'total_sales', true );
 				
			?>
			<!-- | <span class="sold"><?= $units_sold ?> đã bán</span> | 
						<span class="link-product"> -->
				<!-- <li><span>Xem Sản Phẩm Tại</span></li> -->
				
				| 
				<?php if(!empty($shopee)): ?>
					<span class="shopee"> <a href="<?php echo $shopee; ?>" target="_blank"> <img src="<?= get_stylesheet_directory_uri() ?>/images/shopee.png" alt=""></a> </span>
				<?php endif; ?>
				
				<?php if(!empty($lazada)): ?>
					<span class="lazada"> <a href="<?php echo $lazada; ?>" target="_blank"> <img src="<?= get_stylesheet_directory_uri() ?>/images/lazada.png" alt=""></a> </span>
				<?php endif; ?>
				
				<?php if(!empty($tiki)): ?>
					<span class="tiki"> <a href="<?php echo $tiki; ?>" target="_blank"> <img src="<?= get_stylesheet_directory_uri() ?>/images/tiki.png" alt=""></a> </span>
				<?php endif; ?>
				
			</span>
            </div>
		</div>
		
	</div>
	
	
	<?php
	endif;
}
add_action( 'woocommerce_single_product_summary', 'nt_link_product' , 10 ); 

/*
* Author: Le Van Toan - https://levantoan.com
* Đoạn code thu gọn nội dung bao gồm cả nút xem thêm và thu gọn lại sau khi đã click vào xem thêm
*/
add_action('wp_footer','devvn_readmore_flatsome');
function devvn_readmore_flatsome(){
    ?>
    <style>
        .single-product div#tab-description {
            overflow: hidden;
            position: relative;
            padding-bottom: 25px;
        }
        .single-product .tab-panels div#tab-description.panel:not(.active) {
            height: 0 !important;
        }
        .devvn_readmore_flatsome {
            text-align: center;
            cursor: pointer;
            position: absolute;
            z-index: 10;
            bottom: 0;
            width: 100%;
            left: 0;
            background: #fff;
        }
        .devvn_readmore_flatsome:before {
            height: 55px;
            margin-top: -45px;
            content: "";
            background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
            background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
            background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff00', endColorstr='#ffffff',GradientType=0 );
            display: block;
        }
        .devvn_readmore_flatsome a {
            color: #fff;
            background: #fe7200 !important;
            display: block;
            font-size: 20px;
            padding: 5px;
            text-transform: capitalize;
            font-weight: 700;
        }
        .devvn_readmore_flatsome a:after {
            content: '';
            width: 0;
            right: 0;
            border-top: 6px solid #fff;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            display: inline-block;
            vertical-align: middle;
            margin: -2px 0 0 5px;
        }
        .devvn_readmore_flatsome_less a:after {
            border-top: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #fff;
        }
        .devvn_readmore_flatsome_less:before {
            display: none;
        }
    </style>
    <script>
        (function($){
            $(document).ready(function(){
                $(window).on('load', function(){
                    if($('.single-product div#tab-description').length > 0){
                        var wrap = $('.single-product div#tab-description');
                        var current_height = wrap.height();
                        var your_height = 818;
                        if(current_height > your_height){
                            wrap.css('height', your_height+'px');
                            wrap.append(function(){
                                return '<div class="devvn_readmore_flatsome devvn_readmore_flatsome_more"><a title="Xem thêm" href="javascript:void(0);">Xem thêm</a></div>';
                            });
                            wrap.append(function(){
                                return '<div class="devvn_readmore_flatsome devvn_readmore_flatsome_less" style="display: none;"><a title="Xem thêm" href="javascript:void(0);">Thu gọn</a></div>';
                            });
                            $('body').on('click','.devvn_readmore_flatsome_more', function(){
                                wrap.removeAttr('style');
                                $('body .devvn_readmore_flatsome_more').hide();
                                $('body .devvn_readmore_flatsome_less').show();
                            });
                            $('body').on('click','.devvn_readmore_flatsome_less', function(){
                                wrap.css('height', your_height+'px');
                                $('body .devvn_readmore_flatsome_less').hide();
                                $('body .devvn_readmore_flatsome_more').show();
                            });
                        }
                    }
                });
            })
        })(jQuery)
    </script>
    <?php
}

// show cross sell in single product
add_action('flatsome_before_product_sidebar', 'show_cross_sell_in_single_product', 30);
function show_cross_sell_in_single_product() {
    $crosssells = get_post_meta( get_the_ID(), '_crosssell_ids',true);

    if(empty($crosssells)){
        return;
    }
    
    $args = array( 
        'post_type' => 'product', 
        'posts_per_page' => -1, 
        'post__in' => $crosssells 
        );
    $products = new WP_Query( $args );
    if( $products->have_posts() ) : ?>
        <aside class="widget cross-sells">
            <h3 class="widget-title" >Sản phẩm liên quan</h3>
            <div class="wiget">
            <div class="row large-columns-5 medium-columns-3 small-columns-2 row-small slider row-slider slider-nav-reveal slider-nav-push flickity-enabled" data-flickity-options="{&quot;imagesLoaded&quot;: true, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: true,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: true,&quot;pageDots&quot;: false, &quot;rightToLeft&quot;: false, &quot;autoPlay&quot; : false}" tabindex="0">

                <?php
                while ( $products->have_posts() ) : $products->the_post();?>
				
					<div class="product-small col">
						<div class="col-inner">
						<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
						<div class="product-small box <?php echo flatsome_product_box_class(); ?>">
							<div class="box-image">
								<div class="<?php echo flatsome_product_box_image_class(); ?>">
									<a href="<?php echo get_the_permalink(); ?>">
										<?php
											/**
											 *
											 * @hooked woocommerce_get_alt_product_thumbnail - 11
											 * @hooked woocommerce_template_loop_product_thumbnail - 10
											 */
											do_action( 'flatsome_woocommerce_shop_loop_images' );
										?>
									</a>
								</div>
								<div class="image-tools is-small top right show-on-hover">
									<?php do_action( 'flatsome_product_box_tools_top' ); ?>
								</div>
								<div class="image-tools is-small hide-for-small bottom left show-on-hover">
									<?php do_action( 'flatsome_product_box_tools_bottom' ); ?>
								</div>
								<div class="image-tools <?php echo flatsome_product_box_actions_class(); ?>">
									<?php do_action( 'flatsome_product_box_actions' ); ?>
								</div>
								<?php if ( $out_of_stock ) { ?><div class="out-of-stock-label"><?php _e( 'Out of stock', 'woocommerce' ); ?></div><?php } ?>
							</div>

							<div class="box-text <?php echo flatsome_product_box_text_class(); ?>">
								<?php
									do_action( 'woocommerce_before_shop_loop_item_title' );

									echo '<div class="title-wrapper">';
									do_action( 'woocommerce_shop_loop_item_title' );
									echo '</div>';


									echo '<div class="price-wrapper">';
									do_action( 'woocommerce_after_shop_loop_item_title' );
									echo '</div>';

									do_action( 'flatsome_product_box_after' );

								?>
							</div>
						</div>
						<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>
						</div>
					</div>

				<?php
				endwhile; // end of the loop.
                ?>
            </div>
            </div>
        </aside>
    <?php
    endif;

    wp_reset_postdata();
}

// chang text add to cart
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text( $text ) {
	return __( 'Thêm vào giỏ' );
}

/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
	$tabs['description']['title'] = __( 'Mô Tả Sản Phẩm' );		// Rename the description tab

	return $tabs;

}




// liên hệ nhân viên tư vấn check out 

/*
 * Tùy chỉnh hiển thị thông tin chuyển khoản trong woocommerce
 * Author: levantoan.com
 */
add_filter('woocommerce_bacs_accounts', '__return_false');
 
add_action( 'woocommerce_email_before_order_table', 'devvn_email_instructions', 10, 3 );
function devvn_email_instructions( $order, $sent_to_admin, $plain_text = false ) {
 
    if ( ! $sent_to_admin && 'bacs' === $order->get_payment_method() && $order->has_status( 'on-hold' ) ) {
        devvn_bank_details( $order->get_id() );
    }
 
}
 
add_action( 'woocommerce_thankyou_bacs', 'devvn_thankyou_page' );
function devvn_thankyou_page($order_id){
    devvn_bank_details($order_id);
}
 
function devvn_bank_details( $order_id = '' ) {
    $bacs_accounts = get_option('woocommerce_bacs_accounts');
    if ( ! empty( $bacs_accounts ) ) {
        ob_start();
        echo '<table style=" border: 1px solid #ddd; border-collapse: collapse; width: 100%; margin-bottom:25px;">';
        ?>
        <tr>
            <td colspan="2" style="border: 1px solid #eaeaea;padding: 6px 10px; color: #000; font-size: 18px;"><strong>Thông tin chuyển khoản</strong></td>
        </tr>
        <?php
        foreach ( $bacs_accounts as $bacs_account ) {
            $bacs_account = (object) $bacs_account;
            $account_name = $bacs_account->account_name;
            $bank_name = $bacs_account->bank_name;
            $stk = $bacs_account->account_number;
            $icon = $bacs_account->iban;
            ?>
            <tr>
                <td style="width: 200px;border: 1px solid #eaeaea;padding: 10px 15px;"><?php if($icon):?><img src="<?php echo $icon;?>" alt=""/><?php endif;?></td>
                <td style="border: 1px solid #eaeaea;padding: 6px 10px; line-height: 25px;">
                    <strong>STK:</strong> <?php echo $stk;?><br>
                    <strong>Chủ tài khoản:</strong> <?php echo $account_name;?><br>
                    <strong>Chi Nhánh:</strong> <?php echo $bank_name;?><br>
                    <strong>Nội dung chuyển khoản:</strong> <span class="red" style="color: #016b64;font-weight: bold">DH<?php echo $order_id;?></span>
                </td>
            </tr>
            <?php
        }
        echo '</table>';
        echo ob_get_clean();;
    }
 
}




// 

// sp blog 1
function create_sanpham_blog() {
    ob_start();   
    $product_blog = get_field('sanphamin');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();

    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                        <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog', 'create_sanpham_blog');
// san pham blog 2
function create_sanpham_blog2() {
    ob_start();   
    $product_blog = get_field('sanphamin_2');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );

    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                             <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog2', 'create_sanpham_blog2');

// 3
function create_sanpham_blog3() {
    ob_start();   
    $product_blog = get_field('sanphamin_3');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog3', 'create_sanpham_blog3');

// 4
function create_sanpham_blog4() {
    ob_start();   
    $product_blog = get_field('sanphamin_4');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog4', 'create_sanpham_blog4');
//5
function create_sanpham_blog5() {
    ob_start();   
    $product_blog = get_field('sanphamin_5');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog5', 'create_sanpham_blog5');
//6 
function create_sanpham_blog6() {
    ob_start();   
    $product_blog = get_field('sanphamin_6');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                             <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog6', 'create_sanpham_blog6');
//7 
function create_sanpham_blog7() {
    ob_start();   
    $product_blog = get_field('sanphamin_7');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span>
                            </span>                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog7', 'create_sanpham_blog7');
//8
function create_sanpham_blog8() {
    ob_start();   
    $product_blog = get_field('sanphamin_8');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                                        <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog8', 'create_sanpham_blog8');
//9
function create_sanpham_blog9() {
    ob_start();   
    $product_blog = get_field('sanphamin_9');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                                        <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog9', 'create_sanpham_blog9');
//10
function create_sanpham_blog10() {
    ob_start();   
    $product_blog = get_field('sanphamin_10');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span>
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog10', 'create_sanpham_blog10');
//11
function create_sanpham_blog11() {
    ob_start();   
    $product_blog = get_field('sanphamin_11');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                                        <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog11', 'create_sanpham_blog11');
//12
function create_sanpham_blog12() {
    ob_start();   
    $product_blog = get_field('sanphamin_12');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>                            <span class="woocommerce-Price-amount amount">
                                <?php echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span>
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog12', 'create_sanpham_blog12');
//13
function create_sanpham_blog13() {
    ob_start();   
    $product_blog = get_field('sanphamin_13');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog13', 'create_sanpham_blog13');
//14
function create_sanpham_blog14() {
    ob_start();   
    $product_blog = get_field('sanphamin_14');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog14', 'create_sanpham_blog14');
//15
function create_sanpham_blog15() {
    ob_start();   
    $product_blog = get_field('sanphamin_15');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog15', 'create_sanpham_blog15');
//16
function create_sanpham_blog16() {
    ob_start();   
    $product_blog = get_field('sanphamin_16');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog16', 'create_sanpham_blog16');
//17
function create_sanpham_blog17() {
    ob_start();   
    $product_blog = get_field('sanphamin_17');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog17', 'create_sanpham_blog17');
//18
function create_sanpham_blog18() {
    ob_start();   
    $product_blog = get_field('sanphamin_18');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog18', 'create_sanpham_blog18');
//19
function create_sanpham_blog19() {
    ob_start();   
    $product_blog = get_field('sanphamin_19');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                            <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog19', 'create_sanpham_blog19');
//20
function create_sanpham_blog20() {
    ob_start();   
    $product_blog = get_field('sanphamin_20');
    $product_id = $product_blog->ID;
    $product = wc_get_product( $product_id );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id(  $product_id ), 'full' );
    $average = $product->get_average_rating();
 
    ?>
        <div class="row sanpham-inblog">
            <div class="col large-5 thumbnail">
                <div class="box-image">
                     <a href="<?= $permalink = $product->get_permalink(); ?>">
                        <img src="<?= $image[0] ?>" alt=""> 
                    </a>
                </div>
            </div>
            <div class="col large-7 content">
               <div class="cat_item graybackground">
                <div class="name w-100">
                    <a class="cat_link strong" href="<?= $permalink = $product->get_permalink(); ?>"><?= get_the_title( $product_id ); ?> </a>
                </div>
                <div class="woocommerce-product-ratings devvn_single_rating cusstomszie">
                    <span class="star-rating" role="img" aria-label="Được xếp hạng <?= $average      = $product->get_average_rating(); ?> sao">
                        <span style="width:<?= 100*$average / 5 ?>%">  </span>
                    </span>
                </div>
                <div class="price d-none d-md-block <?= $stock_price ?>"> 
                   
                        <?php echo $product->get_sku();?> 
                        <div class="nostock w-100">
                            <?php if($product->is_in_stock()){
                                echo __('Còn hàng','woocommerce');
                            }
                            //change text "Out of Stock' to 'SOLD OUT'
                            if(!$product->is_in_stock()) {
                                echo  '<span style="color:red" class="emty">'.$availability['availability']=__('Hết hàng','woocommerce').'</span>';
                                    
                            }
                        ?>   
                        </div>
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                             <span class="woocommerce-Price-amount amount">
                                <?php if ($product->get_price() > 1 ){
                                    echo  number_format($product->get_price()); ?> <span class="woocommerce-Price-currencySymbol"> đ</span> <?php
                                }else{
                                    ?>
                                        <span class="woocommerce-Price-amount amount"> Liên hệ
                                            <span class="woocommerce-Price-currencySymbol"> </span>
                                        </span>

                                    <?php
                                } ?>                               
                            </span>
                            <?php
                        }else{
                            ?>
                            <span class="woocommerce-Price-amount amount"> Liên hệ
                                <span class="woocommerce-Price-currencySymbol"> </span>
                            </span>
                            <?php
                        }
                    ?>
                        <div class="motadacdiem">
                            <?php 
                                $Outstanding_Features = get_field('Outstanding_Features',  $product_id);
                                if ( $Outstanding_Features) {
                                    echo $Outstanding_Features;
                                }
                             ?>
                        </div>
                </div>
                <div class="addtocart d-none d-md-block">
                    <?php 
                        if($product->is_in_stock()){
                            ?>
                                <a href="?add-to-cart=<?= $product_id ?>" rel="nofollow" data-product_id="<?= $product_id ?>" 
                                    class="more ajax_add_to_cart more_enable add_to_cart_button buy_now_url button alt wc-variation-selection-needed">
                                        Mua hàng ngay
                                </a>

                            <?php
                        }else{                          
                        }
                    ?>
                     <a href="<?= $product->get_permalink(); ?>" class="button viewmore">Xem chi tiết</a>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>

    <?php

    $list_post = ob_get_contents();
    ob_end_clean();
    return $list_post;   
}
add_shortcode('sanpham_blog20', 'create_sanpham_blog20');