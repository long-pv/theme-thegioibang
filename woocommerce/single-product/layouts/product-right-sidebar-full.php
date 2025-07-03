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
								?>
							</div><?php
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
							<h3 class="heading_title">Bạn cũng có thể thích…</h3>
							<div class="list_product">
								<?php
								foreach ($product_list as $product_id) :
									$product = wc_get_product($product_id);
									if (!$product) continue;

									$product_link = get_permalink($product_id);
									$product_img = get_the_post_thumbnail_url($product_id, 'medium') ?: TGB_IMG_URL . 'img2.png';
									$product_title = $product->get_name();

									if ($product->is_type('variable')) {
										$regular_price = floatval($product->get_variation_regular_price('min', true));
										$sale_price = floatval($product->get_variation_sale_price('min', true));
									} else {
										$regular_price = floatval($product->get_regular_price());
										$sale_price = floatval($product->get_sale_price());
									}

									$percent = 0;
									if ($product->is_on_sale() && $regular_price > 0 && $sale_price > 0) {
										$percent = round(100 - ($sale_price * 100 / $regular_price));
									}
								?>
									<div>
										<div class="product_item">
											<img class="icon_sale" src="<?php echo TGB_IMG_URL . 'icon_sale.png'; ?>" alt="">
											<a href="<?php echo $product_link; ?>" class="img_wrap">
												<img src="<?php echo $product_img; ?>" alt="<?php echo esc_attr($product_title); ?>">
											</a>
											<div class="content">
												<a href="<?php echo $product_link; ?>" class="d-block" data-mh="title">
													<h3 class="title line-2"><?php echo esc_html($product_title); ?></h3>
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
									</div>
								<?php
								endforeach;
							else:
								echo '<div>Không có sản phẩm upsell.</div>';
								?>
							</div>
						</div>
					<?php endif; ?>
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
			<h2>tao long xemer</h2>
			<?php
			// do_action('flatsome_before_product_sidebar');
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