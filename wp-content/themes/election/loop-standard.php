<?php			

$swm_blog_pagination_style = get_theme_mod( 'swm_blog_pagination_style', 'standard' );
$swm_blog_section = ( $swm_blog_pagination_style == 'infinite-scroll' ) ? 'swm-item-entries' : 'blog-main-section';				

if ( have_posts() ) : 

echo '<section>';

echo '<div id="'.$swm_blog_section.'">';

while ( have_posts() ) : the_post();					
	
	$postid = get_the_ID();		
	$post_format = get_post_format() ? get_post_format() : 'standard';

	if (is_sticky()) {
		$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post', 'sticky');
	} else {
		$classes = array( 'swm-infinite-item-selector post-entry', 'swm_blog_post');
	}		

	echo "<article class='".implode(" ", get_post_class($classes))."'  >";

	echo '<div class="swm_post_format">';	
	echo swm_display_post_format();	
	echo '</div>';

	echo swm_post_date();
	echo swm_post_summary_content();

	echo '</article>';

endwhile;

echo '</div>';

echo '<div class="clear"></div>';

swm_blog_pagination();

echo '<div class="clear"></div>';

echo '</section>';

endif;			

wp_reset_postdata(); wp_reset_query();

?>