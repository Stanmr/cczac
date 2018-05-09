<?php

/* ************************************************************************************** 
Header
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_header', array(
    'title'    => esc_html__( 'Header', 'election' ),
    'priority' => 4
));

$wp_customize->add_setting( 'swm_customizer_header_settings' );


/* ************************************************************************************** 
Title
************************************************************************************** */

$wp_customize->add_setting( 'swm_header_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_header_section_info', array(
      'label'    => esc_html__( 'Page title font size and color you can set from "Fonts" section', 'election' ),
      'section'  => 'swm_customizer_header',
      'settings' => 'swm_header_section_info',
      'priority' => 1
    ))
);

$wp_customize->add_setting( 'swm_header_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_header_title', array(
        'label'    => esc_html__( 'Page Title', 'election' ),
        'section'  => 'swm_customizer_header',
        'settings' => 'swm_header_title',
        'priority' => 6
    ))
);

$wp_customize->add_setting( 'swm_page_title_bg', array(
    'default' => '#093f7f'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_page_title_bg', array(
        'label'    => esc_html__( 'Background Color', 'election' ),
        'section'  => 'swm_customizer_header',
        'settings' => 'swm_page_title_bg',
        'priority' => 7
    ))
);

$wp_customize->add_setting( 'page_title_bg_opacity', array(
'default' => '90'
));

$wp_customize->add_control(           
    new SWM_Customize_Slider_Control( $wp_customize, 'page_title_bg_opacity', array(
        'label'    => esc_html__( 'Background Color Opacity (%)', 'election' ),
        'section' => 'swm_customizer_header',
        'settings' => 'page_title_bg_opacity',       
        'priority' => 8
    ))
);


/* ************************************************************************************** 
Background
************************************************************************************** */

$wp_customize->add_setting( 'swm_header_background' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_header_background', array(
        'label'    => esc_html__( 'Header Background', 'election' ),
        'section'  => 'swm_customizer_header',
        'settings' => 'swm_header_background',
        'priority' => 9
    ))
);


$wp_customize->add_setting( 'swm_header_bg_color', array(
    'default' => '#28415f'
));

$wp_customize->add_control(
    new WP_Customize_Color_Control( $wp_customize, 'swm_header_bg_color', array(
        'label'    => esc_html__( 'Background Color', 'election' ),
        'section'  => 'swm_customizer_header',
        'settings' => 'swm_header_bg_color',
        'priority' => 10
    ))
);

$wp_customize->add_setting( 'swm_header_bg_image' );

$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize, 'swm_header_bg_image', array(
        'label'    => esc_html__( 'Background Image', 'election' ),
        'section'  => 'swm_customizer_header',
        'settings' => 'swm_header_bg_image',
        'priority' => 11
    ))
);

$wp_customize->add_setting( 'swm_header_bg_position', array(
    'default' => 'center'
));

$wp_customize->add_control( 'swm_header_bg_position', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Background Position', 'election' ),
    'section'  => 'swm_customizer_header',
    'priority' => 12,
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

$wp_customize->add_setting( 'swm_header_bg_repeat', array(
    'default' => 'repeat'
));

$wp_customize->add_control( 'swm_header_bg_repeat', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Background Repeat', 'election' ),
    'section'  => 'swm_customizer_header',
    'priority' => 13,
    'choices'  => array(
        'repeat'    => esc_html__( 'Repeat', 'election' ),
        'no-repeat' => esc_html__( 'No Repeat', 'election' ),
        'repeat-x'  => esc_html__( 'Repeat X', 'election' ),
        'repeat-y'  => esc_html__( 'Repeat Y', 'election' )       
    )
));

$wp_customize->add_setting( 'swm_header_bg_attachment', array(
    'default' => 'scroll'
));

$wp_customize->add_control( 'swm_header_bg_attachment', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Background Attachment', 'election' ),
    'section'  => 'swm_customizer_header',
    'priority' => 14,
    'choices'  => array(
        'scroll'    => esc_html__( 'Scroll', 'election' ),
        'fixed' => esc_html__( 'Fixed', 'election' )          
    )
));

$wp_customize->add_setting( 'swm_header_bg_stretch', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_header_bg_stretch', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( '100% Background Image Width', 'election' ),
    'section'  => 'swm_customizer_header',
    'priority' => 15 
));


/* Header Height -------------------------------------------------- */

$wp_customize->add_setting( 'swm_header_height', array(
'default' => '300'
));

$wp_customize->add_control( 'swm_header_height', array(
'type'     => 'text',
'label'    => esc_html__( 'Header Height', 'election' ),
'section'  => 'swm_customizer_header',
'priority' => 30
));

/* Parallax Scroll -------------------------------------------------- */


$wp_customize->add_setting( 'swm_enable_parallax_effect', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_enable_parallax_effect', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Enable Parallax Scrolling', 'election' ),
    'section'  => 'swm_customizer_header',
    'priority' => 39  
));


$wp_customize->add_setting( 'swm_header_parallax_speed', array(
'default' => '2.5'
));

$wp_customize->add_control(           
    new SWM_Customize_Parallax_Slider_Control( $wp_customize, 'swm_header_parallax_speed', array(
        'label'    => esc_html__( 'Background Image Scroll Speed', 'election' ),
        'section' => 'swm_customizer_header',
        'settings' => 'swm_header_parallax_speed',       
        'priority' => 49
    ))
);

$wp_customize->add_setting( 'swm_disable_header_auto_height_js', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_disable_header_auto_height_js', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Disable Auto Height Javascript Function for Header Image', 'election' ),
    'section'  => 'swm_customizer_header',
    'priority' => 60
));

/* ************************************************************************************** 
Categories
************************************************************************************** */

$wp_customize->add_setting( 'swm_header_section_categories' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_header_section_categories', array(
        'label'    => esc_html__( 'Post Category Page Header', 'spiritual' ),
        'section'  => 'swm_customizer_header',
        'settings' => 'swm_header_section_categories',
        'priority' => 90
    ))
);

$swm_get_categories = get_categories();

if ($swm_get_categories) {

    $sm_cat_links_number = 101;

    foreach($swm_get_categories as $swm_category) {        

            $sm_cat_links_number++;

            $swm_cname = $swm_category->slug.'_bg';
            $swm_cname_img = $swm_category->slug.'_bg_img';
            $swm_cname_title = $swm_category->slug.'_title';
            $swm_cname_title_bg = $swm_category->slug.'_title_bg';
            $swm_cname_title_bg_opacity = $swm_category->slug.'_title_bg_opacity';

            $wp_customize->add_setting( $swm_cname, array(
                'default' => '#262626'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control( $wp_customize, $swm_cname, array(
                     'label'    => '"'.$swm_category->name.'" Background Color',
                    'section'  => 'swm_customizer_header',
                    'settings' => $swm_cname,
                     'priority' => $sm_cat_links_number
                ))
            );

            $wp_customize->add_setting( $swm_cname_img );

            $wp_customize->add_control(
                new WP_Customize_Image_Control( $wp_customize, $swm_cname_img, array(
                    'label'    => '"'.$swm_category->name.'" ' . esc_html__( 'Background Image', 'election' ),
                    'section'  => 'swm_customizer_header',
                    'settings' => $swm_cname_img,
                    'priority' => $sm_cat_links_number
                ))
            );

            $wp_customize->add_setting( $swm_cname_title, array(
                'default' => '#ffffff'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control( $wp_customize, $swm_cname_title, array(
                     'label'    => '"'.$swm_category->name.'" ' . esc_html__( 'Title Color', 'election' ),
                    'section'  => 'swm_customizer_header',
                    'settings' => $swm_cname_title,
                     'priority' => $sm_cat_links_number
                ))
            );

            $wp_customize->add_setting( $swm_cname_title_bg, array(
                'default' => '#093f7f'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control( $wp_customize, $swm_cname_title_bg, array(
                    'label'    => '"'.$swm_category->name.'" ' . esc_html__( 'Title Background Color', 'election' ),
                    'section'  => 'swm_customizer_header',
                    'settings' => $swm_cname_title_bg,
                    'priority' => $sm_cat_links_number
                ))
            );

            $wp_customize->add_setting( $swm_cname_title_bg_opacity, array(
            'default' => '90'
            ));

            $wp_customize->add_control(           
                new SWM_Customize_Slider_Control( $wp_customize, $swm_cname_title_bg_opacity, array(
                    'label'    => '"'.$swm_category->name.'" ' . esc_html__( 'Background Color Opacity (%)', 'election' ),
                    'section' => 'swm_customizer_header',
                    'settings' => $swm_cname_title_bg_opacity,       
                    'priority' => $sm_cat_links_number
                ))
            );
       
    }
}