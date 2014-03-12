jQuery(document).ready(function($){

	load_fblb();
	$('#fb_box_close, body').click( function() { unload_fblb(); });
	function unload_fblb() { $('#fb_box, .fb_overlay').fadeOut("slow"); }
	function load_fblb() { $('#fb_box, .fb_overlay').fadeIn("slow"); }
	
});