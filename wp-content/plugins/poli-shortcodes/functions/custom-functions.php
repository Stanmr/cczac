<?php

if ( !function_exists( 'swm_short_title' ) ) {

	function swm_short_title($text, $limit) { 
	  $chars_limit = $limit;
	  $chars_text = strlen($text);
	  $text = $text." ";
	  $text = substr($text,0,$chars_limit);
	  $text = substr($text,0,strrpos($text,' '));
	 
	  if ($chars_text > $chars_limit)
	     { $text = $text."..."; } 
	     return $text;
	}

}

add_action( 'plugins_loaded', 'swm_polishortcodes_load_textdomain' );

function swm_polishortcodes_load_textdomain() {
  load_plugin_textdomain( 'poli-shortcodes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}


/* ---------------------------------------------------------------------------------------- 
	Post Author Social Icons : Admin > Users > User Profile page > Contact Info
---------------------------------------------------------------------------------------- */

if (!function_exists('swm_author_social_icons')) {
	function swm_author_social_icons( $contactmethods ) {

	$contactmethods['twitter'] = esc_html__( 'Twitter URL', '__poli-shortcodes__' );
	$contactmethods['facebook'] = esc_html__( 'Facebook URL', '__poli-shortcodes__' );
	$contactmethods['google-plus'] = esc_html__( 'Google Plus URL', '__poli-shortcodes__' );
	$contactmethods['pinterest'] = esc_html__( 'Pinterest URL', '__poli-shortcodes__' );
	$contactmethods['linkedin'] = esc_html__( 'LinkedIn URL', '__poli-shortcodes__' );
	$contactmethods['tumblr'] = esc_html__( 'Tumblr URL', '__poli-shortcodes__' );
	$contactmethods['delicious'] = esc_html__( 'Delicious URL', '__poli-shortcodes__' );
	$contactmethods['vimeo-square'] = esc_html__( 'Vimeo URL', '__poli-shortcodes__' );
	$contactmethods['youtube-play'] = esc_html__( 'YouTube URL', '__poli-shortcodes__' );

	return $contactmethods;

	}

	add_filter('user_contactmethods','swm_author_social_icons',10,1);
}