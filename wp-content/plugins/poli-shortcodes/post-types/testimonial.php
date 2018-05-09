<?php

/* ************************************************************************************** 
	Testimonials Post Type
************************************************************************************** */

add_action( 'init', 'swm_posttype_testimonials' );
if (!function_exists('swm_posttype_testimonials')) {
	function swm_posttype_testimonials() {	
		$labels = array(
			'name' => __( 'Testimonials', '__poli-shortcodes__'),
			'singular_name' => __( 'Testimonial' , '__poli-shortcodes__'),
			'add_new' =>  __( 'Add New' , '__poli-shortcodes__'),
			'add_new_item' => __('Add New testimonial', '__poli-shortcodes__'),
			'edit_item' => __('Edit Testimonial', '__poli-shortcodes__'),
			'new_item' => __('New Testimonial Item', '__poli-shortcodes__'),
			'view_item' => __('View Testimonial Item', '__poli-shortcodes__'),
			'search_items' => __('Search Testimonials', '__poli-shortcodes__'),
			'not_found' =>  __('No testimonial items found', '__poli-shortcodes__'),
			'not_found_in_trash' => __('No testimonial items found in Trash', '__poli-shortcodes__'),
			'parent_item_colon' => ''
		);

		$labels = apply_filters( 'swm_testimonials_labels', $labels );
		$swm_church_testimonials_slug = 'clients-testimonials';
    	$swm_church_testimonials_slug = apply_filters( 'swm_testimonials_slug', $swm_church_testimonials_slug );
		  
		$args = array(
			'labels' => $labels,
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'rewrite' => array('slug' => $swm_church_testimonials_slug),
			'show_ui' => true, 
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,		
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail','excerpt')
		); 
		  
		register_post_type(__( 'testimonials' , '__poli-shortcodes__'),$args);	
		
	}
}
/* ------------------------------------------------------------------------------ */	

add_action( 'init', 'swm_posttype_testimonial_taxonomies', 0 );
if (!function_exists('swm_posttype_testimonial_taxonomies')) {
	function swm_posttype_testimonial_taxonomies(){
		
		register_taxonomy(__( "testimonials-categories" , '__poli-shortcodes__'), 
			array(__( "testimonials" , '__poli-shortcodes__'),), 
			array(
				"hierarchical" => true, 
				"query_var" => true, 
				"label" => __( "Categories" , '__poli-shortcodes__'),
				"singular_label" => __( "Testimonials Categories" , '__poli-shortcodes__'),
				"rewrite" => array(
					'slug' => 'testimonials-categories', 
					'hierarchical' => true, 
					'with_front' => false )
			)); 
		
	}
}
/* ------------------------------------------------------------------------------ */
 
add_filter("manage_edit-testimonials_columns", "swm_posttype_testimonials_edit_columns"); 
if (!function_exists('swm_posttype_testimonials_edit_columns')) {
	function swm_posttype_testimonials_edit_columns($columns){  
		$columns = array(  
			"cb" => "<input type=\"checkbox\" />",  
			"title" => __( 'Client Name' , '__poli-shortcodes__'),
			"Image" => __( 'Image' , '__poli-shortcodes__'),
			"client-details" => __( 'Client Details' , '__poli-shortcodes__'),	
			"Category" => __( 'Category' , '__poli-shortcodes__'),					
			"website-url" => __( 'Website URL' , '__poli-shortcodes__')
		); 
		return apply_filters( 'swm_testimonials_table_titles', $columns );
	} 
}	
/* ------------------------------------------------------------------------------ */
	
add_action("manage_posts_custom_column",  "swm_posttype_testimonials_image_column");	
if (!function_exists('swm_posttype_testimonials_image_column')) {
	function swm_posttype_testimonials_image_column($column){  
		global $post;  
		switch ($column)  {
			
			case "title":  
				echo get_the_title();  
				break;
				
			case "client-details":
				if(get_post_meta($post->ID, "swm_client_details", true)){
					echo get_post_meta($post->ID, "swm_client_details", true);
				} else {echo '---';}
				break;
				
			case "website-name":
				if(get_post_meta($post->ID, "swm_website_title", true)){
					echo get_post_meta($post->ID, "swm_website_title", true);
				} else {echo '---';}
				break;

			case 'Category':  
				echo wp_strip_all_tags( get_the_term_list($post->ID, 'testimonials-categories', '', ', ',''));  
				break;	
				
			case "website-url":
				if(get_post_meta($post->ID, "swm_website_url", true)){
					echo get_post_meta($post->ID, "swm_website_url", true);
				} else {echo '---';}
				break;
				
		}  
	}
}
/* Edit "Featured Image" box text --------------------------------------------------- */

add_filter( 'gettext', 'testimonials_post_edit_change_text', 20, 3 );
if (!function_exists('testimonials_post_edit_change_text')) {
	function testimonials_post_edit_change_text( $translated_text, $text, $domain ) {
	    if( ( is_testimonials_admin_page() ) ) {
	        switch( $translated_text ) {
	        case 'Featured Image' :
	            $translated_text = __( 'Add Client Image', '__poli-shortcodes__' );
	        break;
	        case 'Set Featured Image' :
	            $translated_text = __( 'Set client image', '__poli-shortcodes__' );
	        break;
	        case 'Set featured image' :
	            $translated_text = __( 'Set client image', '__poli-shortcodes__' );
	        break;
	        case 'Remove featured image' :
	            $translated_text = __( 'Remove client image', '__poli-shortcodes__' );
	        break;
	        }
	    }
	    return $translated_text;
	}
}

if (!function_exists('is_testimonials_admin_page')) {
	function is_testimonials_admin_page() {
	    global $pagenow;

	    if( $pagenow == 'post-new.php' ) {
	        if( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'testimonials' )
	            return true;
	    }

	    if( $pagenow == 'post.php' ) {
	        if( isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) == 'testimonials' )
	            return true;
	    }
	    return false;
	}
}
if( defined( 'DOING_AJAX' ) && 'DOING_AJAX' ) {
    if( isset( $_POST['post_id'] ) && get_post_type( $_POST['post_id'] ) == 'testimonials' )
        return true;
}