<?php

/* ************************************************************************************** 
	Portfolio Post Type
************************************************************************************** */

add_action( 'init', 'swm_posttype_portfolio' );
if (!function_exists('swm_posttype_portfolio')) {
	function swm_posttype_portfolio() {	
		$labels = array(
			'name' => __( 'Portfolio', '__poli-shortcodes__'),
			'singular_name' => __( 'Portfolio', '__poli-shortcodes__'),
			'add_new' =>  __( 'Add New' , '__poli-shortcodes__'),
			'add_new_item' => __('Add New Portfolio', '__poli-shortcodes__'),
			'edit_item' => __('Edit Portfolio', '__poli-shortcodes__'),
			'new_item' => __('New Portfolio Item', '__poli-shortcodes__'),
			'view_item' => __('View Portfolio Item', '__poli-shortcodes__'),
			'search_items' => __('Search Portfolio Items', '__poli-shortcodes__'),
			'not_found' =>  __('No portfolio items found', '__poli-shortcodes__'),
			'not_found_in_trash' => __('No portfolio items found in Trash', '__poli-shortcodes__'),
			'parent_item_colon' => ''
		);

		$labels = apply_filters( 'swm_portfolio_labels', $labels );
		$swm_church_portfolio_slug = 'portfolios';
    	$swm_church_portfolio_slug = apply_filters( 'swm_portfolio_slug', $swm_church_portfolio_slug );
		  
		$args = array(
			'labels' => $labels,
			'public' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'rewrite' => array('slug' => $swm_church_portfolio_slug),
			'show_ui' => true, 
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,		
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail','excerpt','comments')
		); 
		  
		register_post_type(__( 'portfolio' , '__poli-shortcodes__'),$args);	
		
	}
}	
/* ------------------------------------------------------------------------------ */	

add_action( 'init', 'swm_posttype_portfolio_taxonomies', 0 );
if (!function_exists('swm_posttype_portfolio_taxonomies')) {
	function swm_posttype_portfolio_taxonomies(){
		
		register_taxonomy(__( "portfolio-categories" , '__poli-shortcodes__'), 
			array(__( "portfolio" , '__poli-shortcodes__'),), 
			array(
				"hierarchical" => true, 
				"query_var" => true, 
				"label" => __( "Portfolio Categories" , '__poli-shortcodes__'),
				"singular_label" => __( "Portfolio Categories" , '__poli-shortcodes__'),
				"rewrite" => array(
					'slug' => 'portfolio-categories', 
					'hierarchical' => true, 
					'with_front' => false )
			)); 
		
	}
}	
/* ------------------------------------------------------------------------------ */
 
add_filter("manage_edit-portfolio_columns", "swm_posttype_portfolio_edit_columns"); 
if (!function_exists('swm_posttype_portfolio_edit_columns')) {
	function swm_posttype_portfolio_edit_columns($columns){  
		$columns = array(  
			"cb" => "<input type=\"checkbox\" />",  
			"title" => __( 'Portfolio Item Title' , '__poli-shortcodes__'),			
			"Category" => __( 'Category' , '__poli-shortcodes__'),			
			"Image" => __( 'Image' , '__poli-shortcodes__'),
			'date' => __( 'Date', '__poli-shortcodes__')
		); 
		return apply_filters( 'swm_portfolio_table_titles', $columns );
	} 
}	
/* ------------------------------------------------------------------------------ */
	
add_action("manage_posts_custom_column",  "swm_posttype_portfolio_image_column");	
if (!function_exists('swm_posttype_portfolio_image_column')) {
	function swm_posttype_portfolio_image_column($column){  
		global $post;  
		switch ($column)  { 

			case 'Category':  
				echo wp_strip_all_tags( get_the_term_list($post->ID, 'portfolio-categories', '', ', ',''));  
				break;		
				
			case 'Image':  
				echo get_the_post_thumbnail($post->ID, array(80,80));  
				break;
		}  
	}
}
/* Edit "Featured Image" box text --------------------------------------------------- */

add_filter( 'gettext', 'portfolio_post_edit_change_text', 20, 3 );
if (!function_exists('portfolio_post_edit_change_text')) {
	function portfolio_post_edit_change_text( $translated_text, $text, $domain ) {
	    if( ( is_portfolio_admin_page() ) ) {
	        switch( $translated_text ) {
	        case 'Featured Image' :
	            $translated_text = __( 'Add Portfolio Image', '__poli-shortcodes__' );
	        break;
	        case 'Set Featured Image' :
	            $translated_text = __( 'Set portfolio image', '__poli-shortcodes__' );
	        break;
	        case 'Set featured image' :
	            $translated_text = __( 'Set portfolio image', '__poli-shortcodes__' );
	        break;
	        case 'Remove featured image' :
	            $translated_text = __( 'Remove portfolio image', '__poli-shortcodes__' );
	        break;
	        }
	    }
	    return $translated_text;
	}
}
if (!function_exists('is_portfolio_admin_page')) {
	function is_portfolio_admin_page() {
	    global $pagenow;

	    if( $pagenow == 'post-new.php' ) {
	        if( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'portfolio' )
	            return true;
	    }

	    if( $pagenow == 'post.php' ) {
	        if( isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) == 'portfolio' )
	            return true;
	    }
	    return false;
	}
}
if( defined( 'DOING_AJAX' ) && 'DOING_AJAX' ) {
    if( isset( $_POST['post_id'] ) && get_post_type( $_POST['post_id'] ) == 'portfolio' )
        return true;
}

