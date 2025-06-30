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
				<img class="pattern" src="<?php echo TGB_IMG_URL . 'pt_1.png'; ?>" alt="">

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

			<div class="tgb_show_noti">
				<div class="icon">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9.5 22H14.5M10 10H14M12 10L12 16M15 15.3264C17.3649 14.2029 19 11.7924 19 9C19 5.13401 15.866 2 12 2C8.13401 2 5 5.13401 5 9C5 11.7924 6.63505 14.2029 9 15.3264V16C9 16.9319 9 17.3978 9.15224 17.7654C9.35523 18.2554 9.74458 18.6448 10.2346 18.8478C10.6022 19 11.0681 19 12 19C12.9319 19 13.3978 19 13.7654 18.8478C14.2554 18.6448 14.6448 18.2554 14.8478 17.7654C15 17.3978 15 16.9319 15 16V15.3264Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</div>
				<div class="text">
					Hiển thị hơn 100.000 sản phẩm cho từ khóa "<strong>Bảng trắng</strong>".
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer();
