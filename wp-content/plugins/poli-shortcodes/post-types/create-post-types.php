<?php


/* ****************************************************************************
    Sort Post Items
**************************************************************************** */ 

add_action('admin_menu', 'swm_post_sort_order_page');

function swm_post_sort_order_page() {
    
    add_submenu_page('edit.php?post_type=portfolio', __('Sort Portfolio Items', '__poli-shortcodes__'), __('Sort Portfolio Items', '__poli-shortcodes__'), 'edit_posts', 'sort-portfolios', 'swm_portfolio_sort_order_list');   

    add_submenu_page('edit.php?post_type=testimonials', __('Sort Testimonials Items', '__poli-shortcodes__'), __('Sort Testimonials Items', '__poli-shortcodes__'), 'edit_posts', 'sort-testimonials', 'swm_testimonials_sort_order_list');  
   
}

function swm_portfolio_sort_order_list() {     
    swm_sort_post_items('portfolio');
}
function swm_testimonials_sort_order_list() {     
    swm_sort_post_items('testimonials');
}

function swm_sort_post_items($post_name) {
    $post_item = new WP_Query('post_type='.$post_name.'&posts_per_page=-1&orderby=menu_order&order=ASC');  
    ?>
     <div class="wrap">
        <div id="icon-edit" class="icon32"><br /></div>
        <h2><?php _e('Sort Items', '__poli-shortcodes__'); ?></h2>
        <p><?php _e('Re-order items by drag and drop.', '__poli-shortcodes__'); ?></p>

        <ul id="swm_sort_items">
            <?php while( $post_item->have_posts() ) : $post_item->the_post(); 
                
                $postid = get_the_ID();
                $thumb_img = wp_get_attachment_url(get_post_thumbnail_id($postid));
                $posttype = '';

                $posttype = 'portfolio';

                if( get_post_status() == 'publish' ) { ?>
                    <li id="<?php the_id(); ?>" class="menu-item <?php echo $posttype; ?>-sort-items">
                        <dl class="menu-item-bar">
                            <dt class="menu-item-handle">
                                <?php 

                                if ($thumb_img) {
                                    echo '<span>'.get_the_post_thumbnail($postid, 'thumbnail').'</span>';
                                }
                                ?>

                                <span><?php the_title(); ?></span>
                            </dt>
                        </dl>
                        <ul class="menu-item-transport"></ul>
                    </li>
                <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
    <?php
}

add_action('wp_ajax_swm_sort_order', 'swm_save_post_sort_order');
if (!function_exists('swm_save_post_sort_order')) {
    function swm_save_post_sort_order() {
       
        global $wpdb;    
        $sort_order = explode(',', $_POST['order']);
        $counter = 0;
        
        foreach($sort_order as $post_item_id) {
            $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $post_item_id));
            $counter++;
        }
        die(1);
    }
}


