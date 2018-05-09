<?php 
get_header(); 

$swm_blog_style = get_theme_mod( 'swm_blog_all_style', 'large-image' );
$swm_loop_type = ( $swm_blog_style == 'blog-style-grid' ) ? 'standard-grid' : 'standard';
$swm_infinite_pagination_style = ( $swm_blog_style == 'blog-style-grid' ) ? 'swm_infinite_scroll_style' : '';
?>				
	<div class="swm_container <?php echo swm_page_post_layout_type(); ?> <?php echo $swm_infinite_pagination_style; ?>" >	
		<div class="swm_column swm_custom_two_third">			
				
			<?php

			$swm_post_author_bio = get_theme_mod('swm_show_author_bio');

			if ( have_posts() ) : the_post();

			if (isset($_COOKIE["pixel_ratio"])) {
		   	 	$pixel_ratio = $_COOKIE["pixel_ratio"];
		    	$avatar_size = $pixel_ratio > 1 ? '190' : '95'; 
			} else { 	   
			    $avatar_size = '95'; 
			}

			$swm_get_author_contact = '';

			$author_contacts = array('twitter','facebook','google-plus','pinterest','linkedin','tumblr','delicious','vimeo-square','youtube-play');

			foreach ($author_contacts as $author_contact ) {

				if ( get_the_author_meta($author_contact) ) { 
					$swm_get_author_contact .= '<li><a href="' . esc_url( get_the_author_meta($author_contact) ) . '" target="_blank" ><i class="fa fa-'.$author_contact.'"></i></a></li>'; 
				}

			}

				if ( $swm_post_author_bio ) {
					?>

					<!-- .......... About Author .......... -->	
							
					<div class="about_author swm_author_page_box">
						<div class="author_title"><h4><span><strong><?php echo esc_html__('Author: ', 'election'); ?></strong></span><?php the_author(); ?></h4></div>

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
					
					<?php 

					

				}

			endif; 

			rewind_posts();
			?>
			<?php get_template_part('loop', $swm_loop_type); ?>	
			<div class="clear"></div>
			
			<div class="clear"></div>
		</div>		
	
	<?php get_sidebar(); 	?>

	</div>	<?php
 
get_footer(); 

?>