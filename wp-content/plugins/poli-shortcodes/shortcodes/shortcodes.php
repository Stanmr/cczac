<?php

/* ************************************************************************************** 
	IMAGE SIZE
************************************************************************************** */

add_image_size('recent-work-widget', 125, 125, true); 	// recent posts sidebar widget tiny image

/* ************************************************************************************** 
	DISPLAY SHORTCODES IN SIDEBAR, TEXT FIELDS, COMMENTS ETC.
************************************************************************************** */

add_filter( 'comment_text', 'shortcode_unautop');
add_filter( 'comment_text', 'do_shortcode' );

add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode' );

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

add_filter( 'term_description', 'shortcode_unautop');
add_filter( 'term_description', 'do_shortcode' );

/* ************************************************************************************** 
     DISABLE WORDPRESS AUTOMATIC FORMATTING ON POSTS
************************************************************************************** */
if (!function_exists('swm_sc_autop_fix')) {
	function swm_sc_autop_fix($content) {   
	    $array = array (
	        '<p>[' => '[',      
	        ']</p>' => ']',       
	        ']<br />' => ']'
	    );

	    $content = strtr($content, $array);

	    return $content;
	}
}
add_filter('the_content', 'swm_sc_autop_fix');


/* ************************************************************************************** 
     HEADINGS
************************************************************************************** */

if (!function_exists('swm_headings')) {
	function swm_headings($atts, $content = null, $heading) {
		return '<'.$heading.'>' . do_shortcode($content) . '</'.$heading.'>';
	}

	$swm_headings_tags = array("h1","h2","h3","h4","h5","h6");

	foreach ($swm_headings_tags as $swm_headings_tag) {
		add_shortcode($swm_headings_tag, 'swm_headings');
	}
	
}

/* ************************************************************************************** 
     COLUMNS
************************************************************************************** */

if (!function_exists('swm_column')) {
	function swm_column($atts, $content = null, $column) {		

		extract( shortcode_atts( array (		
			'position' => '',			
			'animation_style' => 'none'			
		), $atts ) );

		$first = '';
		$animation_class = '';

		if (isset($atts[0]) && trim($atts[0]) == 'first') { 
			$first = 'first';
		}

		if ( $position == 'first') {
			$first = 'first';
		}
		
		if ( $animation_style != 'none') {
			$animation_class = 'swm_element_visible '.$animation_style.' ';
		}

		return '<div class="swm_column '.$column.' '.$first.' '.$animation_class.'">' . do_shortcode($content) . '</div>';
	}

	$swm_column_array = array("swm_one_full","swm_one_half","swm_one_third","swm_one_fourth","swm_one_fifth","swm_one_sixth","swm_two_third","swm_three_fourth","swm_four_fifth","swm_five_sixth");

	foreach ($swm_column_array as $swm_column_name) {
		add_shortcode($swm_column_name, 'swm_column');
	}

	$swm_column_array = array(
		"swm_one_full" 		=> "one_full",
		"swm_one_half"		=> "one_half",
		"swm_one_third"		=> "one_third",
		"swm_one_fourth"	=> "one_fourth",
		"swm_one_fifth"		=> "one_fifth",
		"swm_one_sixth" 	=> "one_sixth",
		"swm_two_third"		=> "two_third",
		"swm_three_fourth" 	=> "three_fourth",
		"swm_four_fifth" 	=> "four_fifth",
		"swm_five_sixth" 	=> "five_sixth",
	);

	foreach ($swm_column_array as $swm_column_name => $column) {
		add_shortcode($column, 'swm_column');		
	}

}

/* ************************************************************************************** 
     OTHER HTML ELEMENTS
************************************************************************************** */

if (!function_exists('swm_html_elements')) {
	function swm_html_elements($atts, $content = null, $heading) {
		return '<'.$heading.'>' . do_shortcode($content) . '</'.$heading.'>';
	}

	$swm_general_tags = array("p","div","span","sub","sup","small");

	foreach ($swm_general_tags as $swm_general_tag) {
		add_shortcode($swm_general_tag, 'swm_html_elements');
	}

}

/* ************************************************************************************** 
     COLOR
************************************************************************************** */

if (!function_exists('swm_span_color')) {
	function swm_span_color($atts, $content = null, $color) {
		return '<span style="color:'.str_replace('swm_', '', $color).'">' . do_shortcode($content) . '</span>';
	}	
	add_shortcode('swm_red', 'swm_span_color');
	add_shortcode('swm_green', 'swm_span_color');
	add_shortcode('swm_white', 'swm_span_color');
	add_shortcode('swm_pink', 'swm_span_color');
	add_shortcode('swm_yellow', 'swm_span_color');
	add_shortcode('swm_blue', 'swm_span_color');
	add_shortcode('swm_orange', 'swm_span_color');
	add_shortcode('swm_brown', 'swm_span_color');
	add_shortcode('swm_black', 'swm_span_color');
}

/* ************************************************************************************** 
     ALIGNMENT
************************************************************************************** */

if (!function_exists('swm_alignments')) {
	function swm_alignments($atts, $content = null, $align) {
		return '<div align="'.$align.'">' . do_shortcode($content) . '</div>';
	}	
	add_shortcode('left', 'swm_alignments');
	add_shortcode('center', 'swm_alignments');
	add_shortcode('right', 'swm_alignments');
}

/* ************************************************************************************** 
     FONT
************************************************************************************** */

if (!function_exists('swm_font')) {
	function swm_font($atts, $content = null, $column) {		

		extract( shortcode_atts( array (		
			'size' => '14px',
			'color' => '#777777',
			'weight' => 'normal',			
			'line_height' => '20px'			
		), $atts ) );

		$style = "";

		$output = '';
		$output .=  '<span style="font-size:'.$size.'px; color:'.$color.'; font-weight:'.$weight.'; line-height:'.$line_height.'px;">';
		$output .=  do_shortcode($content);
		$output .=  '</span>';
	  
		return $output; 


	}	
	add_shortcode('swm_font', 'swm_font');
	
}

/* ************************************************************************************** 
    PRE-DEFINDED TEXT
************************************************************************************** */

if (!function_exists('swm_pretext')) {
	function swm_pretext($atts, $content = null, $heading) {

		return '<'.$heading.'>' . do_shortcode(str_replace('<br />', '', $content)) . '</'.$heading.'>';
	}
	add_shortcode('pre', 'swm_pretext');
	add_shortcode('code', 'swm_pretext');
}


/* ************************************************************************************** 
   HORIZONTAL TAB
************************************************************************************** */

if (!function_exists('swm_horizontal_tab')) {
	function swm_horizontal_tab( $atts, $content = null ) {			
		
		$output = '';		
		$output .=  '<div class="swm_horizontal_menu">';
		$output .=  '<ul>';		
		$output .=  do_shortcode($content);
		$output .=  '</ul>';	
		$output .=  '</div>';	
		$output .=  '<div class="clear"></div>';
	  
		return $output;   
	}

	add_shortcode( 'horizontal_tab', 'swm_horizontal_tab' );
}

if (!function_exists('swm_menu_tab')) {
	function swm_menu_tab( $atts, $content = null ) {
		extract( shortcode_atts( array (		
			'link' => '',
			'text' => 'tab',
			'target' => '_self',
			'active'=> ''
		), $atts ) );

		$active_class = '';

		if ($active == 'true' || $active == 'yes') {
			
			$active_class = ' class="current_page_item"';
		}		
			
		$output = '';

		$output .= '<li'.$active_class.'><a href="'.$link.'" target="'.$target.'" class="swm_text_color">'.$text.'</a></li>';
		
		return $output;
		
	}

	add_shortcode( 'menu_tab', 'swm_menu_tab' );
}

/* **************************************************************************************
   IMAGE SLIDER
************************************************************************************** */

if (!function_exists('swm_image_slider')) {
	function swm_image_slider( $atts, $content = null ) {	
		extract( shortcode_atts( array (		
			'auto_play' => 'true',
			'slide_interval' => 5000,
			'animation_type' => 'fade',
			'bullet_navigation' => 'true',
			'arrow_navigation' => 'true'	
						
		), $atts ) );			
		
		$output = '';		
		$output .=  '<div class="swm_slider_box">';
		$output .=  '<div class="swm_image_slider flexslider" data-slideAnimation="'.$animation_type.'" data-autoSlide="'.$auto_play.'" data-autoSlideInterval="'.$slide_interval.'" data-bulletNavigation="'.$bullet_navigation.'" data-arrowNavigation="'.$arrow_navigation.'" >';
		$output .=  '<ul class="slides">';		
		$output .=  do_shortcode($content);
		$output .=  '</ul>';	
		$output .=  '</div>';	
		$output .=  '</div>';	

	  
		return $output;   
	}

	add_shortcode( 'swm_image_slider', 'swm_image_slider' );

}

if (!function_exists('swm_image_slide')) {
	function swm_image_slide( $atts, $content = null ) {
		extract( shortcode_atts( array (		
			'src' => '',
			'target' => '_self',
			'link' => '#',
			'alt' => ''		
		), $atts ) );

		$output = '';
		
		$output .= '<li><a href="'.$link.'" target="'.$target.'"><img src="'.$src.'" alt="'.$alt.'" /></a></li>';
		
		return $output;	
	}

	add_shortcode( 'swm_image_slide', 'swm_image_slide' );
}

/* ************************************************************************************** 
  RECENT POSTS FULL
************************************************************************************** */

if (!function_exists('swm_recent_posts_full')) {
	function swm_recent_posts_full( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'column' => '4',
			'post_limit' => 3,	
			'read_more_text' => '',
			'date_comments' => 'true',	
			'desc_limit' => '80',
			'cat'  => '',
			'target' => '_self',
			'grid_type' => 'fitRows',
			'exclude' => ''
		), $atts ) );
	  
		$p_margin = '';
		$output = '';		

		$args = array(
			'category__not_in' => $exclude,
			'cat'  => $cat,
			'order'	=> 'desc',
			'orderby'	=> 'date',			
			'terms'    => array( 'link' ),
			'posts_per_page' => $post_limit,
			'paged' => get_query_var( 'paged' ),
			'tax_query' => array(
	        array(
	          'taxonomy' => 'post_format',
	          'field'    => 'slug',
	          'terms'    => array( 'post-format-link','post-format-quote','post-format-aside' ),
	          'operator' => 'NOT IN'
	        )
	    )
		);

		$blog_query = new WP_Query($args);
		global $id; 

		$output = '';

		$output .= '<div class="recent_posts_full" >	';
		$output .= '<div id="swm-item-entries" class="swm_blog_grid_sort swm_row" data-grid="'.$grid_type.'">';

			while ($blog_query->have_posts()) : $blog_query->the_post();		

				$format = get_post_format();

				if ( $format != 'quote' && $format != 'aside' ) { 

					$swm_featured_image = wp_get_attachment_url(get_post_thumbnail_id($id));	
					$post_id = get_the_ID();		
					$meta_video = get_post_meta($post_id, 'swm_meta_video', true);				

					$slider_content1 = '';
					$slider_content2 = '';
					$post_content = '';	

					$slider_content1 .= '<div class="swm_column'.$column.' left swm_blog_grid swm_blog_grid_isotope isotope-item">';
					$slider_content1 .=  '<div class="swm_column_gap">';
					$slider_content1 .=  '<div class="swm_slider_box">';
					$slider_content1 .=  '<div class="swm_recent_posts flexslider">';
					$slider_content1 .=  '<ul class="slides">';	
					$slider_content2 .=  '</ul>';	
					$slider_content2 .=  '</div>';	
					$slider_content2 .=  '</div>';

					
					$post_content .= '<div class="swm-arrow-up arrow-grid"><span></span></div>';
					$post_content .= '<div class="sc_post_full_content">';
					$post_content .= '<div class="text">';			
					$post_content .= '<div class="swm_post_title"><a href="' . get_permalink() . '" target="'.$target.'">' . get_the_title() . '</a></div>';

					if ( $date_comments == 'true' )	{
					
						$post_content .= '<div class="post_meta">';
						$post_content .= '<div class="grid_date"><span><i class="fa fa-clock-o"></i>'.get_the_date('d F, Y').'</span><span><i class="fa fa-comment-o"></i><a href="' . get_permalink() . '" target="'.$target.'">'.get_comments_number($post_id).' '.__('Comments', '__poli-shortcodes__').'</a></span></div>';
						$post_content .= '<div class="clear"></div>';
						$post_content .= '</div>';

					}					
					
					$truncate = get_the_excerpt();
					$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
					$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);
					$truncate = strip_tags($truncate);
					$truncate = substr($truncate, 0, strrpos(substr($truncate, 0, $desc_limit), ' ')); 
					
					$post_content .= '<p>';
					$post_content .= $truncate;
					$post_content .= ' </p>';

					if ($read_more_text) {

						$post_content .= '<p class="recent_post_read_more_link"><a href="' . get_permalink() . '" target="'.$target.'">'.$read_more_text.' <i class="fa fa-angle-right"></i></a></p>';

					}

					$post_content .= '</div>';

					$post_featured_img = get_the_post_thumbnail($post_id, 'recent-post');

					if ($format == 'video' && $meta_video != '') {
						
						if ( $post_featured_img != '' ) {
							$output .= $slider_content1.		
									'<li>
										<a class="swm-video-post-img" href="' . get_permalink() . '" target="'.$target.'">'
											.$post_featured_img.'
										</a>
									</li>'
									.$slider_content2.
										$post_content.
										'<div class="clear"></div>
									</div>
								</div>';
						} else {
							$output .= $slider_content1.'
									<li class="fitVids">'				
										.stripslashes(htmlspecialchars_decode($meta_video)).		
									'</li>'
									.$slider_content2.
										$post_content.
										'<div class="clear"></div>
									</div>
								</div>';
						}

					} else {				

						$output .= $slider_content1.		
								'<li>
									<a class="swm-video-post-img" href="' . get_permalink() . '" target="'.$target.'">'
										.$post_featured_img.'
									</a>
								</li>'
								.$slider_content2.
									$post_content.
									'<div class="clear"></div>
								</div>
							</div>';
					}

					$output .= '</div>';			

				} //end if		

			endwhile;

			wp_reset_query();	

		
		$output .= '<div class="clear"></div>';
		$output .= '</div>';	
		$output .= '</div>';
		
		return $output;   
	}

	add_shortcode( 'recent_posts_full', 'swm_recent_posts_full' );
}

/* ************************************************************************************** 
  RECENT POSTS TINY
************************************************************************************** */

if (!function_exists('swm_recent_posts_tiny')) {
	function swm_recent_posts_tiny( $atts ) {
		extract( shortcode_atts( array( 
			'cat'  => '',
			'exclude' => '',
			'target' => '_self',
			'post_limit' => 2
		 ), $atts ) );

		$output = '';

		$output .= '<div class="recent_posts_tiny">';
		$output .= '<ul>';		

		$q = new WP_Query( 'posts_per_page='.$post_limit.'&cat='.$cat.'&exclude='.$exclude );
		
		while ( $q->have_posts() ) { 
		$q->the_post();	
			
			$format = get_post_format(); 

			$rcp_icon = '';

			switch ( $format ) {

				case 'link': $rcp_icon = 'link';
					break;
				case 'aside': $rcp_icon = 'pencil';
					break;
				case 'image': $rcp_icon = 'camera';
					break;
				case 'gallery': $rcp_icon = 'th-large';
					break;
				case 'video': $rcp_icon = 'video-camera';
					break;
				case 'quote': $rcp_icon = 'quote-left';
					break;
				case 'audio': $rcp_icon = 'volume-up';
					break;
				case 'status': $rcp_icon = 'info-circle';
					break;
				default: $rcp_icon = 'pencil';
					break;
			}

			$output .= '<li class="swm_text_color">';
				
			if(has_post_thumbnail()) { 
				$output .= '<a href="'.get_permalink().'" title="'.esc_attr(strip_tags(get_the_title())).'" class="tiny_img" target="'.$target.'">';
				$output .= get_the_post_thumbnail(get_the_ID(), 'recent-post-tiny');
				$output .= '</a>';					
			} else { 
				$output .= '<a href="'.get_permalink().'" title="'.esc_attr(strip_tags(get_the_title())).'" class="recent_posts_tiny_icon" target="'.$target.'">'; 
				$output .= '<i class="fa fa-'.$rcp_icon.'"></i>';
				$output .= '</a>';					
			}
			$output .= '<div class="recent_posts_tiny_content">';				
			$output .= '<div class="recent_posts_tiny_title"><a href="'.get_permalink().'" target="'.$target.'">'.get_the_title().'</a></div>';			
			$output .= '<p>'.get_the_time('F j, Y - g:i a').'</p>';
			$output .= '</div>';
			
			$output .= '<div class="clear"></div>';

			$output .= '</li>';					

		}	

		wp_reset_query();	

		$output .= '</ul>';
		$output .= '</div>';
		$output .= '<div class="clear"></div>';

		return $output;
	}

	add_shortcode( 'recent_posts_tiny', 'swm_recent_posts_tiny' );
}

/* ************************************************************************************** 
  RECENT POSTS SQUARE
************************************************************************************** */

if (!function_exists('swm_recent_posts_square')) {
	function swm_recent_posts_square( $atts ) {
		extract( shortcode_atts( array( 
			'cat'  => '',
			'exclude' => '',
			'post_limit' => 2, 	
			'target' => '_self',			
			'desc_limit' => '55' ), $atts ) );

		$q = new WP_Query( 'posts_per_page='.$post_limit.'&cat='.$cat.'&exclude='.$exclude );

		$output = '';	

		$output .= '<div class="recent_posts_square_posts">';
		$output .= '<ul>';	

		while ( $q->have_posts() ) { 
			$q->the_post();
			
			$output .= '<li>';		
			$output .= '<div class="recent_posts_square_date"><a href="' . get_permalink() . '" target="'.$target.'">' . get_the_date('d');		
			$output .= '<span class="d_month">' . get_the_date('M').'</span>';
			$output .= '<span class="d_year">' . get_the_date('Y').'</span></a>';
			$output .= '</div>';
			
			$output .= '<div class="recent_posts_square_content">';
			$output .= '<div class="recent_posts_square_title"><a href="' . get_permalink() . '" target="'.$target.'">' . get_the_title() . '</a></div>';
			$output .= '<p>';			

			$truncate = get_the_excerpt();
			$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
			$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);
			$truncate = strip_tags($truncate);
			$truncate = substr($truncate, 0, strrpos(substr($truncate, 0, $desc_limit), ' ')); 
			
			$output .= $truncate;			

			$output .='</p>';	

			$output .= '<div class="grid_date">';			
			$output .= '<span><i class="fa fa-user"></i><a href="'.get_author_posts_url( get_the_author_meta( 'ID' )).'">'.get_the_author().'</a></span>';
			$output .= '<span><i class="fa fa-comment-o"></i><a href="' . get_permalink() . '" target="'.$target.'">'.get_comments_number(get_the_ID()).' '.__('Comments', '__poli-shortcodes__').'</a></span>';
			$output .= '</div>';

			$output .= '</div>';
			$output .= '<div class="clear"></div>';
			
			$output .= '</li>';		
		}
		
		wp_reset_query();	
		
		$output .= '</ul>';
		$output .= '</div>';	 

		return $output;
	}

	add_shortcode( 'recent_posts_square', 'swm_recent_posts_square' );
}

/* ************************************************************************************** 
  UPCOMING EVENTS
************************************************************************************** */

if (!function_exists('swm_upcoming_events')) {
	function swm_upcoming_events( $atts ) {
		extract( shortcode_atts( array( 		
			'post_limit' => 2, 	
			'target' => '_self',
			'event_type' => 'list',			
			'desc_limit' => '55' ), $atts ) );

		$output = '';	

		if ( class_exists( 'Tribe__Events__Main' ) ) { 			

			global $wp_query, $tribe_ecp, $post;			

			if ( function_exists( 'tribe_get_events' ) ) {

				$args = array(
					'eventDisplay'   => $event_type,
					'posts_per_page' => $post_limit,
				);

				if ( ! empty( $category ) ) {
					$args['tax_query'] = array(
						array(
							'taxonomy'         => TribeEvents::TAXONOMY,
							'terms'            => $category,
							'field'            => 'ID',
							'include_children' => false
						)
					);
				}

				$posts = tribe_get_events( $args );
			}		

			$output .= '<div class="recent_posts_square_posts">';
			$output .= '<ul>';	

			if ( $posts ) {
				/* Display list of events. */
				
				foreach( $posts as $post ) :
					setup_postdata( $post );

					$date_day 		= tribe_get_start_date(null, false, 'd');    
					$date_month		= tribe_get_start_date(null, false, 'M');
					$date_year		= tribe_get_start_date(null, false, 'Y');
					$date_time		= tribe_get_start_date(null, false, 'l - g:i a');

            		$venue_name 	= tribe_get_venue();
				
					$output .= '<li>';		
					$output .= '<div class="recent_posts_square_date"><a href="' . tribe_get_event_link() . '" target="'.$target.'">' . $date_day;		
					$output .= '<span class="d_month">' . $date_month .'</span>';
					$output .= '<span class="d_year">' . $date_year .'</span></a>';
					$output .= '</div>';
					
					$output .= '<div class="recent_posts_square_content">';
					$output .= '<div class="recent_posts_square_title"><a href="' . tribe_get_event_link() . '" target="'.$target.'">' . get_the_title() . '</a></div>';
					$output .= '<p>';			

					$truncate = get_the_excerpt();
					$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
					$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);
					$truncate = strip_tags($truncate);
					$truncate = substr($truncate, 0, strrpos(substr($truncate, 0, $desc_limit), ' ')); 
					
					$output .= $truncate;			

					$output .='</p>';	

					$output .= '<div class="grid_date uc_events">';			
					$output .= '<span><i class="fa fa-clock-o"></i><a href="'.tribe_get_event_link().'">'.$date_time.'</a></span>';
					$output .= '<span><i class="fa fa-map-marker"></i><a href="' . tribe_get_event_link() . '" target="'.$target.'">'.$venue_name.'</a></span>';
					$output .= '</div>';

					$output .= '</div>';
					$output .= '<div class="clear"></div>';
					
					$output .= '</li>';		
				endforeach;
				
			} else {
				$output .= '<p>' . __( 'There are no upcoming events at this time.', '__poli-shortcodes__' ) . '</p>';
			}			
			
			$output .= '</ul>';
			$output .= '</div>';	
			
		} else {

			$output .= __( 'Please install and activate <a href="https://wordpress.org/plugins/the-events-calendar/" target="_blank">The Event Calendar</a>" plugin to display Upcoming Events', '__poli-shortcodes__' );
		}

		wp_reset_query();	

		return $output;
	}

	add_shortcode( 'swm_upcoming_events', 'swm_upcoming_events' );
}


/* ************************************************************************************** 
	TESTIMONIALS
************************************************************************************** */

if (!function_exists('swm_testimonials')) {
	function swm_testimonials( $atts, $content = null ) {

		extract( shortcode_atts( array (		
			'columns' => '3',
			'display_testimonials' => '3',
			'target' => '_self',
			'client_img' => 'true',					
			'exclude' => ''
		), $atts ) );	

		
		$display_column = '';	

		global $paged;		
		$count = 1;	

		$exclude_cat = array_map('intval', explode(',', $exclude));

		$args = array(
			'post_type' => 'testimonials',
			'orderby'=>'menu_order',
			'order'     => 'ASC',
			'posts_per_page' => $display_testimonials,			
			'paged' => $paged,
			'type' => get_query_var('type'),
			'tax_query' => array(
				array(
					'taxonomy' => 'testimonials-categories',
					'field' => 'id',
					'terms' => $exclude_cat,
					'operator' => 'NOT IN',
					)
			) // end of tax_query				      	 	
		);

		$query = new WP_Query( $args );	

		$output = '';

		$output .= '<div class="swm_row testimonials_wrapper testimonials_sort">';	

		while ($query->have_posts()) : $query->the_post();					
						
			$post_id = get_the_ID();
			$swm_website_url = get_post_meta($post_id, 'swm_website_url', TRUE); 
			$swm_featured_image = wp_get_attachment_url(get_post_thumbnail_id($post_id));
			$swm_client_details = get_post_meta($post_id, 'swm_client_details', TRUE); 	

			$output .= '<div class="swm_column'.$columns.' testimonials_isotope swm_testimonials_block">';
			$output .= '<div class="swm_column_gap">';
			$output .= '<div class="testimonial_box_wrapper">';
			$output .= '<div class="testimonial_box">';
			$output .= '<p>'.get_the_content().'</p>';
			$output .= '</div>';	
			$output .= '</div>';
			$output .= '</div>';	

			$output .= '<div class="client_details">';				

			if ( $swm_featured_image && $client_img == 'true' ) {
		
				$output .= '<div class="client_img_link">';
				$output .= '<span class="client_image">'.get_the_post_thumbnail($post_id, 'testimonial').'</span>';

				if ($swm_website_url) {				
					$output .= '<span class="icon_url"><a href="'.$swm_website_url.'" title="" target="'.$target.'"><i class="fa fa-link"></i></a></span>';
				}
				$output .= '</div>';
			}				

			$output .= '<div class="client_name_position">';
			$output .= '<h5>'.get_the_title().'</h5>';

			if ($swm_client_details) {
				$output .= '<span>'.$swm_client_details.'</span>'; 
			}

			$output .= '</div>';			
			$output .= '<div class="clear"></div>';
			$output .= '</div>';			
			
			$output .= '</div>';
			
			$count++; 
			
		endwhile; wp_reset_query();
			
		$output .= '</div>';

		return $output;   
		
	}
	add_shortcode( 'swm_testimonials', 'swm_testimonials' );
}

/* ************************************************************************************** 
	TESTIMONIALS SLIDER
************************************************************************************** */

if (!function_exists('swm_testimonials_slider')) {
	function swm_testimonials_slider( $atts, $content = null ) {

		extract( shortcode_atts( array (		
			'slide_limit' => '3',
			'client_img' => 'true',		
			'slide_interval' => '7000',
			'slideshow_speed' => '500',	
			'target' => '_self',			
			'animation_type' => 'fade'
		), $atts ) );	

		$output = '';

		$output .= '<div class="testimonials-bx-slider-wrap">';
		$output .= '<div class="testimonials-bx-slider_two" data-animationType="'.$animation_type.'" data-slideshowSpeed="'.$slideshow_speed.'" data-slideshowInterval="'.$slide_interval.'"  >';	
		
		$count 		=	1;
		$itemlimit 	=	-1;		
		$pageid 	= 	get_the_ID();							
		
		$args = array(
			'post_type' => 'testimonials',
			'orderby'=>'date',
			'order' => 'DESC',			
			'posts_per_page' => $slide_limit,
			'type' => get_query_var('type')					      	 	
			);

		$query = new WP_Query( $args );
			
		while ($query->have_posts()) : $query->the_post();					
				
			$post_id = get_the_ID();
			$client_name = get_the_title();
			$swm_website_url = get_post_meta($post_id, 'swm_website_url', TRUE); 
			$swm_featured_image = wp_get_attachment_url(get_post_thumbnail_id($post_id));
			$swm_client_details = get_post_meta($post_id, 'swm_client_details', TRUE);		

			$output .= '<div class="testimonial_box_spacer swm_testimonials_block">';

			$output .= '<div class="testimonial_box">';
			$output .= '<p>'.get_the_excerpt().'</p>';				
			$output .= '</div>';	
			
			$output .= '<div class="client_details">';		

			if ( $swm_featured_image && $client_img == 'true' ) {
		
				$output .= '<div class="client_img_link">';
				$output .= '<span class="client_image">'.get_the_post_thumbnail($post_id, 'testimonial').'</span>';

				if ($swm_website_url) {				
					$output .= '<span class="icon_url"><a href="'.$swm_website_url.'" title="" target="'.$target.'"><i class="fa fa-link"></i></a></span>';
				}
				$output .= '</div>';
			}				

			$output .= '<div class="client_name_position">';
			$output .= '<h5>'.$client_name.'</h5>';

			if ($swm_client_details) {
				$output .= '<span>'.$swm_client_details.'</span>'; 
			}

			$output .= '</div>';			
			$output .= '<div class="clear"></div>';
			$output .= '</div>';

			$output .= '</div>';			

			$count++; 				
		endwhile; wp_reset_query();

		$output .= '</div>';		
		$output .= '<div class="clear"></div>';		

		$output .= '</div>';

		return $output;   
		
	}
	add_shortcode( 'swm_testimonials_slider', 'swm_testimonials_slider' );
}

/* ************************************************************************************** 
   VIDEO
************************************************************************************** */

if (!function_exists('swm_video')) {
	function swm_video($atts, $content = null) {
	   extract(shortcode_atts(array(     
	      "source" => '',
	      "width" => '608',
	      "height" => '347'
	      
	   ), $atts));
	   return '<div class="fitVids video_shortcode"><iframe width="'.$width.'" height="'.$height.'" src="'.$source.'" frameborder="0" allowfullscreen webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
	}
	add_shortcode("swm_video", "swm_video");
}

/* ************************************************************************************** 
	SUPPORT TEAM
************************************************************************************** */

if (!function_exists('swm_supportteam')) {
	function swm_supportteam( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'image_src' => '',
			'name' => '',		
			'position' => '',
			'email' => '',
			'target' => '_self',
			'phone' => ''	
		), $atts ) );

		$output = '';
			
		$output = '<div class="support_team">';
		$output .= '<div><img src="'.$image_src.'" alt="" /></div>';		
		$output .= '<p class="st_name"><strong>'.$name.'</strong></p>';
		$output .= '<p class="st_position">'.$position.'</p>';
		

		if ($email != '') { $output .= '<p class="st_email"><i class="fa fa-envelope-o"></i><a href="mailto:'.$email.'" target="'.$target.'" class="swm_text_color">'.$email.'</a></p>'; }

		if ($phone != '') { $output .= '<p class="st_phone"><i class="fa fa-phone"></i>'.$phone.'</p>'; }

		$output .= '<div class="clear"></div>';
		$output .= '</div>';
	  
		return $output;   
	}

	add_shortcode( 'support_team', 'swm_supportteam' );
}



/* ************************************************************************************** 
	TOOLTIPS
************************************************************************************** */

if (!function_exists('swm_tooltips')) {
	function swm_tooltips( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'position' => 'tipUp',		
			'tooltip_text' => 'tooltip text here'	
		), $atts ) );
			
		$output = '';	
		$output .=  ' <a class="'.$position.'" href="#" title="'.$tooltip_text.'">';		
		$output .=  do_shortcode($content);
		$output .=  '</a>';	
	  
		return $output;   
	}

	add_shortcode( 'swm_tooltip', 'swm_tooltips' );
}

/* ************************************************************************************** 
    MAP
************************************************************************************** */

if (!function_exists('swm_google_map')) {
	function swm_google_map($atts, $content = null) {
	   extract(shortcode_atts(array(     
	      "height" => '',
	      "src" => ''
	   ), $atts));
	   return '<p class="swm_google_map"><iframe style="width:100%" width="" height="'.$height.'" src="'.$src.'&amp;iwloc=near&amp;output=embed"></iframe></p><div class="clear"></div>';
	}
	add_shortcode("google_map", "swm_google_map");
}

/* ************************************************************************************** 
   SOCIAL MEDIA
************************************************************************************** */

if (!function_exists('swm_social_media')) {
	function swm_social_media( $atts, $content = null ) {	
	  extract( shortcode_atts( array (		
			'size' => ''		
		), $atts ) );
		
		
		$output = '';   
		$output .=  '<div class="sm_icons">';		
		$output .=  '<ul>';
		$output .=  do_shortcode($content);	
		$output .=  '</ul>';
		$output .=  '<div class="clear"></div>'; 
		$output .=  '</div>'; 
	  
		return $output;   
	}

	add_shortcode( 'social_media_icons', 'swm_social_media' );
}

if (!function_exists('swm_social_media_sc')) {
	function swm_social_media_sc( $atts, $content = null, $media ) {
		
		extract( shortcode_atts( array (		
			'link' => '',
			'target' => '_self',
			'title' => ''
		), $atts ) );

		$patterns = array();
		$patterns[0] = '/fa-/';
		$patterns[1] = '/-square/';
		$patterns[2] = '/-circle/';
		$patterns[3] = '/-alt/';		

		$new_media = ucwords(preg_replace($patterns, '', $media));		
		
		if ($link != '') {
	  
			$output = ''; 	
			$output .=  '<li>';
			$output .=  '<a href="'.$link.'" class="tipUp" title="'.$new_media.'" target="'.$target.'"><i class="fa '.$media.'"></i></a>';	
			$output .=  '</li>';
		  
			return $output; 

		}
	}

	$fa_media_icons = array("fa-adn","fa-android","fa-apple","fa-behance","fa-behance-square","fa-bitbucket","fa-bitbucket-square","fa-bitcoin","fa-btc","fa-codepen","fa-css3","fa-delicious","fa-deviantart","fa-digg","fa-dribbble","fa-dropbox","fa-drupal","fa-empire","fa-facebook","fa-facebook-square","fa-flickr","fa-foursquare","fa-ge","fa-git","fa-git-square","fa-github","fa-github-alt","fa-github-square","fa-gittip","fa-google","fa-google-plus","fa-google-plus-square","fa-hacker-news","fa-html5","fa-instagram","fa-joomla","fa-jsfiddle","fa-linkedin","fa-linkedin-square","fa-linux","fa-maxcdn","fa-openid","fa-pagelines","fa-pied-piper","fa-pied-piper-alt","fa-pied-piper-square","fa-pinterest","fa-pinterest-square","fa-qq","fa-ra","fa-rebel","fa-reddit","fa-reddit-square","fa-renren","fa-share-alt","fa-share-alt-square","fa-skype","fa-slack","fa-soundcloud","fa-spotify","fa-stack-exchange","fa-stack-overflow","fa-steam","fa-steam-square","fa-stumbleupon","fa-stumbleupon-circle","fa-tencent-weibo","fa-trello","fa-tumblr","fa-tumblr-square","fa-twitter","fa-twitter-square","fa-vimeo-square","fa-vine","fa-vk","fa-wechat","fa-weibo","fa-weixin","fa-windows","fa-wordpress","fa-xing","fa-xing-square","fa-yahoo","fa-youtube","fa-youtube-play","fa-youtube-square");

	foreach ($fa_media_icons as $fa_media_icon) {
		add_shortcode( $fa_media_icon, 'swm_social_media_sc' );
	}	
	
}

/* ************************************************************************************** 
  TEAM MEMBER
************************************************************************************** */

if (!function_exists('swm_team_member')) {
	function swm_team_member( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'image_src' => '',
			'alt' => '',
			'name' => 'John Doe',
			'position' => 'Director',			
			'column' => 'swm_one_third',
			'column_position' => 'other'
			
		), $atts ) );

		$client_info = '<div class="member_name">'.$name.'<span>'.$position.'</span></div>';	
			
		$output = '';

		$output .= '<div class="swm_team_members">';
		$output .= '<div class="swm_column '.$column.' '.$column_position.'">';
		
		$output .= '<div class="tm_img">';
		$output .= '<img src="'.$image_src.'" alt="'.$alt.'">';
		$output .= '<div class="clear"></div>';
		$output .= '</div>';				
		$output .= '<div class="tm_box_content">';
		$output .= '<div class="team-arrow-up"></div>';
		
		$output .= '<div class="member_name">'.$name.'<span>'.$position.'</span></div>';
		$output .= '<div class="tm_toggle">';		
		$output .= '<div class="tm_box_sub_content">';
		$output .=  do_shortcode($content);	
		$output .= '</div>';
		$output .= '</div>	';	

		$output .= '</div>';
		
		$output .= '</div>';
		$output .= '</div>';
	  
		return $output;   
	}

	add_shortcode( 'team_member', 'swm_team_member' );
}

/* ************************************************************************************** 
  	IMAGE FRAME WITH ALIGNMENT
************************************************************************************** */

if (!function_exists('swm_image_frames')) {
	function swm_image_frames($atts, $content=null) {	
		
		extract( shortcode_atts( array (			
			'align' => '',
			'link' => '',			
			'src' => '',
			'alt' => '',
			'title' => '',
			'target' => '_self'
		), $atts ) );
		
		$output  = '';		
		
		if ( isset($align) && $align == "center" ) {
			$output .= '<div class="center">';
		}

		$output .= '<div class="image_lightbox image_'.$align.'">';

		$output .= '<img alt="'.$alt.'" src="'.$src.'" class="" />';
		
		if ( isset($link)  && $link != "" ) {
			
			$output .= '<div class="img_overlay">';
			$output .= '<a href="'.$link.'" title="'.$title.'" target="'.$target.'" >';	
			$output .= '<i class="fa fa-expand"></i>';	
			$output .= '</a></div>';
		}
		
		if ( isset($align) && $align == "center" ) {
			$output .= '</div>';	
		}

		$output .= '</div>';
		
		return $output;
	}

	add_shortcode( 'swm_image', 'swm_image_frames' );
}

/* ************************************************************************************** 
 	PROMOTION BOX
************************************************************************************** */

if (!function_exists('swm_promotion_box')) {
	function swm_promotion_box( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'button_link' => '#',
			'button_text' => '',
			'target' => '_self',
			'sub_text' => '',
			'border' => 'true',
			'sub_text_color' => '#888888',
			'sub_text_size' => '13px',
			'title_text_size' => '22px',
			'title_text_color' => '#333333'
		), $atts ) );
	  
		$p_margin = '';
		$output = '';	
		$p_text = '';
		$p_border = '';

		if ($sub_text == '') { $p_margin = 'style="margin-top:8px;"'; }
		if ($button_text == '') { $p_text = 'p_text'; }
		if ($border == 'false' ) { $p_border = 'p_border'; }
		
		$output .= '<div class="clear"></div>';	
		$output .= '<div class="swm_promotion_box '.$p_border.'">';
		$output .= '<div class="left '.$p_text.'">';
		$output .= '<div class="title_text" '.$p_margin.' style="font-size:'.$title_text_size.'px; color:'.$title_text_color.';">' . do_shortcode($content).'<div class="sub_title" style="color:'.$sub_text_color.'; font-size:'.$sub_text_size.'px;">'.$sub_text.'</div></div>';	
		$output .= '</div>';	

		if ( $button_text != '' ) {
			$output .= '<div class="right">';
			$output .= '<a href="'.$button_link.'" class="swm_button large square skin_color" target="'.$target.'">'.$button_text.'</a>';			
			$output .= '</div>';
		}	


		$output .= '<div class="clear"></div>';
		$output .= '</div>';	
		
		return $output;   
	}

	add_shortcode( 'swm_promotion_box', 'swm_promotion_box' );
}

/* ************************************************************************************** 
   PRICING TABLES
************************************************************************************** */

if (!function_exists('swm_pricing_table')) {
	function swm_pricing_table( $atts, $content = null ) {
		extract( shortcode_atts( array (		
			'column' => '4',
			'table_position' => 'middle',
			'popular_plan' => 'false',
			'title' => 'Table Title',		
			'price' => '$99',
			'button_background' => '#575757',
			'button_text_color' => '#fff',
			'price_sub_text' => 'per month',
			'button_size' => 'medium',
			'button_shape' => 'square',
			'button_link' => '#',
			'target' => '_self',
			'button_text' => 'Join Now!'
		), $atts ) );
	  
		$output = '';
		$plan_type = '';
		$position = '';
		$btn_text_shadow = '';

		if ( $button_background == "#fff" || $button_background == "#FFF" || $button_background == "#ffffff" || $button_background == "#FFFFFF" ) {
			$btn_text_shadow = "text-shadow:none;";
		}

		if ( $column == '2' ) { $display_column = 'pt_2';	}
		if ( $column == '3' ) { $display_column = 'pt_3';	}
		if ( $column == '4' ) { $display_column = 'pt_4';	}
		if ( $table_position == 'first' ) { $position = 'border_left';	}
		if ( $table_position == 'last' ) { $position = 'border_right';	}
		if ( $popular_plan == 'true' ) { 
			$plan_type = 'special_plan';	
			$button_size = 'large';
			$button_color = '';
			$skin_color = 'skin_color';

		}else {
			$button_color = 'style="background:'.$button_background.'; color:'.$button_text_color.';'.$btn_text_shadow.'"';
			$skin_color = '';
		}

		$output .=  '<div class="swm_pricing_table '.$plan_type.' '.$position.' '.$display_column.'">';
		$output .=  '<div class="pricing_box">';
		$output .=  '<div class="pricing_title">';
		$output .=  '<div class="title_text">'.$title.'</div>';					
		$output .=  '</div>';

		$output .=  '<div class="plan_price">';
		$output .=  '<span>'.$price.'<sub>'.$price_sub_text.'</sub></span>';
		$output .=  '</div>';

		$output .=  '<div class="pricing_content">';
		$output .=  do_shortcode($content);	
		$output .=  '</div>';

		$output .=  '<div class="pricing_button">';
		$output .=  '<a href="'.$button_link.'" class="swm_button round '.$button_shape.' '.$button_size.' '.$skin_color.'" '.$button_color.' target="'.$target.'">'.$button_text.'</a>';
		$output .=  '</div>';

		$output .=  '</div>';
		$output .=  '</div>';
		
		return $output;   
	}

	add_shortcode( 'pricing_table', 'swm_pricing_table' );
}

/* ************************************************************************************** 
   BUTTONS
************************************************************************************** */

if (!function_exists('swm_buttons')) {
	function swm_buttons($atts, $content = null) {		
		extract( shortcode_atts( array (
			'font_color' => '',
			'button_color' => '',
			'shape' => 'square',	
			'target' => '_self',
			'text_shadow' => 'dark',		
			'link' => '#',
			'size' => 'small',
			'button_3d' => 'false',
			'button_style' => 'standard',

		), $atts ) );		
		
		$output= '';
		$btn_bg_color = '';		
		$button_outline = '';
		$border_color = '';

		if ($button_3d == 'true') {
			$button_3d = 'button_3d';
		}

		if ($button_style == 'button_outline') {
			$button_outline = 'button_outline';	
			$btn_bg_color = 'background:transparent;';	
			$border_color = 'border-color:'.$button_color.';';	
			$button_3d = '';
		} else {
			$btn_bg_color = 'background:'.$button_color.';';
		}

		$output .= '<a href="'.$link.'" class=" swm_button '.$button_3d.'  '.$shape.' '.$size.' shadow_'.$text_shadow.' '.$button_outline.' " style="'.$btn_bg_color.' color:'.$font_color.'; '.$border_color.'" target="'.$target.'">'. do_shortcode($content) . '</a>';
		return $output;
	}

	add_shortcode('swm_button', 'swm_buttons');
}

/* ************************************************************************************** 
    TABS
************************************************************************************** */

if (!function_exists('swm_tab_init')) {
	function swm_tab_init( $atts, $content = null ) {

		extract( shortcode_atts( array (				
			'style' => 'tabs_horizontal'
		), $atts ) );
		
		$title = explode(",",$atts['title']);				
		$total_tabs = count($title);	
		$output = "";
		$output .= '<div class="swm_tabs '.$style.'">	';
		$output .= '<ul class="tab-nav tab-clearfix">';
		
		foreach($title as $key=>$value){
			$output .= '<li><a href="#tab'.($key+1).'">'.$value.'</a></li>';
		}
		
		$output .= '</ul>';
		$output .= do_shortcode($content);
		$output .= '</div>';
		
		return $output;
		
	} add_shortcode('swm_tabs', 'swm_tab_init');
}

if (!function_exists('swm_tab_container')) {
	function swm_tab_container( $atts, $content = null ) {
		
		$output = '';
		$output .= do_shortcode($content);	
		
		return $output;
		
	} add_shortcode('tab_container', 'swm_tab_container');
}

if (!function_exists('swm_tab_content')) {
	function swm_tab_content( $atts, $content = null ) {
		
		$tab = $atts['tabno'];
		$output = '';	
		$output .= '<div id="tab'.$tab.'" class="swm_tab">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		
		return $output;
		
	} add_shortcode('tab', 'swm_tab_content');
}

/* ************************************************************************************** 
    TOOGLE CONTENT
************************************************************************************** */

if (!function_exists('swm_toggle_accordion')) {
	function swm_toggle_accordion( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'title' => '',
			'style' => 'toggle_box',
			'status' => 'closed',
			'icon' => ''
		), $atts ) );
		
		$output = '';		
		$output .= '<div class="swm_toggle_accordion_container">';
		$output .= do_shortcode($content);		
		$output .= '</div>';

		return $output;
	} add_shortcode('swm_toggle_accordion_container', 'swm_toggle_accordion');
}

if (!function_exists('swm_toggle_content')) {
	function swm_toggle_content( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'title' => '',			
			'status' => 'closed',
			'icon' => ''
		), $atts ) );
		
		$output = '';
		$no_icon = 'no_icon';

		$output .= '<div data-id="'.$status.'" class="toggle_box">';
		$output .= '<span class="toggle_box_title">';

		if ( $icon !== '' ) {
			$output .= '<span class="title_icon"><i class="fa '.$icon.'"></i></span>';
			$no_icon = '';
		}

		$output .= '<span class="title_text '.$no_icon.'">'.$title.'<i class="fa fa-plus-square-o openclose"></i><i class="fa fa-minus-square-o openclose"></i></span></span>';	
		$output .= '<div class="toggle_box_inner">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	} add_shortcode('swm_toggle', 'swm_toggle_content');
}

if (!function_exists('swm_toggle_accordion_content')) {
	function swm_toggle_accordion_content( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'title' => '',			
			'status' => 'closed',
			'icon' => ''
		), $atts ) );
		
		$output = '';
		$no_icon = 'no_icon';

		$output .= '<div data-id="'.$status.'" class="toggle_box_accordion">';
		$output .= '<span class="toggle_box_title_accordion">';

		if ( $icon !== '' ) {
			$output .= '<span class="title_icon"><i class="fa '.$icon.'"></i></span>';
			$no_icon = '';
		}

		$output .= '<span class="title_text '.$no_icon.'">'.$title.'<i class="fa fa-plus-square-o openclose"></i><i class="fa fa-minus-square-o openclose"></i></span></span>';	
		$output .= '<div class="toggle_box_inner">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	} add_shortcode('swm_toggle_accordion', 'swm_toggle_accordion_content');
}



/* ************************************************************************************** 
    PULL QUOTES
************************************************************************************** */

if (!function_exists('swm_pull_quote')) {
	function swm_pull_quote($atts, $content = null, $quote) {	
		return '<span class="swm_'.$quote.'">' . do_shortcode($content) . '</span>';
	}

	add_shortcode('pullquote_left', 'swm_pull_quote');
	add_shortcode('pullquote_right', 'swm_pull_quote');
}

/* ************************************************************************************** 
    LIST STYLES
************************************************************************************** */

if (!function_exists('swm_list')) {
	function swm_list($atts, $content = null, $list) {		
		return '<div class="'.$list.'">' . do_shortcode($content) . '</div>';
	}

	$swm_list_array = array("list_lower_roman","list_upper_roman","list_lower_alpha","list_upper_alpha","steps_with_box","steps_with_circle");

	foreach ($swm_list_array as $swm_list_name) {
		add_shortcode($swm_list_name, 'swm_list');
	}	
}

/* ************************************************************************************** 
    INFO BOXES
************************************************************************************** */

if (!function_exists('swm_infobox')) {
	function swm_infobox($atts, $content = null, $infobox) {	
		return '<p class="swm_info_box round5"> <span class="swm_hide_boxes"><i class="fa fa-times-circle"></i></span><i class="fa fa-info-circle"></i>' . do_shortcode($content) . '</p>';
	}
	add_shortcode('info', 'swm_infobox');
}

if (!function_exists('swm_errorbox')) {
	function swm_errorbox($atts, $content = null, $errorbox) {	
		return '<p class="swm_error_box round5"> <span class="swm_hide_boxes"><i class="fa fa-times-circle"></i></span><i class="fa fa-exclamation-circle"></i>' . do_shortcode($content) . '</p>';
	}
	add_shortcode('error', 'swm_errorbox');
}

if (!function_exists('swm_successbox')) {
	function swm_successbox($atts, $content = null, $successbox) {	
		return '<p class="swm_success_box round5"> <span class="swm_hide_boxes"><i class="fa fa-times-circle"></i></span><i class="fa fa-check-circle"></i>' . do_shortcode($content) . '</p>';
	}
	add_shortcode('success', 'swm_successbox');
}

if (!function_exists('swm_notebox')) {
	function swm_notebox($atts, $content = null, $notebox) {	
		return '<p class="swm_note_box round5"> <span class="swm_hide_boxes"><i class="fa fa-times-circle"></i></span><i class="fa fa-thumb-tack"></i>' . do_shortcode($content) . '</p>';
	}
	add_shortcode('note', 'swm_notebox');
}

if (!function_exists('swm_downloadbox')) {
	function swm_downloadbox($atts, $content = null, $downloadbox) {	
		return '<p class="swm_download_box round5"> <span class="swm_hide_boxes"><i class="fa fa-times-circle"></i></span><i class="fa fa-download"></i>' . do_shortcode($content) . '</p>';
	}
	add_shortcode('download', 'swm_downloadbox');
}

if (!function_exists('swm_warningbox')) {	
	function swm_warningbox($atts, $content = null, $warningbox) {	
		return '<p class="swm_warning_box round5"> <span class="swm_hide_boxes"><i class="fa fa-times-circle"></i></span><i class="fa fa-warning"></i>' . do_shortcode($content) . '</p>';
	}
	add_shortcode('warning', 'swm_warningbox');
}


/* **************************************************************************************
   LIST ICON
************************************************************************************** */

if (!function_exists('swm_icon_list')) {
	function swm_icon_list( $atts, $content = null ) {		
		
		$output = '';		
		$output .=  '<ul class="the_icons">';		
		$output .=  do_shortcode($content);
		$output .=  '</ul>';	
		$output .=  '<div class="clear"></div>';
	  
		return $output;   
	}

	add_shortcode( 'icon_list', 'swm_icon_list' );
}

if (!function_exists('swm_list_icon')) {
	function swm_list_icon( $atts, $content = null ) {
		extract( shortcode_atts( array (		
			'icon_name' => ''
			
		), $atts ) );

		$output = '';
		
		$output .= '<li>';
		$output .= '<i class="fa '.$icon_name.'"></i>';
		$output .=  do_shortcode($content);
		$output .=  '</li>';	
		
		return $output;	
	}

	add_shortcode( 'swm_list_icon', 'swm_list_icon' );
}

/* **************************************************************************************
   ICON
************************************************************************************** */

if (!function_exists('swm_icon')) {
	function swm_icon( $atts, $content = null ) {
		extract( shortcode_atts( array (		
			'icon_name' => 'fa-star',
			'icon_color' => '#606060',			
			'icon_bg_color' => '#ffffff',
			'icon_size' => 'small',						
			'icon_style' => 'default',
			'icon_border' => 'false',	
			'border_color' => '#606060',			
			'margin' => '4',
			'rotate' => 'false',
			'link' => '#',
			'target' => '_self',
			'animation_style' => 'none'
		), $atts ) );
		
		$border_radius = '';
		$icon_bg = '';
		$border_styles = '';
		$rotate_icon = '';
		$block_class = '';

		if ( $icon_style == 'square' ) {
			$border_radius = '3';
		} else if ( $icon_style == 'circle' ) {
			$border_radius = '1000';
		}

		if ( $icon_style == 'square' || $icon_style == 'circle' ) {
			$icon_bg = 'background:'.$icon_bg_color.'; border-radius:'.$border_radius.'px; ';
			$block_class = "i_box";
		}

		if ( $icon_border == 'true' ) {
			$border_styles = 'border:1px solid '.$border_color.'; ';			
		}

		if ( $rotate == 'true' ) {
			$rotate_icon = 'fa-spin';
		}

		if ( $animation_style != 'none') {
			$animation_style = 'swm_element_visible '.$animation_style.' ';
		} else {
			$animation_style = '';
		}

		$output = '';		
		$output .= '<a href="'.$link.'" target="'.$target.'"><i class="fa '.$block_class.' '.$rotate_icon.' '.$icon_name.' size_'.$icon_size.' '.$animation_style.'" style="'.$border_styles.' '.$icon_bg.' color:'.$icon_color.'; margin:'.$margin.'px;"></i></a>';
		
		return $output;	
	}

	add_shortcode( 'swm_icon', 'swm_icon' );
}

/* **************************************************************************************
   SIMPLE ICON
************************************************************************************** */

if (!function_exists('fa_icon')) {
	function fa_icon($atts, $content = null) {	

		extract( shortcode_atts( array (				
				'icon' => 'fa-star',				
			), $atts ) );

		return '<i class="fa '.$icon.'"></i>';
	}

	add_shortcode('fa_icon', 'fa_icon');
}


/* ************************************************************************************** 
    GAP
************************************************************************************** */

if (!function_exists('swm_gap')) {
	function swm_gap($atts, $content = null) {	

		extract( shortcode_atts( array (				
				'size' => '10px',				
			), $atts ) );

		return '<div class="clear"></div><hr class="swm_gap" style="margin:'.$size.' 0 0 0;">';
	}

	add_shortcode('gap', 'swm_gap');
}

/* ************************************************************************************** 
	COUNTER CIRCLES
************************************************************************************** */

if (!function_exists('counter_circles')) {
	function counter_circles($atts, $content = null) {			
		return '<div class="swm_counters_circle clear"><div class="swm_counters_circle_holder">'.do_shortcode($content).'</div></div>';
	}
	add_shortcode('counter_circles', 'counter_circles');
}

if (!function_exists('counter_circle')) {
	function counter_circle( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'percentage' => '50',
			'bar_color' => '#cccccc',
			'track_color' => '#606060',
			'track_line_width' => '10',
			'size' => '220',
			'speed' => '1500',
			'circle_text_size' => '30',
			'desc_text' => '',
			'desc_text_size' => '30'			
		), $atts ) );
			
		$output = '';
		
		$output .=  '<div class="swm_counter_circle_wrap" style="width:'.$size.'px;">';
		$output .=  '<div class="swm_counter_circle" style="height:'.$size.'px;width:'.$size.'px; line-height:'.$size.'px;">';
		$output .=  '<div class="swm_counter_circle_text" style="font-size:'.$circle_text_size.'px; line-height:'.$size.'px;" data-percent="'.$percentage.'" data-barColor="'.$bar_color.'" data-trackColor="'.$track_color.'" data-chartSize="'.$size.'" data-speed="'.$speed.'" data-lineWidth="'.$track_line_width.'">';
		
		$output .=  '<div style="width:'.$size.'px;">';
		$output .=  do_shortcode($content);
		$output .=  '</div>';

		$output .=  '</div>';
		$output .=  '</div>';
		$output .=  '<div class="clear"></div>';

		if ( $desc_text != '' ) {
			$output .=  '<div class="swm_counter_circle_desc" style="font-size:'.$desc_text_size.'px;">';
			$output .=  $desc_text;
			$output .=  '</div>';
		}

		$output .=  '</div>';				
	  
		return $output;   
	}

	add_shortcode( 'counter_circle', 'counter_circle' );
}

/* ************************************************************************************** 
	PROGRESS BAR
************************************************************************************** */

if (!function_exists('progress_bar')) {
	function progress_bar( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'percentage' => '50',
			'title_text' => 'Title Text',
			'background' => '#606060'
		), $atts ) );
			
		$output = '';

		$output .=  '<div class="swm_progress_bar">';
		$output .=  '<div class="swm_progress_bar_title">'.$title_text.'</div>';
		$output .=  '<div class="swm_progress_bar_block">';
		$output .=  '<span class="swm_progress_bar_out swm_dark_gradient" data-width="'.$percentage.'" style="background-color:'.$background.';">';
		$output .=  '<span class="swm_progress_bar_in"></span>';
		$output .=  '</span>';
		$output .=  '</div>';
		$output .=  '<div class="clear"></div>';
		$output .=  '</div>';			
	  
		return $output;   
	}

	add_shortcode( 'progress_bar', 'progress_bar' );
}


/* ************************************************************************************** 
	COUNTER BOX
************************************************************************************** */

if (!function_exists('swm_counter_boxes')) {
	function swm_counter_boxes($atts, $content = null) {			
		return '<div class="swm_row swm_counter_boxes clear">'.do_shortcode($content).'<div class="clear"></div></div>';
	}
	add_shortcode('swm_counter_boxes', 'swm_counter_boxes');
}

if (!function_exists('swm_counter_box')) {
	function swm_counter_box( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'box_bg_color' => '#ffffff',
			'font_color' => '#606060',
			'icon' => '',
			'icon_bg_color' => '#606060',
			'icon_color' => '#ffffff',			
			'counter_number' => '1000',
			'unit' => '',
			'unit_position' => '',
			'speed' => '2000',
			'column' => '4'
		), $atts ) );
			
		$output = '';

		$output .=  '<div class="swm_counter_box swm_column'.$column.'">';
		$output .=  '<div class="swm_counter_box_gap">';
		$output .=  '<div class="swm_counter_box_wrap" style=" background:'.$box_bg_color.'; color:'.$font_color.';">';

		if ( $icon != '' ) {
			$output .=  '<div class="counter_icon" style=" background:'.$icon_bg_color.'; color:'.$icon_color.';">';
			$output .=  '<i class="fa '.$icon.'"></i>';
			$output .=  '</div>';
		}

		$output .=  '<div class="stat-counter" data-finalNumber="'.$counter_number.'" data-speed="'.$speed.'">';

		if ( $unit != '' && $unit_position == 'before_number') {
			$output .=  '<span class="percent">'.$unit.'</span>';
		}
		
		$output .=  '<span class="count"></span>';	

		if ( $unit != '' && $unit_position == 'after_number') {
			$output .=  '<span class="percent">'.$unit.'</span>';
		}

		$output .=  '<div class="stat-text">'.do_shortcode($content).'</div>';
		$output .=  '</div>';
		$output .=  '<div class="clear"></div>';
		$output .=  '</div>';
		$output .=  '</div>';	
		$output .=  '</div>';			
	  
		return $output;   
	}

	add_shortcode( 'swm_counter_box', 'swm_counter_box' );
}


/* ************************************************************************************** 
	100% WIDTH SECTION
************************************************************************************** */

if (!function_exists('swm_section')) {
	function swm_section( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'background_color' => '',
			'background_image' => '',
			'background_repeat' => 'repeat',
			'background_position' => 'center-top',
			'background_attachment' => 'fixed',
			'background_stretch' => 'false',
			'parallax_effect' => 'true',
			'parallax_speed' => '2',
			'padding_top' => '',
			'padding_bottom' => '',
			'margin_top' => '',
			'margin_bottom' => '',
			'font_color' => '',
			'section_id' => '',
			'border_width' => '0',
			'border_top_color' => '',
			'border_bottom_color' => '',
			'arrow_direction' => 'none',
			'arrow_color' => '#606060',
		), $atts ) );
		
		$parallax_on = '';		
		$data_bg_scrollSpeed = '';
		$background_size = 'background-size: auto; ';
		$bg_image = '';
		$bg_position = '';
		$bg_repeat = '';
		$bg_attachment = '';
		$dataParallax = '';
		$border_style = '';

		if ( $background_image != '' ) {
			$bg_image 		= 'background-image:url(' . $background_image . '); ';
			$bg_position 	= 'background-position:' . str_replace( '-', ' ', $background_position) . '; ';
			$bg_repeat 		= 'background-repeat: ' . $background_repeat . '; ';
			$bg_attachment 	= 'background-attachment: ' . $background_attachment . '; ';

			if ( $background_stretch == 'true' ) {
			    $background_size = 'background-size: cover;';
			    $bg_attachment = '';
			    $bg_repeat = '';
			}
		}

		if ( $parallax_effect == 'true' ) {
			$parallax_on = "swm_section_prallax swm_parallax_on swm_full_stretch";
			$data_bg_scrollSpeed = 'data-bg-scrollSpeed="' . $parallax_speed . '"';
			$bg_attachment = '';
			$background_size = 'background-size: cover; ';
			$dataParallax = 'true';
		}

		if ( $border_width != '0') {
			$border_style .= ( $border_top_color !=  '' ) ? 'border-top:'.$border_width.'px solid '.$border_top_color.'; ' : '';
			$border_style .= ( $border_bottom_color !=  '' ) ? 'border-bottom:'.$border_width.'px solid '.$border_bottom_color.'; ' : '';
		}

		$get_header_bg_color = 'background-color:' . $background_color . ';' ;				

		$background_style = $get_header_bg_color . $bg_image . $bg_position . $bg_repeat . $bg_attachment . $background_size;

		$section_style = 'padding-top:'.$padding_top.'; padding-bottom:'.$padding_bottom.'; margin-top:'.$margin_top.'; margin-bottom:'.$margin_bottom.'; color:'.$font_color.'; ';
			
		$output = '';		

		if ( $arrow_direction == 'top' ) {
			$output .= '
			
			<div class="swm_section_arrow_divider" style="border:1px solid ' . $arrow_color . ';">
				<div class="swm_arrow_divider top" style="background-color:' . $arrow_color . ';border-bottom:1px solid ' . $arrow_color . ';border-left:1px; solid ' . $arrow_color . '"></div>
			</div>		

			';	
		}	

		$output .=  '<div id="'.$section_id.'" class="swm_full_width_section '.$parallax_on.'" style="'.$border_style.' '.$background_style.' '.$section_style.' " '.$data_bg_scrollSpeed.' data-parallaxtest="'.$dataParallax.'">';		

		$output .=  '<div class="swm_container">';		
		$output .=  do_shortcode($content);		
		$output .=  '<div class="clear"></div>';
		$output .=  '</div>';			
		$output .=  '</div>';	

		if ( $arrow_direction == 'bottom' ) {
			$output .= '
			
			<div class="swm_section_arrow_divider" style="border:1px solid ' . $arrow_color . ';">
				<div class="swm_arrow_divider bottom" style="background-color:' . $arrow_color . ';border-bottom:1px solid ' . $arrow_color . ';border-left:1px; solid ' . $arrow_color . '"></div>
			</div>		

			';	
		}	

				
	  
		return $output;   
	}

	add_shortcode( 'swm_section', 'swm_section' );
}

/* ************************************************************************************** 
	LINE BREAK / HORIZONTAL LINE / CLEARFIX
************************************************************************************** */

if (!function_exists('horizontal_line')) {
	function horizontal_line( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'percentage' => '50',
			'title_text' => 'Title Text',
			'background' => '#606060'
		), $atts ) );
			
		$output = '';

		$output .=  '<div class="horizontal_line">';
		$output .=  '<span class="h_line"></span><span class="h_icon"><i class="fa fa-star"></i></span>';
		$output .=  '<div class="clear"></div>';
		$output .=  '</div>';			
	  
		return $output;   
	}

	add_shortcode( 'hr', 'horizontal_line' );
}

if (!function_exists('swm_break')) {
	function swm_break( $atts, $content = null ) {
		return '<br />';
	} add_shortcode('break', 'swm_break');
}

if (!function_exists('swm_clear')) {
	function swm_clear( $atts, $content = null ) {
		return '<div class="clear"></div>';
	} add_shortcode('clear', 'swm_clear');
}

if (!function_exists('swm_line')) {
	function swm_line( $atts, $content = null ) {
		return '<div class="clear"></div><div class="swm_line"><span></span></div>';
	} add_shortcode('line', 'swm_line');
}


/* ************************************************************************************** 
	BLOCKQUOTE
************************************************************************************** */

if (!function_exists('swm_blockquote')) {
	function swm_blockquote( $atts, $content = null ) {
		return '<blockquote>'.do_shortcode($content).'</blockquote>';
	} add_shortcode('blockquote', 'swm_blockquote');
}

/* ************************************************************************************** 
	DROPCAPS
************************************************************************************** */

if (!function_exists('swm_dropcap')) {
	function swm_dropcap( $atts, $content = null ) {
		extract( shortcode_atts( array (
			'style' => 'dark'
			
		), $atts ) );
			
		$output = '';

		$output .=  '<div class="swm_dropcap '.$style.'">';
		$output .=  do_shortcode($content);		
		$output .=  '</div>';			
	  
		return $output;   
	}

	add_shortcode( 'swm_dropcap', 'swm_dropcap' );
}


?>