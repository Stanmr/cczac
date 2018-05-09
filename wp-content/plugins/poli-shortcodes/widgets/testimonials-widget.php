<?php

function SWM_Testimonials_Widget_Display() {
	register_widget('SWM_Testimonials_Widget');
}

add_action('widgets_init', 'SWM_Testimonials_Widget_Display');
if ( !class_exists( 'SWM_Testimonials_Widget' ) ) {
	class SWM_Testimonials_Widget extends WP_Widget {
		
	    function __construct() {			
			$widget_ops = array( 'classname' => '', 'description' => __('Display Testimoinals with Rotation', '__poli-shortcodes__') );				
			parent::__construct( 'testimonials-widget', __('Widget - Testimonials', '__poli-shortcodes__'), $widget_ops );
		}
			
		function widget( $args, $instance ) {
			extract( $args );

			/* User-selected settings. */
			$swm_testimonials_title = apply_filters('widget_title', $instance['title'] );
			$animation_type = apply_filters('animation_type', $instance['animation_type'] );
			$open_new_window = $instance['open_new_window'] ? '1' : '0';
			$hide_client_image = $instance['hide_client_image'] ? '1' : '0';		
			$auto_slideshow = $instance['auto_slideshow'] ? 'true' : 'false';
			$pause_slideshow = $instance['pause_slideshow'] ? 'true' : 'false';
			$smooth_height = $instance['smooth_height'] ? 'true' : 'false';
			$display_navigation = $instance['display_navigation'] ? 'true' : 'false';
			$testimonials_word_limit = !empty($instance['testimonials_word_limit']) ? $instance['testimonials_word_limit'] : '40' ;
			$testimonials_post_limit = !empty($instance['testimonials_post_limit']) ? $instance['testimonials_post_limit'] : '' ;
			$slideshow_speed = !empty($instance['slideshow_speed']) ? $instance['slideshow_speed'] : '500' ;
			$slideshow_interval = !empty($instance['slideshow_interval']) ? $instance['slideshow_interval'] : '500' ;
			
			echo $before_widget;		
			echo $before_title.$swm_testimonials_title.$after_title;		
			
			rewind_posts();
			wp_reset_query();		
			
			echo '<div class="testimonials-bx-slider-wrap">';
			echo '<div class="testimonials-bx-slider" data-animationType="'.$animation_type.'" data-autoSlideshow="'.$auto_slideshow.'" data-slideshowSpeed="'.$slideshow_speed.'" data-slideshowInterval="'.$slideshow_interval.'" data-pauseHover="'.$pause_slideshow.'" data-displayNavigation="'.$display_navigation.'" data-smoothHeight="'.$smooth_height.'" >';
			
				$count 		=	1;
				$itemlimit 	=	-1;		
				$pageid 	= 	get_the_ID();							
				
				$args = array(
					'post_type' => 'testimonials',
					'orderby'=>'menu_order',
					'order' => 'ASC',			
					'showposts' => $testimonials_post_limit,	
					'type' => get_query_var('type')					      	 	
					);

				$query = new WP_Query( $args );
				
				while ($query->have_posts()) : $query->the_post();					
					
					$swm_website_url = get_post_meta(get_the_ID(), 'swm_website_url', TRUE); 
					$swm_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
					$swm_client_details = get_post_meta(get_the_ID(), 'swm_client_details', TRUE);
					$post_id = get_the_ID();
					$client_name = get_the_title();
					
					$words = explode(" ",strip_tags(get_the_excerpt()));
					$content = implode(" ",array_splice($words,0,$testimonials_word_limit));

					echo '<div class="testimonial_box_spacer swm_testimonials_block">';
					echo '<div class="testimonial_box">';
					echo '<p>'.$content.'</p>';	
					echo '</div>';	
					
					echo '<div class="client_details">';				

					if ( $swm_featured_image && $hide_client_image == 0 ) {
				
						echo '<div class="client_img_link">';
						echo '<span class="client_image">'.get_the_post_thumbnail($post_id, 'testimonial').'</span>';

						if ($swm_website_url) {				
							echo '<span class="icon_url"><a href="'.$swm_website_url.'" title=""><i class="fa fa-link"></i></a></span>';
						}

						echo '</div>';

					}				

					echo '<div class="client_name_position">';
					echo '<h5>'.$client_name.'</h5>';

					if ($swm_client_details) {
						echo '<span>'.$swm_client_details.'</span>'; 
					}

					echo '</div>';					
					echo '<div class="clear"></div>';
					echo '</div>';

					
					echo '</div>';


					$count++; 				
				endwhile; 
			echo'</div>';		
			echo '<div class="clear"></div>';		

			echo'</div>';
		
			echo $after_widget;
		}	
		
		/*Saves the settings. */
	    function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = stripslashes($new_instance['title']);		
			$instance['animation_type'] = stripslashes($new_instance['animation_type']);	
			$instance['open_new_window'] = !empty($new_instance['open_new_window']) ? 1 : 0;
			$instance['hide_client_image'] = !empty($new_instance['hide_client_image']) ? 1 : 0;		
			$instance['auto_slideshow'] = !empty($new_instance['auto_slideshow']) ? true : false;
			$instance['pause_slideshow'] = !empty($new_instance['pause_slideshow']) ? true : false;
			$instance['smooth_height'] = !empty($new_instance['smooth_height']) ? true : false;
			$instance['display_navigation'] = !empty($new_instance['display_navigation']) ? true : false;
			$instance['testimonials_word_limit'] = stripslashes($new_instance['testimonials_word_limit']);
			$instance['testimonials_post_limit'] = stripslashes($new_instance['testimonials_post_limit']);
			$instance['slideshow_speed'] = stripslashes($new_instance['slideshow_speed']);
			$instance['slideshow_interval'] = stripslashes($new_instance['slideshow_interval']);

			return $instance;
		}
		
		function form( $instance ) {

			/* Set up some default widget settings */
			
			$defaults = array( 
				'title' => __('Testimonials', '__poli-shortcodes__'), 
				'open_new_window' => true,
				'hide_quote_icon' => false,			
				'hide_client_image' => false,			
				'testimonials_word_limit' => 40,
				'testimonials_post_limit' => '',
				'animation_type' => 'fade',	
				'slideshow_speed' => 500,	
				'slideshow_interval' => 4000,	
				'auto_slideshow' => true,	
				'pause_slideshow' => true,	
				'smooth_height' => true,	
				'display_navigation' => true,	
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			$title = htmlspecialchars($instance['title']);		
			$animation_type = htmlspecialchars($instance['animation_type']);
			$open_new_window = isset($instance['open_new_window']) ? (bool) $instance['open_new_window'] :false;	
			$hide_client_image = isset($instance['hide_client_image']) ? (bool) $instance['hide_client_image'] :false;	
			$auto_slideshow = isset($instance['auto_slideshow']) ? (bool) $instance['auto_slideshow'] :true;
			$pause_slideshow = isset($instance['pause_slideshow']) ? (bool) $instance['pause_slideshow'] :true;
			$smooth_height = isset($instance['smooth_height']) ? (bool) $instance['smooth_height'] :true;
			$display_navigation = isset($instance['display_navigation']) ? (bool) $instance['display_navigation'] :true;
			$testimonials_word_limit = $instance['testimonials_word_limit'];
			$testimonials_post_limit = $instance['testimonials_post_limit'];
			$slideshow_speed = $instance['slideshow_speed'];
			$slideshow_interval = $instance['slideshow_interval'];
			
			

			?>
			
			<p>
				<small><?php _e('Add Clients Testimonials from left sidebar menu "Testimonials" > Add New', '__poli-shortcodes__') ?></small>
			</p>
			
			<hr />
			
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', '__poli-shortcodes__') ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
			</p>
			
			<hr />

			<p>
				<label for="<?php echo $this->get_field_id( 'testimonials_word_limit' ); ?>"><?php _e('Word Limit:', '__poli-shortcodes__') ?></label>
				<input id="<?php echo $this->get_field_id( 'testimonials_word_limit' ); ?>" name="<?php echo $this->get_field_name( 'testimonials_word_limit' ); ?>" value="<?php echo $instance['testimonials_word_limit']; ?>" style="width:95%;" /><br >
				<small><?php _e('Set word limit of testimonial, leave it blank for full testimonial.', '__poli-shortcodes__') ?></small>
			</p>
			<hr />

			<p>
				<label for="<?php echo $this->get_field_id( 'animation_type' ); ?>"><?php _e('Animation Style', '__poli-shortcodes__') ?></label>
				<input id="<?php echo $this->get_field_id( 'animation_type' ); ?>" name="<?php echo $this->get_field_name( 'animation_type' ); ?>" value="<?php echo $instance['animation_type']; ?>" style="width:95%;" /><br >
				<small><?php _e('Type of transition between slides:<br /> horizontal, fade', '__poli-shortcodes__') ?></small>
			</p>
			<hr />

			<p>
				<label for="<?php echo $this->get_field_id( 'slideshow_speed' ); ?>"><?php _e('Slideshow Speed', '__poli-shortcodes__') ?></label>
				<input id="<?php echo $this->get_field_id( 'slideshow_speed' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_speed' ); ?>" value="<?php echo $instance['slideshow_speed']; ?>" style="width:95%;" /><br >
				<small><?php _e('Slide transition duration (in ms)', '__poli-shortcodes__') ?></small>
			</p>
			<hr />

			<p>
				<label for="<?php echo $this->get_field_id( 'slideshow_interval' ); ?>"><?php _e('Slideshow Interval', '__poli-shortcodes__') ?></label>
				<input id="<?php echo $this->get_field_id( 'slideshow_interval' ); ?>" name="<?php echo $this->get_field_name( 'slideshow_interval' ); ?>" value="<?php echo $instance['slideshow_interval']; ?>" style="width:95%;" /><br >
				<small><?php _e('The amount of time (in ms) between each auto transition', '__poli-shortcodes__') ?></small>
			</p>
			<hr />

			<p>
				<label for="<?php echo $this->get_field_id( 'testimonials_post_limit' ); ?>"><?php _e('Number of Testimonials to Display:', '__poli-shortcodes__') ?></label>
				<input id="<?php echo $this->get_field_id( 'testimonials_post_limit' ); ?>" name="<?php echo $this->get_field_name( 'testimonials_post_limit' ); ?>" value="<?php echo $instance['testimonials_post_limit']; ?>" style="width:95%;" /><br >
				<small><?php _e('Set testimoinals slides limit, leave it blank to slide all testimonials.', '__poli-shortcodes__') ?></small>
			</p>

			<hr /><br />
			
			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['open_new_window'], true) ?> id="<?php echo $this->get_field_id('open_new_window'); ?>" name="<?php echo $this->get_field_name('open_new_window'); ?>" />
				<label for="<?php echo $this->get_field_id('open_new_window'); ?>"><?php _e('Open client\'s website in <strong>New Window</strong>', '__poli-shortcodes__') ?></label>	
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['hide_client_image'], true) ?> id="<?php echo $this->get_field_id('hide_client_image'); ?>" name="<?php echo $this->get_field_name('hide_client_image'); ?>" />
				<label for="<?php echo $this->get_field_id('hide_client_image'); ?>"><?php _e('Hide <strong>Client Image</strong>', '__poli-shortcodes__') ?></label>		
			</p>
			
			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['auto_slideshow'], true) ?> id="<?php echo $this->get_field_id('auto_slideshow'); ?>" name="<?php echo $this->get_field_name('auto_slideshow'); ?>" />
				<label for="<?php echo $this->get_field_id('auto_slideshow'); ?>"><?php _e('Auto Slideshow', '__poli-shortcodes__') ?></label>		
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['pause_slideshow'], true) ?> id="<?php echo $this->get_field_id('pause_slideshow'); ?>" name="<?php echo $this->get_field_name('pause_slideshow'); ?>" />
				<label for="<?php echo $this->get_field_id('pause_slideshow'); ?>"><?php _e('Pause Slideshow on mouseover', '__poli-shortcodes__') ?></label>		
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['smooth_height'], true) ?> id="<?php echo $this->get_field_id('smooth_height'); ?>" name="<?php echo $this->get_field_name('smooth_height'); ?>" />
				<label for="<?php echo $this->get_field_id('smooth_height'); ?>"><?php _e('Smooth Auto Height', '__poli-shortcodes__') ?></label>		
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['display_navigation'], true) ?> id="<?php echo $this->get_field_id('display_navigation'); ?>" name="<?php echo $this->get_field_name('display_navigation'); ?>" />
				<label for="<?php echo $this->get_field_id('display_navigation'); ?>"><?php _e('Display Navigation Arrows', '__poli-shortcodes__') ?></label>		
			</p>
			
			<hr />
			
			
			<?php	
		}
	}
}	