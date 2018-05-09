<?php

/* ************************************************************************************** 
Error page
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_error_page', array(
    'title'    => esc_html__( 'Error 404', 'election' ),
    'priority' => 14
));

$wp_customize->add_setting( 'swm_error_title', array(
'default' => 'Page Not Found'
));

$wp_customize->add_control( 'swm_error_title', array(
'type'     => 'text',
'label'    => esc_html__( 'Error 404 Title Text', 'election' ),
'section'  => 'swm_customizer_error_page',
'priority' => 2
));

$wp_customize->add_setting( 'swm_error_content');  

$wp_customize->add_control(
    new SWM_Customize_Control_Textarea( $wp_customize, 'swm_error_content', array(
      'label'    => esc_html__( 'Error 404 Message', 'election' ),
      'section'  => 'swm_customizer_error_page',
      'settings' => 'swm_error_content',
      'priority' => 3
    ))
);

$wp_customize->add_setting( 'swm_error_image' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_error_image', array(
        'label'    => esc_html__( 'Error 404 Image', 'election' ),
        'section'  => 'swm_customizer_error_page',
        'settings' => 'swm_error_image',
        'priority' => 4
    ))
);