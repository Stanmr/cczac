<?php

if (!function_exists('swm_output_styles')) {
    function swm_output_styles() {

$swm_primary_skin = get_theme_mod('swm_primary_skin_color','#093f7f');
$swm_secondary_skin = get_theme_mod('swm_secondary_skin_color','#b93941');

$output = '';
$swm_postid = swm_get_id();
$swm_body_bg = array();
$swm_get_queried_object_id = get_queried_object_id();

if ( SWM_WOOCOMMERCE_IS_ACTIVE ) {      
    if ( is_shop() ) {
        $swm_get_queried_object_id = wc_get_page_id( 'shop' );
    }
}

$output .= '<style type="text/css" media="all">
';

// =================================== 

// Body font -family,weight,color and size,background color and image

$swm_body_bg['default_body_bg_color'] = get_theme_mod('swm_body_bg_color','#606060');
$swm_body_bg['default_body_bg_image'] = get_theme_mod('swm_body_bg_image');
$swm_body_bg['default_body_bg_repeat'] = get_theme_mod('swm_body_bg_repeat','no-repeat');
$swm_body_bg['default_body_bg_position'] = get_theme_mod('swm_body_bg_position','center-top');
$swm_body_bg['default_body_bg_attachment'] = get_theme_mod('swm_body_bg_attachment','fixed');
$swm_body_bg['default_body_bg_stretch'] = get_theme_mod('swm_body_bg_stretch',0);

if (function_exists('rwmb_meta')) {    

    $swm_body_bg['meta_body_bg_color'] = get_post_meta( $swm_get_queried_object_id, 'swm_meta_body_bg_color', true );

    $swm_get_meta_body_bg_image   = get_post_meta( $swm_get_queried_object_id, 'swm_meta_body_bg_image', true );
    $swm_get_meta_body_bg_image_src = wp_get_attachment_image_src($swm_get_meta_body_bg_image,'full');
    $swm_final_meta_header_bg_images = $swm_get_meta_body_bg_image_src[0];
    $swm_body_bg['final_meta_body_bg_image'] = $swm_final_meta_header_bg_images;

    if ( ! empty($swm_body_bg['final_meta_body_bg_image']) ) {
        $swm_body_bg['default_body_bg_repeat'] = get_post_meta( $swm_get_queried_object_id, 'swm_meta_body_bg_image_repeat', true );
        $swm_body_bg['default_body_bg_position'] = get_post_meta( $swm_get_queried_object_id, 'swm_meta_body_bg_image_position', true );
        $swm_body_bg['default_body_bg_attachment'] = get_post_meta( $swm_get_queried_object_id, 'swm_meta_body_bg_image_attachment', true );
        $swm_body_bg['default_body_bg_stretch'] = get_post_meta( $swm_get_queried_object_id, 'swm_meta_body_bg_image_stretch', true );
    }

}

$swm_body_bg['final_body_bg_color'] = empty($swm_body_bg['meta_body_bg_color']) ? $swm_body_bg['default_body_bg_color'] : $swm_body_bg['meta_body_bg_color'];
$swm_body_bg['final_body_bg_image'] = empty($swm_body_bg['final_meta_body_bg_image']) ? $swm_body_bg['default_body_bg_image'] : $swm_body_bg['final_meta_body_bg_image'];

$output .= 'body { '. swm_output_font_family_weight('swm_body_font_family','swm_body_font_weight','swm_body_sf','swm_body_sw');    

$output .= empty( $swm_body_bg['final_body_bg_color'] ) ? "" : 'background-color: ' . $swm_body_bg['final_body_bg_color'] .'; ';
        
        if ($swm_body_bg['final_body_bg_image'] != '') {
            $output .= 'background-image:url(' . $swm_body_bg['final_body_bg_image'] . '); ';
            $output .= 'background-position:' . str_replace( '-', ' ', $swm_body_bg['default_body_bg_position']) . '; ';
            $output .= 'background-repeat: ' . $swm_body_bg['default_body_bg_repeat'] . '; ';
            $output .= 'background-attachment: ' . $swm_body_bg['default_body_bg_attachment'] . '; ';

            if ($swm_body_bg['default_body_bg_stretch']) {
                $output .= 'background-size: cover;';
            }
        } 

$output .= swm_output_font_size_color('swm_body_sc_size','swm_body_sc_color');

$output .= '}
';

//Site preloader

$output .= '.swm_site_loader { background:'.get_theme_mod('swm_page_preloader_bg','#ffffff').'; }
.swm_loader span { border:4px solid '.get_theme_mod('swm_page_preloader_circle_two','#e6e6e6').';  border-top: 4px solid '.get_theme_mod('swm_page_preloader_circle_one','#093f7f').'; }';

// General color

$output .= '.swm_archives_page a,.search-list a,.swm_portfolio_title_section a,.swm_portfolio_title_section,.swm_horizontal_menu li a,a.swm_text_color,.swm_text_color a,a.page-numbers,.pagination_menu a span,.pf_quote p.pf_quote_text a,.swm_search_meta ul li a { color:'. get_theme_mod('swm_body_sc_color','#606060') .' }';
$output .= '.swm_archives_page a:hover,.search-list a:hover,.icon_url a i.fa-link,a.swm_text_color:hover,.swm_search_meta ul li a:hover { color:'.$swm_primary_skin.'}';

$output .= '.swm_horizontal_menu li a.active,.swm_horizontal_menu li.current_page_item a,.swm_highlight_skin_color,ul.mobi-menu li,.sf-menu ul li,#wp-calendar caption { background:'.$swm_primary_skin.';}';
$output .= '.swm_horizontal_menu li a.active,.swm_horizontal_menu li.current_page_item a { border-color:'.$swm_primary_skin.';}';

$output .= '::selection {color:#fff; background:'.$swm_primary_skin.'; }';
$output .= '::-moz-selection {color:#fff;background:'.$swm_primary_skin.'; }';

$output .= '.swm_text_color a:hover,.swm_portfolio_box .project_title a:hover { color:'.$swm_secondary_skin.'}';

// Main Container

if (function_exists('rwmb_meta')) {

    $swm_main_container_top_padding = '';
    $swm_main_container_bottom_padding = '';
    $swm_meta_page_content_top_padding = get_post_meta( $swm_get_queried_object_id, 'swm_meta_page_content_top_padding', true );
    $swm_meta_page_content_bottom_padding = get_post_meta( $swm_get_queried_object_id, 'swm_meta_page_content_bottom_padding', true );

    if ( $swm_meta_page_content_top_padding != '' ) {
        $swm_main_container_top_padding = 'padding-top:'.$swm_meta_page_content_top_padding.';';
    }
    if ( $swm_meta_page_content_bottom_padding != '' ) {
        $swm_main_container_bottom_padding = 'padding-bottom:'.$swm_meta_page_content_bottom_padding.';';
    }
    $output .= '#swm_page_container { '.$swm_main_container_top_padding.' '.$swm_main_container_bottom_padding.'}';
}

// primary secondary colors
$output .= 'a,.primary_color a,.author_title h4 span,.swm_portfolio_title_section a:hover { color: '.$swm_primary_skin.' }';
$output .= 'a:hover,.primary_color a:hover,.icon_url a:hover i.fa-link { color:'.$swm_secondary_skin.'}';

// Headings

$output .= 'h1,h2,h3,h4,h5,h6,.pf_image_caption .img_title {' . swm_output_font_family_weight('swm_headings_font_family','swm_headings_font_weight','swm_headings_sf','swm_headings_sw') . '}';
$output .= 'h1 {' . swm_output_font_size_color('swm_h1_sc_size','swm_h1_sc_color') . ' }';
$output .= 'h2 {' . swm_output_font_size_color('swm_h2_sc_size','swm_h2_sc_color') . ' }';
$output .= 'h3 {' . swm_output_font_size_color('swm_h3_sc_size','swm_h3_sc_color') . ' }';
$output .= 'h4 {' . swm_output_font_size_color('swm_h4_sc_size','swm_h4_sc_color') . ' }';
$output .= 'h5 {' . swm_output_font_size_color('swm_h5_sc_size','swm_h5_sc_color') . ' }';
$output .= 'h6 {' . swm_output_font_size_color('swm_h6_sc_size','swm_h6_sc_color') . ' }';

// logo

$output .= '.logo_section { background:'. get_theme_mod('swm_logo_bg_color','#b93a43') . '; }';

// Search Box

$output .= '.swm_search_box form input.button:hover { background: ' . $swm_primary_skin . '; }';
$output .= '.swm_search_box form input.button { background: ' . $swm_secondary_skin . '; }';

// Blog

$output .= '.swm_blog_post h2 a,.swm_blog_post h2,.swm_blog_post h1 a,.swm_blog_post h1,.swm_blog_grid h2 a,.swm_blog_grid h2  {' . swm_output_font_size_color('swm_blog_post_sc_size','swm_blog_post_sc_color') . ' }';
$output .= '.p_comment_arrow { border-color: transparent ' . $swm_secondary_skin . ' transparent transparent; }';
$output .= '.swm_post_meta ul li a,.page-numbers span.dots {color:'.get_theme_mod('swm_body_sc_color','#606060').';  }';
$output .= 'a.p_continue_reading,.swm_blog_grid_sort a.p_continue_reading:hover,.swm_portfolio_text a.p_continue_reading:hover { color:' . $swm_primary_skin . '; }';
$output .= 'a:hover.p_continue_reading,.swm_post_meta ul li a:hover,.swm_blog_post h2 a:hover,.sidebar ul.menu > li ul li.current-menu-item > a,.sidebar .widget_nav_menu  ul li.current-menu-item a,.sidebar .widget_nav_menu  ul li.current-menu-item:before,.sidebar .widget_categories ul li.current-cat > a,.sidebar .widget_categories ul li.current-cat:before,.widget_product_categories ul li.current-cat > a,.widget_product_categories ul li.current-cat:before,.swm_blog_grid_sort a.p_continue_reading,.swm_portfolio_text a.p_continue_reading {color:' . $swm_secondary_skin . '; }';

$output .= 'small.swm_pf_icon, .page-numbers.current, .page-numbers.current:hover,.next_prev_pagination a,#sidebar .tagcloud a:hover,.pagination_menu > span,.paginate-com span.current,.paginate-com a:hover {background:' . $swm_primary_skin . ';}';
$output .= '.p_comments,.next_prev_pagination a:hover,.sidebar ul.menu > li.current-menu-item > a,.sidebar ul.menu > li.current_page_item > a,.sidebar ul.menu > li.current-menu-parent > a {background:' . $swm_secondary_skin . ';}';
$output .= 'small.post_arrow_shape { border-top: 20px solid ' . $swm_primary_skin . ';}';
$output .= '.page-numbers.current, .page-numbers.current:hover,#sidebar .tagcloud a:hover,.pagination_menu > span,.paginate-com span.current,.paginate-com a:hover { border-color: '.$swm_primary_skin.';}';

// Top Navigation

$output .= '.top_bar_nav ul li a { ' . swm_output_font_size_color('swm_top_bar_sc_size','swm_top_bar_sc_color') . ' }';
$output .= '.top_section_bg { background-color:'. get_theme_mod('swm_nav_background_color','#222945') . '; }';
$output .= '.top_section_bg.transparent_bg_opacity { ' .swm_background_opacity('swm_nav_bg_opacity') .' } ';
$output .= '.sf-menu > li > a {' . swm_output_font_size_color('swm_top_nav_sc_size','swm_top_nav_sc_color') . ' }';
$output .= '.sf-menu > li > a {' . swm_output_font_family_weight('swm_top_nav_font_family','swm_top_nav_font_weight','swm_top_nav_sf','swm_top_nav_sw') .'}';
$output .= 'nav.activeDonate ul.sf-menu > li:last-child a span  { background:' . get_theme_mod('swm_nav_donate_background_color','#b93941') . '; color: ' . get_theme_mod('swm_nav_donate_text_color','#ffffff') . '; }';
$output .= 'nav.activeDonate ul.sf-menu > li:last-child:hover a span  { background:' . get_theme_mod('swm_nav_donate_hover_background_color','#093f7f') . '; color: ' . get_theme_mod('swm_nav_donate_hover_text_color','#ffffff') . '; }';

$swm_current_pg_arrow_display = ( get_theme_mod('swm_display_active_link',1) == 0 ) ? ' display:none; ' : '';

$swm_current_pg = array('current_page_item','current-menu-item','current-menu-parent','current-category-ancestor','current-post-ancestor','current-page-ancestor','current-menu-ancestor');

$swm_current_pg_border      = array();
$swm_current_pg_arrow_icon  = array();
$swm_current_pg_arrow       = array();
$swm_all_current_pg_shape   = array();
$swm_mobile_active_pg       = array();

foreach ($swm_current_pg as $swm_current) 
{
    $swm_current_pg_border[]        = '.sf-menu>li.'.$swm_current.' span.menu_border';
    $swm_current_pg_arrow_icon[]    = '.sf-menu>li.'.$swm_current.' span.menu_arrow small.link_icon';
    $swm_current_pg_arrow[]         = '.sf-menu>li.'.$swm_current.' span.menu_arrow';
    $swm_all_current_pg_shape[]     = '.sf-menu>li.'.$swm_current.' span.menu_arrow small.arrow_shape';
    $swm_mobile_active_pg[]         = '.sf-menu>li.'.$swm_current.' > a';
}

$output .= implode(',', $swm_current_pg_border);
$output .= '{ background: ' . get_theme_mod('swm_nav_active_link_bg','#222945') . '; ' . swm_background_opacity('swm_active_arrow_opacity') . ' ' . $swm_current_pg_arrow_display . '}';

$output .= implode(',', $swm_current_pg_arrow_icon);
$output .= '{ background: ' . get_theme_mod('swm_nav_active_link_bg','#222945') . '; color:' . get_theme_mod('swm_nav_active_icon_color','#ffffff') . ';}';

$output .= implode(',', $swm_current_pg_arrow);
$output .= '{' .swm_background_opacity('swm_active_arrow_opacity') . ' ' . $swm_current_pg_arrow_display . '}';

$output .= implode(',', $swm_all_current_pg_shape);
$output .= '{ border-top: 25px solid ' . get_theme_mod('swm_nav_active_link_bg','#222945') . '; }';
$output .= '#mobile_nav_button:hover { background:' . $swm_secondary_skin . '; }';

// Header

$output .= '.heading_h1 h1,.heading_h1 h1 a { color:' . swm_output_page_element_color('swm_page_title_sc_color','#ffffff','swm_meta_page_title_color') . '; font-size:'. get_theme_mod('swm_page_title_sc_size','#fff') . '; }';
$output .= '.heading_bg { background-color:' . swm_output_page_element_color('swm_page_title_bg',$swm_primary_skin,'swm_meta_page_title_bg') . '; }';
$output .= '.heading_bg.transparent_bg_opacity { ' .swm_background_opacity('page_title_bg_opacity','swm_meta_page_title_bg_opacity') .' } ';

if (is_category() ) :
    $swm_get_query_var_cat = get_query_var('cat');
    $swm_get_cat = get_category($swm_get_query_var_cat);
    $swm_default_header_title_color = get_theme_mod($swm_get_cat->slug.'_title');
     $swm_default_header_title_color = get_theme_mod($swm_get_cat->slug.'_title');  

    if ( $swm_default_header_title_color ) {
        $output .= '.heading_h1 h1,.heading_h1 h1 a { color:' . $swm_default_header_title_color .'; }';
    }

endif;


// Sidebar

$output .= '.sidebar h2,.sidebar h3,.aboutme_widget .person_name {' . swm_output_font_size_color('swm_sidebar_h2_sc_size','swm_sidebar_h2_sc_color') . ' }';
$output .= '.sidebar a { '.swm_output_font_size_color('swm_body_sc_size','swm_body_sc_color').'; }';
$output .= '.sidebar a:hover { color:' . $swm_secondary_skin . ';}';

// Footer

$output .= '.footer h2, .footer h3,.footer .aboutme_widget .person_name {' . swm_output_font_size_color('swm_footer_h2_sc_size','swm_footer_h2_sc_color') . ' }';

$swm_footer_bg_image = get_theme_mod('swm_footer_bg_image');
$swm_footer_bg_color = get_theme_mod('swm_footer_bg_color','#265894');
$swm_footer_bg_color_two = get_theme_mod('swm_footer_bg_color_two','#093f7f');
$swm_footer_border_color = get_theme_mod('swm_footer_border_color','#3b689d');
$swm_footer_text_color = 'color:'.get_theme_mod('swm_footer_text_sc_color','#ffffff').';';
$swm_footer_links_hover_color = get_theme_mod('swm_footer_links_hover_color','#eaff00');

$swm_footer_bg_color_final = empty( $swm_footer_bg_color ) ? "transparent" : $swm_footer_bg_color;           
$swm_footer_bg_image_final = empty( $swm_footer_bg_image ) ? "" : "url(". $swm_footer_bg_image .") " .get_theme_mod('swm_footer_bg_repeat'). " " .str_replace( '-', ' ', get_theme_mod('swm_footer_bg_position','center-top'));

$output .='.swm_footer_bg { background:'.$swm_footer_bg_color_final.' '.$swm_footer_bg_image_final.'; }';
$output .= '.small_footer_bg { background:' .get_theme_mod('swm_small_footer_bg','#093f7f'). '; }';
$output .= '.small_footer { border:1px solid ' . get_theme_mod('swm_small_footer_border_color','#33639e') . '; }';
$output .= '.small_footer_bg.transparent_bg_opacity { ' .swm_background_opacity('small_footer_bg_opacity') .' }';
$output .= '.small_footer ul li a,.small_footer p {' . swm_output_font_size_color('swm_small_footer_sc_size','swm_small_footer_sc_color') . ' }';

$output .= '.footer,.footer a,.footer .client_name_position h5,.footer .client_name_position span,.footer .sm_icons ul li a,.footer .sm_icons ul li a:hover,.footer .widget ul li a,.footer .widget.woocommerce ul li a,.footer ul.product_list_widget li ins,.footer ul.product_list_widget li span.amount,.footer .widget_shopping_cart_content span.amount,.footer .widget_layered_nav ul li.chosen a,.footer .widget_layered_nav_filters ul li a  { '.$swm_footer_text_color.' }';

$output .= '.footer a:hover,.footer #wp-calendar tbody td a,.footer .tp_recent_tweets ul li a:hover,.footer ul.menu > li ul li.current-menu-item > a,.footer .widget_nav_menu  ul li.current-menu-item a,.footer .widget_nav_menu  ul li.current-menu-item:before,.footer .widget_categories ul li.current-cat > a,.footer .widget_categories ul li.current-cat:before,.footer .widget.woocommerce ul li.current-cat a,.footer .widget.woocommerce ul li.current-cat:before,.footer .widget ul li a:hover,.footer .recent_posts_square_posts ul li .grid_date a:hover { color:'.$swm_footer_links_hover_color.'; }';

$output .= '.footer { font-size:'.get_theme_mod('swm_footer_text_sc_size').'; }';
$output .= '.footer #widget_search_form form input[type="text"] { '.$swm_footer_text_color.' text-shadow:none; }';
$output .= '.footer #widget_search_form form input[type="text"]::-webkit-input-placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form form input[type="text"]::-moz-placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form form input[type="text"]::-ms-placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form form input[type="text"]::placeholder { '.$swm_footer_text_color.' opacity:.5; }';
$output .= '.footer #widget_search_form #searchform #s,.footer #widget_search_form #searchform input.button,.footer .aboutme_widget,.footer .aboutme_social,.footer .aboutme_widget .person_img,.footer .widget_product_categories ul li,.footer .widget.woocommerce ul li:first-child,.footer .widget_rss ul li,.footer .uc_events_widget ul li:first-child,.footer .uc_events_widget ul li:last-child { border-color: '.$swm_footer_border_color.'; }';

$output .= '.footer .widget_meta ul li,.footer .widget_categories ul li,.footer .widget_pages ul li,.footer .widget_archive ul li,.footer .widget_recent_comments ul li,.footer .widget_recent_entries ul li,.footer .widget_nav_menu ul li,.footer .widget_meta ul li:before { border-color: '.$swm_footer_border_color.'; }';
$output .= '.footer .widget_categories ul li:before,.footer .widget_pages ul li:before,.footer .widget_archive ul li:before,.footer .widget_recent_comments ul li:before,.footer .widget_recent_entries ul li:before,.footer .widget_nav_menu ul li:before,.footer .widget.woocommerce ul li:before,.footer .widget_rss ul li:before { color: '.$swm_footer_border_color.'; border-color: '.$swm_footer_border_color.'; }';

$output .= '.footer #widget_search_form #searchform input.button { '.$swm_footer_text_color.' }';
$output .= '.footer .input-text,.footer input[type="text"], .footer input[type="input"], .footer input[type="password"], .footer input[type="email"], .footer input[type="number"], .footer input[type="url"], .footer input[type="tel"], .footer input[type="search"], .footer textarea, .footer select,.footer #wp-calendar thead th,.footer #wp-calendar caption,.footer #wp-calendar tbody td,.footer #wp-calendar tbody td:hover { '.$swm_footer_text_color.' border-color: '.$swm_footer_border_color.';}';

$output .= '.footer input[type="text"]:focus, .footer input[type="password"]:focus, .footer input[type="email"]:focus, .footer input[type="number"]:focus, .footer input[type="url"]:focus, .footer input[type="tel"]:focus, .footer input[type="search"]:focus, .footer textarea:focus,footer #widget_search_form #searchform #s:focus { '.$swm_footer_text_color.' border-color: '.get_theme_mod('swm_footer_text_sc_color').';}';

if ( get_theme_mod('swm_scroll_top_arrow',1) == 0 ) {
    $output .= '#go_top_scroll {right:-100px;}';
}

// plugin styles
$output .= '.footer .testimonials-bx-slider .testimonial_box:before { border-color: '.$swm_footer_border_color.' transparent transparent '.$swm_footer_border_color.'; }';
$output .= '.footer .testimonials-bx-slider .testimonial_box:after { border-color: '.$swm_footer_bg_color_two.' transparent transparent '.$swm_footer_bg_color_two.'; }';
$output .= '.footer .testimonial_box,.footer #wp-calendar caption { background:'.$swm_footer_bg_color_two.'; border-top: 1px solid '.$swm_footer_border_color.'; } ';
$output .= '.footer select { background:'.$swm_footer_bg_color_two.' url('.get_template_directory_uri() .'/images/select2.png) no-repeat center right;  }';
$output .= '.footer .bx-controls-direction { background:'.$swm_footer_bg_color.' }';
$output .= '.footer .bx-wrapper .bx-controls-direction a,.footer .testimonial_box .fa-quote-left,.footer .recent_posts_tiny p,.footer .tp_recent_tweets ul li:before,.footer .tp_recent_tweets ul li a,.footer .recent_posts_square_posts ul li .grid_date i { '.$swm_footer_text_color.'; }';
$output .= '.footer .testimonial_box,footer .recent_posts_square_posts ul li { border-color:'.$swm_footer_border_color.'; }';
$output .= '.footer .contact_info,.footer .recent_posts_square_date a,.footer .recent_posts_square_date a:hover { border-color:'.$swm_footer_border_color.'; background:'.$swm_footer_bg_color_two.'; }';
$output .= '.footer ul li.cat-item a small,.footer #wp-calendar thead th,.footer #wp-calendar caption,.footer #wp-calendar tbody td,.footer .tagcloud a:hover,.footer .aboutme_social,.footer .tp_recent_tweets ul li:before {  background:'.$swm_footer_bg_color_two.' }';

/*Custom CSS*/

$swm_custom_css = get_theme_mod('swm_custom_css');
if ($swm_custom_css != '') { 
    $output .= $swm_custom_css; 
}

// Portfolio Page

if ( is_page_template( 'templates/portfolio.php' ) ) { 

    $swm_onoff_page_title_section   = get_post_meta($swm_postid, 'swm_onoff_page_title_section', true );
    $swm_pf_title_font_size         = get_post_meta($swm_postid, 'swm_pf_title_font_size', true );
    $swm_pf_title_font_weight         = get_post_meta($swm_postid, 'swm_pf_title_font_weight', true );
    $swm_pf_excerpt_font_size       = get_post_meta($swm_postid, 'swm_pf_excerpt_font_size', true );

    $output .= '.swm_portfolio_box .swm_portfolio_title_section span.portfolio_title { font-size: '.$swm_pf_title_font_size.'px; font-weight:'.$swm_pf_title_font_weight.'; }';
    $output .= '.swm_portfolio_box .swm_portfolio_title_section span.subtexts { font-size: '.$swm_pf_excerpt_font_size.'px;} ';

    if (!$swm_onoff_page_title_section) {
        $output .= '.swm_portfolio_text,.swm-arrow-up.arrow-portfolio { display:none; }';     
    }

} // end if portfolio template condition

// Respionsive styles

$output .= '@media only screen and (max-width: 979px) { ';
$output .= '.sf-menu li a { font-size: 12px; font-weight: normal; color:#fff; } ';

$output .= implode(',', $swm_mobile_active_pg);
$output .= '{ background: ' . $swm_primary_skin . '; }';

$output .= '.BtnRed { background: ' . $swm_secondary_skin . '; }';

$output .= 'nav.activeDonate ul.sf-menu li:last-child a span,nav.activeDonate ul.sf-menu li:last-child:hover a span {background:none; color:#fff; }';

$output .= '}';

$output .= '@media (min-width: 1200px) {';
$output .= implode(',', $swm_all_current_pg_shape);
$output .= '{ border-top: 36px solid ' . get_theme_mod('swm_nav_active_link_bg','#222945') . '; }';
$output .= '}';

// Tablet Portrait
$output .= '@media only screen and (min-width: 768px) and (max-width: 979px) ';    
$output .= '{';
$output .= '.top_section_bg.transparent_bg_opacity { opacity:1; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100;);  }'; 
$output .= '}';

// Mobile Portrait
$output .= '@media only screen and (max-width: 767px) ';
$output .= '{';
$output .= '.top_section_bg.transparent_bg_opacity { opacity:1; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100;);  } ';
$output .= '.heading_h1 h1 { display: block; font-size: 22px; }';
$output .= '}';

// Mobile Landscape
$output .= '@media only screen and (min-width: 480px) and (max-width: 767px)';
$output .= '{';
$output .= '.top_section_bg.transparent_bg_opacity { opacity:1; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100;);  }';
$output .= '}';

// ========== Shortcodes Styles ==========

$output .= '.steps_with_circle ol li span,.projects_style1 a,.sm_icons ul li a,.sm_icons ul li a:hover,.recent_posts_square_title a { color:'. get_theme_mod('swm_body_sc_color','#606060') .' }';

$output .= '.skin_color,.special_plan .pricing_title,.special_plan .swm_button,.client_position,.p_bar_skin_color .p_bar_bg,.cta_block,.swm_pagination li a.current,.swm_pagination li a:hover.current,.horizontal_menu li.current_page_item a,.horizontal_menu li:hover.current_page_item a, a.swm_button.skin_color,button.swm_button.skin_color,input.swm_button[type="submit"],input[type="submit"],input[type="button"],input[type="reset"], a.button,button.button,#footer a.button,#footer button.button { background:'.$swm_primary_skin.'; color:#fff; }';

$output .= '.footer .offer_icon { background:'.$swm_primary_skin.';  }';

$output .= '.swm_pagination li a.current,.swm_pagination li a:hover.current,.horizontal_menu li.current_page_item a,.horizontal_menu li:hover.current_page_item a,input.swm_button[type="submit"],input[type="submit"],input[type="button"],input[type="reset"] { border-color:'.$swm_primary_skin.'; }';

$output .= 'input.skin_color:hover,a.skin_color:hover,input[type="submit"]:hover,button[type="submit"]:hover,.swm-product-price-cart a.button:hover,.sidebar .widget_shopping_cart_content p.buttons a:hover,.swm_woo_cart_hover_menu p.buttons a { border-color:'.$swm_secondary_skin.'; background:'.$swm_secondary_skin.'; opacity:1; color:#fff; }';

$output .= '.recent_posts_full .swm_post_title a:hover,.recent_posts_full p.recent_post_read_more_link a,.recent_posts_full .post_meta span a:hover,.recent_posts_square_content a:hover,.recent_posts_square_posts ul li .grid_date a:hover,.swm_promotion_box .title_text  { color:'.$swm_secondary_skin.'; }';

$output .= '.icon_url a i.fa-link,.recent_post_read_more_link a,blockquote .title_text,blockquote .title_text p,.recent_posts_full p.recent_post_read_more_link a:hover { color:'.$swm_primary_skin.'; }';

$output .= '.swm_special_offer,.swm_tabs ul.tab-nav li a:hover,.swm_tabs ul.tab-nav li.ui-tabs-selected a,.recent_posts_square_date span.d_year { background:'.$swm_secondary_skin.';  }';

$output .= '.toggle_box .ui-state-active,.toggle_box_accordion .ui-state-active,.toggle_box:hover .toggle_box_title,.toggle_box_accordion:hover .toggle_box_title_accordion { background:'.$swm_secondary_skin.';  }';

$output .= '.footer .aboutme_widget,.footer a.recent_posts_tiny_icon { background:'.$swm_footer_bg_color_two.';  }';

// Newsletter plugin
$output .= '#mc_signup_form input[type="submit"] { background:'.$swm_secondary_skin.';  }';
$output .= '.widget_mailchimpsf_widget { background:'.$swm_primary_skin.';  }';
$output .= '.footer .widget_mailchimpsf_widget { background:'.$swm_footer_bg_color_two.';  }';
$output .= '.footer .widget_mailchimpsf_widget .swm_fancy_title .title_border span,.footer #mc_signup_form .mc_merge_var input { border-color:'.$swm_footer_border_color.'; }';
$output .= '.footer #mc_signup_form .mc_merge_var input[type="text"] { background:'.$swm_footer_bg_color.';  }';
$output .= '.footer #mc_signup_form .mc_merge_var input {'.$swm_footer_text_color.'; }';

// WPML Plugin
$output .= '#lang_sel_footer,#wpml_credit_footer { background:' .get_theme_mod('swm_small_footer_bg',$swm_primary_skin). '; border-color:' .get_theme_mod('swm_small_footer_bg',$swm_primary_skin). ';}';
$output .= '#lang_sel_footer ul li,#wpml_credit_footer,#lang_sel_footer ul li a,#wpml_credit_footer a { ' . swm_output_font_size_color('swm_small_footer_sc_size','swm_small_footer_sc_color') . '  } ';

$output .= '.footer .widget #lang_sel_list ul li a { '.$swm_footer_text_color.'   }';
$output .= '.footer .widget #lang_sel_list ul li a:hover { color:'.$swm_footer_links_hover_color.'; }';

$output .= '.footer .widget #lang_sel_click ul li a { background-color:'.$swm_footer_bg_color_two.'; }';
$output .= '.footer .widget #lang_sel_click a, .footer .widget #lang_sel_click a:visited,.footer .recent_work_widget ul li a img { '.$swm_footer_text_color.' border-color:'.$swm_footer_border_color.'; }';
$output .= '.footer .widget #lang_sel_click ul li ul { background:'.$swm_footer_bg_color_two.'; border:1px solid '.$swm_footer_border_color.'; }';

$output .= '.swm_team_members img { border-color:'.$swm_secondary_skin.'; }';
$output .= '#lang_sel_footer ul li a { font-size: 11px; }';

// Give Plugin
$output .= '.swm_tabs_container ul.tab-nav li.active,ul#give-donation-level-button-wrap li button.give-default-level { background:'.$swm_secondary_skin.'; color:'.get_theme_mod('swm_text_color_on_skin_color_bg','#ffffff').'; }';
$output .= '[id*=give-form].give-display-modal button.give-btn.give-btn-modal:hover,[id*=give-form].give-display-reveal button.give-btn-reveal:hover { background:'.$swm_secondary_skin.'; border-color:'.$swm_secondary_skin.';}';
$output .= '[id*=give-form].give-display-modal button.give-btn.give-btn-modal,[id*=give-form].give-display-reveal button.give-btn-reveal { background:'.$swm_primary_skin.';color:'.get_theme_mod('swm_text_color_on_skin_color_bg','#ffffff').'; }';

$output .= '.footer .give-form, .footer .give-error, .footer .give-warning, .footer ul#give-donation-level-button-wrap li button, .footer .give_error, .footer .give_success, .footer #give-recurring-form .give-tooltip, .footer form.give-form .give-tooltip, .footer form[id*=give-form] .give-tooltip, .footer form[id*=give-form] .give-required-indicator { '.$swm_footer_text_color.' } ';

$output .= '.footer form[id*=give-form] .give-donation-amount #give-amount, .footer form[id*=give-form] .give-donation-amount #give-amount-text, .footer form[id*=give-form] .give-donation-amount .give-currency-symbol, .footer form[id*=give-form] #give-final-total-wrap .give-donation-total-label, .footer form[id*=give-form] #give-final-total-wrap .give-final-total-amount { background:'.$swm_footer_bg_color_two.'; '.$swm_footer_text_color.' }';

$output .= '.footer #give-recurring-form, .footer form.give-form, .footer form[id*=give-form], .footer form[id*=give-form] .give-donation-amount .give-currency-symbol, .footer ul#give-donation-level-button-wrap li button, .footer form[id*=give-form] .give-donation-amount .give-currency-symbol, .footer form[id*=give-form] .give-donation-amount .give-currency-symbol.give-currency-position-before, .footer #give-payment-mode-select, .footer #give_purchase_form_wrap, .footer form[id*=give-form] #give-final-total-wrap .give-donation-total-label, .footer form[id*=give-form] #give-final-total-wrap .give-final-total-amount, .footer form[id*=give-form] .give-donation-amount #give-amount, .footer form[id*=give-form] .give-donation-amount #give-amount-text  { border-color:'.$swm_footer_border_color.'; }';

$output .= '.footer .give_error,.footer .give_success { background:'.$swm_footer_bg_color_two.'; }';

$output .= '.footer form[id*=give-form] .form-row input[type=text].required, .footer form[id*=give-form] .form-row input[type=email].required, .footer form[id*=give-form] input[type="text"], .footer form[id*=give-form] input[type="text"]:focus, .footer form[id*=give-form] input[type="email"], .footer form[id*=give-form] input[type="email"]:focus { background:'.$swm_footer_bg_color_two.'; '.$swm_footer_text_color.' border-color:'.$swm_footer_border_color.'; }';

// ========== WooCommerce Styles ==========

if ( class_exists('woocommerce') ) {

/*Onsale colors*/

$swm_large_footer_text = '';

$swm_onsale_bg = (get_option('swm_onsale_badge_background') <> '') ? get_option('swm_onsale_badge_background') : '#d75f5f'; 
$swm_onsale_text = (get_option('swm_onsale_badge_font_color') <> '') ? get_option('swm_onsale_badge_font_color') : '#ffffff';

if ($swm_large_footer_text != "") { 
$output .= '#footer ins,#footer .price_slider_amount .price_label { color:'.$swm_large_footer_text['color'].';font-size:'.$swm_large_footer_text['size'].'; }
'; }

$output .= 'span.onsale { background:'.$swm_onsale_bg.'; color:'.$swm_onsale_text.'; }';

$output .= '#reviews #comments ol.commentlist li .meta,.swm-woo-sort-order a { color:'.get_theme_mod('swm_body_sc_color','#606060').'; }';

$output .= 'p.price ins,p.price > span.amount,.single_variation span.price span.amount,table.group_table .price ins,.product_meta > span > a,a.reset_variations,.single_variation span ins,#comments p.noreviews a,table.cart td.product-name a,a.woocommerce-remove-coupon,.order-total span.amount,.woocommerce-info a,.woocommerce-message:before,p.lost_password a,p.form-row.terms a,td.product-name strong.product-quantity,.order_details li strong,td.product-name a,table.shop_table.order_details tfoot tr:last-child td,ul.product_list_widget li ins,ul.product_list_widget li span.amount,.widget_shopping_cart_content span.amount,.widget_layered_nav ul li.chosen a,.widget_layered_nav_filters ul li a,p.stars span a:focus, p.stars span a.active,.star-rating,p.stars span a:hover,.swm-product-details h3 a:hover,.swm-product-details h3 a:hover mark,.swm-featured-product-block.p_category:hover a h3,.swm-featured-product-block.p_category:hover a h3 mark,#reviews #comments ol.commentlist li .comment-text p.meta strong { color:'.$swm_primary_skin.'; }';

$output .= '.cart-loading { background-color:'.$swm_primary_skin.'; }';
$output .= 'nav.woocommerce-pagination span,p.demo_store,.woocommerce-pagination a:hover,.swm_woo_next_prev span a:hover,.swm_woo_cart_hover_menu p.buttons a:hover,.main_hover_cart_menu .widget_shopping_cart_content { background: '.$swm_primary_skin.'; }';
$output .= 'nav.woocommerce-pagination span,.swm_woo_next_prev span a:hover,.swm_woo_cart_hover_menu p.buttons a:hover { border-color:'.$swm_primary_skin.'; }';
$output .= '.product .woocommerce-tabs ul.tabs li a:hover,.product .woocommerce-tabs ul.tabs li.active a { background:'.$swm_secondary_skin.'; }';

$output .= '@media only screen and (max-width: 767px) { .product .woocommerce-tabs ul.tabs li.active a { color:'.$swm_secondary_skin.'; } }';


}  // end if class_exists ( woocommerce )

//event calendar
if (function_exists('tribe_is_event')) { 

$output .= 'ul.tribe-events-sub-nav li a,.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],.tribe-events-calendar thead th,#tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit]:hover,.swm_te_single_title_meta_section span.swm_te_single_title_cost,#tribe-events .tribe-events-button:hover,.tribe-grid-header  { background:'.$swm_primary_skin.'; }';

$output .= 'ul.tribe-events-sub-nav li a:hover,#tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit] { background:'.$swm_secondary_skin.'; }';

$output .= 'h3.tribe-events-month-event-title a,#tribe-events-content .tribe-events-tooltip h4,.tribe-events-list .vevent.hentry h2 a:hover,.tribe-events-list .type-tribe_events h2 a:hover,a.tribe-events-read-more,a.tribe-events-read-more:hover { color:'.$swm_primary_skin.'; }';

$output .= 'ul.tribe-bar-views-list li.tribe-bar-active a span { color:'.$swm_secondary_skin.'; }';
 
$output .= 'h3.tribe-events-month-event-title a:hover,.swm-tribe-event-list-meta ul li a:hover,a.tribe-events-read-more,.swm_event_single_meta_row dd.fn.org { color:'.$swm_secondary_skin.'; }';

$output .= '#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a,.swm-tribe-event-list-meta ul li a,.tribe-events-day .tribe-events-day-time-slot h5 { color:'.get_theme_mod('swm_body_sc_color','#606060').'; }';

$output .= ' #tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit]:hover { border-color:'.$swm_primary_skin.'; }';
$output .= ' #tribe-bar-form .tribe-bar-filters .tribe-bar-submit input[type=submit] { border-color:'.$swm_secondary_skin.'; }';

$output .= '.footer .tribe-events-list-widget .tribe-events-widget-link a,.footer ol.hfeed.vcalendar li span{ '.$swm_footer_text_color.' }';
 
$output .= '.footer .tribe-events-list-widget .tribe-events-widget-link a:hover,.footer .star-rating { color:'.$swm_footer_links_hover_color.'; }';

 $output .= '.footer ol.hfeed.vcalendar li,.footer .tagcloud a,.footer ul.product_list_widget li,.footer .widget_shopping_cart_content ul li:last-child,.footer ul.product_list_widget li a img { border-color:'.$swm_footer_border_color.'; }';

$output .= '.footer .star-rating:before { color:'.$swm_footer_border_color.'; }';

$output .= '.footer .widget_layered_nav ul small.count { background:'.$swm_footer_bg_color_two.';}';

$output .= '.swm_upcoming_events ul li:nth-child(even) .upcoming_events_square_date.primary,.swm_upcoming_events ul li .upcoming_events_square_date.colorful.primary { background:'.$swm_primary_skin.'; border-color:'.$swm_primary_skin.'; }';
$output .= '.swm_upcoming_events ul li:nth-child(even) .upcoming_events_square_date.secondary,.swm_upcoming_events ul li .upcoming_events_square_date.colorful.secondary { background:'.$swm_secondary_skin.'; border-color:'.$swm_secondary_skin.'; }';

} // end if function exists tribe event 

// Detect Internet Explorer version and apply styles    

//IF IE 9
if (stripos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9')) {
    $output .= '.search_box input { width: 150px; } .about_author { border: 1px solid #e4e4e4; box-shadow: none; } .client_img_link span.icon_url { display:none;  } .testimonial_box:hover .client_img_link span.icon_url { display: block;  } .testimonial_box sub { font-size: 13px; } .star-rating { width: 5.2em !important;}'; 
}

//IF IE 10
if (stripos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10')) {
    $output .= '.search_box input { width: 120px; } .about_author { border: 1px solid #e4e4e4; box-shadow: none; } .client_img_link span.icon_url { display:none;  } .testimonial_box:hover .client_img_link span.icon_url { display: block;  } .testimonial_box sub { font-size: 13px; } .star-rating { width: 5.2em !important;} .p.stars span { width: 102px !important;}';
}

//IF IE 11
if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {        
    $output .= '.client_img_link span.icon_url { display: none; } .swm_testimonials_block:hover .client_img_link span.icon_url { display: block; }';
}

// =================================== 

$output .= '</style>
';

echo $output;

}
    add_action('wp_head', 'swm_output_styles');
}

?>