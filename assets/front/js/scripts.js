jQuery(document).ready(function($) {
	
	$(".wplm_button_container").draggable();
	$(".wplm_box_container .wplm_box").draggable({
		handle: ".wplm_box_move"
	});
	
	$(document).on('click', '.wplm_box_container .wplm_box .wplm_box_header_icon.wplm_box_close', function() {
		$('.wplm_box_container').fadeOut();
	})
	
	$(document).on('click', '.wplm_button_container .wplm_button', function() {
		$('.wplm_box_container').fadeIn();
	})
});	







