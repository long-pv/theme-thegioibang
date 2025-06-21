<?php global $product; ?>
<li>
	<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_image( 'woocommerce_gallery_thumbnail' ); ?>
		<span class="product-title"><?php echo $product->get_title(); ?></span>
	</a>
	<div class="price-wrapper">
		<?php echo do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
	</div>
</li>
