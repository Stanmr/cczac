<?php
/*
Plugin Name: PoliShortcodes
Plugin URI: http://themeforest.net/user/Softwebmedia
Description: Create content with Shortcodes, Custom Post Types and Widgets
Version: 1.04
Author: SoftWebMedia
Author URI: http://themeforest.net/user/Softwebmedia
Text Domain: __poli-shortcodes__
Domain Path: /languages/
*/

class SWMShortcodes {
	
    function __construct() 
    {	
    	require_once( plugin_dir_path( __FILE__ ) .'/shortcodes/shortcodes.php' );
    	require_once( plugin_dir_path( __FILE__ ) .'/functions/custom-functions.php' );
    	require_once( plugin_dir_path( __FILE__ ) .'/post-types/post-types.php' );
    	require_once( plugin_dir_path( __FILE__ ) .'/post-types/create-post-types.php' );
    	require_once( plugin_dir_path( __FILE__ ) .'/post-types/metaboxes.php' );
    	require_once( plugin_dir_path( __FILE__ ) .'/widgets/widgets.php' );     	
    	define('SWM_PLUGIN_URL', plugin_dir_url( __FILE__ ));
    	define('SWM_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
    	define('SWM_TINYMCE_URI', plugin_dir_url( __FILE__ ) .'shortcodes/tinymce');
		define('SWM_TINYMCE_DIR', plugin_dir_path( __FILE__ ) .'shortcodes/tinymce');       

        add_action('init', array(&$this, 'init'));
        add_action('admin_init', array(&$this, 'admin_init'));
        
	}
	
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function init()
	{	
		
		function swm_poli_fronend_scripts_styles() {

			if( ! is_admin() ) {
				
				//css
				wp_enqueue_style( 'swm-poli-font-awesome', plugin_dir_url( __FILE__ ) . 'fonts/font-awesome.css', '', '1.0' );			
				wp_enqueue_style( 'swm-poli-global', plugin_dir_url( __FILE__ ) . 'css/global.css', '', '1.0' );
				wp_enqueue_style( 'swm-poli-shortcodes', plugin_dir_url( __FILE__ ) . 'css/poli-shortcodes.css', '', '1.0' );					

				//javascripts
				wp_enqueue_script('jquery');
				wp_enqueue_script('swm-poli-plugins',  plugin_dir_url( __FILE__ ) . 'js/plugins.js','jquery','1.0', TRUE);
				wp_enqueue_script('swm-poli-isotope',  plugin_dir_url( __FILE__ ) . 'js/isotope.js','jquery','1.0', TRUE);			
				wp_enqueue_script('swm-poli-scripts',  plugin_dir_url( __FILE__ ) . 'js/custom-scripts.js','jquery','1.0', TRUE);
			}	
		}
		
		add_action('wp_enqueue_scripts', 'swm_poli_fronend_scripts_styles');

		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
			add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
		}
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @return	void
	 */
	function add_rich_plugins( $plugin_array )
	{
		$plugin_array['swmShortcodes'] = SWM_TINYMCE_URI . '/plugin.js';
			
		return $plugin_array;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function register_rich_buttons( $buttons )
	{
		array_push( $buttons, "|", 'swm_button' );
		return $buttons;
	}
	
	/**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */

	function admin_init() {	

		function swm_poli_backend_scripts_styles() {
			
			// css		
			wp_enqueue_style( 'swm-poli-font-awesome', plugin_dir_url( __FILE__ ) . 'fonts/font-awesome.css', '', '1.0' );	
			wp_enqueue_style( 'swm-popup', SWM_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
			wp_enqueue_style( 'swm-widgets', plugin_dir_url( __FILE__ ) . '/css/custom-admin.css' );
			wp_enqueue_style( 'wp-color-picker' );			
			// js
			wp_enqueue_script( 'jquery-ui-sortable' );		
			wp_enqueue_script( 'jquery-livequery', SWM_TINYMCE_URI . '/js/plugins.js', false, '1.1.1', false );		
			wp_enqueue_script( 'swm-popup', SWM_TINYMCE_URI . '/js/popup.js', false, '1.0', false );
			wp_enqueue_script( 'admin-javascript', plugin_dir_url( __FILE__ ) . 'js/admin-javascripts.js', false, '1.0', false );
		}
		
		add_action('admin_enqueue_scripts', 'swm_poli_backend_scripts_styles');		

		wp_localize_script( 'jquery', 'SWMShortcodes', array('plugin_folder' => WP_PLUGIN_URL .'/poli-shortcodes') );
	}	
    
}
$swm_shortcodes = new SWMShortcodes();

?>