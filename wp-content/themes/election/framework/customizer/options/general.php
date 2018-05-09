<?php

/* ************************************************************************************** 
General
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_general', array(
'title'    => esc_html__( 'General', 'election' ),
'priority' => 1
));

$wp_customize->add_setting( 'swm_customizer_general_settings' );

/* Site Layout -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_website_layout', array(
'default' => 'wide'
));

$wp_customize->add_control( 'swm_website_layout', array(
'type'     => 'select',
'label'    => esc_html__( 'Site Layout', 'election' ),
'section'  => 'swm_customizer_general',
'priority' => 20,
'choices'  => array(
  'wide' => esc_html__( 'Wide (Full Width)', 'election' ),
  'boxed' => esc_html__( 'Boxed', 'election' )
)
));

/* Google Analytical -------------------------------------------------- */ 

$wp_customize->add_setting( 'swm_google_analytical');

$wp_customize->add_control( 'swm_google_analytical', array(
'type'     => 'text',
'label'    => esc_html__( 'Google Analytical Code', 'election' ),
'section'  => 'swm_customizer_general',
'priority' => 30
));

/* Display Hide -------------------------------------------------- */

$wp_customize->add_setting( 'swm_show_hide_subtitle' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_show_hide_subtitle', array(
        'label'    => esc_html__( 'On / Off ( Enable / Disable )', 'election' ),
        'section'  => 'swm_customizer_general',
        'settings' => 'swm_show_hide_subtitle',
        'priority' => 50
    ))
);

$wp_customize->add_setting( 'swm_customizer_show_hide_settings' );

$swm_show_hide = array(
    "swm_search_box"            =>  esc_html__('Display Search Icon in Top Bar', 'election' ),
    "swm_topbar_cart_icon"      =>  esc_html__('Display Cart Icon in Top Bar', 'election' ),
    "swm_scroll_top_arrow"      =>  esc_html__('Display Scroll To Top Arrow Icon', 'election' ),      
    "swm_breadcrumbs"           =>  esc_html__('Display Breadcrumbs', 'election' ),
    "swm_commnets_in_pages"     =>  esc_html__('Display Comments in Pages', 'election' )
);

$sm_show_hide_number = 51;

$default_show_hides = array(1,1,1,1,0);

$default_sh_no = 0;

foreach ($swm_show_hide as $section_name => $section_details) {

    $sm_show_hide_number++;

    $wp_customize->add_setting( $section_name, array(
        'default' => $default_show_hides[$default_sh_no]
    ));

    $wp_customize->add_control( $section_name, array(
        'type'     => 'checkbox',
        'label'    => $section_details,
        'section'  => 'swm_customizer_general',
        'priority' => $sm_show_hide_number
    )); 

    $default_sh_no++;

}    

