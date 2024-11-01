<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class wplm_Functions  {
	
	public function wplm_settings_options($options = array()){
		
		$options['Messenger Options'] = array(

			'wplm_fb_page_url'=>array(
				'css_class'=>'wplm_fb_page_url',					
				'title'=>__('Facebook Page URL',WPLM_TEXT_DOMAIN),
				'option_details'=>__('Specify your Facebook Page URL.<br><b>Example: https://www.facebook.com/pluginbazar</b>',WPLM_TEXT_DOMAIN),						
				'input_type'=>'text',
				'placeholder'=>'https://www.facebook.com/pluginbazar',
			),
			'wplm_show_tabs'=>array(
				'css_class'=>'wplm_show_tabs',					
				'title'=>__('Tabs to Show',WPLM_TEXT_DOMAIN),
				'option_details'=>__('Select which tabs you want to show.<br><b>Default: Messages</b>',WPLM_TEXT_DOMAIN),						
				'input_type'=>'checkbox', 
				'input_args'=> array( 
					'messages'=>__('Messages', WPLM_TEXT_DOMAIN),
					'timeline'=>__('Timeline', WPLM_TEXT_DOMAIN),
					'events'=>__('Events', WPLM_TEXT_DOMAIN),
				),
			),
			'wplm_show_page_cover'=>array(
				'css_class'=>'wplm_show_page_cover',					
				'title'=>__('Show Page Cover',WPLM_TEXT_DOMAIN),
				'option_details'=>__('Do you want to show the Facebook Page Cover.<br><b>Default: Yes</b>',WPLM_TEXT_DOMAIN),						
				'input_type'=>'select', 
				'input_args'=> array( 
					'yes'=>__('Yes', WPLM_TEXT_DOMAIN),
					'no'=>__('No', WPLM_TEXT_DOMAIN),
				),
			),
			'wplm_show_facepile'=>array(
				'css_class'=>'wplm_show_facepile',					
				'title'=>__('Show Facepile',WPLM_TEXT_DOMAIN),
				'option_details'=>__('Do you want to show the Facepile.<br><b>Default: Yes</b>',WPLM_TEXT_DOMAIN),						
				'input_type'=>'select', 
				'input_args'=> array( 
					'yes'=>__('Yes', WPLM_TEXT_DOMAIN),
					'no'=>__('No', WPLM_TEXT_DOMAIN),
				),
			),
			'wplm_show_small_header'=>array(
				'css_class'=>'wplm_show_small_header',					
				'title'=>__('Show Small Header',WPLM_TEXT_DOMAIN),
				'option_details'=>__('Do you want to show the Page small header.<br><b>Default: Yes</b>',WPLM_TEXT_DOMAIN),						
				'input_type'=>'select', 
				'input_args'=> array( 
					'yes'=>__('Yes', WPLM_TEXT_DOMAIN),
					'no'=>__('No', WPLM_TEXT_DOMAIN),
				),
			),
			
			'wplm_messenger_icon'=>array(
				'css_class'=>'wplm_messenger_icon',					
				'title'=>__('Messenger Icon',WPLM_TEXT_DOMAIN),
				'option_details'=>'Use your own custom Icon as Messenger Icon<br><b>Square size recommended</b>',						
				'input_type'=>'file', 
			),
			
			'wplm_messenger_icon_width'=>array(
				'css_class'=>'wplm_messenger_icon_width',					
				'title'=>__('Icon Size',WPLM_TEXT_DOMAIN),
				'option_details'=>'Set the messenger icon size, here you need to define only the width of the Icon',						
				'input_type'=>'text', 
				'placeholder'=>__('200px',WPLM_TEXT_DOMAIN),
			),
			
		);
		
		$options = apply_filters( 'wplm_filter_settings_options', $options );
		return $options;
	}
	
	public function wplm_generate_options_form($wplm_options){
		
		$html = '';
		$html.= '<div class="back-settings post-grid-settings">';			
		$html_nav = '';
		$html_box = '';
		
		$i=1;
		foreach($wplm_options as $key=>$options) {
			
			if( $i == 1 ) $html_nav.= '<li nav="'.$i.'" class="nav'.$i.' active">'.$key.'</li>';				
			else $html_nav.= '<li nav="'.$i.'" class="nav'.$i.'">'.$key.'</li>';
							
			if( $i == 1 ) $html_box.= '<li style="display: block;" class="box'.$i.' tab-box active">';				
			else $html_box.= '<li style="display: none;" class="box'.$i.' tab-box">';
				
			foreach($options as $option_key=>$option_info)
			{
				$option_value =  get_option( $option_key );				
				
				if(!isset($option_info['placeholder'])) $placeholder = '';
				else $placeholder = $option_info['placeholder'];
				
				if(!isset($option_info['input_values'])) $option_info['input_values'] = '';
				if(!isset($option_info['status'])) $option_info['status'] = '';
				if(!isset($option_info['option_details'])) $option_info['option_details'] = '';
				
				if(empty($option_value)) $option_value = $option_info['input_values'];
				
				$html_box.= '<div class="section-box '.$option_info['css_class'].'">';
				$html_box.= '<p class="section-title">'.$option_info['title'].'</p>';
				$html_box.= '<p class="section-info">'.$option_info['option_details'].'</p>';
				
				if($option_info['input_type'] == 'text') 
					$html_box.= '<input type="text" '.$option_info['status'].' placeholder="'.$placeholder.'" name="'.$option_key.'" id="'.$option_key.'" value="'.$option_value.'" /> ';					
				elseif($option_info['input_type'] == 'text-multi') {
					$input_args = $option_info['input_args'];
					foreach($input_args as $input_args_key=>$input_args_values) {
						if(empty($option_value[$input_args_key])) $option_value[$input_args_key] = $input_args[$input_args_key];
						$html_box.= '<label>'.$input_args_key.'<br/><input class="job-bm-color" type="text" placeholder="" name="'.$option_key.'['.$input_args_key.']" value="'.$option_value[$input_args_key].'" /></label><br/>';	
					}
				}					
				elseif($option_info['input_type'] == 'textarea') $html_box.= '<textarea placeholder="" name="'.$option_key.'" >'.$option_value.'</textarea> ';
				elseif($option_info['input_type'] == 'radio') {
					$input_args = $option_info['input_args'];
					foreach($input_args as $input_args_key=>$input_args_values)
					{
						if($input_args_key == $option_value) $checked = 'checked';
						else $checked = '';
						$html_box.= '<label><input class="'.$option_key.'" type="radio" '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'"   >'.$input_args_values.'</label><br/>';
					}
				}
				elseif($option_info['input_type'] == 'select') {
					$input_args = $option_info['input_args'];
					$html_box.= '<select name="'.$option_key.'" >';
					foreach($input_args as $input_args_key=>$input_args_values)
					{
						if($input_args_key == $option_value) $selected = 'selected';
						else $selected = '';
						$html_box.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';
					}
					$html_box.= '</select>';
				}					
				elseif($option_info['input_type'] == 'checkbox') {
					$input_args = $option_info['input_args'];
					foreach($input_args as $input_args_key=>$input_args_values)
					{
						if(empty($option_value[$input_args_key])) $checked = '';
						else $checked = 'checked';
						$html_box.= '<label><input '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'['.$input_args_key.']"  type="checkbox" >'.$input_args_values.'</label><br/>';
					}
				}
				elseif($option_info['input_type'] == 'file') {
					$html_box.= '<div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"><img width="100%" src="'.$option_value.'" /></div>';
					$html_box.= '<input type="hidden" id="file_'.$option_key.'" name="'.$option_key.'" value="'.$option_value.'" /><br />';
					$html_box.= '<input id="upload_button_'.$option_key.'" class="upload_button_'.$option_key.' button" type="button" value="Upload File" />';					
					$html_box.= '
					<script>
						jQuery(document).ready(function($){
							var custom_uploader; 
							jQuery("#upload_button_'.$option_key.'").click(function(e) {
							e.preventDefault();
							if (custom_uploader) {
								custom_uploader.open();
								return;
							}
							custom_uploader = wp.media.frames.file_frame = wp.media({
								title: "Choose File",
								button: {
									text: "Choose File"
								},
								multiple: false
							});
							custom_uploader.on("select", function() {
								attachment = custom_uploader.state().get("selection").first().toJSON();
								jQuery("#file_'.$option_key.'").val(attachment.url);
								jQuery(".logo-preview img").attr("src",attachment.url);											
							});
							custom_uploader.open();
						});
					})
					</script>';					
				}		
				$html_box.= '</div>';
			}
			$html_box.= '</li>';
			$i++;
		}
	
		$html.= '<ul class="tab-nav">';
		$html.= $html_nav;			
		$html.= '</ul>';
		$html.= '<ul class="box">';
		$html.= $html_box;
		$html.= '</ul>';		
		$html.= '</div>';			
		return $html;
	}
	
} new wplm_Functions();
