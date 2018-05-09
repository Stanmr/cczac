<?php
if ( !class_exists( 'SWM_offer_widget' ) ) {
    class SWM_offer_widget extends WP_Widget {

        function __construct() {       
            $widget_ops = array('classname' => '', 'description' => __('Add special offer or donation details','__poli-shortcodes__'));
            $control_ops = array('height' => 450);       
            parent::__construct('offer-widget', __('Widget - Special Offer','__poli-shortcodes__'), $widget_ops, $control_ops);
        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $small_desc = apply_filters( 'widget_text', empty( $instance['small_desc'] ) ? 'small description' : $instance['small_desc'], $instance );   
            $open_new_window = $instance['open_new_window'] ? '1' : '0';
            $icon_name = !empty($instance['icon_name']) ? $instance['icon_name'] : 'fa-gift' ;
            $box_link = !empty($instance['box_link']) ? $instance['box_link'] : '#' ;            

            $target = ( $open_new_window == 1 ) ?  "_blank" : "_self";

    		$output = '';

            $output .= '<div class="swm_special_offer">';            
    		$output .= '<div class="offer_content">';
            $output .= '<a href="'.$box_link.'" target="'.$target.'" >';
            $output .= '<span class="offer_title">'.$title.'</span>';
    		$output .= '<span class="offer_desc">'.$small_desc.'</span>';
            $output .= '</a>';
            $output .= '</div>';
            $output .= '<div class="offer_icon"><a href="'.$box_link.'" target="'.$target.'" ><i class="fa '.$icon_name.'"></i></a></div>';
            $output .= '</div>';

            echo $output;    		
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);     
            if ( current_user_can('unfiltered_html') ) {
                $instance['small_desc'] =  $new_instance['small_desc'];           
            } else {
                $instance['small_desc'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['small_desc']) ) );
            } 
            $instance['open_new_window'] = !empty($new_instance['open_new_window']) ? 1 : 0;
            $instance['icon_name'] = stripslashes($new_instance['icon_name']);
            $instance['box_link'] = stripslashes($new_instance['box_link']);

            return $instance;
        }

        function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, array( 
            'title' => 'Special Offer', 
            'icon_name' => 'fa-gift', 
            'small_desc' => 'small description',
            'box_link' => '#', 
            'open_new_window' => 0
            
    		) );
            $title = strip_tags($instance['title']);
            $small_desc = esc_textarea($instance['small_desc']);      
    		
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', '__poli-shortcodes__'); ?></label><br />
            <input style="width:99%;"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p>
                <label for="<?php echo $this->get_field_id( 'icon_name' ); ?>"><?php _e('Icon Name:', '__poli-shortcodes__') ?></label>
                <input id="<?php echo $this->get_field_id( 'icon_name' ); ?>" name="<?php echo $this->get_field_name( 'icon_name' ); ?>" value="<?php echo $instance['icon_name']; ?>" style="width:95%;" /><br >
                <small><?php _e('Add icon name e.g. fa-star, fa-gift. You can refer icon name from this page : <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">FontAwesome Icons</a>', '__poli-shortcodes__') ?></small>
            </p>                
    		
    		<p><label for="<?php echo $this->get_field_id('small_desc'); ?>"><?php _e('Small Description:', '__poli-shortcodes__'); ?></label><br />
    		<textarea  class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('small_desc'); ?>" name="<?php echo $this->get_field_name('small_desc'); ?>"><?php echo $small_desc; ?></textarea></p>	   

            <p>
                <label for="<?php echo $this->get_field_id( 'box_link' ); ?>"><?php _e('Link on Box:', '__poli-shortcodes__') ?></label>
                <input id="<?php echo $this->get_field_id( 'box_link' ); ?>" name="<?php echo $this->get_field_name( 'box_link' ); ?>" value="<?php echo $instance['box_link']; ?>" style="width:95%;" /><br >                
            </p> 

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['open_new_window'], true) ?> id="<?php echo $this->get_field_id('open_new_window'); ?>" name="<?php echo $this->get_field_name('open_new_window'); ?>" />
                <label for="<?php echo $this->get_field_id('open_new_window'); ?>"><?php _e('Open linked page in new window', '__poli-shortcodes__') ?></label> 
            </p>

            <?php
        }
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "SWM_offer_widget" );' ) );
