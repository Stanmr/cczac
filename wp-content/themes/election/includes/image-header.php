<?php

$swm_parallax_header = '';
$swm_parallax_header_bg = '';
$swm_final_meta_header_bg_images = '';
$swm_meta_header_bg_color = '';
$header_fixed_height = '';
$swm_get_queried_object_id = get_queried_object_id();

if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {		
	if ( is_shop() ) {
		$swm_get_queried_object_id = wc_get_page_id( 'shop' );
	}
}

//customizer header values
$swm_default_header_bg_color			= get_theme_mod('swm_header_bg_color','#28415f');
$swm_default_header_bg_image 			= get_theme_mod('swm_header_bg_image');
$swm_header_bg_image_event 				= get_theme_mod('swm_header_bg_image_event');
$swm_header_bg_image_search 			= get_theme_mod('swm_header_bg_image_search');
$swm_default_header_bg_repeat 			= get_theme_mod('swm_header_bg_repeat','no-repeat');
$swm_default_header_bg_position 		= get_theme_mod('swm_header_bg_position','center-top');
$swm_default_header_bg_attachment		= get_theme_mod('swm_header_bg_attachment','fixed');
$swm_default_header_bg_stretch			= get_theme_mod('swm_header_bg_stretch',0);
$swm_default_header_bg_parallax 		= get_theme_mod('swm_enable_parallax_effect',0);
$swm_default_header_bg_parallax_speed 	= get_theme_mod('swm_header_parallax_speed',2.5);
$swm_default_header_bg_height 			= get_theme_mod('swm_header_height',300);

if ( SWM_TRIBE_EVENTS_IS_ACTIVE ) {		
	if ( tribe_is_event() || tribe_is_upcoming() || tribe_is_past() || tribe_is_month() || tribe_is_day() ||  tribe_is_venue() ) {
		$swm_default_header_bg_image = empty($swm_header_bg_image_event) ? $swm_default_header_bg_image : $swm_header_bg_image_event;
	}
}

if ( SWM_TRIBE_EVENTS_PRO_IS_ACTIVE ) {
	if ( tribe_is_week() || tribe_is_map() || tribe_is_photo() ) {
		$swm_default_header_bg_image = empty($swm_header_bg_image_event) ? $swm_header_bg_image_event : $swm_default_header_bg_image;
	}
}


if ( is_search() ) {
	$swm_default_header_bg_image = empty($swm_header_bg_image_search) ? $swm_default_header_bg_image : $swm_header_bg_image_search;
}

if ( function_exists('rwmb_meta') ) {

	//page metabox values
	$swm_meta_header_bg_color	= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_bg_color', true );

	$swm_meta_header_bg_image	= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_bg_image', true );
	$swm_meta_header_bg_image_src = wp_get_attachment_image_src($swm_meta_header_bg_image,'full');
	$swm_final_meta_header_bg_images = $swm_meta_header_bg_image_src[0];

	if ( ! empty($swm_final_meta_header_bg_images) ) {				
		$swm_default_header_bg_repeat 			= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_bg_repeat', true );
		$swm_default_header_bg_position 		= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_bg_position', true );
		$swm_default_header_bg_attachment 		= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_bg_attachment', true );
		$swm_default_header_bg_stretch 			= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_bg_stretch', true );
		$swm_default_header_bg_parallax 		= get_post_meta( $swm_get_queried_object_id, 'swm_meta_enable_parallax_effect', true );
		$swm_default_header_bg_parallax_speed 	= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_parallax_speed', true );
		$swm_default_header_bg_height 			= get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_height', true );
	}

}

if (is_category() ) :
	$swm_get_query_var_cat = get_query_var('cat');
	$swm_get_cat = get_category($swm_get_query_var_cat);
	$swm_cat_header_bg = get_theme_mod($swm_get_cat->slug.'_bg_img');

	if ( $swm_cat_header_bg ) {
		$swm_default_header_bg_image = $swm_cat_header_bg;
	}

	$swm_default_header_bg_color = get_theme_mod($swm_get_cat->slug.'_bg','#ffffff');			
endif;

if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {

	if ( is_product_category() ) {

		global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$swm_woo_cat_header_bg = wp_get_attachment_url( $thumbnail_id );

		if ( $swm_woo_cat_header_bg ) {
			$swm_default_header_bg_image = $swm_woo_cat_header_bg;
		}

	}

}

//final values
$swm_final_header_bg_color = empty($swm_meta_header_bg_color) ? $swm_default_header_bg_color : $swm_meta_header_bg_color;
$swm_final_header_bg_image = empty($swm_final_meta_header_bg_images) ? $swm_default_header_bg_image : $swm_final_meta_header_bg_images;

$swm_data_bg_scrollSpeed = '';
$swm_final_header_bg_size = 'background-size: auto; ';
$swm_get_header_bg_image = '';
$swm_get_header_bg_position = '';
$swm_get_header_bg_repeat = '';
$swm_get_header_bg_attachment = '';
$swm_dataParallax = '';

if ( $swm_final_header_bg_image != '' ) {
	$swm_get_header_bg_image 		= 'background-image:url(' . $swm_final_header_bg_image . '); ';
	$swm_get_header_bg_position 	= 'background-position:' . str_replace( '-', ' ', $swm_default_header_bg_position) . '; ';
	$swm_get_header_bg_repeat 		= 'background-repeat: ' . $swm_default_header_bg_repeat . '; ';
	$swm_get_header_bg_attachment 	= 'background-attachment: ' . $swm_default_header_bg_attachment . '; ';

	if ( $swm_default_header_bg_stretch == 1 ) {
	    $swm_final_header_bg_size = 'background-size: cover;';
	    $swm_get_header_bg_attachment = '';
	    $swm_get_header_bg_repeat = '';
	}
}

if ( $swm_default_header_bg_parallax == 1 ) {
	$swm_parallax_header = "swm_parallax_on swm_full_stretch";
	$swm_data_bg_scrollSpeed = 'data-bg-scrollSpeed="' . $swm_default_header_bg_parallax_speed . '"';
	$swm_get_header_bg_attachment = '';
	$swm_final_header_bg_size = 'background-size: cover; ';
	$swm_dataParallax = 'true';
}

$swm_get_header_bg_color = 'background-color:' . $swm_final_header_bg_color . ';' ;				

$swm_final_header_style = $swm_get_header_bg_color . $swm_get_header_bg_image . $swm_get_header_bg_position . $swm_get_header_bg_repeat . $swm_get_header_bg_attachment . $swm_final_header_bg_size;

if ( $swm_final_meta_header_bg_images == '' ) {
	if ( $swm_meta_header_bg_color != '' ) {
		$swm_final_header_style = 'background-color:' . $swm_meta_header_bg_color . ';' ;
		$swm_default_header_bg_height = get_post_meta( $swm_get_queried_object_id, 'swm_meta_header_height', true );
	}
}

$swm_default_header_bg_height = preg_replace('/[^0-9]/','',$swm_default_header_bg_height);

if ( get_theme_mod('swm_disable_header_auto_height_js',0 ) == 1 ) {
	$header_fixed_height = ' height:'.$swm_default_header_bg_height.'px;max-height:'.$swm_default_header_bg_height.'px; ';
}

?>

<section class="title_header">
<div class="swm_headerImage <?php echo $swm_parallax_header; ?>" style="<?php echo $swm_final_header_style . ' ' . $header_fixed_height; ?>" <?php echo $swm_data_bg_scrollSpeed; ?> data-header-height="<?php echo $swm_default_header_bg_height; ?>" data-parallaxtest="<?php echo $swm_dataParallax; ?>"></div>

<?php

$swm_display_breadcrumbs = '';
$swm_display_pg_title = '';
$swm_meta_breadcrumbs = '';
$swm_pg_title_onoff = '';

$swm_default_breadcrumbs = get_theme_mod('swm_breadcrumbs','1');

if (function_exists('rwmb_meta')) {
	$swm_meta_breadcrumbs = get_post_meta( $swm_get_queried_object_id, 'swm_meta_breadcrumbs_onoff', true );
	$swm_pg_title_onoff = get_post_meta( $swm_get_queried_object_id, 'swm_meta_page_title_onoff', true );
}

if ( $swm_meta_breadcrumbs != '' ) {

	if ( $swm_default_breadcrumbs != 1 ||  $swm_meta_breadcrumbs != 1 ) {
		$swm_display_breadcrumbs = 'swm_hide';										
	}

} elseif ( is_front_page() || is_home() ) {
	$swm_display_breadcrumbs = 'swm_hide';
} else {
	if ( $swm_default_breadcrumbs != 1 ) {
		$swm_display_breadcrumbs = 'swm_hide';										
	}
}

if ( $swm_pg_title_onoff != '' ) {
	if ( $swm_pg_title_onoff != 1 ) {
		$swm_display_pg_title = 'swm_hide';										
	}
}

$swm_get_pg_title = swm_page_title();

?>
	<div class="title_header_wrap">								
	<div class="title_section" style="<?php echo $header_fixed_height; ?>">

		<?php if ( $swm_get_pg_title != '' ) { ?>
	    
		    <div class="title_section_wrap <?php echo $swm_display_pg_title; ?>">
			    <div class="title_section_block <?php echo $swm_display_breadcrumbs; ?>">
					<?php echo swm_breadcrumb_trail(); ?>			    
			    </div><div class="title_section_block"> 
			      	<div class="heading_h1">						      		
						<h1><?php echo $swm_get_pg_title;  ?></h1>
						<div class="heading_bg transparent_bg transparent_bg_opacity"></div>
					</div>
				</div>
		    </div>
		
		<?php } ?>

	</div>
	
	</div><div class="swm_header_border"></div>
</section>