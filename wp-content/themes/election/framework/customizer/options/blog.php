<?php

/* ************************************************************************************** 
Blog
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_blog', array(
    'title'    => esc_html__( 'Blog', 'election' ),
    'priority' => 8
));

$swm_blog_layout = array(
    "layout-sidebar-right" => esc_html__( 'Sidebar Right','election' ),
    "layout-sidebar-left" => esc_html__( 'Sidebar Left','election' ),
    "layout-full-width" => esc_html__( 'Full Width','election' )   
);

$swm_blog_style = array(
    "blog-style-standard" => esc_html__( 'Standard','election' ),
    "blog-style-grid" => esc_html__( 'Grid','election' ),        
    "blog-style-fullwidth" => esc_html__( 'Full Width','election' )   
);

$swm_blog_style_single = array(
    "blog-style-standard" => esc_html__( 'Standard','election' ),    
    "blog-style-fullwidth" => esc_html__( 'Full Width','election' )   
);

$swm_blog_grid_column = array(
    "swm_column2" => esc_html__( '2 Column','election' ),
    "swm_column3" => esc_html__( '3 Column','election' ),
    "swm_column4" => esc_html__( '4 Column','election' )    
);

$wp_customize->add_setting( 'swm_blog_all_layout', array(
    'default' => 'layout-sidebar-right'
));

$wp_customize->add_control( 'swm_blog_all_layout', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Default Blog Layout', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 29,
    'choices'  => $swm_blog_layout
));

$wp_customize->add_setting( 'swm_blog_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_blog_section_info', array(
      'label'    => esc_html__( 'Select your preferred layout for blog pages like archive, categories, author and tags etc. blog pages.', 'election' ),
      'section'  => 'swm_customizer_blog',
      'settings' => 'swm_blog_section_info',
      'priority' => 30
    ))
);

$wp_customize->add_setting( 'swm_blog_all_style', array(
    'default' => 'blog-style-standard'
));

$wp_customize->add_control( 'swm_blog_all_style', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Blog Style', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 31,
    'choices'  => $swm_blog_style
));

$wp_customize->add_setting( 'swm_blog_grid_column', array(
    'default' => 'swm_column3'
));

$wp_customize->add_control( 'swm_blog_grid_column', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Blog Grid Column', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 32,
    'choices'  => $swm_blog_grid_column
));



$wp_customize->add_setting( 'swm_show_excerpt', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_show_excerpt', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Display Excerpt', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 33
));

$wp_customize->add_setting( 'swm_excerpt_length', array(
'default' => '320'
));

$wp_customize->add_control( 'swm_excerpt_length', array(
    'type'     => 'text',
    'label'    => esc_html__( 'Excerpt Length', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 34
));

$wp_customize->add_setting( 'swm_blog_pagination_style', array(
'default' => 'standard'
));

$wp_customize->add_control( 'swm_blog_pagination_style', array(
    'type'     => 'select',
    'label'    => esc_html__( 'Pagination Style', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 35,
    'choices'  => array(
	    "standard" => esc_html__( 'Standard','election' ),
	    "next-prev" => esc_html__( 'Next - Previous','election' ),        
	    "infinite-scroll" => esc_html__( 'Infinite Scroll','election' )   
	)
));

$wp_customize->add_setting( 'swm_multiple_featured_imgs', array(
'default' => '5'
));

$wp_customize->add_control( 'swm_multiple_featured_imgs', array(
'type'     => 'text',
'label'    => esc_html__( 'How Many Multiple Featued Images', 'election' ),
'section'  => 'swm_customizer_blog',
'priority' => 60
));

$wp_customize->add_setting( 'swm_blog_exclude_cats', array(
'default' => ''
));

$wp_customize->add_control( 'swm_blog_exclude_cats', array(
'type'     => 'text',
'label'    => esc_html__( 'Exclude Categories from Blog', 'election' ),
'section'  => 'swm_customizer_blog',
'priority' => 61
));

$wp_customize->add_setting( 'swm_blog_exclude_cat_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_blog_exclude_cat_info', array(
      'label'    => esc_html__( 'Add category IDs, seperated by commas. ( e.g. 1,34,55 )', 'election' ),
      'section'  => 'swm_customizer_blog',
      'settings' => 'swm_blog_exclude_cat_info',
      'priority' => 62
    ))
);

$wp_customize->add_setting( 'swm_display_post_year', array(
    'default' => 0
));

$wp_customize->add_control( 'swm_display_post_year', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Enable Post Year in Date Box', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 63
));

/* ************************************************************************************** 
Blog Single Page
************************************************************************************** */

$wp_customize->add_setting( 'swm_blog_single_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_blog_single_title', array(
        'label'    => esc_html__( 'Blog Single Page', 'election' ),
        'section'  => 'swm_customizer_blog',
        'settings' => 'swm_blog_single_title',
        'priority' => 100
    ))
);

$wp_customize->add_setting( 'swm_single_featured_imgvid', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_single_featured_imgvid', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Display Featured Image/Video', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 112
));

$wp_customize->add_setting( 'swm_single_about_author', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_single_about_author', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Display About Author Box', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 113
));

$wp_customize->add_setting( 'swm_single_comments', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_single_comments', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Display Post Comments', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 114
));

$wp_customize->add_setting( 'swm_single_image_lightbox', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_single_image_lightbox', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Featured Image Lightbox', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 115
));

$wp_customize->add_setting( 'swm_single_page_title', array(
'default' => 'Blog'
));

$wp_customize->add_control( 'swm_single_page_title', array(
'type'     => 'text',
'label'    => esc_html__( 'Single Page Title', 'election' ),
'section'  => 'swm_customizer_blog',
'priority' => 116
));

$wp_customize->add_setting( 'swm_blog_single_title_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_blog_single_title_info', array(
      'label'    => esc_html__( 'Leave above field blank to display default post title in header section.', 'election' ),
      'section'  => 'swm_customizer_blog',
      'settings' => 'swm_blog_single_title_info',
      'priority' => 117
    ))
);

$wp_customize->add_setting( 'swm_blog_page_url', array(
'default' => '#'
));

$wp_customize->add_control( 'swm_blog_page_url', array(
'type'     => 'text',
'label'    => esc_html__( 'Blog Page URL', 'election' ),
'section'  => 'swm_customizer_blog',
'priority' => 118
));

$wp_customize->add_setting( 'swm_blog_page_url_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_blog_page_url_info', array(
      'label'    => esc_html__( 'Enter the URL to blog main page to use in breadcrumbs.', 'election' ),
      'section'  => 'swm_customizer_blog',
      'settings' => 'swm_blog_page_url_info',
      'priority' => 119
    ))
);

/* ************************************************************************************** 
Archives Pages
************************************************************************************** */


$wp_customize->add_setting( 'swm_archive_page_subtitle' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_archive_page_subtitle', array(
        'label'    => esc_html__( 'Archives Page', 'election' ),
        'section'  => 'swm_customizer_blog',
        'settings' => 'swm_archive_page_subtitle',
        'priority' => 151
    ))
);

$wp_customize->add_setting( 'swm_blog_section_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_blog_section_info', array(
      'label'    => esc_html__( 'Settins for blog pages like archives, categories, author, tags etc.', 'election' ),
      'section'  => 'swm_customizer_blog',
      'settings' => 'swm_blog_section_info',
      'priority' => 152
    ))
);

$wp_customize->add_setting( 'swm_archives_sidebar', array(
    'default' => ''
));

$wp_customize->add_control(
    new SWM_Customize_Sidebar_Control( $wp_customize,'swm_archives_sidebar', array(
            'label'    => 'Select Sidebar Name',
            'settings' => 'swm_archives_sidebar',
            'section'  => 'swm_customizer_blog',
            'priority'   => 154
        )
    )
);

$wp_customize->add_setting( 'swm_blog_archive_sidebar_info' );

$wp_customize->add_control(
    new SWM_Customize_Description( $wp_customize, 'swm_blog_archive_sidebar_info', array(
      'label'    => esc_html__( 'Do not select "Footer Column 1" to "Footer Column 5" Sidebar because this sidebars are designed for footer widget section.', 'election' ),
      'section'  => 'swm_customizer_blog',
      'settings' => 'swm_blog_archive_sidebar_info',
      'priority' => 155
    ))
);

/* ************************************************************************************** 
Author Page
************************************************************************************** */

$wp_customize->add_setting( 'swm_blog_author_title' );

$wp_customize->add_control(
    new SWM_Customize_Sub_Title( $wp_customize, 'swm_blog_author_title', array(
        'label'    => esc_html__( 'Author Page', 'election' ),
        'section'  => 'swm_customizer_blog',
        'settings' => 'swm_blog_single_title',
        'priority' => 200
    ))
);

$wp_customize->add_setting( 'swm_show_author_bio', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_show_author_bio', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Display Author Biographical Info', 'election' ),
    'section'  => 'swm_customizer_blog',
    'priority' => 201
));