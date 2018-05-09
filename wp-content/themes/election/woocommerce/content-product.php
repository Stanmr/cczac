<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

?>
<li <?php post_class(); ?>>
	<div class="swm-featured-product-block">

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<a href="<?php the_permalink(); ?>" class="product-images">
			
			
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
			
		</a>

			<div class="swm-product-details">
			
				<h3 class="swm-product-title swm_text_color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<div class="swm-product-price-cart">

					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>

					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				
				</div>
				<div class="clear"></div>

			</div>
	</div>

	

</li>