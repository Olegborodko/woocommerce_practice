jQuery(document).ready(function(){

	
	jQuery('.in-pro-only').on('click', function(e){

		// Prevent doaction button from its default behaviour
		e.preventDefault();

		awr_show_in_pro ();
		
		return false;
		
	});

	jQuery('#awr-custom-snapshot_loading').hide();
    jQuery('#awr-no-custom-snapshot').show();


});