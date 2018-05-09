<?php 
get_header(); 

$swm_search_layout_style = get_theme_mod( 'swm_search_page_layout', 'layout-sidebar-right' );
?>				
	<div class="swm_container <?php echo $swm_search_layout_style; ?>" >	
		<div class="swm_column swm_custom_two_third">
			
			<?php

			$my_searchterm = trim(get_search_query());

			global $wp_query;
			$swm_search_term = trim(get_search_query());
			$swm_search_result = '';
			$swm_no_search_result = '';

			if ( $swm_search_term == '' ) {
				$swm_search_result = '0';
				$swm_no_search_result = 'swm_no_search_result_title';
			} else {
				$swm_search_result = $wp_query->found_posts;
			} ?>

			<h3 class="swm_search_pg_subtitle <?php echo esc_attr($swm_no_search_result); ?>"><?php
				echo esc_html($swm_search_result) . ' ' .sprintf( esc_html__( 'results for &quot;%1$s&quot;','spiritual' ), esc_html( get_search_query() ) ); ?>
			</h3>

			<?php			
			if ( $swm_search_term != '' ) :

				?>
				<div class="search_pg_box">	
					<ul class="swm_search_list">		
						<?php

						/* ----------------------------------------------------------------------------------
							Search List
						---------------------------------------------------------------------------------- */						

							if ( have_posts() ) : 
								while (have_posts()) : the_post(); ?>							
									<li>										
												
										<?php if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {	 ?>
											<div class="swm_search_featured_img">	
											<a href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr( the_title() ); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail' ); ?></a>									
											</div>
										<?php } ?>
										

										<div class="swm_search_page_text">
											<h4><a href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_attr( the_title() ); ?>"><?php esc_html(the_title()); ?></a></h4>

											<div class="swm_search_meta">
									            <ul>									               
													<li><?php echo get_the_date(); ?></li>								               
													<li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php echo esc_html(get_the_author()); ?></a></li>
													<li><a href="<?php echo esc_url(get_comments_link()); ?>"><?php swm_get_comments_number(); ?></a></li>
												</ul>
									        </div>

											<p>
												<?php
												ob_start();
												the_content();
												$swm_old_content = ob_get_clean();
												$swm_new_content = strip_tags($swm_old_content);
												echo substr($swm_new_content,0,300).'...';
												?>
											</p>
											<p class="swm_search_page_readmore"><a href="<?php esc_url( the_permalink() ); ?>" class="swm_skin_text" ><?php echo esc_html__( 'Read more', 'spiritual' ); ?> <i class="fa fa-angle-right"></i></a></p>
										</div>										

										<div class="clear"></div>
									</li>
								<?php 
								endwhile; 					

							else:

								swm_search_page_form();
								get_search_form();

							endif; ?>
						
					</ul>
				</div>
				<?php swm_blog_pagination(); ?>
				<?php wp_reset_postdata(); wp_reset_query(); ?>
				<div class="clear"></div>

				<?php
			else : 					
				swm_search_page_form();					
			endif; ?>				
			
			<div class="clear"></div>
		</div>		
	
		<?php
			if ( $swm_search_layout_style != 'layout-full-width' ) { ?>

				<aside class="swm_column sidebar" id="sidebar">		
					<?php
					if ( is_active_sidebar('blog-sidebar') ) {
						dynamic_sidebar('blog-sidebar');	
					}		
					?>		
					<div class="clear"></div>
				</aside>
				<?php 	
			}
		?>

	</div>	<?php
 
get_footer();