<?php

/* ************************************************************************************** 
Logo
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_logo', array(
    'title'    => esc_html__( 'Logo', 'election' ),
    'priority' => 2
));

$wp_customize->add_setting( 'swm_customizer_logo_settings' );

$wp_customize->add_setting( 'swm_logo_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_logo_section_info', array(
      'label'    => esc_html__( 
        'Upload standard and retina logo as per given sizes. If you do not want to add retina logo then leave it blank to display standard logo in all devices. Logo section background color is necessary for sticky menu effect.', 'election' ),
      'section'  => 'swm_customizer_logo',
      'settings' => 'swm_logo_section_info',
      'priority' => 1
    ))
);


/* Logo Standard -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_loog_standard' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_loog_standard', array(
        'label'    => esc_html__( 'Standard Logo Image (Size : 300x118) ', 'election' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_loog_standard',
        'priority' => 5
    ))
);


/* Logo Retina -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_loog_retina' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_loog_retina', array(
        'label'    => esc_html__( 'Retina Logo Image (Size : 600x236)', 'election' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_loog_retina',
        'priority' => 6
    ))
);

/* Logo Background Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_logo_bg_color', array(
    'default' => '#b93a43'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_logo_bg_color', array(
        'label'    => esc_html__( 'Logo Background Color', 'election' ),
        'section'  => 'swm_customizer_logo',
        'settings' => 'swm_logo_bg_color',
        'priority' => 7
    ))
);