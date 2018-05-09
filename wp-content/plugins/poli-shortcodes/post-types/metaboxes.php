<?php

add_filter( 'rwmb_meta_boxes', 'swm_register_custom_posttypes_metaboxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function swm_register_custom_posttypes_metaboxes( $meta_boxes )
{
	
	// Portfolio Options

	$meta_boxes[] = array(		
		'id' => 'swm-portfolio-metabox',	
		'title' => __('Portfolio Options', '__poli-shortcodes__'),				
		'pages' => array( 'portfolio' ),		
		'context' => 'normal',		
		'priority' => 'high',
		'autosave' => true,		
		'fields' => array(	
			array(
				"name" => __('Project Type', '__poli-shortcodes__'),				
				"id" => "swm_portfolio_project_type",
				"std" => "default",
				"type" => "select",				
				"options" => array(		
					"image" => __('Image', '__poli-shortcodes__'),
					"video" => __('Video', '__poli-shortcodes__')							
				),				
			),					
			array( 
				'name' => __('Add YouTube/Vimeo Video URL', '__poli-shortcodes__'),				
				'id' => "swm_portfolio_video",
				'std' => '',			
				"type" => "text"
			)			
		)
	);

	// Testimonials Options
	
	$meta_boxes[] = array(		
		'id' => 'swm-testimonials-metabox',	
		'title' => __('Testimonials Options', '__poli-shortcodes__'),				
		'pages' => array( 'testimonials' ),		
		'context' => 'normal',		
		'priority' => 'high',
		'autosave' => true,		
		'fields' => array(	
			array( 
				'name' => __('Client Details (optional)', '__poli-shortcodes__'),	
				'desc' => __('Client designation, city or country name etc. ', '__poli-shortcodes__'),			
				'id' => "swm_client_details",
				'std' => '',			
				"type" => "text"
			),					
			array( 
				'name' => __('Website URL (optional)', '__poli-shortcodes__'),	
				'desc' => __('Client website FULL PATH URL. <br />Example: http://www.loremips.com', '__poli-shortcodes__'),
				'id' => "swm_website_url",
				'std' => '',			
				"type" => "text"
			)				
		)
	);

	// Logos Options

	$meta_boxes[] = array(		
		'id' => 'swm-logos-metabox',	
		'title' => __('Logo Options', '__poli-shortcodes__'),				
		'pages' => array( 'logos' ),		
		'context' => 'normal',		
		'priority' => 'high',
		'autosave' => true,		
		'fields' => array(	
			array( 
				'name' => __('Client Website URL (optional)', '__poli-shortcodes__'),	
				'desc' => __('Enter client website URl or leave it blank', '__poli-shortcodes__'),			
				'id' => "swm_client_logo_url",
				'std' => '',			
				"type" => "text"
			)					
		)
	);

	return $meta_boxes;
}