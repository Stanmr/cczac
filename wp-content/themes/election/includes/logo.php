<?php 

if (isset($_COOKIE["pixel_ratio"])) {
    $swm_pixel_ratio = $_COOKIE["pixel_ratio"];
    $swm_logo = $swm_pixel_ratio > 1 ? esc_attr(get_theme_mod('swm_loog_retina')) : esc_attr(get_theme_mod('swm_loog_standard')); 
} else {    
    $swm_logo = (get_theme_mod('swm_loog_standard') <> '') ? esc_attr(get_theme_mod('swm_loog_standard')) : get_template_directory_uri().'/framework/images/logo.jpg'; 
} 

?>

<div class="logo_section">
	<a href="<?php echo home_url(); ?>"> 	
		<img src="<?php echo esc_url($swm_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />	
	</a>
</div>