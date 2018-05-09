<?php
if ( !class_exists( 'SWM_Categories_Widget' ) ) {
    class SWM_Categories_Widget extends WP_Widget {

        function __construct() {
            $widget_ops = array( 'classname' => 'widget_categories', 'description' => __( "My list or dropdown of categories", '__poli-shortcodes__' ) );
            parent::__construct('my_categories', __('Widget - Categories', '__poli-shortcodes__'), $widget_ops);
        }

        function widget( $args, $instance ) {
            extract( $args );

            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories', '__poli-shortcodes__' ) : $instance['title']);
            $c = $instance['count'] ? '1' : '0'; 
    		$exclude_cat = $instance['exclude_cat'];	

            echo $before_widget;
            if ( $title )
                echo $before_title . $title . $after_title;      
            
            ?>
            <ul class="my_cat_items">
            <?php
            
    		$categories = wp_list_categories('title_li=&show_count='.$c.'&echo=0&hierarchical=0&exclude='.$exclude_cat);
    		$categories = preg_replace('#</a> \(([0-9]+)\)#', ' <small>\\1</small></a>', $categories);
    		echo $categories;		
            ?>
            </ul>
            <?php

            echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['count'] = $new_instance['count'] ? 1 : 0; 
    		$instance['exclude_cat'] = strip_tags($new_instance['exclude_cat']);	

            return $instance;
        }

        function form( $instance ) {
            //Defaults
            $instance = wp_parse_args( (array) $instance, array( 'title' => 'Categories', 'exclude_cat' => '', 'count' => 1) );
            $title = esc_attr( $instance['title'] );
            $count = isset($instance['count']) ? (bool) $instance['count'] :false;  
    		$exclude_cat = esc_attr( $instance['exclude_cat'] );		
    		?>		
    		<p>
    			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', '__poli-shortcodes__') ?></label>
    			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />			
    		</p>		
    		<p>
    			<label for="<?php echo $this->get_field_id( 'exclude_cat' ); ?>"><?php _e('Exclude Categories:', '__poli-shortcodes__') ?></label>
    			<input id="<?php echo $this->get_field_id( 'exclude_cat' ); ?>" name="<?php echo $this->get_field_name( 'exclude_cat' ); ?>" value="<?php echo $instance['exclude_cat']; ?>" style="width:95%;" /><br /><small><?php _e( 'Categories IDs, separated by commas (e.g. 1,8)','__poli-shortcodes__' ) ?></small>
    		</p>		
    		<p>
    			<input class="checkbox" type="checkbox" <?php checked($instance['count'], true) ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" />
    			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts', '__poli-shortcodes__') ?></label>		
    		</p>
    		<?php
        }

    }
}

function SWM_Cats_Widget() {
  register_widget('SWM_Categories_Widget');
}
add_action('widgets_init', 'SWM_Cats_Widget');