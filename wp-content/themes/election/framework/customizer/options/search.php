<?php

/* ************************************************************************************** 
Portfolio
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_search', array(
    'title'    => esc_html__( 'Search Page', 'spiritual' ),
    'priority' => 10
));

$swm_search_layout = array(
    "layout-sidebar-right" => esc_html__( 'Sidebar Right','spiritual' ),
    "layout-sidebar-left" => esc_html__( 'Sidebar Left','spiritual' ),
    "layout-full-width" => esc_html__( 'Full Width','spiritual' )   
);

$wp_customize->add_setting( 'swm_search_page_layout', array(
    'default' => 'layout-sidebar-right'
));

$wp_customize->add_control( 'swm_search_page_layout', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Default Search Page Layout', 'spiritual' ),
    'section'  => 'swm_customizer_search',
    'priority' => 1,
    'choices'  => $swm_search_layout
));

$wp_customize->add_setting( 'swm_header_bg_image_search' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_header_bg_image_search', array(
        'label'    => esc_html__( 'Header Background Image', 'spiritual' ),
        'section'  => 'swm_customizer_search',
        'settings' => 'swm_header_bg_image_search',
        'priority' => 2
    ))
);