<?php 
get_header(); 
?>
				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?>" >	
		<div class="swm_column swm_custom_two_third">
			
			<?php
			echo '<section>';
			echo '<div id="blog-main-section">';
				
			if (have_posts()) : while (have_posts()) : the_post();	
					
					$postid = swm_get_id();		
					$post_format = get_post_format() ? get_post_format() : 'standard';

					if (is_sticky()) {
						$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post', 'sticky');
					} else {
						$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post');
					}		

					echo "<article class='".implode(" ", get_post_class($classes))."'  >";

					if (get_theme_mod('swm_single_featured_imgvid')) {
						echo '<div class="swm_post_format">';
						echo swm_display_post_format();	
						echo '</div>';
					} else {
						echo '<div class="nopf_imgvid"></div>';
					}

					echo swm_post_date();
					echo swm_post_single_content();
					

					$args = array(
						'before'           => '<div class="clear"></div><div class="pagination_menu">',
						'after'            => '</div>',
						'link_before'      => '<span class="wp_link_pages_custom">',
						'link_after'       => '</span>',
						'next_or_number'   => 'number',
						'nextpagelink'     => esc_html__('Next Page ', 'election'),
						'previouspagelink' => esc_html__('Previous Page ', 'election'),
						'pagelink'         => '%',
						'echo'             => 0
					);

					echo wp_link_pages( $args );
					echo '<div class="clear"></div>';							
					echo '</article>';
					echo '<div class="clear"></div>';					
					
					/* ----------------------------------------------------------------------------------
						About Author Box
					---------------------------------------------------------------------------------- */		
					
					$swm_about_author_box = get_theme_mod('swm_single_about_author',1);
					$url = get_the_author_meta( 'user_login' );
					$url = str_replace(' ' , '-', $url );						

					if (isset($_COOKIE["pixel_ratio"])) {
			   	 		$pixel_ratio = $_COOKIE["pixel_ratio"];
			    		$avatar_size = $pixel_ratio > 1 ? '150' : '75'; 
					} else { 	   
					    $avatar_size = '75'; 
					}

					$swm_get_author_contact = '';

					$author_contacts = array('twitter','facebook','google-plus','pinterest','linkedin','tumblr','delicious','vimeo-square','youtube-play');

					foreach ($author_contacts as $author_contact ) {

						if ( get_the_author_meta($author_contact) ) { 
							$swm_get_author_contact .= '<li><a href="' . esc_url( get_the_author_meta($author_contact) ) . '" target="_blank" ><i class="fa fa-'.$author_contact.'"></i></a></li>'; 
						}

					}
					
					if ($swm_about_author_box) { ?>				
						
						<div class="about_author primary_color">
							<div class="author_title"><h4><span><?php _e('Author: ', 'election'); ?></span><?php the_author(); ?></h4></div>				

							<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
								<?php echo get_avatar(get_the_author_meta('email'),$size=$avatar_size,$default=get_template_directory_uri().'/images/thumbs/blog-author.jpg' ); ?>
							</a>			

							<div class="swm_author_bio_section">
								<p><?php the_author_meta('description'); ?></p>	
										
								<?php if (get_the_author_meta('user_url')) { ?>

									<p style="margin-top:10px;"><strong><?php _e('Website:', 'spiritual')?></strong> <a href="<?php echo get_the_author_meta('user_url'); ?>"><?php echo get_the_author_meta('user_url'); ?></a></p>
							
								<?php } ?>
								
								<ul class="swm_post_author_icon">
									<?php echo $swm_get_author_contact; ?>
								</ul>
							</div>
							<div class="clear"></div>
										
						</div>

						<div class="clear"></div>				
					
					<?php }

					/* ----------------------------------------------------------------------------------
						Post Comments
					---------------------------------------------------------------------------------- */	
					
					$swm_post_comments = get_theme_mod('swm_single_comments',1);
					
					if ($swm_post_comments) {
					
						comments_template('', true); 		
					
					}	

			endwhile;
			endif; 

			echo '</div>';	

			echo '<div class="clear"></div>';

			echo '</section>';

			wp_reset_postdata(); wp_reset_query();
			?>



			<div class="clear"></div>
			
			<div class="clear"></div>
		</div>
		
	
	<?php get_sidebar(); 	?>

	</div>	<?php
 
get_footer(); 

?>