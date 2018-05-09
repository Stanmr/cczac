<?php

/* ************************************************************************************** 
	Language Translation
************************************************************************************** */

load_theme_textdomain( 'election',get_template_directory().'/languages/' );

/* ************************************************************************************** 
	Google Analytical
************************************************************************************** */

if (!function_exists('swm_display_google_analytical_code')) {
	function swm_display_google_analytical_code() {		
		$swm_display_google_analytical = get_theme_mod('swm_google_analytical');	
		if(!empty($swm_display_google_analytical)) {
	?>
		<script>
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $swm_display_google_analytical; ?>']);
			_gaq.push(['_setDomainName', 'none']);
			_gaq.push(['_setAllowLinker', true]);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	<?php  
		}
	}
	add_action('wp_footer', 'swm_display_google_analytical_code');
}

/* ************************************************************************************** 
	Top Menu and Portfolio Menu
************************************************************************************** */

//Register WordPress Menus
if ( ! function_exists('swm_register_menu')) {
	function swm_register_menu() {
		register_nav_menus(array(		
			'main-navigation' => esc_html__('Main Navigation', 'election'),
			'top-bar-navigation' => esc_html__('Top Bar Navigation', 'election'),		
			'footer-menu' => esc_html__('Small Footer Navigation', 'election'),
			'portfolio-menu-1' => esc_html__('Portfolio Horizontal Menu', 'election'),		
		));
	} // end function

	add_action( 'init' , 'swm_register_menu' );
	
} // end if

if ( ! function_exists('swm_display_main_navigation')) {
	function swm_display_main_navigation() {
		wp_nav_menu( array( 
			'theme_location' => 'main-navigation', 
			'sort_column' => 'menu_order', 					
			'container' =>false, 
			'menu_class' => 'sf-menu', 
			'menu_id' => 'nav',
			'echo' => true,
			'before' => '', 
			'after' => '', 
			'link_before' => '', 
			'link_after' => '',
			'depth' => 0, 
			'fallback_cb' => 'swm_default_topmenu'						
		) ); 
	} // end function
} // end if

if ( ! function_exists('swm_display_top_bar_navigation')) {
	function swm_display_top_bar_navigation() {
		wp_nav_menu( array( 
			'theme_location' => 'top-bar-navigation', 
			'sort_column' => 'menu_order', 					
			'container' =>false, 
			'menu_class' => '', 
			'menu_id' => '',
			'echo' => true,
			'before' => '', 
			'after' => '', 
			'link_before' => '', 
			'link_after' => '',
			'depth' => 0, 
			'fallback_cb' => ''						
		) ); 
	} // end function
} // end if


if ( ! function_exists('swm_display_footer_menu')) {
	function swm_display_footer_menu() {
		wp_nav_menu( array( 
			'theme_location' => 'footer-menu', 
			'sort_column' => 'menu_order', 					
			'container' =>false, 
			'menu_class' => '', 
			'menu_id' => 'footer-menu',
			'echo' => true,
			'before' => '', 
			'after' => '', 
			'link_before' => '', 
			'link_after' => '',
			'depth' => 0, 
			'fallback_cb' => 'swm_default_footer_menu'				
		) ); 
	} // end function
} // end if

if ( ! function_exists('swm_default_topmenu')) {
	function swm_default_topmenu() {		
		echo __('<ul><li class="menu-setting-msg">Set Top Menu from Wordpress Admin > Appearance > Menus > "Manage Locations" Box</li><li class="menu-setting-msg2">Add Top Menu icon from Wordpress Admin > Customizer > Main Navigation > Active Link Styling</li></ul>', 'election');
	} // end function
} // end if

if ( ! function_exists('swm_default_footer_menu')) {
	function swm_default_footer_menu() {		
		echo __('<ul><li class="footer_menu-setting-msg">Set Footer Menu from Wordpress Admin > Appearance > Menus > "Manage Locations" Box</li></ul>', 'election');
	} // end function
} // end if

if ( ! function_exists('swm_display_portfolio_menu')) {	
	function swm_display_portfolio_menu() {

		global $swm_pf_display_type,$swm_excluce_pf_cat_tabs;

		if ($swm_pf_display_type == 'Classic_Portfolio') { 
			?>
			<div class="swm_horizontal_menu classic_pf">
				<?php
				wp_nav_menu( array( 
					'theme_location' => 'portfolio-menu-1', 
					'sort_column' => 'menu_order', 					
					'container'       => '', 
					'container_class' => '', 				
					'echo' => true,
					'before' => '', 
					'after' => '', 
					'link_before' => '', 
					'link_after' => '',
					'depth' => 0, 
					'fallback_cb' => ''				
				) );
				?>
				<div class="clear"></div>
			</div> 
			<?php
		}	

		if ($swm_pf_display_type == 'Sortable_Portfolio') {	
				?>			
				<div class="swm_horizontal_menu filter_menu">
					<ul>
						<li><a href="#" class="active" data-filter="*"><?php echo esc_html__('All','election'); ?></a></li>
						<?php if ($swm_excluce_pf_cat_tabs):
								wp_list_categories(array('title_li' => '', 'taxonomy' => 'portfolio-categories', 'hierarchical' => false, 'exclude' => $swm_excluce_pf_cat_tabs, 'order' => 'asc', 'walker' => new Portfolio_Walker())); 
							else:
								wp_list_categories(array('title_li' => '', 'taxonomy' => 'portfolio-categories',  'order' => 'asc', 'walker' => new Portfolio_Walker())); 
						endif; ?>
					</ul>
					<div class="clear"></div>
				</div>
			<?php 
		}	


	} // end function
} // end if


/* ************************************************************************************** 
	Social Media
************************************************************************************** */

if ( ! function_exists('swm_display_social_media')) {
	function swm_display_social_media() { 
		
		$swm_sm_icons = array( esc_html__('Twitter', 'election' ), esc_html__('Facebook', 'election' ), esc_html__('YouTube', 'election' ), esc_html__('Delicious', 'election' ), esc_html__('Vimeo', 'election' ), esc_html__('Flickr', 'election' ), esc_html__('Digg', 'election' ), esc_html__('StumbleUpon', 'election' ), esc_html__('LinkedIn', 'election' ), esc_html__('Blogger', 'election' ), esc_html__('Technorati', 'election' ), esc_html__('Pinterest', 'election' ), esc_html__('Apple', 'election' ), esc_html__('Dropbox', 'election' ), esc_html__('Amazon', 'election' ), esc_html__('Picasa', 'election' ), esc_html__('Skype', 'election' ), esc_html__('deviantART', 'election' ), esc_html__('Windows', 'election' ), esc_html__('Tumblr', 'election' ), esc_html__('Lastfm', 'election' ),
esc_html__('Yahoo', 'election' ), esc_html__('Wordpress', 'election' ), esc_html__('Dribble', 'election' ), esc_html__('Forest', 'election' ), esc_html__('Google', 'election' ), esc_html__('GooglePlus', 'election' ), esc_html__('AppleStore', 'election' ), esc_html__('Instagram', 'election' ), esc_html__('Myspace', 'election' ), esc_html__('SoundCloud', 'election' ), esc_html__('RSS', 'election' ) );

		foreach ($swm_sm_icons as $swm_sm_icon) {

			$sm_icon = 'swm_' . strtolower($swm_sm_icon);

			$get_sm_icon = get_theme_mod( $sm_icon );
		    if($get_sm_icon != '') { ?>
				<li><a href="<?php echo $get_sm_icon; ?>" <?php echo swm_open_sm_new_window() ?> class="<?php echo $sm_icon; ?> tipDown" title="<?php echo $swm_sm_icon; ?>"  ></a></li>
				<?php 
			}	

		}  // end foreach

	} // end function
} // end if

if ( ! function_exists('swm_open_sm_new_window')) {
	 function swm_open_sm_new_window() {	
		 if (get_theme_mod('swm_open_sm_new_window')) { ?> target="_blank" <?php 	}  
	 }
}

/* ************************************************************************************** 
	Footer Widgets and Columns
************************************************************************************** */

if ( ! function_exists('swm_display_footer_column')) {
	function swm_display_footer_column() {	

		$footer_columns = get_theme_mod( 'swm_footer_column',3 );		

		$first_column = 'first';
        switch($footer_columns) {
        	case 1: $class = 'swm_one_full'; break;
        	case 2: $class = 'swm_one_half'; break;
        	case 3: $class = 'swm_one_third'; break;
        	case 4: $class = 'swm_one_fourth'; break;
        	case 5: $class = 'swm_one_fifth'; break;
        	case 6: $class = 'swm_one_sixth'; break;
        }

        echo '<div class="swm_large_footer">';
		
		for ($i = 1; $i <= $footer_columns; $i++) {
			echo "<div class='swm_column $class $first_column'>";
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Column '.$i) ) : 
				else : swm_sample_widget($i); 
			endif;
			echo "</div>";
			$first_column = "";
		}

		echo '<div class="clear"></div>';

		echo '</div>';
	
	} // end function
}  // end if


if ( ! function_exists('swm_sample_widget')) {
	function swm_sample_widget($number)	{

		$widget_info = "<p class='sample_widget'>" . esc_html__('Replace this sample widget with your desired widget from WordPress Admin > Appearance > Widgets Page by drag and drop in Footer Column ','election');
		$title = apply_filters('widget_title', esc_html__('Footer Column','election') );

		echo "<div class='footer_widget'>";
		echo "<h3>" . $title . " " . $number . "</h3><div class='clear'></div>";			
		echo $widget_info;
		echo $number . ' </p>';
		echo '<p class="sample_widget">Set footer columns 1 to 5 from WordPress Admin > Customizer > Footer > Footer Column Dropdown</p>';
		echo "</div>";

	}  // end function
} // end if


/* ************************************************************************************** 
	Output Font Styles
************************************************************************************** */

if ( ! function_exists( 'swm_output_font_family_weight' ) ) {	
  	function swm_output_font_family_weight($font_family=null,$font_weight=null,$standard_font_family=null,$standard_font_weight=null) {

  		$output = '';

  		$get_standard_font_family = get_theme_mod( $standard_font_family,'none' );  		

  		if ( $get_standard_font_family != 'none' ) {  			
  			
			$swm_standard_font_total_weight = ( get_theme_mod( $standard_font_weight ) == '' ) ? 'regular' : get_theme_mod( $standard_font_weight );		
			$swm_standard_font_weight = ( strpos( $swm_standard_font_total_weight, 'italic' ) ) ? str_replace( 'italic', '', $swm_standard_font_total_weight ) : $swm_standard_font_total_weight;	
			$swm_standard_font_style = ( strpos( $swm_standard_font_total_weight, 'italic' ) ) ? " font-style: italic;" : '';

			$output .= 'font-family:"' . $get_standard_font_family . '";';
			$output .= " font-weight:" . $swm_standard_font_weight . ";";

			if ($swm_standard_font_style) { $output .= $swm_standard_font_style; }


  		} else {

  			if ( get_theme_mod( 'swm_google_fonts',1 ) == 1 ) {

		  		$swm_font_family = get_theme_mod( $font_family,'Open Sans' );
				$swm_font_total_weight = ( get_theme_mod( $font_weight,'400' ) == '' ) ? '400' : get_theme_mod( $font_weight,'400' );		
				$swm_font_weight = ( strpos( $swm_font_total_weight, 'italic' ) ) ? str_replace( 'italic', '', $swm_font_total_weight ) : $swm_font_total_weight;	
				$swm_font_style = ( strpos( $swm_font_total_weight, 'italic' ) ) ? " font-style: italic;" : " font-style: normal;";

				if ($swm_font_family) { $output .= 'font-family:"' . $swm_font_family . '";'; }

				if ($swm_font_weight) { $output .= " font-weight:" . $swm_font_weight . ";"; }

				if ($swm_font_style) { $output .= $swm_font_style; }

			}
		
		}
		return $output;

   } // end function
} // end if

/* ************************************************************************************** 
	Output Google Font URL
************************************************************************************** */

if ( ! function_exists( 'swm_output_google_font_url' ) ) {	
  	function swm_output_google_font_url($font_family=null,$font_weight=null,$separator=null,$standard_font='none') { 
		
		$swm_font_family               = get_theme_mod( $font_family,'Open Sans' );
		$logo_font_family_query         = str_replace( ' ', '+', $swm_font_family );
		$logo_font_weight_and_style     = get_theme_mod( $font_weight,'400' );	

		return $logo_font_family_query . ':' . $logo_font_weight_and_style . $separator;	

   } // end function
}  // end if

/* ************************************************************************************** 
	Output Google Font Size and Color
************************************************************************************** */

if ( ! function_exists( 'swm_output_font_size_color' ) ) {	
  	function swm_output_font_size_color($font_size=null,$font_color=null) {  		
		
		$output = '';

		$output	.=  ( get_theme_mod( $font_size ) == '' ) ? '' : 'font-size:' . get_theme_mod( $font_size ) . '; ';
		$output	.=  ( get_theme_mod( $font_color ) == '' ) ? '' : 'color:' . get_theme_mod( $font_color ) . '; ';	

		return $output;			

   } // end function
} // end if

/* ************************************************************************************** 
	Output Page Element Colors
************************************************************************************** */

if ( ! function_exists( 'swm_output_page_element_color' ) ) {	
  	function swm_output_page_element_color($default_color=null,$primary_skin=null,$metabox_color=null) {  		
		
		$output = '';
		$meta_col = '';
		$swm_get_queried_object_id = get_queried_object_id();

		if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {      
		    if ( is_shop() ) {
		        $swm_get_queried_object_id = wc_get_page_id( 'shop' );
		    }
		}

		$default_col = get_theme_mod($default_color,$primary_skin);
		if (function_exists('rwmb_meta')) {
			$meta_col = get_post_meta( $swm_get_queried_object_id, $metabox_color, true );
		}

		if ( is_page() || is_single() && !is_attachment() ) {
			$output = ($meta_col != '') ? $meta_col : $default_col;	
		} else {
			$output = $default_col;
		}	

		if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {      
			if ( is_shop() ) {
				$output = ($meta_col != '') ? $meta_col : $default_col;	
			}
		}	

		if (is_category() ) :
		    $swm_get_query_var_cat = get_query_var('cat');
		    $swm_get_cat = get_category($swm_get_query_var_cat);
		    $swm_cat_name_title_bg = get_theme_mod($swm_get_cat->slug.'_title_bg');  

		    if ( $swm_cat_name_title_bg ) {
		        $output = ($swm_cat_name_title_bg != '') ? $swm_cat_name_title_bg : $default_col;	
		    }

		endif;

		return $output;			

   } // end function
} // end if


/* ************************************************************************************** 
	Elements Opacity 
************************************************************************************** */

if ( ! function_exists('swm_background_opacity') ) {
	function swm_background_opacity($element=null,$metafield=null) {

		$output = '';
		$metafield_opacity = '';
		$default_opacity = get_theme_mod( $element,80 );

		if ($metafield != '') {
			$swm_get_queried_object_id = get_queried_object_id();
			$metabox_title_color = get_post_meta( $swm_get_queried_object_id, 'swm_meta_page_title_color', true );

			if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {      
			    if ( is_shop() ) {
			        $swm_get_queried_object_id = wc_get_page_id( 'shop' );
			    }
			}
			
			if (function_exists('rwmb_meta') && $metabox_title_color != '') {
				$metafield_opacity = get_post_meta( $swm_get_queried_object_id, $metafield, true );
			}
		}		

		if ( is_page() || is_single() && !is_attachment() ) {
			$get_opacity = ($metafield_opacity != '') ? $metafield_opacity : $default_opacity;	
		} else {
			$get_opacity = $default_opacity;
		}

		if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {      
			if ( is_shop() ) {
				$get_opacity = ($metafield_opacity != '') ? $metafield_opacity : $default_opacity;	
			}
		}

		if (is_category() ) :
		    $swm_get_query_var_cat = get_query_var('cat');
		    $swm_get_cat = get_category($swm_get_query_var_cat);
		    $swm_cat_name_title_bg_opacity = get_theme_mod($swm_get_cat->slug.'_title_bg_opacity');  

		    if ( $swm_cat_name_title_bg_opacity ) {
		        $get_opacity = ($swm_cat_name_title_bg_opacity != '') ? $swm_cat_name_title_bg_opacity : $default_opacity;	
		    }

		endif;

		$decimal = ($get_opacity == '100') ? '' : '.';
		
		$output .= 'opacity:' . $decimal . $get_opacity . '; '; 
		$output .= '-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=' .$get_opacity . ')"; ';
		$output .= 'filter: alpha(opacity=' .$get_opacity . ';); ';

		return $output;

	} // end function
} // end if

if ( ! function_exists('swm_border_opacity') ) {
	function swm_border_opacity($color=null,$opacity=null) {

		$output = '';

		$get_opacity = '.' . get_theme_mod( $opacity,10 );
		$get_color = get_theme_mod( $color,'light' );		

		$decimal = ($get_opacity == '100') ? '' : '.';

		$color = ($get_color == 'dark') ? '0,0,0' : '255,255,255';
		
		$output = ' rgba(' . $color . ',' . $get_opacity . ')';

		return $output;

	} // end function	
} // end if

/* ************************************************************************************** 
	Post Page Layout
************************************************************************************** */

if ( ! function_exists( 'swm_page_post_layout_type' ) ) {
	
	function swm_page_post_layout_type() {
		
		// Vars
		$class = 'layout-sidebar-right';
		$post_types = get_post_types( '', 'names' ); 
		$blog_all_layout = get_theme_mod( 'swm_blog_all_layout', 'layout-sidebar-right' );
		$meta = '';
		
		// Loop through post types
		foreach ( $post_types as $post_type ) {
			if ( is_singular($post_type) ) {
				if ( $post_type == 'post' ) $post_type = 'blog';
				global $post;
				$post_id = $post->ID;
				$admin_id = $post_type .'_single_layout';
				$admin_setting = get_theme_mod( $admin_id, 'layout-sidebar-right' );
				
				if (function_exists('rwmb_meta')) {
					$meta = rwmb_meta('swm_meta_page_layout');
				}				
				
				if ( $meta !== '' ) {
					$class = $meta;
				} else {
					$class = $admin_setting;
				}		
			}
		}		
		
		if ( is_archive() || is_author() || is_tag() ) {
			$class = $blog_all_layout;
		}		
		
		// Portfolio
		if ( is_tax( 'portfolio-categories' ) || is_tax( 'portfolio_tag' ) ) {
			$class = get_theme_mod( 'portfolio_archive_layout', 'full-width' );
		}


		//event calendar pages
		if ( class_exists( 'Tribe__Events__Main' ) ) {	

			$event_pt = get_theme_mod( 'swm_event_page_layout', 'layout-full-width' );				

            if ( tribe_is_upcoming() || tribe_is_past() || tribe_is_month() || tribe_is_day() ||  tribe_is_venue() && !is_single() ) {
                $class = $event_pt;              
            } 

            if ( class_exists( 'TribeEventsPro' ) ) {
            	if ( tribe_is_week() || tribe_is_map() || tribe_is_photo() ) {
                	$class = $event_pt;              
            	}
            }
		}

		$class = apply_filters( 'swm_page_layout_type', $class );
		
		return $class;
		
	} // End function
} // End if


/* ************************************************************************************** 
	Image Meta Data
************************************************************************************** */

if (!function_exists('swm_wp_get_attachment')) {
	function swm_wp_get_attachment( $attachment_id ) {

		$attachment = get_post( $attachment_id );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title
		);
	}	
}

/* ************************************************************************************** 
	Post Format Icon
************************************************************************************** */

if (!function_exists('swm_get_post_format_icon')) {
	function swm_get_post_format_icon() { 
				
		$format = get_post_format();
		$pf_icon = '';

		switch ( $format ) {
			case 'link': $pf_icon = 'link'; 
				break;
			case 'aside': $pf_icon = 'pencil';
				break;
			case 'image': $pf_icon = 'camera';
				break;
			case 'gallery': $pf_icon = 'th-large';
				break;
			case 'video': $pf_icon = 'video-camera';
				break;
			case 'audio': $pf_icon = 'volume-up';
				break;
			case 'status': $pf_icon = 'info-circle';
				break;
			case 'quote': $pf_icon = 'quote-left';
				break;
			default: $pf_icon = 'pencil';
				break;
		} //end switch

		return $pf_icon;

 	}
}

/* ************************************************************************************** 
	Comments Listing
************************************************************************************** */

if ( !function_exists( 'swm_comment_listing' ) ) {

	function swm_comment_listing( $comment, $args, $depth ) {
		
		$GLOBALS['comment'] = $comment;

		if (isset($_COOKIE["pixel_ratio"])) {
   	 		$pixel_ratio = $_COOKIE["pixel_ratio"];
    		$avatar_size = $pixel_ratio > 1 ? '90' : '45'; 
		} else { 	   
		    $avatar_size = '45'; 
		}
		
		switch ( $comment->comment_type ) :
			case '' : ?>				
							
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment_body clearfix">					

						<div class="comment_content">
							<div class="comment_area">
								
								<div class="comment-content">
									<?php comment_text();
										if ( $comment->comment_approved == '0' ) : ?>									
											<p><em><?php echo esc_html__( 'Your comment is awaiting moderation.', 'election' ); ?></em></p>								
									<?php 
										endif; ?>
											
								</div> <!-- end comment-content-->
								<div class="clear"></div>
							</div> <!-- end comment_area-->

						</div>

						<div class="comment_avatar">
							<?php echo get_avatar( $comment, $avatar_size ); ?>		
						</div> <!-- end .comment_avatar -->					

						<div class="comment_postinfo">
							<span class="comment_author"><?php printf( __( '%s', 'election' ), sprintf( '%s ', get_comment_author_link()." " ) );  ?></span>				
							<span class="comment_date">
								<?php
										/* translators: 1: date, 2: time */
										printf( __( '%1$s at %2$s ', 'election' ), get_comment_date(),  get_comment_time() ); ?> - <?php 

										comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );?>		

									 <?php edit_comment_link( __( '(Edit)', 'election' ), ' ' );									
									?>	

							</span>
						</div> <!-- end .comment_postinfo -->
						
						<div class="clear"></div>

					</article> <!-- end comment-body -->
					<div class="clear"></div>
										
				<?php
				break;
			case 'pingback'  :
			case 'trackback' : ?>
				
				<li class="post pingback">
				<p><?php echo esc_html__( 'Pingback:', 'election' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'election'), ' ' ); ?></p>
				<?php
				break;
		endswitch;
	}
}


/* ************************************************************************************** 
	Add Plugin Fix CSS
************************************************************************************** */

if (!function_exists('swm_plugin_fix')) {
	function swm_plugin_fix() {

		$template_uri = get_template_directory_uri();		

		if (!is_admin()) {			
			
			wp_register_style( 'swm-tribe-events', SWM_DIRECTORY . '/tribe-events/tribe-events.css', '', '1.0' );
			wp_register_style('swm-plugin-fix', $template_uri . '/css/plugin-fix.css');			

			wp_enqueue_style( 'swm-tribe-events' );	
			wp_enqueue_style('swm-plugin-fix');
		}
 
	}
	add_action('wp_enqueue_scripts', 'swm_plugin_fix');
}

/* ************************************************************************************** 
	Blog Post Excerpt
************************************************************************************** */

if (!function_exists('swm_the_excerpt')) {
	function swm_the_excerpt($charlength) {
		$excerpt = get_the_excerpt();

		$charlength++;

		if ( function_exists('mb_strlen') ) {
		    
			if ( mb_strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
					$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					echo mb_substr( $subex, 0, $excut );
				} else {
					echo $subex;
				}
				//echo '[...]';
			} else {
				echo $excerpt;
			}

		} else {

			if ( strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
					$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					echo mb_substr( $subex, 0, $excut );
				} else {
					echo $subex;
				}
				//echo '[...]';
			} else {
				echo $excerpt;
			}

		}
		
	}
}



/* ############################################################################################### 
	Functions with Filters    #####################################################################
############################################################################################### */

/* ---------------------------------------------------------------------------------------- 
	Post Formats
---------------------------------------------------------------------------------------- */

if (!function_exists('swm_display_post_format')) {
	function swm_display_post_format() {
		
		$format = get_post_format() ? get_post_format() : 'standard';		

		if ( $format == 'link') {
			echo '<div class="nopf_imgvid"></div>';
		} else {

			if ( ! post_password_required() ) {

				$output = '';
				$swm_pf = array();
				$swm_meta_page_layout = '';

				$swm_pf['id'] = get_the_ID();
				$swm_pf['title'] = get_the_title();
				$swm_pf['attached_image'] = wp_get_attachment_url(get_post_thumbnail_id($swm_pf['id']));
				$swm_wp_get_attachment = swm_wp_get_attachment(get_post_thumbnail_id($swm_pf['id']));
				
				// blog pages
				$swm_pf['blog_all_style']			= get_theme_mod('swm_blog_all_style','blog-style-standard');			
				$swm_pf['show_excerpt'] 			= get_theme_mod('swm_show_excerpt',1);				
				$swm_pf['multiple_featured_imgs']	= get_theme_mod('swm_multiple_featured_imgs',5);		

				// blog single page
				$swm_pf['blog_single_style'] 		= get_theme_mod('swm_blog_single_style','blog-style-standard');
				$swm_pf['single_featured_imgvid']	= get_theme_mod('swm_single_featured_imgvid',1);			
				$swm_pf['single_image_lightbox'] 	= get_theme_mod('swm_single_image_lightbox',1);								

				if (function_exists('rwmb_meta')) {
					$swm_meta_page_layout = rwmb_meta('swm_meta_page_layout');						
				}			

				if ( $swm_pf['blog_all_style'] == 'blog-style-grid' ) {
					$image_size_type = 'blog-grid-post';
				} elseif ( $swm_pf['blog_all_style'] == 'blog-style-fullwidth') { 
					$image_size_type = 'blog-fullwidth-post';
				} else {
					$image_size_type = 'blog-post';				
				}

				if ( is_single() ) {
					if ( $swm_meta_page_layout != '' && $swm_meta_page_layout == 'layout-full-width') { 
						$image_size_type = 'blog-fullwidth-post';
					} else {
						$image_size_type = 'blog-post';		
					}
				}

				if ( $swm_pf['single_image_lightbox'] == 1 ) {
					$post_lightbox = 'data-rel="prettyPhoto"';
					$post_link = $swm_pf['attached_image'];
				}else {
					$post_lightbox = '';
					$post_link = get_permalink();
				}
				
				if (  is_single() ) {
					if ( $swm_pf['single_image_lightbox'] ) {
						$post_lightbox = 'data-rel="prettyPhoto"';
						$post_link = $swm_pf['attached_image'];
					}else {
						$post_lightbox = '';
						$post_link = '#';
					}						
				}

				// Display Post Format as per Type

				switch($format) 
				{
	        		case 'standard':
		        		if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && $format != 'portfolio' ) {	
							if ( $swm_pf['attached_image'] ) {									
								$output .= '<div class="post_format">';		
								$output .= '<a href="'.$post_link.'"  '.$post_lightbox.' title="' . $swm_pf['title'] . '">';
								$output .= get_the_post_thumbnail($swm_pf['id'], $image_size_type );
								$output .= '</a>';									
								$output .= '</div>';								
							}
						}
	        		break;

	        		case 'image':
						if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {								
											
							$output .= '<div class="post_format pf_image">';					
							$output .= '<a href="' . $post_link . '" ' . $post_lightbox . ' title="' . get_the_title() .'">';
							$output .= get_the_post_thumbnail($swm_pf['id'], $image_size_type );
							$output .= '</a>';				
						
							if ( $swm_wp_get_attachment['title'] || $swm_wp_get_attachment['description'] != '' ) {	
								
								$output .= '<div class="pf_image_caption">';
								
								if ( $swm_wp_get_attachment['title'] != '' ) {
									$output .= '<div class="img_title">'. $swm_wp_get_attachment['title'] .'</div>';
								}
								if ( $swm_wp_get_attachment['description'] != '') {
									$output .= '<div class="img_desc">'. $swm_wp_get_attachment['description'] .'</div>';		
								}
								$output .= '</div>';
							}
							
							$output .= '<div class="clear"></div>';	
							$output .= '</div>';
							$output .= '<div class="clear_pf"></div>';												
						}         		
	        		break;

	        		case 'video':
	        			if (function_exists('rwmb_meta')) {								
							$swm_pf_meta_video = rwmb_meta('swm_meta_video');
							if( !empty( $swm_pf_meta_video ) ) {			
								$output .= "<div class='fitVids'>";
								$output .= stripslashes(htmlspecialchars_decode($swm_pf_meta_video));								
								$output .= "</div>";	
							}		
						}	        								
	        		break;        		

					case 'gallery':

						if ( $swm_pf['blog_all_style'] == 'blog-style-grid' && !is_single() ) {
							if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {	
								if ( $swm_pf['attached_image'] ) {									
									$output .= '<div class="post_format">';		
									$output .= '<a href="'.$post_link.'"  '.$post_lightbox.' title="' . $swm_pf['title'] . '">';
									$output .= get_the_post_thumbnail($swm_pf['id'], $image_size_type );
									$output .= '</a>';									
									$output .= '</div>';								
								}
							}

						} else {

							$output .= "<div class='swm_slider_box' id='pf_type_gallery'><div class='flexslider pfi_gallery' data-pfGalleryId='".get_the_ID()."' id='swm-pf-gallery-".get_the_ID()."'>";       
					        $output .= "<ul class='slides'>";

								$i = 1;
								while($i <= $swm_pf['multiple_featured_imgs']):
									$attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');

									$attachment_image = wp_get_attachment_image_src($attachment_id, $image_size_type);

									if( $attachment_id ) {
										$output .= '<li><img src="' .$attachment_image[0] .'" alt="" /></li>'; 
									} 				
								
									$i++;
								endwhile;   			

					        $output .= '</ul>';                
					        $output .= "</div></div>";	
					        $output .= '<div class="clear"></div>';

						}

	        		break;
	        	
	        	} // end switch

	        	return apply_filters( 'swm_display_post_format', $output );

			} // end if post password required

		}

	}
}

/* ---------------------------------------------------------------------------------------- 
	Post Date
---------------------------------------------------------------------------------------- */

if (!function_exists('swm_post_date')) {
	function swm_post_date() {	

		$output = '';
		$swm_date_height = '';		
		$swm_year_on = get_theme_mod('swm_display_post_year',0);
		if ( $swm_year_on == 1 ) {
			$swm_date_height = 'swm_year_on';
		}

		$output .= '<div class="swm_post_date '.$swm_date_height.'">';
		$output .= '<div class="p_date">';
		$output .= '<a href="'.get_permalink().'" title="'.esc_html__('Comments','election').'">';
		$output .= "<span class='p_day'>".get_the_date('d')."</span>";
		$output .= "<span class='p_month'>".get_the_date('M')."</span>";

		if ( $swm_year_on == 1 ) {
			$output .= "<span class='p_year'>".get_the_date('Y')."</span>";
		}

		$output .= '</a>';
		$output .= '</div>';
		$output .= '<div class="p_comments">';		
		$output .= '<a href="'.get_permalink().'" title="'.esc_html__('Comments','election').'">'.get_comments_number().'</a>';
		$output .= '<small class="p_comment_arrow"></small>';
		$output .= '</div>';
		$output .= '</div>';	

		return apply_filters( 'swm_post_date', $output );
	}
}

/* ---------------------------------------------------------------------------------------- 
	Post Continue Reading Link
---------------------------------------------------------------------------------------- */

if (!function_exists('swm_post_read_more')) {
	function swm_post_read_more() {

		$output = '';
		if ( get_theme_mod('swm_show_excerpt',1) == 1 ) {		
			$output = '<a href="'.get_permalink().'" class="p_continue_reading">' . esc_html__('Read more','election') . ' <i class="fa fa-chevron-right"></i></a>';
		}	

		return apply_filters( 'swm_post_read_more', $output );
	}
}

if (!function_exists('swm_portfolio_read_more')) {
	function swm_portfolio_read_more() {

		$output = '';
		$output = '<a href="'.get_permalink().'" class="p_continue_reading">' . esc_html__('Read more','election') . ' <i class="fa fa-chevron-right"></i></a>';
		

		return apply_filters( 'swm_portfolio_read_more', $output );
	}
}

/* ---------------------------------------------------------------------------------------- 
	Post Summary / Content
---------------------------------------------------------------------------------------- */

if (!function_exists('swm_post_summary_content')) {
	function swm_post_summary_content() {

		$output = '';
		$pf_large = '';
		$pf_quote_icons = '';
		$swm_post_format = get_post_format();
		$blog_style = get_theme_mod( 'swm_blog_all_style', 'blog-style-standard' );	
		
		if ( $blog_style == 'blog-style-grid' ) { 
			echo '<div class="swm-arrow-up arrow-grid"><span></span></div>';
		}

		if ( $blog_style !== 'blog-style-grid' ) { 
			$pf_large =  'pf_large';
			$pf_quote_icons =  'pf_quote_icons';
		}

		echo '<div class="swm_post_summary primary_color">';				

		if ( $swm_post_format == 'quote' ) {			   			
			echo '<div class="pf_quote '.$pf_large.' ">';	
			echo '<div class="'.$pf_quote_icons.'">';				
			echo '<p class="pf_quote_text"><a href="'.get_permalink().'" >' . get_the_title() . '</a></p>';
			echo '<span class="q_left"><i class="fa fa-quote-left"></i></span>';
			echo '<span class="q_right"><i class="fa fa-quote-right"></i></span>';	
			echo '</div>';		
			echo '<span class="pf_quote_content">'.get_the_content().'</span>';
			echo '<div class="clear"></div>';
			echo '</div>';
		} else {
			if ( $swm_post_format == 'link' ) {
				if ( $blog_style == 'blog-style-grid' ) { 
					echo '<h2>'.get_the_title().'</h2>';
					echo '<div class="grid_date"><span><i class="fa fa-clock-o"></i>'.get_the_date('d F, Y').'</span><span><i class="fa fa-comment-o"></i><a href="' . get_permalink() . '">'.get_comments_number(get_the_ID()).' '.esc_html__('Comments', 'election').'</a></span></div>';
				} else {
					echo '<h2>'.get_the_title().'</h2>';
				}
			} else {				
				if ( $blog_style == 'blog-style-grid' ) { 
					echo '<h2><a href="'.get_permalink().'" >'.get_the_title().'</a></h2>';
					echo '<div class="grid_date"><span><i class="fa fa-clock-o"></i>'.get_the_date('d F, Y').'</span><span><i class="fa fa-comment-o"></i><a href="' . get_permalink() . '">'.get_comments_number(get_the_ID()).' '.esc_html__('Comments', 'election').'</a></span></div>';
				} else {
					echo '<h2><a href="'.get_permalink().'" >'.get_the_title().'</a></h2>';
				}	
			}

			echo swm_post_metas();

			if ( $blog_style == 'blog-style-grid' ) { 
				echo '<div class="post_grid_divider"></div>';
			}

			echo '<div class="swm_post_text">';

			if ( get_theme_mod('swm_show_excerpt',1) == 1 ) {
				echo swm_the_excerpt(get_theme_mod('swm_excerpt_length',320));
			} else {
				echo the_content();
			}
			
			echo '<div class="clear"></div>';

			echo swm_post_read_more();

			echo '</div>';
		}

		echo '</div>';

		echo '<div class="clear"></div>';
		
	}
}

// Single Page Content ------------------------------------------------------------------

if (!function_exists('swm_post_single_content')) {
	function swm_post_single_content() {
		
		$swm_post_format = get_post_format();			

		echo '<div class="swm_post_summary primary_color">';		

		if ( $swm_post_format == 'quote' ) {			   			
			echo '<div class="pf_quote pf_large">';
			echo '<div class="pf_quote_icons">';		
			echo '<p class="pf_quote_text">' . get_the_title() . '</p>';
			echo '<span class="q_left"><i class="fa fa-quote-left"></i></span>';
			echo '<span class="q_right"><i class="fa fa-quote-right"></i></span>';
			echo '</div>';
			echo '<span>'.the_content().'</span>';
			echo '<div class="clear"></div>';
			echo '</div>';
		} else {
			if ( $swm_post_format == 'link' ) {
				echo '<h1>'.get_the_title().'</h1>';
			} else {				
				echo '<h1>'.get_the_title().'</h1>';	
			}	

			echo swm_post_metas();

			echo '<div class="swm_post_text">';

			echo '<div class="swm_post_content">'.the_content().'</div>';

			echo '</div>';

		}

		echo '</div>';

		echo '<div class="clear"></div>';	
		
	}
}



/* ---------------------------------------------------------------------------------------- 
	Post Meta - author, categories, tags
---------------------------------------------------------------------------------------- */

if (!function_exists('swm_post_metas')) {
	function swm_post_metas() {		

		$output = '';
		$output .= '<div class="swm_post_meta">';
		$output .= '<ul>';
		
		// display author name start
		$output .= '<li class="f_user"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' )).'">'.get_the_author().'</a></li>';					
		// display author name end
		
		// display category names start	
		$swm_meta_cats = get_the_category();		
		$swm_meta_cat_list = array();;
		if($swm_meta_cats){
			$output .= '<li class="f_folder">';
			foreach($swm_meta_cats as $category) {
				$swm_meta_cat_list[] = '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'election' ), $category->name ) ) . '">'.$category->cat_name.'</a>';
			}		 
		 	$output .= implode(', ', $swm_meta_cat_list);
		 	$output .= '</li>';
		}	
		// display category names end	

		// display tags start
		if ( get_the_tag_list() ) {
			$output .= '<li class="f_tags">'.get_the_tag_list('',', ','').'</li>';
		}	
		// display tags end

		$output .= '</ul>';
		$output .= '</div>';		

		return apply_filters( 'swm_post_metas', $output );
	}
}


/* ---------------------------------------------------------------------------------------- 
	Pagination
---------------------------------------------------------------------------------------- */

// Standard Pagination (1,2,3,4)
if ( !function_exists( 'swm_standard_pagination' ) ) {	
	function swm_standard_pagination() {
		
		$arrowPrev = is_rtl() ? 'fa fa-angle-right' : 'fa fa-angle-left';
		$arrowNext = is_rtl() ? 'fa fa-angle-left' : 'fa fa-angle-right';
		
		global $wp_query;
		$total = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		$output = '';
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			
			$output = paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				"add_args" 		=> false,
				'type' 			=> 'list',
				'prev_text'	=> '<i class="'. $arrowPrev .'"></i>',
				'next_text'	=> '<i class="'. $arrowNext .'"></i>',
			 ) );
		}

		echo apply_filters( 'swm_standard_pagination', $output );
	}	
}

// Next - Previous links
if ( !function_exists( 'swm_next_prev_links' ) ) {	
	function swm_next_prev_links() {

		$output = '';
		$output .= '<div class="alignleft post-prev">';
		$output .= get_previous_posts_link('&larr; '. esc_html__( 'Previous', 'election' ) );
		$output .= '</div>';
		$output .= '<div class="alignright post-next">';
		$output .= get_next_posts_link( esc_html__( 'Next', 'election' ) .' &rarr;');
		$output .= '</div>';

		return apply_filters( 'swm_next_prev_links', $output );
	}
}

// Next - Previous Pagination
if ( !function_exists( 'swm_next_prev_pagination' ) ) {	
	function swm_next_prev_pagination( $pages = '', $range = 4 ) {
		$output = '';
		$showitems = ($range * 2)+1; 
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if( $pages == '' ) {
		   global $wp_query;
		   $pages = $wp_query->max_num_pages;
		   if(!$pages) {
			   $pages = 1;
		   }
		}  
		
		if( 1 != $pages ) {
		  	$output .= '<div class="next_prev_pagination clear">';
			$output .= swm_next_prev_links();
		  	$output .= '</div>';
		}		
		
		echo apply_filters( 'swm_next_prev_pagination', $output );
	}
}

// Infinite Scroll Pagination
if ( !function_exists( 'swm_infinite_scroll_pagination' ) ) {	
	function swm_infinite_scroll_pagination() {		
		
		wp_enqueue_script( 'swm_infinite_scroll', SWM_THEME_DIR .'/js/infinitescroll.js', 'jquery','1.0', TRUE );		
		$translation_array_IS = array( 'loadingMessage' => esc_html__( 'Loading...', 'election' ) );
		wp_localize_script( 'swm_infinite_scroll', 'swmInfiniteScrollMessage', $translation_array_IS );			
		
		$output = '';
		$output .= '<div class="infiniteScroll_pagination clr">';
		$output .= swm_next_prev_links();
		$output .= '</div>';
		
		echo apply_filters( 'swm_next_prev_pagination', $output );
	}	
}


if ( !function_exists( 'swm_pagination' ) ) {
	function swm_pagination($pagination_style) {			
		
		if ( $pagination_style == 'infinite-scroll' ) {
			swm_infinite_scroll_pagination();
		} elseif ( $pagination_style == 'next-prev' ) {
			swm_next_prev_pagination();
		} else {
			swm_standard_pagination();
		}		
	}
}

if ( !function_exists( 'swm_blog_pagination' ) ) {
	function swm_blog_pagination() {		
		
		$pagination_style = get_theme_mod( 'swm_blog_pagination_style', 'standard' );		
		
		if ( $pagination_style == 'infinite-scroll' ) {
			swm_infinite_scroll_pagination();
		} elseif ( $pagination_style == 'next-prev' ) {
			swm_next_prev_pagination();
		} else {
			swm_standard_pagination();
		}		
		
	}
}


/* ---------------------------------------------------------------------------------------- 
	Search Form
---------------------------------------------------------------------------------------- */

if (!function_exists('swm_search_page_form')) {
	function swm_search_page_form() {

		global $wp_query;
		
		$output = '';

		$output .= '<div class="search_page_form">';
		$output .= '<h4>' . esc_html__('No Results Found for "', 'election') . get_search_query() . '"</h4>';		
		$output .= "<p>" . esc_html__(' We\'re sorry, but the page you requested could not be found. Try refining your search, or use the navigation above to locate the post.', 'election') . "</p>";
		$output .= '</div>';

		echo apply_filters( 'swm_search_page_form', $output );
	}
}

/* ************************************************************************************** 
	Portfolio Thumbnail, Title
************************************************************************************** */

if (!function_exists('swm_portfolio_thumb_title')) {
	function swm_portfolio_thumb_title() {
		
		global $swm_pf_display_column,$swm_onoff_pf_prettyphoto,$swm_onoff_pf_readmore,$swm_pf_display_excerpt_category,$swm_pf_item_title_link;
		
		$postid					= get_the_ID();
		$thumb 					= null;	
		$swm_pf_project_type	= get_post_meta($postid, 'swm_portfolio_project_type', true );	
		$video 					= get_post_meta($postid, 'swm_portfolio_video', true);	
		$permalink 				= get_permalink( $postid  );
		$title 					= get_the_title( $postid  );
		$swm_attached_image 	= wp_get_attachment_url(get_post_thumbnail_id($postid));	
		$output = '';


		if ($swm_pf_project_type == "video" && $video != '') {
			$large_view = $video;
		} else {
			$large_view = $swm_attached_image;		
		}

		if ( $swm_onoff_pf_prettyphoto) {
			$show_lightbox = 'data-rel="prettyPhoto[mygallery1]"';			
			$img_link = $large_view;

			if ($swm_pf_project_type == "video" && $video != '') {
				$hover_icon = 'icon_play';
			}else {
				$hover_icon = 'icon_zoom';
			}

		} else {
			$show_lightbox = '';
			$img_link = get_permalink($postid);
			$hover_icon = 'icon_link';
		}

		switch ($swm_pf_display_column) {
			case '2': $image_size = 'portfolio-2'; break;
			case '3': $image_size = 'portfolio-3'; break;
			default: $image_size = 'portfolio-4'; break;
		}				

		// thumb image
		$output .= '<div class="thumb_img"><a '.$show_lightbox .' title="" href="'.$img_link.'">';
		$output .= '<div class="swm_portfolio_img_hovericon '.$hover_icon.'"></div>';		
		$output .= '<div class="swm_portfolio_img_overlay"></div>';
		$output .= get_the_post_thumbnail($postid, $image_size); 
		$output .= '</a></div>';	

		$output .= '<div class="swm-arrow-up arrow-portfolio"><span></span></div>';		
		
		// title and excerpt
		$output .= '<div class="swm_portfolio_text">';
			$output .= '<div class="swm_portfolio_title_section ">';
				$output .= '<div class="project_title swm_portfolio_text_style">';

					if ( $swm_pf_item_title_link ) {
						$output .= '<span class="portfolio_title"><a href="'.$permalink.'" rel="bookmark" title="'.$title.'">'.$title .'</a></span>';
					} else {
						$output .= '<span class="portfolio_title">'.$title.'</span>';
					}

						if ($swm_pf_display_excerpt_category == 'Display_Excerpt' || $swm_pf_display_excerpt_category == 'Display_Category_Names' ) {
							
							if ($swm_pf_display_excerpt_category == 'Display_Excerpt') {
							
								if ( has_excerpt() ) {
									$output .= '<span class="subtexts">'.get_the_excerpt().'</span>';		
								}

							} else {
								$output .= '<span class="subtexts">';
								$terms = get_the_terms( $postid, 'portfolio-categories' );
								$count = count($terms); $i=0;
								if ($count > 0) {
									if ( !empty( $terms ) ) {
										foreach ( $terms as $term ) {
											 $i++;
											$output .= $term->name;
											if ($count != $i) $output .= ', ';
										}
									}
								}
								$output .= '</span>';
							}
							
							if ( $swm_onoff_pf_readmore ) {							
								$output .= swm_portfolio_read_more();
							}
						}

				$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="clear"></div>';
		$output .= '</div>';
		
		echo $output;
		
	}
}

/* ===== Sortable Portfolio Categories List ===== */
if ( !class_exists( 'Portfolio_Walker' ) ) {
	class Portfolio_Walker extends Walker_Category {
		function start_el( &$output, $object, $depth = 0, $args = Array(), $current_object_id = 0 ) {
			
			extract($args);
			
			$cat_name = esc_attr( $object->name);		
			$cat_name = apply_filters( 'list_cats', $cat_name, $object );
			$link = '<a href="#" data-filter=".'.strtolower(preg_replace('/\s+/', '-', $cat_name)).'" title="'.$cat_name.'">'.$cat_name.'</a> ';			

			if ( isset($show_count) && $show_count )
				$link .= ' (' . intval($object->count) . ')';
			if ( isset($show_date) && $show_date ) {
				$link .= ' ' . gmdate('Y-m-d', $object->last_update_timestamp);
			}
			if ( isset($current_category) && $current_category )
				$_current_category = get_category( $current_category );
			if ( 'list' == $args['style'] ) {
				$output .= "<li>$link";			
			} else {
				$output .= "\t$link<br />\n";
			}
		}
	}
}

/* ************************************************************************************** 
	Page Title
************************************************************************************** */

if (!function_exists('swm_page_title')) {
	function swm_page_title($title='') {

		global $post;
		$swm_get_queried_object_id = get_queried_object_id();

		if ( is_front_page() && !is_singular('page') ) {

			$title = get_bloginfo( 'description' );	

		} elseif ( is_archive() ) {

			if ( is_day() ) {  
				$title = sprintf( esc_html__( 'Archive: %s', 'election' ), get_the_date() );
			} 
			elseif ( is_month() ) {
				$title = sprintf( esc_html__( 'Archive: %s', 'election' ), get_the_date('F Y') );
			}
			elseif ( is_year() ) {
				$title = sprintf( esc_html__( 'Archive: %s', 'election' ), get_the_date('Y') );				
			} 
			elseif ( is_author() ) {					
			$title = esc_html__( 'Author Archives', 'election' );			
			}	
			else {
				$title = single_term_title( '', false );
			}
		} elseif ( is_category() ) { 
			global  $wp_query;
			$termname = $wp_query->queried_object->name;
			$title =  $termname;	
			//echo single_cat_title();				
		}			
		
		elseif ( is_search() ) {
			$title = esc_html__( 'Search', 'election' );	
		}
		elseif ( is_attachment() ) {
			$title = get_the_title();
		}		
		elseif ( is_404() ) {
									
			if ( class_exists( 'WPML_String_Translation' ) ) {
				$title = icl_translate('Theme Mod', 'swm_error_title', get_theme_mod( 'swm_error_title' ));
			} else {
				$title = do_shortcode( get_theme_mod('swm_error_title') ); 
			}
			
		}
		elseif ( is_single() ) {	
			
			$category = get_the_category();
			$postType = get_post_type();
					
			if ($postType == 'post') { 	

				$single_pg_title = get_theme_mod( 'swm_single_page_title' );
				$swm_blog_page_url = get_theme_mod( 'swm_blog_page_url' );

				if ($single_pg_title != '' ) {					
					$title = '<a href="'.$swm_blog_page_url.'">' . $single_pg_title . '</a>';
				} else {
					$title = get_the_title();
				}			
				
			}
			
			if ($postType == 'portfolio') {
				$title = get_the_title();
			}

			if ($postType == 'product') {
				$title = get_the_title();							    
			}
		}		
		else {
			$post_id = isset( $post->ID ) ? $post->ID : null;
			$title = get_the_title($post_id);
		} //end main if else		

		//event calendar pages
		if ( SWM_TRIBE_EVENTS_IS_ACTIVE && !is_front_page() && !is_singular('page') && !is_search() ) {

			$event_pt_event_single = esc_html__('Event Details', 'election');
    		$event_pt_event_single = apply_filters( 'swm_event_single_title_text', $event_pt_event_single );

    		$swm_get_event_pages_title_text = esc_html__('Events', 'election');
    		$swm_get_event_pages_title_text = apply_filters( 'swm_event_pages_title_text', $swm_get_event_pages_title_text );
			$event_pt = '<a href="' . tribe_get_events_link().'">'. $swm_get_event_pages_title_text .'</a>';

            if ( tribe_is_upcoming()) {
                $title = $event_pt;              
            } elseif( tribe_is_past() ) {
				$title = $event_pt;
			} elseif( tribe_is_month() && !is_tax() ) {
				$title = $event_pt;
			} elseif( tribe_is_month() && is_tax() ) { 
				$title = $event_pt;
			} elseif( tribe_is_event() && !tribe_is_day() && !is_single() ) {
				$title = $event_pt;
			} elseif( tribe_is_event($swm_get_queried_object_id) && is_single() ) {
				$title = $event_pt_event_single;
			} elseif( tribe_is_day() ) {
				$title = $event_pt;
			} elseif( tribe_is_venue() ) {	
				$title = $event_pt;
			}

			if ( SWM_TRIBE_EVENTS_PRO_IS_ACTIVE ) {
				if ( tribe_is_week()) {
               		$title = $event_pt;              
	            } elseif( tribe_is_map() ) {
					$title = $event_pt;
				} elseif( tribe_is_photo() && !is_tax() ) {
					$title = $event_pt;
				}
			}

		}

		if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {
			
			if ( is_shop() ) {
				$title = woocommerce_page_title($echo = false);
			}	
			elseif ( is_product_category() ) {
				$title = single_cat_title('',false);
			}	
			elseif ( is_product_tag() ) {			
				$title = sprintf( __( '%s', 'election' ), single_tag_title('',false) );
			}	
			
		}	

		return $title;
		
	}
}

if (!function_exists('swm_override_page_title')) {
	function swm_override_page_title() {
		return false;
	}
}
add_filter('woocommerce_show_page_title', 'swm_override_page_title');

/* ************************************************************************************** 
	Get Page Post ID
************************************************************************************** */

if (!function_exists('swm_get_id')) {
	function swm_get_id() {
		global $post;
		$post_id = isset( $post->ID ) ? $post->ID : null ;
		return $post_id;
	}
}


/* ************************************************************************************** 
	GET COMMENTS NUMBER
************************************************************************************** */

if( ! function_exists( 'swm_get_comments_number' ) ) {
	function swm_get_comments_number() {

		$swm_num_comments = get_comments_number();

		if ( $swm_num_comments == 0 ) {
			$output =  esc_html__('No Comments','spiritual');
		} elseif ( $swm_num_comments > 1 ) {
			$output =  $swm_num_comments . esc_html__(' Comments','spiritual');
		} else {
			$output =  esc_html__('1 Comment','spiritual');
		}

		echo apply_filters( 'swm_get_comments_number', $output );
	}
}
