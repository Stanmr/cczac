<?php

// Theme Image Sizes for different sections	

// get image height from theme options
$swm_img_pt_2col 			= get_theme_mod('swm_img_pt_2col','310');
$swm_img_pt_3col 			= get_theme_mod('swm_img_pt_3col','250');
$swm_img_pt_4col 			= get_theme_mod('swm_img_pt_4col','250');
$swm_img_pt_blog_featured 	= get_theme_mod('swm_img_pt_blog_featured','400');
$swm_img_pt_blog_gallery 	= get_theme_mod('swm_img_pt_blog_gallery','400');
$swm_img_pt_blog_grid_featured 	= get_theme_mod('swm_img_pt_blog_grid_featured','335');
$swm_img_pt_blog_grid_gallery 	= get_theme_mod('swm_img_pt_blog_grid_gallery','335');
$swm_img_pt_blog_fullwidth_featured 	= get_theme_mod('swm_img_pt_blog_fullwidth_featured','500');

add_image_size('portfolio-2', 			540, $swm_img_pt_2col, true);						// portfolio 2 column image
add_image_size('portfolio-3', 			401, $swm_img_pt_3col, true);						// portfolio 3 column image
add_image_size('portfolio-4', 			401, $swm_img_pt_4col, true);						// portfolio 4 column image
add_image_size('blog-post', 			800, $swm_img_pt_blog_featured, true);				// blog post standard and image 
add_image_size('blog-gallery', 			800, $swm_img_pt_blog_gallery, true); 				// blog post gallery image
add_image_size('blog-grid-post', 		540, $swm_img_pt_blog_grid_featured, true);			// blog post grid standard and image 
add_image_size('blog-fullwidth-post', 	1100, $swm_img_pt_blog_fullwidth_featured, true);	// blog post fullwidth standard and image 

add_image_size('recent-post', 514, 342, true); 		// recent posts full image 2, 3 column
add_image_size('recent-post-tiny', 75, 75, true); 	// recent posts sidebar widget tiny image
add_image_size('testimonial', 48, 48, true);		// testimonials page client image
add_image_size('logos', 152,107, true);				// logo slider image