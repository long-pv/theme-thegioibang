<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>
<div class="product-page-sections">
	<?php $i = 0; ?>
	<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
		<?php $i++ ?>
	<div class="product-section">
		<div class="container section-title-container title_homes title_short title_hom3 homestab<?= $i ?>">
			<h3 class="section-title section-title-center tab-title tab_s<?= $i ?>" style="padding-top: 16px;padding-left: 20px;" ><b></b>
				<span class="section-title-main"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ); ?></span><b></b></h3>
			</div>
		
	
		<div class="panel entry-content" id="tab-<?php echo esc_attr( $key ); ?>" >
			<?php
			if ( isset( $product_tab['callback'] ) ) {
				call_user_func( $product_tab['callback'], $key, $product_tab );
			}
			?>
		</div>
	</div>
	<div class="gap"></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
