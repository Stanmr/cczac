<?php

if ( ! function_exists('swm_register_sidebars')) {
	function swm_register_sidebars() {      

	register_sidebar( array(
	'name' => esc_html__('Blog Sidebar', 'election'),
	'id' => 'blog-sidebar',
	'description' => 'Sidebar for blog section',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));	

	register_sidebar( array(
	'name' => esc_html__('Portfolio Single Page Sidebar', 'election'),
	'id' => 'swm-portfolio-single-page-sidebar',
	'description' => 'Sidebar for portfolio single page',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));	
	
	register_sidebar(array(
	'name' => esc_html__('Footer Column 1', 'election'),
	'id' => 'swm-footer-1',
	'description' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => esc_html__('Footer Column 2', 'election'),
	'description' => '',
	'id' => 'swm-footer-2',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => esc_html__('Footer Column 3', 'election'),
	'description' => '',
	'id' => 'swm-footer-3',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => esc_html__('Footer Column 4', 'election'),
	'description' => '',
	'id' => 'swm-footer-4',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => esc_html__('Footer Column 5', 'election'),
	'id' => 'swm-footer-5',
	'description' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));	

	register_sidebar( array(
	'name' => esc_html__('Shop Page Sidebar', 'election'),
	'id' => 'swm-shop-page-sidebar',
	'description' => 'Sidebar for shop page',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));	

	register_sidebar( array(
	'name' => esc_html__('Product Single Page Sidebar', 'election'),
	'id' => 'product-single-page-sidebar',
	'description' => 'Sidebar for product single (product overview) page',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box">',
	'after_widget' => '<div class="clear"></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));		

	}
}

add_action( 'widgets_init', 'swm_register_sidebars' );