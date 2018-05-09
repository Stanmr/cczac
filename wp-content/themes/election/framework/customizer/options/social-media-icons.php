<?php

/* ************************************************************************************** 
Social Media
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_sm_icons', array(
    'title'    => esc_html__( 'Social Media Icons', 'election' ),
    'priority' => 11
));

$wp_customize->add_setting( 'swm_open_sm_new_window', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_open_sm_new_window', array(
    'type'     => 'checkbox',
    'label'    => esc_html__( 'Open media websites in new window', 'election' ),
    'section'  => 'swm_customizer_sm_icons',
    'priority' => 1   
));

$swm_sm_icons = array( esc_html__('Twitter', 'election' ), esc_html__('Facebook', 'election' ), esc_html__('YouTube', 'election' ), esc_html__('Delicious', 'election' ), esc_html__('Vimeo', 'election' ), esc_html__('Flickr', 'election' ), esc_html__('Digg', 'election' ), esc_html__('StumbleUpon', 'election' ), esc_html__('LinkedIn', 'election' ), esc_html__('Blogger', 'election' ), esc_html__('Technorati', 'election' ), esc_html__('Pinterest', 'election' ), esc_html__('Apple', 'election' ), esc_html__('Dropbox', 'election' ), esc_html__('Amazon', 'election' ), esc_html__('Picasa', 'election' ), esc_html__('Skype', 'election' ), esc_html__('deviantART', 'election' ), esc_html__('Windows', 'election' ), esc_html__('Tumblr', 'election' ), esc_html__('Lastfm', 'election' ),
esc_html__('Yahoo', 'election' ), esc_html__('Wordpress', 'election' ), esc_html__('Dribble', 'election' ), esc_html__('Forest', 'election' ), esc_html__('Google', 'election' ), esc_html__('GooglePlus', 'election' ), esc_html__('AppleStore', 'election' ), esc_html__('Instagram', 'election' ), esc_html__('Myspace', 'election' ), esc_html__('SoundCloud', 'election' ), esc_html__('RSS', 'election' ) );

$sm_sites_number = 2;

foreach ($swm_sm_icons as $swm_sm_icon) {

    $sm_sites_number++;

    $sm_icon = 'swm_' . strtolower($swm_sm_icon);

    $wp_customize->add_setting( $sm_icon, array(
        'default' => ''
    ));

    $wp_customize->add_control( $sm_icon, array(
        'type'     => 'text',
        'label'    => $swm_sm_icon,
        'section'  => 'swm_customizer_sm_icons',
        'priority' => $sm_sites_number
    ));
        
}