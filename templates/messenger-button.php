<?php
/*
* @Author 		Pluginbazar
* Copyright: 	2015 Pluginbazar
*/

if ( ! defined('ABSPATH')) exit; // if direct access 


$wplm_Functions = new wplm_Functions();
$wplm_options = $wplm_Functions->wplm_settings_options();

foreach($wplm_options as $options_tab=>$options) {
	foreach($options as $option_key=>$option_data){
		${$option_key} = get_option( $option_key );
	}
}

if( empty( $wplm_fb_page_url ) ) $wplm_fb_page_url = "https://www.facebook.com/pluginbazar";

// echo '<pre>'; print_r( $wplm_show_tabs ); echo '</pre>';

if( !empty( $wplm_show_tabs ) ) $wplm_show_tabs_str = implode(",", $wplm_show_tabs);
else $wplm_show_tabs_str = 'messages';

if( $wplm_show_page_cover == 'yes' ) $wplm_show_page_cover_str = 'true';
else $wplm_show_page_cover_str = 'false';

if( $wplm_show_facepile == 'yes' ) $wplm_show_facepile_str = 'true';
else $wplm_show_facepile_str = 'false';

if( $wplm_show_small_header == 'yes' ) $wplm_show_small_header_str = 'true';
else $wplm_show_small_header_str = 'false';

if( empty( $wplm_messenger_icon ) ) $wplm_messenger_icon_url = WPLM_PLUGIN_URL . 'assets/fb.png';
else $wplm_messenger_icon_url = $wplm_messenger_icon;

if( empty( $wplm_messenger_icon_width ) ) $icon_width = "100px";
else $icon_width = $wplm_messenger_icon_width;

?>

<div style="width:<?php echo $icon_width; ?>" class="wplm_button_container wplm_tooltip">
	<img class="wplm_button wplm_button_icon" src="<?php echo $wplm_messenger_icon_url; ?>" />
	<span class="wplm_tooltip_text">Hold and Drag</span>
</div>

<div class="wplm_box_container">
	<div class="wplm_box">
		<span class="wplm_box_header_icon wplm_box_move"><i class="fa fa-arrows-alt"></i></span>
		<span class="wplm_box_header_icon wplm_box_close"><i class="fa fa-times"></i></span>
		<div class="fb-page" 
			data-href="<?php echo $wplm_fb_page_url; ?>" 
			data-tabs="<?php echo $wplm_show_tabs_str; ?>" 
			data-small-header="<?php echo $wplm_show_small_header_str; ?>" 
			data-adapt-container-width="true" 
			data-hide-cover="<?php echo $wplm_show_page_cover_str; ?>" 
			data-show-facepile="<?php echo $wplm_show_facepile_str; ?>">
		</div>
	</div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1340401656050227";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>