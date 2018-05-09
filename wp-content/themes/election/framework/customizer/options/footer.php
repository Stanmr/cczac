<?php

/* ************************************************************************************** 
Footer
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_footer', array(
'title'    => esc_html__( 'Footer', 'election' ),
'priority' => 7
));

$wp_customize->add_setting( 'swm_customizer_footer_settings' );

/* Large Footer -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_large_footer', array(
'default' => 1
));

$wp_customize->add_control( 'swm_large_footer', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Display Large Footer', 'election' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 1
));

/* Footer Column -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_footer_column', array(
    'default' => '3'
));

$footer_column = array(
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5"    
);

$wp_customize->add_control( 'swm_footer_column', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Footer Column', 'election' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 2,
    'choices'  => $footer_column
));



/* Background Image and Color -------------------------------------------------- */

$wp_customize->add_setting( 'swm_footer_bg_color', array(
    'default' => '#2c5791'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_bg_color', array(
        'label'    => esc_html__( 'Primary Background Color', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_bg_color',
        'priority' => 11
    ))
);

$wp_customize->add_setting( 'swm_footer_bg_color_two', array(
    'default' => '#0f4484'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_bg_color_two', array(
        'label'    => esc_html__( 'Secondary Background Color', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_bg_color_two',
        'priority' => 12
    ))
);

$wp_customize->add_setting( 'swm_footer_bg_image' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_footer_bg_image', array(
        'label'    => esc_html__( 'Background Image', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_bg_image',
        'priority' => 13
    ))
);

$wp_customize->add_setting( 'swm_footer_bg_position', array(
    'default' => 'center-top'
));

$wp_customize->add_control( 'swm_footer_bg_position', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Image Position', 'election' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 14,
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

$wp_customize->add_setting( 'swm_footer_bg_repeat', array(
    'default' => 'repeat'
));

$wp_customize->add_control( 'swm_footer_bg_repeat', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Image Repeat', 'election' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 15,
    'choices'  => array(
        'repeat'    => esc_html__( 'Repeat', 'election' ),
        'no-repeat' => esc_html__( 'No Repeat', 'election' ),
        'repeat-x'  => esc_html__( 'Repeat X', 'election' ),
        'repeat-y'  => esc_html__( 'Repeat Y', 'election' ),
        'fixed'     => esc_html__( 'Fixed', 'election' )
    )
));


/* Widget Title Border -------------------------------------------------- */


$wp_customize->add_setting( 'swm_footer_border_color', array(
    'default' => '#3b689d'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_border_color', array(
        'label'    => esc_html__( 'Footer Borders Color', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_border_color',
        'priority' => 21
    ))
);

$wp_customize->add_setting( 'swm_footer_links_hover_color', array(
    'default' => '#eaff00'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_footer_links_hover_color', array(
        'label'    => esc_html__( 'Footer Links Hover Color', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_footer_links_hover_color',
        'priority' => 21
    ))
);

/* Small Footer -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_small_footer_heading' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_small_footer_heading', array(
        'label'    => esc_html__( 'Small Footer', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_small_footer_heading',
        'priority' => 50
    ))
);

$wp_customize->add_setting( 'swm_small_footer', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_small_footer', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Display Small Footer', 'election' ),
    'section'  => 'swm_customizer_footer',
    'priority' => 51
));

$wp_customize->add_setting( 'swm_small_footer_bg', array(
'default' => '#093f7f'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_small_footer_bg', array(
        'label'    => esc_html__( 'Background Color', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_small_footer_bg',
        'priority' => 52
    ))
);


$wp_customize->add_setting( 'small_footer_bg_opacity', array(
'default' => '80'
));

$wp_customize->add_control(           
    new SWM_Customize_Slider_Control( $wp_customize, 'small_footer_bg_opacity', array(
        'label'    => esc_html__( 'Background Color Opacity (%)', 'election' ),
        'section' => 'swm_customizer_footer',
        'settings' => 'small_footer_bg_opacity',       
        'priority' => 53
    ))
);

$wp_customize->add_setting( 'swm_small_footer_border_color', array(
    'default' => '#33639e'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_small_footer_border_color', array(
        'label'    => esc_html__( 'Border Color', 'election' ),
        'section'  => 'swm_customizer_footer',
        'settings' => 'swm_small_footer_border_color',
        'priority' => 55
    ))
);

$wp_customize->add_setting( 'swm_footer_copyright', array(
    'default' => 'Add copyright text from WordPress Admin > Customizer > Footer > Small Footer'
));  

$wp_customize->add_control(
    new SWM_Customize_Control_Textarea( $wp_customize, 'swm_footer_copyright', array(
      'label'    => esc_html__( 'Copyright Info', 'election' ),
      'section'  => 'swm_customizer_footer',
      'settings' => 'swm_footer_copyright',
      'priority' => 60
    ))
);