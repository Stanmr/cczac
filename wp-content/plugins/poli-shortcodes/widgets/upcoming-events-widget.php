<?php 

if ( !class_exists( 'SWM_Upcoming_Events' ) ) {
	class SWM_Upcoming_Events extends WP_Widget {
	    function __construct() {
			$widget_ops = array('description' => __('Display upcoming events', '__poli-shortcodes__'));	
			parent::__construct('swm_upcoming_events_wid',$name = __('Widget - Upcoming Events', '__poli-shortcodes__'),$widget_ops);
	    }

	  	/* Displays the Widget in the front-end */
	    function widget($args, $instance){
			extract($args);

			global $wp_query, $tribe_ecp, $post;

			$title = apply_filters('widget_title', !empty($instance['title']) ? $instance['title'] : __('Upcoming Events', '__poli-shortcodes__') );
			$no_of_posts = !empty($instance['no_of_posts']) ? $instance['no_of_posts'] : '6' ;			

			echo $before_widget;
			echo $before_title . $title . $after_title;		
			echo '<div class="recent_posts_square_posts uc_events_widget">';
			echo '<ul>';				

			if ( function_exists( 'tribe_get_events' ) ) {

				$args = array(
					'eventDisplay'   => 'upcoming',
					'posts_per_page' => $no_of_posts,
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
			
			if ( $posts ) {
			/* Display list of events. */
			
				foreach( $posts as $post ) :
					setup_postdata( $post );
						
					$date_day 		= tribe_get_start_date(null, false, 'd');    
					$date_month		= tribe_get_start_date(null, false, 'M');
					$date_year		= tribe_get_start_date(null, false, 'Y');
					$date_time		= tribe_get_start_date(null, false, 'l - g:i a');

            		$venue_name 	= tribe_get_venue();
				
					echo '<li>';		
					echo '<div class="recent_posts_square_date"><a href="' . tribe_get_event_link() . '">' . $date_day;		
					echo '<span class="d_month">' . $date_month .'</span></a>';					
					echo '</div>';
					
					echo '<div class="recent_posts_square_content">';
					echo '<div class="recent_posts_square_title"><a href="' . tribe_get_event_link() . '">' . get_the_title() . '</a></div>';					
					echo '<div class="grid_date uc_events">';			
					echo '<span><i class="fa fa-clock-o"></i><a href="'.tribe_get_event_link().'">'.$date_time.'</a></span>';
					echo '<span><i class="fa fa-map-marker"></i><a href="' . tribe_get_event_link() . '">'.$venue_name.'</a></span>';
					echo '</div>';

					echo '</div>';
					echo '<div class="clear"></div>';
					
					echo '</li>';

				endforeach;

			} else {
				$output .= '<p>' . __( 'There are no upcoming events at this time.', 'tribe-events-calendar' ) . '</p>';
			}	
			echo '</ul>';
			echo '<div class="clear"></div>';
			echo '</div>';		
			echo $after_widget;		
		}

	  /*Saves the settings. */
	    function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = stripslashes($new_instance['title']);
			$instance['no_of_posts'] = stripslashes($new_instance['no_of_posts']);		
			
			return $instance;
		}
		
	    function form($instance){
			//Defaults
			$instance = wp_parse_args( (array) $instance, array(
				'title'=> __('Upcoming Events', '__poli-shortcodes__'), 
				'no_of_posts'=>'3'
			));

			$title = htmlspecialchars($instance['title']);
			$no_of_posts = $instance['no_of_posts'];		
			
			echo '<p><label for="' . $this->get_field_id('title') . '">' . __('Widget Title:', '__poli-shortcodes__') . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
			
			echo '<p><label for="' . $this->get_field_id('no_of_posts') . '">' . __('Number of Events to Display:', '__poli-shortcodes__') . '</label><input class="widefat" id="' . $this->get_field_id('no_of_posts') . '" name="' . $this->get_field_name('no_of_posts') . '" type="text" value="' . $no_of_posts . '" /></p>';			
		}
	}
}

function SWM_Upcoming_Events_Widget() {
  register_widget('SWM_Upcoming_Events');
}
add_action('widgets_init', 'SWM_Upcoming_Events_Widget');

?>