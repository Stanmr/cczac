<?php 

	if ( have_posts() ) :

		echo '<section>';	
		echo '<div id="swm-item-entries" class="swm_blog_grid_sort swm_row">';
		
		while ( have_posts() ) : the_post();
			
			$postid = get_the_ID();		
			$get_format = swm_display_post_format();


			if ( empty($get_format) ) {
				$grid_class = 'no_pf_grid';
			} else {
				$grid_class = '';
			}

			$default_classes = 'swm-infinite-item-selector swm_blog_grid swm_blog_grid_isotope isotope-item '. get_theme_mod('swm_blog_grid_column','swm_column3');

			if (is_sticky()) {
				$classes = array( 'post-entry', $default_classes, 'sticky');
			} else {
				$classes = array( 'post-entry', $default_classes);
			}	

			echo "<article class='".implode(" ", get_post_class($classes))."'  >";
			echo '<div class="swm_column_gap">';

			echo '<div class="swm_post_format '.$grid_class.'">';		
			echo swm_display_post_format();	
			echo '</div>';
			
			echo swm_post_summary_content();
			echo swm_post_metas();

			echo '</div>';
			echo '<div class="clear"></div>';

			echo '</article>';

		endwhile;

		echo '<div class="clear"></div>';
		echo '</div>';
		echo '<div class="clear"></div>';		

		swm_blog_pagination();

		echo '<div class="clear"></div>';
		echo '</section>';

	else : 
		echo '<article class="clr">' . esc_html__( 'No Posts found.', 'election' ) . '</article>';

	endif;

	wp_reset_postdata(); wp_reset_query();

?>