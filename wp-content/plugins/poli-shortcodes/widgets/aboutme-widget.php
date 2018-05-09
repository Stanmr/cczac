<?php
if ( !class_exists( 'SWM_aboutme' ) ) {
	class SWM_aboutme extends WP_Widget {

	    function __construct() {       
	        $widget_ops = array('classname' => '', 'description' => __('Short description about person','__poli-shortcodes__'));
	        $control_ops = array('width' => 400, 'height' => 350);       
	        parent::__construct('aboutme-widget', __('Widget - About Me','__poli-shortcodes__'), $widget_ops, $control_ops);
	    }

	    function widget( $args, $instance ) {
	        extract($args);
	        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );	        
	        $image_url = apply_filters( 'widget_text', empty( $instance['image_url'] ) ? '' : $instance['image_url'], $instance );			
			$social_icons = apply_filters( 'widget_text', empty( $instance['social_icons'] ) ? '' : $instance['social_icons'], $instance );		
			$person_bio = apply_filters( 'widget_text', empty( $instance['person_bio'] ) ? '' : $instance['person_bio'], $instance );

			echo '<div class="aboutme_widget_wrap">';			
			echo '<div class="aboutme_widget">';
			
			if ( !empty( $image_url ) ) { 
				echo '<div class="person_img">';
				echo '<img src="'.$image_url.'" alt="" />'; 
				echo '</div>';
			}

			 if ( !empty( $title ) ) {						
			 	echo '<div class="person_name"><h3>'.$title.'</h3></div>';
			}

			if ( !empty( $person_bio ) ) { 
				echo '<div class="person_bio"><p>'.$person_bio.'</p></div>';				
			}

			if ( !empty( $social_icons ) ) { 
				echo '<div class="aboutme_social">'.$social_icons.'<div class="clear"></div></div>';				
			}
			
			echo '<div class="clear"></div>';
			echo '</div>';	        
			echo '</div>';
			
	    }

	    function update( $new_instance, $old_instance ) {
	        $instance = $old_instance;
	        $instance['title'] = strip_tags($new_instance['title']);
	        $instance['contact_email'] = esc_attr($new_instance['contact_email']);
	        if ( current_user_can('unfiltered_html') ) {
	            $instance['contact_address'] =  $new_instance['contact_address'];
	            $instance['image_url'] =  $new_instance['image_url'];			
				$instance['social_icons'] =  $new_instance['social_icons'];
				$instance['person_bio'] =  $new_instance['person_bio'];
	        } else {
	            $instance['contact_address'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['contact_address']) ) );
	            $instance['image_url'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['image_url']) ) );			
				$instance['social_icons'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['social_icons']) ) );
				$instance['person_bio'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['person_bio']) ) );
	        } 		
	        return $instance;
	    }

	    function form( $instance ) {
	    	$person_image = SWM_PLUGIN_URL . 'images/person.jpg';
	        $instance = wp_parse_args( (array) $instance, array( 
			'title' => 'About John Doe', 			
			'image_url' => $person_image,
			'person_bio' => 'Donec egestas augue eget mi viver on ultricies sem mattis dsfdr. Nam nec mollis sapien. Fusce sit amet ipsum nulla. Proin ac est lectus.', 
			'social_icons' => '[social_media_icons] [fa-twitter-square link="#"] [fa-facebook-square link="#"] [fa-pinterest-square link="#"] [fa-vimeo-square link="#"] [/social_media_icons]',
			) );
	        $title = strip_tags($instance['title']);
	        $image_url = esc_textarea($instance['image_url']);
			$social_icons = esc_textarea($instance['social_icons']);			
			$person_bio = esc_textarea($instance['person_bio']);
			
			?>
	        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Person Name:', '__poli-shortcodes__'); ?></label><br />
	        <input style="width:99%;"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
	        
	        <p><label for="<?php echo $this->get_field_id('person_bio'); ?>"><?php _e('Person Bio Text:', '__poli-shortcodes__'); ?></label><br />
			<textarea  class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('person_bio'); ?>" name="<?php echo $this->get_field_name('person_bio'); ?>"><?php echo $person_bio; ?></textarea></p>
			
			<p><label for="<?php echo $this->get_field_id('social_icons'); ?>"><?php _e('Social Media Icons:', '__poli-shortcodes__'); ?></label><br />
			<textarea  class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('social_icons'); ?>" name="<?php echo $this->get_field_name('social_icons'); ?>"><?php echo $social_icons; ?></textarea></p>         
	       
			<p><label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Person Image URL:', '__poli-shortcodes__'); ?></label><br />
			<textarea  class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>"><?php echo $image_url; ?></textarea></p>
	       
			<?php
	    }
	}
}
add_action( 'widgets_init', create_function( '', 'register_widget( "SWM_aboutme" );' ) );
