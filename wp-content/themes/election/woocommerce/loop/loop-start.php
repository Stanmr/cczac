<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

$shop_product_column = (get_option('swm_woo_shop_p_column') <> '') ? esc_attr(get_option('swm_woo_shop_p_column')) : 4;

// Reset according to sidebar or fullwidth pages
if ( empty( $woocommerce_loop['columns'] ) ) {
	if ( is_shop() || is_cart() || is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_tax( 'images_collections' ) ) {

		$woocommerce_loop['columns'] = $shop_product_column;

	}
}
?>
<ul class="products clear shop-column-<?php echo $woocommerce_loop['columns']; ?>">