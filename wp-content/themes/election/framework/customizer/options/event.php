<?php

/* ************************************************************************************** 
Portfolio
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_event', array(
    'title'    => esc_html__( 'The Event Calendar Plugin', 'election' ),
    'priority' => 15
));

$swm_eveny_layout = array(
    "layout-sidebar-right" => esc_html__( 'Sidebar Right','election' ),
    "layout-sidebar-left" => esc_html__( 'Sidebar Left','election' ),
    "layout-full-width" => esc_html__( 'Full Width','election' )   
);

$wp_customize->add_setting( 'swm_event_page_layout', array(
    'default' => 'layout-full-width'
));

$wp_customize->add_control( 'swm_event_page_layout', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Default Event Page Layout', 'election' ),
    'section'  => 'swm_customizer_event',
    'priority' => 10,
    'choices'  => $swm_eveny_layout
));

$wp_customize->add_setting( 'swm_header_bg_image_event' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_header_bg_image_event', array(
        'label'    => esc_html__( 'Header Background Image', 'election' ),
        'section'  => 'swm_customizer_event',
        'settings' => 'swm_header_bg_image_event',
        'priority' => 11
    ))
);