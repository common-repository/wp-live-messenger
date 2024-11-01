<?php
/*
	Plugin Name: WP Live Messenger
	Plugin URI: https://www.pluginbazar.net/product/wp-messenger/
	Description: 	It allows user to send message directly in Facebook
	Version: 1.0.1
	Author: pluginbazar
	Author URI: https://pluginbazar.net/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class WPMessenger {
	
	public function __construct(){
	
		$this->wplm_define_constants();
		$this->wplm_load_scripts();
		
		require_once( plugin_dir_path( __FILE__ ) . 'class-messenger-button.php');	
		require_once( plugin_dir_path( __FILE__ ) . 'class-menus.php');	
		require_once( plugin_dir_path( __FILE__ ) . 'class-functions.php');
		
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ));
	}
	
	public function load_textdomain() {

		load_plugin_textdomain( WPLM_TEXT_DOMAIN, false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
	}
	
	public function wplm_load_scripts(){
		
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
		add_action( 'wp_enqueue_scripts', array( $this, 'wplm_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'wplm_admin_scripts' ) );
	}
	
	public function wplm_define_constants(){
		
		define('WPLM_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
		define('WPLM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define('WPLM_TEXT_DOMAIN', 'wp-messenger' );
	}
	
	public function wplm_front_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'jquery-ui-draggable' );
		
		wp_enqueue_script('wplm_js', plugins_url( 'assets/front/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('jquery.ui.touch-punch.min', plugins_url( 'assets/front/js/jquery.ui.touch-punch.min.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'wplm_js', 'wplm_ajax', array( 'wplm_ajaxurl' => admin_url( 'admin-ajax.php')));

		wp_enqueue_style('wplm_style', WPLM_PLUGIN_URL.'assets/front/css/style.css');
		wp_enqueue_style('font-awesome', WPLM_PLUGIN_URL.'assets/global/css/font-awesome.css');
	}

	public function wplm_admin_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_style( 'jquery-ui' ); 
		
		// BackAdmin
		wp_enqueue_style('BackAdmin_Style', WPLM_PLUGIN_URL.'assets/BackAdmin/BackAdmin.css');		
		wp_enqueue_script('BackAdmin_JS', plugins_url( 'assets/BackAdmin/BackAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
	}
	
} new WPMessenger();