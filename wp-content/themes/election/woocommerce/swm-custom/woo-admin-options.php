<?php 

// Create custom ptions in woocommerce general settings page

add_filter('woocommerce_general_settings','swm_woocommerce_page_settings_filter');

if (!function_exists('swm_woocommerce_page_settings_filter')) {

    function swm_woocommerce_page_settings_filter($options) { 

    	$swm_shortname = 'swm_';
    	for($i = 1; $i<101; $i++) { $swm_one_to_hundred_count[$i] = $i; }	

        $swm_two_to_five =  array (
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                );

        $swm_woo_shop_layout =  array(
            "layout-full-width" => esc_html__( 'Full Width', 'election' ),
            "layout-sidebar-right" => esc_html__( 'Sidebar Right', 'election' ),
            "layout-sidebar-left" => esc_html__( 'Sidebar Left', 'election' )            
        );

    	$options[] = array(
    		'name' => esc_html__('Shop Featured Products Page Options', 'election'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_shop_page_options'
    	);

    	
        $options[] = array(
            'name' => esc_html__('Shop Layout', 'election'),
            'desc' => '',
            'id' => $swm_shortname.'woo_shop_page_layout',
            'css' => 'min-width:175px;',
            'std' => 'full_width',
            'desc_tip' => esc_html__('Select layout for Shop page', 'election'),
            'type' => 'select',
            'options' => $swm_woo_shop_layout           
        );

        $options[] = array(
    		'name' => esc_html__('How Many Products Per Page?', 'election'),            
            'id' => $swm_shortname.'show_product_per_page',            
            'desc_tip' => esc_html__('Enter number of products to display per page', 'election'),
            'std' => '12',
            'css' => 'width:50px;',
            'type' => 'text'            
    	);

        $options[] = array(
            'name' => esc_html__('Products Column', 'election'),
            'desc' => '',
            'id' => $swm_shortname.'woo_shop_p_column',
            'css' => 'min-width:175px;',
            'std' => '4',
            'desc_tip' => esc_html__('Select column number to display products in shop page', 'election'),
            'type' => 'select',
            'options' => $swm_two_to_five
        );

    	$options[] = array(    
            'type' => 'sectionend',
            'id' => 'shop_page_options'
        );

    	$options[] = array(
    		'name' => esc_html__('Product Single (Overview) Page Options', 'election'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_single_page_options'
    	);

        $options[] = array(
            'name' => esc_html__('Product Overview Layout', 'election'),
            'desc' => '',
            'id' => $swm_shortname.'woo_product_page_layout',
            'css' => 'min-width:175px;',
            'std' => 'full_width',
            'desc_tip' => esc_html__('Select layout for product single page', 'election'),
            'type' => 'select',
            'options' => $swm_woo_shop_layout           
        );	

        $options[] = array(
    			'name' => esc_html__('Display Next Previous links', 'election'),
                'desc' => "",
                'id' => $swm_shortname.'woo_next_prev_links_options',            
                'desc' => esc_html__('Enable next previous arrows on right side beside product title', 'election'),
                'std' => '1',
                'type' => 'checkbox'            
    	);

        $options[] = array(
                'name' => esc_html__('Gallery Images Column', 'election'),
                'desc' => '',
                'id' => $swm_shortname.'woo_single_page_gallery_thumbnails',
                'css' => 'min-width:175px;',
                'std' => '5',
                'desc_tip' => esc_html__('Select column number to display thumanail images below large image', 'election'),
                'type' => 'select',
                'options' => array(
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6'
                    )
        );

    	$options[] = array(
    			'name' => esc_html__('Related Products Column', 'election'),
                'desc' => '',
                'id' => $swm_shortname.'woo_related_p_column',
                'css' => 'min-width:175px;',
                'std' => '4',
                'desc_tip' => esc_html__('Select column number to display Related products', 'election'),
                'type' => 'select',
                'options' => $swm_two_to_five
    	);
    	
    	$options[] = array(
    			'name' => esc_html__('How Many Related Items?', 'election'),
                'desc' => "",
                'id' => $swm_shortname.'woo_related_p_nos',
                'css' => 'min-width:175px;',
                'desc_tip' => esc_html__('How many related products you want to display in the page, below product description section?', 'election'),
                'std' => '4',
                'type' => 'select',
                'options' => $swm_one_to_hundred_count
    	);

        $options[] = array(
                'name' => esc_html__('Up-Sells Products Column', 'election'),
                'desc' => '',
                'id' => $swm_shortname.'woo_upsells_p_column',
                'css' => 'min-width:175px;',
                'std' => '4',
                'desc_tip' => esc_html__('Select column number to display Up-Sells products', 'election'),
                'type' => 'select',
                'options' => $swm_two_to_five
        );
        
        $options[] = array(
                'name' => esc_html__('How Many Up-Sells Items?', 'election'),
                'desc' => "",
                'id' => $swm_shortname.'woo_upsells_p_nos',
                'css' => 'min-width:175px;',
                'desc_tip' => esc_html__('How many Up-Sells products you want to display in the page, below product description section?', 'election'),
                'std' => '4',
                'type' => 'select',
                'options' => $swm_one_to_hundred_count
        );
    	
    	$options[] = array(
            
                'type' => 'sectionend',
                'id' => 'column_options'
        );

        $options[] = array(
            'name' => esc_html__('Cart Page Options', 'election'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_cart_page_options'
        );

        $options[] = array(
                'name' => esc_html__('Cross-Sells Products Column', 'election'),
                'desc' => '',
                'id' => $swm_shortname.'woo_cross_sells_p_column',
                'css' => 'min-width:175px;',
                'std' => '4',
                'desc_tip' => esc_html__('Select column number to display Cross-Sells products', 'election'),
                'type' => 'select',
                'options' => $swm_two_to_five
        );
        
        $options[] = array(
                'name' => esc_html__('How Many Cross-Sells Items?', 'election'),
                'desc' => "",
                'id' => $swm_shortname.'woo_cross_sells_p_nos',
                'css' => 'min-width:175px;',
                'desc_tip' => esc_html__('How many Cross-Sells products you want to display in the cart page, below Calculate Shipping and Order Total tables?', 'election'),
                'std' => '4',
                'type' => 'select',
                'options' => $swm_one_to_hundred_count
        );

        $options[] = array(
            
                'type' => 'sectionend',
                'id' => 'column_options'
        );

        $options[] = array(
            'name' => esc_html__('Sale Badge Options', 'election'),
            'type' => 'title',      
            'id'   => $swm_shortname.'woo_cart_page_options'
        );


        $options[] = array(
            'name' => esc_html__('Sale Badge Background Color', 'election'),            
            'id' => $swm_shortname.'onsale_badge_background',            
            'desc_tip' => esc_html__('Select "sale" badge background color', 'election'),
            'std' => '#b93a41',
            'css' => 'width:50px;',
            'type' => 'color'            
        );

        $options[] = array(
            'name' => esc_html__('Sale Badge Font Color', 'election'),            
            'id' => $swm_shortname.'onsale_badge_font_color',            
            'desc_tip' => esc_html__('Select "sale" badge font color', 'election'),
            'std' => '#ffffff',
            'css' => 'width:50px;',
            'type' => 'color'            
        );



        $options[] = array(
            
                'type' => 'sectionend',
                'id' => 'column_options'
        );
    	
    	
    	return $options;
    }

}
