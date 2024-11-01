<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class wplm_Messenger_button{
	
	public function __construct(){
		
		add_action( 'wp_footer', array($this, 'wplm_display_messenger_button') );
	}
	
	public function wplm_display_messenger_button(){
		
		require_once( WPLM_PLUGIN_DIR .'templates/messenger-button.php');	
	}
} new wplm_Messenger_button();