<?php
$google_font_family_list = array();
$swm_google_fonts_weight = array();
$all_google_fonts = file( get_template_directory() . '/framework/customizer/options/googlefonts.json' );
$google_fonts = implode( '', $all_google_fonts );
$swm_font_list_json_decode = json_decode( $google_fonts, true );

foreach ( $swm_font_list_json_decode['items'] as $key => $value ) 
{
    $item_family = $swm_font_list_json_decode['items'][$key]['family'];
    $google_font_family_list[$item_family] = $item_family; 
    $swm_google_fonts_weight[$item_family] = $swm_font_list_json_decode['items'][$key]['variants'];
}

$list_all_font_weights = array(
    '100'       => esc_html__( 'Thin', 'election' ),
    '100italic' => esc_html__( 'Thin Italic', 'election' ),
    '200'       => esc_html__( 'Light', 'election' ),
    '200italic' => esc_html__( 'Light Italic', 'election' ),
    '300'       => esc_html__( 'Book', 'election' ),
    '300italic' => esc_html__( 'Book Italic', 'election' ),
    '400'       => esc_html__( 'Regular', 'election' ),
    '400italic' => esc_html__( 'Regular Italic', 'election' ),
    '500'       => esc_html__( 'Medium', 'election' ),
    '500italic' => esc_html__( 'Medium Italic', 'election' ),
    '600'       => esc_html__( 'Semi-Bold', 'election' ),
    '600italic' => esc_html__( 'Semi-Bold Italic', 'election' ),
    '700'       => esc_html__( 'Bold', 'election' ),
    '700italic' => esc_html__( 'Bold Italic', 'election' ),
    '800'       => esc_html__( 'Extra Bold', 'election' ),
    '800italic' => esc_html__( 'Extra Bold Italic', 'election' ),
    '900'       => esc_html__( 'Ultra Bold', 'election' ),
    '900italic' => esc_html__( 'Ultra Bold Italic', 'election' )
);

$wp_customize->add_section( 'swm_customizer_fonts', array(
    'title'    => esc_html__( 'Fonts', 'election' ),
    'priority' => 6
));

$wp_customize->add_setting( 'swm_google_fonts_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_google_fonts_title', array(
        'label'    => esc_html__( 'Google Fonts', 'election' ),
        'section'  => 'swm_customizer_fonts',
        'settings' => 'swm_google_fonts_title',
        'priority' => 10
    ))
);

$wp_customize->add_setting( 'swm_google_font_weight_list', array(
    'default' => $swm_google_fonts_weight
));

$wp_customize->add_setting( 'swm_google_fonts', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_google_fonts', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Activate Google Fonts', 'election' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 20
));

// Sub Sets

$wp_customize->add_setting( 'swm_google_font_subset', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Enable Subsets', 'election' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 30
));

$wp_customize->add_setting( 'swm_google_font_subset_cyrillic', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset_cyrillic', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Cyrillic', 'election' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 31
));

$wp_customize->add_setting( 'swm_google_font_subset_greek', array(
'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset_greek', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Greek', 'election' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 32
));

$wp_customize->add_setting( 'swm_google_font_subset_vietnamese', array(
'default' => 0
));

$wp_customize->add_control( 'swm_google_font_subset_vietnamese', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Vietnamese', 'election' ),
    'section'  => 'swm_customizer_fonts',
    'priority' => 33
));

// Font Family

$swm_google_font_famalies = array(
    "swm_body_font_family"       =>  esc_html__('Body ', 'election' ),
    "swm_top_nav_font_family"    =>  esc_html__('Top Navigation', 'election' ),
    "swm_headings_font_family"   =>  esc_html__('Headings (H1,H2,H3...)', 'election' )    
);

$swm_gff_number = 50;

foreach ($swm_google_font_famalies as $family_control => $family_label) 
{

    $swm_gff_number = $swm_gff_number + 2;

    $wp_customize->add_setting( $family_control, array(
        'default' => 'Open Sans'
    ));

    $wp_customize->add_control( $family_control, array(
        'type'     => 'select',
        'label'    => $family_label,
        'section'  => 'swm_customizer_fonts',
        'choices'  => $google_font_family_list,
        'priority' => $swm_gff_number
    )); 
}  


// Font Weight

$swm_fonts_weight = array( "swm_body_font_weight","swm_top_nav_font_weight","swm_headings_font_weight");

$sm_font_weight_number = 51;

foreach ($swm_fonts_weight as $font_weight) 
{

    $sm_font_weight_number = $sm_font_weight_number + 2;

    $wp_customize->add_setting( $font_weight, array(
        'default' => 'regular'
    ));

    $wp_customize->add_control( $font_weight, array(
        'type'     => 'radio',
        'label'    => '',
        'section'  => 'swm_customizer_fonts',
        'priority' => $sm_font_weight_number,
        'choices'  => $list_all_font_weights
    )); 
}

// Standard Fonts ==========================================================================================

$wp_customize->add_setting( 'swm_standard_fonts_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_standard_fonts_title', array(
        'label'    => esc_html__( 'Standard Fonts', 'election' ),
        'section'  => 'swm_customizer_fonts',
        'settings' => 'swm_standard_fonts_title',
        'priority' => 99
    ))
);

$wp_customize->add_setting( 'swm_standard_fonts_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_standard_fonts_info', array(
      'label'    => esc_html__( 'If you don\'t want to use Google fonts for body, top navigation or headings then select system\'s standard fonts and font weight.', 'election' ),
      'section'  => 'swm_customizer_fonts',
      'settings' => 'swm_standard_fonts_info',
      'priority' => 100
    ))
);


// Font Family and Weight

$swm_standard_fonts_list = array(
    'none' => 'Select a Font',
    'Arial' => 'Arial',
    'Arial Black' => 'Arial Black',
    'Georgia' => 'Georgia',         
    'Impact' => 'Impact',       
    'MS Sans Serif' => 'MS Sans Serif',
    'Palatino Linotype' => 'Palatino Linotype',
    'Trebuchet MS' => 'Trebuchet MS',      
    'Times' => 'Times New Roman',
    'Tahoma' => 'Tahoma',
    'Verdana' => 'Verdana',
);

$swm_standard_fonts_weight = array(
    '400' => 'Regular',
    '400italic' => 'Italic',
    '700' => 'Bold',    
    '700italic' => 'Bold Italic'
);

$swm_standard_font_famalies = array(
    "swm_body_sf"       =>  esc_html__('Body ', 'election' ),
    "swm_top_nav_sf"    =>  esc_html__('Top Navigation', 'election' ),
    "swm_headings_sf"   =>  esc_html__('Headings (H1,H2,H3...)', 'election' )    
);

$swm_sff_number = 101;

foreach ($swm_standard_font_famalies as $family_control => $family_label) 
{

    $swm_sff_number = $swm_sff_number + 2;

    $wp_customize->add_setting( $family_control, array(
        'default' => 'none'
    ));

    $wp_customize->add_control( 
         new SWM_Customize_Control_Mini_Select( $wp_customize, $family_control, array(
            'type'     => 'miniselect',
            'label'    => $family_label,
            'section'  => 'swm_customizer_fonts',          
            'choices'  => $swm_standard_fonts_list,
            'priority' => $swm_sff_number
        ))
    );
} 

$swm_standard_font_famalies_weight = array( "swm_body_sw", "swm_top_nav_sw", "swm_headings_sw" );

$swm_sfw_number = 102;

foreach ($swm_standard_font_famalies_weight as $family_control) 
{

    $swm_sfw_number = $swm_sfw_number + 2;

    $wp_customize->add_setting( $family_control, array(
        'default' => 'regular'
    ));

    $wp_customize->add_control( 
        new SWM_Customize_Control_Mini_Select( $wp_customize, $family_control, array(
            'type'     => 'miniselect',
            'label'    => '&nbsp;',
            'section'  => 'swm_customizer_fonts',           
            'choices'  => $swm_standard_fonts_weight,
            'priority' => $swm_sfw_number
        ))
    );
} 

// Font size and color ==========================================================================================

$wp_customize->add_setting( 'swm_font_size_color_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_font_size_color_title', array(
        'label'    => esc_html__( 'Font Size and Color', 'election' ),
        'section'  => 'swm_customizer_fonts',
        'settings' => 'swm_font_size_color_title',
        'priority' => 200
    ))
);

$swm_font_size_sections = array(
    "swm_body_sc"       =>  esc_html__('Body', 'election' ),
    "swm_top_nav_sc"       =>  esc_html__('Top Navigation', 'election' ),
    "swm_top_bar_sc"       =>  esc_html__('Top Bar Small Navigation', 'election' ),
    "swm_page_title_sc"    =>  esc_html__('Page Title (Header Section)', 'election' ),
    "swm_sidebar_h2_sc"    =>  esc_html__('Sidebar Widget Title', 'election' ),
    "swm_footer_h2_sc"     =>  esc_html__('Footer Widget Title', 'election' ),
    "swm_footer_text_sc"     =>  esc_html__('Footer Text', 'election' ),
    "swm_small_footer_sc"  =>  esc_html__('Small Footer', 'election' ),
    "swm_blog_post_sc"     =>  esc_html__('Blog Post Title', 'election' ),
    "swm_h1_sc"            =>  esc_html__('Heading H1', 'election' ),
    "swm_h2_sc"            =>  esc_html__('Heading H2', 'election' ),
    "swm_h3_sc"            =>  esc_html__('Heading H3', 'election' ),
    "swm_h4_sc"            =>  esc_html__('Heading H4', 'election' ),
    "swm_h5_sc"            =>  esc_html__('Heading H5', 'election' ),
    "swm_h6_sc"            =>  esc_html__('Heading H6', 'election' )    
);

$swm_color_number = 202;

$default_font_colors = array('#606060','#ffffff','#ffffff','#ffffff','#000000','#ffffff','#ffffff','#ffffff','#000000','#000000','#000000','#000000','#000000','#000000','#000000');

$default_fz_no = 0;


foreach ($swm_font_size_sections as $control_name => $section_label) 
{

    $swm_color_number = $swm_color_number + 2;


    $wp_customize->add_setting( $control_name . '_color', array(
        'default' => $default_font_colors[$default_fz_no]
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control( $wp_customize, $control_name . '_color', array(
          'label'    => $section_label,
          'section'  => 'swm_customizer_fonts',
          'settings' => $control_name . '_color',
          'priority' => $swm_color_number
        ))
    );

    $default_fz_no++;
} 


for ( $i = 8; $i<73; $i++ ) { $swm_font_size_count[$i . 'px'] = $i . 'px'; } 

$swm_size_number = 203;

$default_font_sizes = array('12px','15px','11px','27px','15px','17px','13px','12px','24px','24px','20px','17px','15px','13px','24px');

$default_fz_no = 0;

foreach ( $swm_font_size_sections as $control_name  => $section_label ) 
{

    $swm_size_number = $swm_size_number + 2;

    $wp_customize->add_setting( $control_name . '_size', array(
        'default' => $default_font_sizes[$default_fz_no]
    ));

    $wp_customize->add_control( 
         new SWM_Customize_Control_Mini_Select( $wp_customize, $control_name . '_size', array(
            'type'     => 'miniselect',
            'label'    => '&nbsp;',
            'section'  => 'swm_customizer_fonts',          
            'choices'  => $swm_font_size_count,
            'priority' => $swm_size_number
        ))
    );

    $default_fz_no++;
}