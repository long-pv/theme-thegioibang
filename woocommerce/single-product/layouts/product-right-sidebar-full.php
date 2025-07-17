<div class="product-main">
	<div class="top_mpro">
		<div class="div row-small row row-tab">
			<div class="tabs_col col large-12">
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
							do_action('woocommerce_before_single_product_summary');
							?>
						</div>
						<?php if (get_field('Outstanding_Features')): ?>
							<div class=" col_galley  Outstanding_Features ">
								<div class="paddings">
									<div class="col-inner">
										<h3 class="widget-title shop-sidebars">Đặc điểm nổi bật</h3>
										<div class="content_editor">
											<?php echo get_field('Outstanding_Features') ?>
										</div>
									</div>
								</div>
							</div>
						<?php endif ?>
					</div>
					<div class="large-5 col  col-info summary entry-summary col col-fit  <?php flatsome_product_summary_classes(); ?>">
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
							do_action('woocommerce_single_product_summary');
							?>


							<div class="nt-product-icon" style="margin-top: 10px;">
								<?php
								$dvsp = get_field('dvsp');
								if ($dvsp) {
								?>
									<div class="nt-product-icon">
										<?php
										foreach ($dvsp as $key_dv) {
										?>
											<div class="icon-box featured-box icon-box-left text-left has-block tooltipstered">
												<div class="icon-box-img" style="width: 24px;">
													<div class="icon" style="width: 24px;">
														<img src="<?php echo $key_dv['icon_sp'] ?>">
													</div>
												</div>
												<div class="icon-box-text last-reset"><?php echo $key_dv['mota_sp'] ?></div>
											</div>
										<?php
										}
										?>
									</div>
								<?php
								} else {
									echo do_shortcode('[block id="19906"]');
								}
								?>
							</div>

							<?php
							global $product;
							$product_list = $product->get_upsell_ids(); // Lấy danh sách ID sản phẩm upsell
							if (!empty($product_list)):
							?>
								<div class="you_may_like">
									<h3 class="heading_title">Phụ kiện tặng kèm</h3>
									<div class="list_product">
										<?php
										foreach ($product_list as $product_id) :
											$item_sale = 0;
											echo '<div>';
											include TGB_SHORTCODE_PATH . '/inc/product_loop.php';
											echo '</div>';
										endforeach;
										?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="div row-small row row-tab">
	<div class="tabs_col col large-12">
		<?php woocommerce_output_product_data_tabs(); ?>
	</div>
</div>
</div>
</div>
<!-- <div class="product-footer container" >
	<?php //woocommerce_output_related_products(); 
	?>
</div> -->

<div class="div row-small row row-tab">
	<div class="tabs_col col large-12">
		<div id="product-sidebar">
			<?php
			// do_action('flatsome_before_product_sidebar');
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			// dynamic_sidebar('product-sidebar');
			?>
			<?php
			$product_list = wc_get_related_products(get_the_ID(), 5);

			if (!empty($product_list)):
			?>
				<section class="custom-related-products">
					<div class="heading">
						<h2 class="title">Sản phẩm liên quan</h2>
						<div class="tgb_view_all">
							<a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn_link">
								<span class="text">
									Xem thêm
								</span>
								<span class="icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M9 18L15 12L9 6" stroke="#255144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</span>
							</a>
						</div>
					</div>
					<div class="grid_row">
						<?php
						foreach ($product_list as $product_id) :
							$item_sale = 0;
							echo '<div class="col_custom">';
							include TGB_SHORTCODE_PATH . '/inc/product_loop.php';
							echo '</div>';
						endforeach;
						?>
					</div><!-- /.product_slider -->
				</section><!-- /.custom-related-products -->
			<?php
			endif;
			?>
		</div>
	</div>
</div>