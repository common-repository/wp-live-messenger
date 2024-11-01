<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


$nonce = isset( $_POST['wplm_settings_nonce_check_value'] ) ? $_POST['wplm_settings_nonce_check_value'] : '';
if ( !empty( $nonce ) && wp_verify_nonce($nonce, 'wplm_settings_nonce_check') ) {
	if( ! empty( $_POST['wplm_hidden'] ) ):	if( $_POST['wplm_hidden'] == 'Y' ) :
		
		if ( current_user_can('manage_options') ) {
			
			$wplm_Functions = new wplm_Functions();
			$wplm_options = $wplm_Functions->wplm_settings_options();
			foreach($wplm_options as $options_tab=>$options) {
				foreach($options as $option_key=>$option_data){
					
					${$option_key} = isset($_POST[$option_key]) ? stripslashes_deep($_POST[$option_key]) : '';
					update_option($option_key, ${$option_key});
				}
			}
			printf( '<div class="%1$s"><p>%2$s</p></div>', 'notice notice-success is-dismissible', __( 'Changes Saved!', WPLM_TEXT_DOMAIN ) ); 
		}
		else {
			printf( '<div class="%1$s"><p>%2$s</p></div>', 'notice notice-error is-dismissible', __( 'Something went wrong!', WPLM_TEXT_DOMAIN ) ); 
		}
		
	endif; endif;
}
?>

<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div>
	<h2>WP Messenger - Settings</h2><br>
	<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="wplm_hidden" value="Y" />
		<?php wp_nonce_field('wplm_settings_nonce_check', 'wplm_settings_nonce_check_value'); ?>
		<?php 
		$wplm_Functions = new wplm_Functions();
		$wplm_options = $wplm_Functions->wplm_settings_options();
			
		echo $wplm_Functions->wplm_generate_options_form($wplm_options); 
		?>
		<br>
		<input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes',WPLM_TEXT_DOMAIN ); ?>" />
	</form>	
</div>
