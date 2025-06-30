<?php
get_header();

?>

<div class="container">
	<div class="grid_row">
		<div class="grid_col-lg-2">
			<?php echo do_shortcode('[tgb_sidebar_filter]'); ?>
		</div>
		<div class="grid_col-lg-10">
			<div class="tgb_top_seller">
				<div class="text_top">
					Top bán chạy liên quan tới “<strong>Bảng trắng</strong>”
				</div>

				<div class="grid_row">
					<div class="grid_col-lg-3">
						<h2 class="title">
							Top bán chạy,
							<br>
							Giá siêu ưu đãi.
						</h2>
					</div>
					<div class="grid_col-lg-9">
						<?php
						$best_selling_products = get_field('best_selling_products', 'option') ?? null;
						$product_list = $best_selling_products['product_list'] ?? [];
						?>
						<div class="list_product">
							<?php
							if (!empty($product_list)):
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
								echo '<div>Không có sản phẩm bán chạy.</div>';
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer();
