<div class="product-main">
	<div class="top_mpro">
		<div class="row row-collapse row_bg_top ">
			<div class="large-7 col col_galley">
			
					<div class="product-gallery">
						<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
					<?php
					/**
					 * woocommerce_before_single_product_summary hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
					</div>
					<?php if (get_field('Outstanding_Features')): ?>
						<div class=" col_galley  Outstanding_Features ">
							<div class="paddings">
								<div class="col-inner">
								
										<h3 class="widget-title shop-sidebars">Đặc điểm nổi bật</h3>
										<?php echo get_field('Outstanding_Features') ?>
								
									
								</div>
							</div>
						</div>
					<?php endif ?>
			</div>
			<div class="large-5 col  col-info summary entry-summary col col-fit  <?php flatsome_product_summary_classes();?>">
					<div class="product-info">
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
					</div>
				<div class=" col-info upsells_products ">
				<div class="paddings">
					<?php 
						global $product;
						if ( $product->get_upsell_ids() ){
							?>
							<div class="widget widget-upsell">
								<?php
								$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'flatsome' ) );

								if ( $heading ) :
									?>
									<h3 class="widget-title shop-sidebar">
										<span><?php echo esc_html( $heading ); ?></span>
										<div class="is-divider small"></div>
									</h3>
								<?php endif; ?>
								<!-- Upsell List style -->
								<div class="row product_list_widget devvn-row-slider">
									<?php
										$upsells = $product->get_upsells();
										$upsell_ids = $product->get_upsell_ids();

										if (!empty($upsell_ids)) :
										    foreach ($upsell_ids as $upsell) :
										        $upsell_product = wc_get_product($upsell);
										        if ($upsell_product) :
										            $upsell_product_name = $upsell_product->get_name();
										            $upsell_product_slug = $upsell_product->get_slug();
										            $upsell_image_id = $upsell_product->get_image_id();
										            $upsell_product_image = wp_get_attachment_image_src($upsell_image_id);
										            $_product = wc_get_product($upsell_product);
										?>

										            <div class="col large-4 small-6 col_prd">
										                <a href="/<?= $upsell_product_slug ?>" title="<?= $upsell_product_name ?>">
										                    <img width="100" height="100" src="<?= $upsell_product_image[0] ?>" class="attachment-woocommerce_gallery_thumbnail size-woocommerce_gallery_thumbnail" alt="<?= $upsell_product_name ?>" loading="lazy">
										                    <span class="product-title"><?= $upsell_product_name ?></span>
										                </a>
										                <div class="price-wrapper">
										                    <span class="price">
										                        <span class="woocommerce-Price-amount amount">
										                            <bdi><?= number_format($_product->get_price(), 0, '', ','); ?><span class="woocommerce-Price-currencySymbol">đ</span></bdi>
										                        </span>
										                    </span>
										                </div>
										            </div>

										<?php
										        endif;
										    endforeach;
										endif;
										?>

								</div>
							</div>

							<?php
						}
					?>
					
					<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>

					<script>
					(function ($) {
					  $(document).ready(function () {
					    $('.devvn-row-slider').each(function () {
					      $(this).find('style[scope="scope"]').remove();
					      $(this).flickity({
					        cellAlign: 'left',
					        contain: true,
					        groupCells: 1,
					        prevNextButtons: true,
					        pageDots: true,
					        wrapAround: true,
					        autoPlay: false,
					      });
					    });
					  });
					})(jQuery);
					</script>   
				</div>	
			</div>
			
			<div class="nt-product-icon" style="margin-top: 10px;">
				<?php
					$dvsp = get_field('dvsp');
					if ($dvsp) {
						?><div class="nt-product-icon"><?php
						foreach ($dvsp as $key_dv) {
							?>
							<div class="icon-box featured-box icon-box-left text-left has-block tooltipstered">
								<div class="icon-box-img" style="width: 60px">
									<div class="icon">
										<div class="icon-inner" style="color:rgb(0, 89, 97);">
											<img src="<?php echo $key_dv['icon_sp'] ?>">
										</div>
									</div>
								</div>
								<div class="icon-box-text last-reset"><?php echo $key_dv['mota_sp'] ?></div>
							</div>
							<?php
						}
						?></div><?php
					}else{
						echo do_shortcode('[block id="19906"]'); 
					}
					
				?>
			</div>
				
			</div>
		</div>


		<div class="div row-small row row-tab">

			<div class="tabs_col col large-12">
				<?php  woocommerce_output_product_data_tabs(); ?>
				
			</div>


		</div>	
	</div>
</div>
<!-- <div class="product-footer container" >
	<?php //woocommerce_output_related_products(); ?>
</div> -->

<div class="tabs_col container">
	<div class="col-inner">
		<div id="product-sidebar">
			<?php
			do_action('flatsome_before_product_sidebar');
			/**
							 * woocommerce_sidebar hook
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
			dynamic_sidebar('product-sidebar');
			?>
		</div>

	</div>
</div>
