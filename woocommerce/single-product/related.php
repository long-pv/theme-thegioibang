<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @package   WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get Type.
$type             = get_theme_mod( 'related_products', 'slider' );
$repeater_classes = array();

if ( $type == 'hidden' ) return;
if ( $type == 'grid' ) $type = 'row';

 if ( get_theme_mod('category_force_image_height' ) ) $repeater_classes[] = 'has-equal-box-heights';
 if ( get_theme_mod('equalize_product_box' ) ) $repeater_classes[] = 'equalize-box';

$repater['type']         = $type;
$repater['columns']      = get_theme_mod( 'related_products_pr_row', 4 );
$repater['columns__md']  = get_theme_mod( 'related_products_pr_row_tablet', 3 );
$repater['columns__sm']  = get_theme_mod( 'related_products_pr_row_mobile', 2 );
$repater['class']        = implode( ' ', $repeater_classes );
$repater['slider_style'] = 'reveal';
$repater['row_spacing']  = 'small';


if ( $related_products ) : ?>

	<div class="related related-products-wrapper product-section">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'flatsome' ) );

		if ( $heading ) :
			?>
			<h3 class="product-section-title product-section-title-related pt-half pb-half">
				<?php echo esc_html( $heading ); ?>
			</h3>
		<?php endif; ?>

	<div class="related-inner">
	<?php get_flatsome_repeater_start( $repater ); ?>

		<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

		<?php endforeach; ?>

		<?php get_flatsome_repeater_end( $repater ); ?>

	</div>
	</div>

	<?php
endif;

wp_reset_postdata();
