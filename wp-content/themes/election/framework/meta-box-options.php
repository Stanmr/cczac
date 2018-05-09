<?php

add_filter( 'rwmb_meta_boxes', 'swm_register_custom_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function swm_register_custom_meta_boxes( $meta_boxes )
{
	
	// Background Repeat
	$swm_background_repeat = array(
		"repeat" => esc_html__( 'Repeat', 'election' ),
		"no-repeat" => esc_html__( 'No-Repeat', 'election' ),
		"repeat-x" => esc_html__( 'Repeat-X', 'election' ),
		"repeat-y" => esc_html__( 'Repeat-Y', 'election' )		
	);

	// Background Position
	$swm_alignment = array(
		"left-top" 		=> esc_html__( 'Left Top', 'election' ),
		"left-center" 	=> esc_html__( 'Left Center', 'election' ),
		"left-bottom" 	=> esc_html__( 'Left Bottom', 'election' ),
		"right-top" 	=> esc_html__( 'Right Top', 'election' ),
		"right-center" 	=> esc_html__( 'Right Center', 'election' ),
		"right-bottom" 	=> esc_html__( 'Right Bottom', 'election' ),
		"center-top" 	=> esc_html__( 'Center Top', 'election' ),
		"center-center" => esc_html__( 'Center Center', 'election' ),
		"center-bottom" => esc_html__( 'Center Bottom', 'election' )
	);

	// Page Layout
	$swm_page_layout = array(
		"layout-sidebar-right" => esc_html__( 'Sidebar Right', 'election' ),
		"layout-sidebar-left" => esc_html__( 'Sidebar Left', 'election' ),
		"layout-full-width" => esc_html__( 'Full Width', 'election' )
	);	

	// Page Layout
	$swm_background_attachment = array(
		"scroll" => esc_html__( 'Scroll', 'election' ),
		"fixed" => esc_html__( 'Fixed', 'election' )	
	);



/* *********************************************************
	PORTFOLIO PAGE OPTIONS
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_portfolio_page_image_header',	
		'title' => esc_html__('Portfolio Page Options', 'election'),	
		'pages' => array(		
			'page'
		),
		'context' => 'normal',	
		'priority' => 'high',
		'autosave' => true,	
		'fields' => array(	
			array(
					'name' => esc_html__('Portfolio Type', 'election'),
					'desc' => esc_html__('Select Portfolio type', 'election'),
					'id' => "swm_portfolio_page_type",
					'type' => 'select',			
					'std' => 'Sortable_Portfolio_with_Hover_Text',
					'options'  => array(
						'Sortable_Portfolio' => esc_html__('Sortable Portfolio', 'election'),					
						'Classic_Portfolio' => esc_html__('Classic Portfolio', 'election'),					
					),				
				),		
			array(
				'name' => esc_html__('Portfolio Column', 'election'),
				'desc' => esc_html__('Select portfolio display column', 'election'),
				'id' => "swm_pf_display_column",
				'type' => 'select',			
				'std' => '4',
				'options'  => array(
					'2' => esc_html__('2 Column Portfolio', 'election'),
					'3' => esc_html__('3 Column Portfolio', 'election'),
					'4' => esc_html__('4 Column Portfolio', 'election'),				
				),				
			),
			array(
				'name' => esc_html__('Exclude Portfolio Categories', 'election'),
				'desc' => esc_html__('Checked categories will be excluded from page display.', 'election'),		
				'id' => "swm_exclude_pf_categories",
				'type' => 'taxonomy',			
				'options' => array(
					'taxonomy' => 'portfolio-categories',			
					'type' => 'checkbox_tree',					
					'args' => array()					
				)		
			),		
			array( 
				'name' => esc_html__('Display Portfolio Title Section', 'election'),
				'desc' => esc_html__('Enable portfolio item title and excerpt/categories section.', 'election'),
				'id' => "swm_onoff_page_title_section",
				'std' => "1",
				"type" => "checkbox",
			),
			array( 
				'name' => esc_html__('Portfolio Item Title Font Size', 'election'),
				'desc' => esc_html__('Enter portfolio title text font size ( only enter number e.g. 14  ) ', 'election'),
				'id' => "swm_pf_title_font_size",
				'std' => "14",			
				"type" => "text"
			),
			array(
				'name' => esc_html__('Portfolio Item Title Font Weight', 'election'),
				'desc' => esc_html__('Select portfolio display column', 'election'),
				'id' => "swm_pf_title_font_weight",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"normal" => esc_html__( 'Normal', 'election' ),
				    "bold" => esc_html__( 'Bold', 'election' )	
				),				
			),
			array( 
				'name' => esc_html__('Add link on Portfolio Title Text', 'election'),
				'desc' => esc_html__('Enable permalink on portfolio title text', 'election'),
				'id' => "swm_pf_item_title_link",
				'std' => "1",
				"type" => "checkbox",
			),	
			array(
				'name' => esc_html__('Display Excerpt or Category Names', 'election'),
				'desc' => esc_html__('Select portfolio sort description text type or hide it', 'election'),
				'id' => "swm_pf_display_excerpt_category",
				'type' => 'select',			
				'std' => 'Display_Expert',
				'options'  => array(
					'Display_Excerpt' => esc_html__('Display Excerpt Text', 'election'),
					'Display_Category_Names' => esc_html__('Display Category Names', 'election'),					
					'Hide_Excerpt' => esc_html__('Hide Excerpt Text or Category Names', 'election'),
				),				
			),
			array( 
				'name' => esc_html__('Portfolio Item Excerpt Font Size', 'election'),
				'desc' => esc_html__('Enter portfolio sort description text font size ( only enter number e.g. 11  ) ', 'election'),
				'id' => "swm_pf_excerpt_font_size",
				'std' => "12",			
				"type" => "text"
			),	
			array( 
				'name' => esc_html__('Display Read more link', 'election'),
				'desc' => esc_html__('Enable read more link', 'election'),
				'id' => "swm_onoff_pf_readmore",
				'std' => "1",
				"type" => "checkbox",
			),					
			array( 
				'name' => esc_html__('Display Images/Videos on Lightbox', 'election'),
				'desc' => esc_html__('Enable lightbox feature (open large image in popup). If disable then link image to portfolio single page', 'election'),
				'id' => "swm_onoff_pf_prettyphoto",
				'std' => "1",
				"type" => "checkbox",
			),
			array(
				'name' => esc_html__('Pagination Style Column', 'election'),
				'desc' => esc_html__('Select portfolio display column', 'election'),
				'id' => "swm_pf_pagination_style",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"standard" => esc_html__( 'Standard', 'election' ),
				    "next-prev" => esc_html__( 'Next - Previous', 'election' ),        
				    "infinite-scroll" => esc_html__( 'Infinite Scroll', 'election' )	
				),				
			),		
			array( 
				'name' => esc_html__('Pagination', 'election'),
				'desc' => esc_html__('Add number to display portfolio items per page e.g. 12', 'election'),
				'id' => "swm_pf_items_pagination",
				'std' => "12",			
				"type" => "text",
			)		
		)

	);


/* *********************************************************
	TESTIMONIALS PAGE
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_testimonials_page',
		'title' => esc_html__('Testimonials Page Options', 'election'),
		'pages' => array(		
			'page'
		),	
		'context' => 'normal',	
		'autosave' => true,
		'priority' => 'high',	
		'fields' => array(	
			array(
				'name'     => esc_html__('Testimonials Display Column', 'election'),
				'desc' => esc_html__('Select Testimonials Style', 'election'),
				'id'       => "swm_testimonial_column",
				'type'     => 'select',
				'my_class' => 'swm_divider_line',
				'std' => 'one_third',			
				'options'  => array(
					"1" => esc_html__('1 Column', 'election'),
					"2" => esc_html__('2 Column', 'election'),
					"3" => esc_html__('3 Column', 'election'),
					"4" => esc_html__('4 Column', 'election')
				),
			),	
			array(
				'name' => esc_html__('Pagination Style Column', 'election'),
				'desc' => esc_html__('Select portfolio display column', 'election'),
				'id' => "swm_testimonials_pagination_style",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"standard" => esc_html__( 'Standard', 'election' ),
				    "next-prev" => esc_html__( 'Next - Previous', 'election' ),        
				    "infinite-scroll" => esc_html__( 'Infinite Scroll', 'election' )	
				),				
			),					
			array(
				'name' => esc_html__('Display Testimonials per page', 'election'),
				'desc' => esc_html__('Add number to display testimonials items per page e.g. 12', 'election'),
				'id' => "swm_testimonials_pagination",
				'type' => 'text',
				'std' => '6'
			),
			array(
				'name' => esc_html__('Exclude Testimonials Categories', 'election'),
				'desc' => esc_html__('Checked categories will be excluded from page display.', 'election'),		
				'id' => "swm_exclude_testimonials_categories",
				'type' => 'taxonomy',			
				'options' => array(
					'taxonomy' => 'testimonials-categories',			
					'type' => 'checkbox_tree',					
					'args' => array()					
				)		
			),
			array( 
					'name' => esc_html__('Display Sortable Horizontal Menu', 'election'),
					'desc' => esc_html__('Enable Sortable Menu', 'election'),
					'id' => "swm_enable_testimonials_h_menu",
					'std' => "1",
					"type" => "checkbox",
				),	
		)

	);



/* *********************************************************
	ARCHIVES PAGE
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_archives_page',
		'autosave' => true,	
		'title' => esc_html__('Archives Page Options', 'election'),
		'pages' => array(		
			'page'
		),	
		'context' => 'normal',	
		'priority' => 'high',
		
		'fields' => array(	
			array(
				'name' => esc_html__('Display Latest Posts', 'election'),
				'desc' => esc_html__('Add number to display latest blog posts in the table e.g. 12', 'election'),
				'id' => "swm_archives_pagination",
				'type' => 'text',
				'std' => '12'
			),
			array( 
				'name' => esc_html__('Display Archives by Month', 'election'),
				'desc' => esc_html__('Enable archives by months list.', 'election'),
				'id' => "swm_onoff_archives_month",
				'std' => "1",
				"type" => "checkbox",
			),			
			array( 
				'name' => esc_html__('Display Archives by Categories', 'election'),
				'desc' => esc_html__('Enable archives by categories list.', 'election'),
				'id' => "swm_onoff_archives_categories",
				'std' => "1",
				"type" => "checkbox",
			)
		)

	);



/* *********************************************************
	POST OPTIONS
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm-post-meta-box',
		'title' =>  esc_html__('Post Options', 'election'),
		'pages' => array('post'),	
		'context' => 'normal',	
		'priority' => 'high',	
		'autosave' => true,	
		'fields' => array(					
			array( "name" => esc_html__('Add YouTube/Vimeo video embed or embedded code','election'),
					'desc' => esc_html__('Default embed video width - 616', 'election'),
					"id" => "swm_meta_video",
					"type" => "textarea",
					'my_class' => 'swm_divider_line',
					"std" => ''
			)
		)
	);

	$meta_boxes[] = array(		
		'id' => 'swm-page-meta-box',		
		'title' => esc_html__('Page Options', 'election'),				
		'pages' => array( 'page','post','portfolio','product','tribe_events' ),		
		'context' => 'normal',		
		'priority' => 'high',
		'autosave' => true,		
		'fields' => array(	
			array(
				"name" => esc_html__('Site Layout', 'election'),				
				"id" => "swm_meta_site_layout",
				"std" => "default",
				"type" => "select",				
				"options" => array(		
					"default" => esc_html__('Select Site Layout', 'election'),
					"wide" => esc_html__('Wide (Full Width)', 'election'),
					"boxed" => esc_html__('Boxed', 'election'),					
				),				
			),				
			array( 
				'name' => esc_html__('Breadcrumbs', 'election'),
				'desc' => esc_html__('Enable Breadcrumbs', 'election'),
				'id' => "swm_meta_breadcrumbs_onoff",
				'std' => "1",
				"type" => "checkbox",
			),
			array(
				'type' => 'heading',
				'name' => esc_html__('Page Content', 'election'),
				'id'   => "swm_page_page_content_heading",
			),
			array(
				"name" => esc_html__('Content Layout', 'election'),				
				"id" => "swm_meta_page_layout",
				"std" => "sidebar-right",
				"type" => "select",				
				"options" => $swm_page_layout,				
			),
			array( 
				'name' => esc_html__('Page Content Top Padding', 'election'),
				'desc' => esc_html__('Enter content top padding value in pixels or em( Example: 20px, 30px, 1em, 2em). Leave it empty for default value.', 'election'),		
				'id' => "swm_meta_page_content_top_padding",
				'std' => '50px',			
				"type" => "text"
			),
			array( 
				'name' => esc_html__('Page Content Bottom Padding', 'election'),				
				'desc' => esc_html__('Enter content bottom padding value in pixels or em( Example: 20px, 30px, 1em, 2em). Leave it empty for default value.', 'election'),
				'id' => "swm_meta_page_content_bottom_padding",
				'std' => '50px',			
				"type" => "text"
			),		
			
			array(
				'type' => 'heading',
				'name' => esc_html__('Page Title', 'election'),
				'id'   => "swm_page_title_heading",
			),
			array( 
				'name' => esc_html__('Page Title', 'election'),
				'desc' => esc_html__('Enable Page title', 'election'),
				'id' => "swm_meta_page_title_onoff",
				'std' => "1",
				"type" => "checkbox",
			),
			array(
				"name" => esc_html__('Page Title Color', 'election'),							
				"id" => "swm_meta_page_title_color",
				"std" => '',
				"type" => "color",				
			),
			array(
				"name" => esc_html__('Page Title Background Color', 'election'),									
				"id" => "swm_meta_page_title_bg",
				"std" => '',
				"type" => "color",				
			),
			array(
				'name' => esc_html__( 'Background Color Opacity', 'election' ),
				'id'   => "swm_meta_page_title_bg_opacity",
				'type' => 'slider',
				'std'  => '80',
				'js_options' => array(
					'min'   => 0,
					'max'   => 100,
					'step'  => 1,
				),
			),								
			array(
				'type' => 'heading',
				'name' => esc_html__('Header Style', 'election'),
				'id'   => "swm_page_header_options",
			),
			array(
				"name" => esc_html__('Header Style', 'election'),				
				"id" => "swm_meta_header_style",
				"std" => "default",
				"type" => "select",
				"options" => array(						
					"standard" => esc_html__('Standard - Title with Background', 'election'),		
					"revolution_slider" => esc_html__('Revolution Slider', 'election'),	
					"google_map" => esc_html__('Google Map', 'election')
				),				
			),
			array(
				"name" => esc_html__('Header Background Color', 'election'),
				"desc" => esc_html__('If you do not want to upload background image then add background color value', 'election'),						
				"id" => "swm_meta_header_bg_color",
				"std" => '',
				"type" => "color",				
			),
			array(
				'name' => esc_html__('Header Background Image', 'election'),
				'desc' => esc_html__('Recommended header background image size : 1920x1280', 'election'),
				'id'  => "swm_meta_header_bg_image",
				'type'  => 'image_advanced',
			),
			array(
				"name" => esc_html__('Header Background Position', 'election'),				
				"id" => "swm_meta_header_bg_position",
				"std" => "center",
				"type" => "select",
				"options" => $swm_alignment,				
			),
			array(
				"name" => esc_html__('Header Background Repeat', 'election'),				
				"id" => "swm_meta_header_bg_repeat",
				"std" => "no-repeat",
				"type" => "select",				
				"options" => $swm_background_repeat,				
			),
			array(
				"name" => esc_html__('Header Background Attachment', 'election'),				
				"id" => "swm_meta_header_bg_attachment",
				"std" => "fixed",
				"type" => "select",				
				"options" => $swm_background_attachment,				
			),	
			array( 
				'name' => esc_html__('100% Header Background Image Width', 'election'),				
				'id' => "swm_meta_header_bg_stretch",
				'std' => "0",
				"type" => "checkbox",
			),			
			array( 
				'name' => esc_html__('Parallax Scrolling', 'election'),				
				'id' => "swm_meta_enable_parallax_effect",
				'std' => "0",
				"type" => "checkbox"
			),			
			array(
				'name' => esc_html__( 'Background Image Scroll Speed', 'election' ),
				'id'   => "swm_meta_header_parallax_speed",
				'type' => 'slider',
				'std'  => '2.5',
				'js_options' => array(
					'min'   => -10.0,
					'max'   => 10.0,
					'step'  => 0.1,
				),
			),
			array( 
				'name' => esc_html__('Header Height', 'election'),				
				'id' => "swm_meta_header_height",
				'std' => 300,			
				"type" => "text",
				'desc' => esc_html__('Enter header height in number. Example: 300,500,800', 'election'),
			),			
			array( 
				'name' => esc_html__('Add Revolution Slider Shortcode', 'election'),
				'desc' => esc_html__('Add revolution slider shortcode e.g. [rev_slider revolution] You have to install revolution slider plugin and generate shortcode ', 'election'),
				'id' => "swm_meta_rev_slider_shortcode",
				'std' => "",			
				"type" => "text"
			),
			array( 
				'name' => esc_html__('Google Map Link', 'election'),
				'desc' => esc_html__( 'Video tutorial to get google map embed code : https://www.youtube.com/watch?v=HjZHkEWTCYg', 'election' ),
				'id' => "swm_header_google_map_link",
				'std' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.313975261218!2d-74.00583600840093!3d40.71110418241921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1440259795109",			
				"type" => "textarea"
			),
			array(
				'type' => 'heading',
				'name' => esc_html__('Body Background', 'election'),
				'id'   => "swm_page_background_options",
			),
			array(
				'name' => esc_html__('Body Background Image', 'election'),
				'desc' => esc_html__('Recommended body background image size : 1920x1280', 'election'),
				'id'  => "swm_meta_body_bg_image",
				'type'  => 'image_advanced',
			),
			array(
				"name" => esc_html__('Body Background Position', 'election'),				
				"id" => "swm_meta_body_bg_image_position",
				"std" => "center",
				"type" => "select",
				"options" => $swm_alignment,				
			),
			array(
				"name" => esc_html__('Body Background Repeat', 'election'),				
				"id" => "swm_meta_body_bg_image_repeat",
				"std" => "no-repeat",
				"type" => "select",				
				"options" => $swm_background_repeat,				
			),
			array(
				"name" => esc_html__('Body Background Attachment', 'election'),				
				"id" => "swm_meta_body_bg_image_attachment",
				"std" => "fixed",
				"type" => "select",				
				"options" => $swm_background_attachment,
				
			),
			array( 
				'name' => esc_html__('100% Body Background Image Width', 'election'),				
				'id' => "swm_meta_body_bg_image_stretch",
				'std' => "0",
				"type" => "checkbox",
			),	
			array(
				"name" => esc_html__('Body Background Color', 'election'),
				"desc" => esc_html__('If you do not want to upload background image then add background color value', 'election'),						
				"id" => "swm_meta_body_bg_color",
				"std" => '',
				"type" => "color",				
			)
		)
	);	

	return $meta_boxes;
}