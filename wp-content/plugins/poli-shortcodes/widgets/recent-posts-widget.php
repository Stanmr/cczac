<?php 
if ( !class_exists( 'SWM_Recent_Posts' ) ) {
	class SWM_Recent_Posts extends WP_Widget {
	    function __construct() {
			$widget_ops = array('description' => __('Display latest blog posts', '__poli-shortcodes__'));	
			parent::__construct('swm_recent_posts_wid',$name = __('Widget - Recent Posts', '__poli-shortcodes__'),$widget_ops);
	    }

	  	/* Displays the Widget in the front-end */
	    function widget($args, $instance){
			extract($args);
			$title = apply_filters('widget_title', !empty($instance['title']) ? $instance['title'] : __('Recent Posts', '__poli-shortcodes__') );
			$no_of_posts = !empty($instance['no_of_posts']) ? $instance['no_of_posts'] : '2' ;		
			$add_category = !empty($instance['add_category']) ? $instance['add_category'] : '' ;	
			

			echo $before_widget;
			echo $before_title . $title . $after_title;		
			echo '<div class="recent_posts_tiny">';
			echo '<ul>';		
			
			$cnt = 0;

			if($add_category != ""){
				$recentposts = new WP_Query('cat='.$add_category.'&posts_per_page='.$no_of_posts.'&orderby=date&order=DESC');
			}else{
				$recentposts = new WP_Query('posts_per_page='.$no_of_posts.'&orderby=date&order=DESC');
			}
			
			while($recentposts->have_posts()): $recentposts->the_post();		
				
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
					default: $rcp_icon = 'picture-o';
						break;
				}					
			
			if($cnt < $no_of_posts){
			?>
				<li>
					<?php
					if(has_post_thumbnail()) { ?>
						<a href="<?php echo get_permalink(); ?>" title="<?php echo esc_attr(strip_tags(get_the_title())); ?>" class="tiny_img"> 
							<?php the_post_thumbnail('recent-post-tiny'); ?>
						</a>
						<?php
					} else { ?>
						<a href="<?php echo get_permalink(); ?>" title="<?php echo esc_attr(strip_tags(get_the_title())); ?>" class="recent_posts_tiny_icon"> 
						<i class="fa fa-<?php echo $rcp_icon; ?>"></i>
					</a>
						<?php
					}  ?>

					<div class="recent_posts_tiny_content">				
						<h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>				
						<p><?php the_time('F j, Y - g:i a') ?></p>
					</div>
					
					<div class="clear"></div>
				</li>			
				
				<?php	

				$cnt++;		
			}	

			endwhile;		

			echo '</ul>';
			echo '</div>';
			echo '<div class="clear"></div>';
			echo $after_widget;		
		}

	  	/*Saves the settings. */
	    function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = stripslashes($new_instance['title']);
			$instance['no_of_posts'] = stripslashes($new_instance['no_of_posts']);		
			$instance['add_category'] = stripslashes($new_instance['add_category']);		
			
			return $instance;
		}
		
	    function form($instance){
			//Defaults
			$instance = wp_parse_args( (array) $instance, array('title'=> __('Recent Posts', '__poli-shortcodes__'), 'no_of_posts'=>'2','add_category'=>'','blog_summery_text'=>'50', 'readmore_btn'=> __('read more', '__poli-shortcodes__')) );

			$title = htmlspecialchars($instance['title']);
			$no_of_posts = $instance['no_of_posts'];		
			$add_category = $instance['add_category'];		
			
			echo '<p><label for="' . $this->get_field_id('title') . '">' . __('Widget Title:', '__poli-shortcodes__') . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
			
			echo '<p><label for="' . $this->get_field_id('no_of_posts') . '">' . __('Number of Posts to Display:', '__poli-shortcodes__') . '</label><input class="widefat" id="' . $this->get_field_id('no_of_posts') . '" name="' . $this->get_field_name('no_of_posts') . '" type="text" value="' . $no_of_posts . '" /></p>';		
			
			
			echo '<p><label for="' . $this->get_field_id('add_category') . '">' . __('Display Specific Categories:', '__poli-shortcodes__') . '</label><input class="widefat" id="' . $this->get_field_id('add_category') . '" name="' . $this->get_field_name('add_category') . '" type="text" value="' . $add_category . '" /><br /><small>' . __('If you want to display specific category(ies) recent posts only, then add Category IDs with comma seperated (e.g. 1,2,3) or <strong>Leave it blank for default.</strong>', '__poli-shortcodes__') . '</small></p>';	
			
		}
	}
}

function SWM_Recent_Posts_Widget() {
  register_widget('SWM_Recent_Posts');
}
add_action('widgets_init', 'SWM_Recent_Posts_Widget');
?>