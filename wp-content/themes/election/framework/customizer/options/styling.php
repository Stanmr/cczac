<?php

/* ************************************************************************************** 
Styling
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_styling', array(
    'title'    => esc_html__( 'Styling', 'election' ),
    'priority' => 3
));

$wp_customize->add_setting( 'swm_customizer_styling_settings' );

/* Primary Skin Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_primary_skin_color', array(
    'default' => '#093f7f'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_primary_skin_color', array(
        'label'    => esc_html__( 'Primary Skin Color', 'election' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_primary_skin_color',
        'priority' => 1
    ))
);

/* Secondary Skin Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_secondary_skin_color', array(
'default' => '#b93941'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_secondary_skin_color', array(
        'label'    => esc_html__( 'Secondary Skin Color', 'election' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_secondary_skin_color',
        'priority' => 2
    ))
);


/* ************************************************************************************** 
Background
************************************************************************************** */


$wp_customize->add_setting( 'swm_body_background' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_body_background', array(
        'label'    => esc_html__( 'Body Background', 'election' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_body_background',
        'priority' => 10
    ))
);


/* Background Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_color', array(
    'default' => '#606060'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_body_bg_color', array(
        'label'    => esc_html__( 'Body Background Color', 'election' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_body_bg_color',
        'priority' => 11
    ))
);


/* Background Image -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_body_bg_image' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_body_bg_image', array(
        'label'    => esc_html__( 'Background Image', 'election' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_body_bg_image',
        'priority' => 12
    ))
);

/* Background Image Position -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_position', array(
    'default' => 'center'
));

$wp_customize->add_control( 'swm_body_bg_position', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Image Position', 'election' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 13,
    'choices'  => array(
        "left-top"      => esc_html__( 'Left Top', 'election' ),
        "left-center"   => esc_html__( 'Left Center', 'election' ),
        "left-bottom"   => esc_html__( 'Left Bottom', 'election' ),
        "right-top"     => esc_html__( 'Right Top', 'election' ),
        "right-center"  => esc_html__( 'Right Center', 'election' ),
        "right-bottom"  => esc_html__( 'Right Bottom', 'election' ),
        "center-top"    => esc_html__( 'Center Top', 'election' ),
        "center-center" => esc_html__( 'Center Center', 'election' ),
        "center-bottom" => esc_html__( 'Center Bottom', 'election' )
    )
));

/* Background Image Repeat -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_repeat', array(
    'default' => 'repeat'
));

$wp_customize->add_control( 'swm_body_bg_repeat', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Image Repeat', 'election' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 14,
    'choices'  => array(
        'repeat'    => esc_html__( 'Repeat', 'election' ),
        'no-repeat' => esc_html__( 'No Repeat', 'election' ),
        'repeat-x'  => esc_html__( 'Repeat X', 'election' ),
        'repeat-y'  => esc_html__( 'Repeat Y', 'election' )       
    )
));

/* Background Image Attachment -------------------------------------------------- */

$wp_customize->add_setting( 'swm_body_bg_attachment', array(
    'default' => 'scroll'
));

$wp_customize->add_control( 'swm_body_bg_attachment', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Attachment', 'election' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 15,
    'choices'  => array(
        'scroll' => esc_html__( 'Scroll', 'election' ),
        'fixed'      => esc_html__( 'Fixed', 'election' )
    )
));

$wp_customize->add_setting( 'swm_body_bg_stretch', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_body_bg_stretch', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( '100% Background Image Width', 'election' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 15 
));

/* ************************************************************************************** 
Page Preloader
************************************************************************************** */

$wp_customize->add_setting( 'swm_body_background' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_body_background', array(
        'label'    => esc_html__( 'Page Preloader', 'spiritual' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_body_background',
        'priority' => 18
    ))
);

/* On/off Page Preloader -------------------------------------------------- */

$wp_customize->add_setting( 'swm_page_preloader', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_page_preloader', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Enable Page Preloader', 'spiritual' ),
    'section'  => 'swm_customizer_styling',
    'priority' => 19
));

/* Page Preloader Background  -------------------------------------------------- */

$wp_customize->add_setting( 'swm_page_preloader_bg', array(
    'default' => '#ffffff'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_page_preloader_bg', array(
        'label'    => esc_html__( 'Background Color', 'spiritual' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_page_preloader_bg',
        'priority' => 20
    ))
);

/*  Page Preloader Animated Circle Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_page_preloader_circle_one', array(
    'default' => '#093f7f'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_page_preloader_circle_one', array(
        'label'    => esc_html__( 'Animated Circle Border Color', 'spiritual' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_page_preloader_circle_one',
        'priority' => 21
    ))
);

/* Page Preloader Static Circle Color  -------------------------------------------------- */

$wp_customize->add_setting( 'swm_page_preloader_circle_two', array(
    'default' => '#e6e6e6'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_page_preloader_circle_two', array(
        'label'    => esc_html__( 'Static Circle Border Color', 'spiritual' ),
        'section'  => 'swm_customizer_styling',
        'settings' => 'swm_page_preloader_circle_two',
        'priority' => 22
    ))
);