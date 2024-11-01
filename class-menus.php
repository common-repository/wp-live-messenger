<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

class wplm_Menus{

	public function __construct(){
		
		add_action('admin_menu', array( $this, 'wplm_menu_init' ));
	}

	public function wplm_menu_main(){	
		include( WPLM_PLUGIN_DIR. 'templates/menus/menu-main.php');			
	}

	public function wplm_menu_init() {
		add_menu_page( __('WP Messenger',WPLM_TEXT_DOMAIN), __('WP Messenger',WPLM_TEXT_DOMAIN), 'manage_options', 'wpm-main', array( $this, 'wplm_menu_main' ), WPLM_PLUGIN_URL.'assets/admin/images/messenger-icon.png', 30 );
	}
}
	
new wplm_Menus();