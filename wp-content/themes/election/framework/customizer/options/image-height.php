<?php

/* ************************************************************************************** 
Image Height
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_image_height', array(
    'title'    => esc_html__( 'Image Height', 'election' ),
    'priority' => 13
));


$wp_customize->add_setting( 'swm_image_height_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_image_height_section_info', array(
      'label'    => esc_html__( 'Note: After changing the image heights, rebuild all thumbnails with "Regenerate Thumbnails" plugin', 'election' ),
      'section'  => 'swm_customizer_image_height',
      'settings' => 'swm_image_height_section_info',
      'priority' => 1
    ))
);


$swm_image_height_sections = array(
    "swm_img_pt_2col"						=>  esc_html__('Portfolio 2 Column', 'election' ),
    "swm_img_pt_3col"            			=>  esc_html__('Portfolio 3 Column', 'election' ),
    "swm_img_pt_4col"            			=>  esc_html__('Portfolio 4 Column', 'election' ),    
    "swm_img_pt_blog_featured"            	=>  esc_html__('Blog with Sidebar Post', 'election' ),    
    "swm_img_pt_blog_grid_featured"         =>  esc_html__('Blog Grid Post', 'election' ),    
    "swm_img_pt_blog_fullwidth_featured"	=>  esc_html__('Blog Fullwidth Post', 'election' ),    
);

$sm_links_number = 2;

$default_image_heights = array(310,250,250,400,250,400);

$default_img_no = 0;

foreach ($swm_image_height_sections as $section_name => $section_details) 
{
    $sm_links_number++;    

    $nav_link_number = 'nav_link_icon' . $i;
    $nav_link_icon = sprintf( esc_html__( 'Link %s Icon','election' ) ,$i );

    $wp_customize->add_setting( $section_name, array(
        'default' => $default_image_heights[$default_img_no]
    ));

   $wp_customize->add_control(
        new SWM_Customize_Control_Mini_Text( $wp_customize, $section_name, array(
            'type'     => 'minitext',
            'label'    => $section_details,
            'section'  => 'swm_customizer_image_height',
            'priority' => $sm_links_number
        ))
    );

   $default_img_no++;
        
}