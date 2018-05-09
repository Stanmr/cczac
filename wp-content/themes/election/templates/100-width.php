<?php
/*
Template Name: 100% Width Page
*/ 

get_header(); 

			if ( have_posts() ) while ( have_posts() ) : the_post();	
				$swm_content = get_the_content();

				if ($swm_content == '') {
					?> &nbsp; <?php
				} else {
					the_content();
				}	

				$args = array(
					'before'           => '<div class="clear"></div><div class="pagination_menu">' . esc_html__('Pages: ', 'election'),
					'after'            => '</div>',
					'link_before'      => '<span class="wp_link_pages_custom">',
					'link_after'       => '</span>',
					'next_or_number'   => 'number',
					'nextpagelink'     => esc_html__('Next Page ', 'election'),
					'previouspagelink' => esc_html__('Previous Page ', 'election'),
					'pagelink'         => '%',
					'echo'             => 1
				);

				wp_link_pages( $args );				

			endwhile;				

			/* ----------------------------------------------------------------------------------
				Page Comments
			---------------------------------------------------------------------------------- */				

			$swm_page_comments = get_theme_mod('swm_commnets_in_pages');			

			if ($swm_page_comments) {
				comments_template('', true); 	
			}			

			?>
			<div class="clear"></div>
<?php get_footer(); ?>