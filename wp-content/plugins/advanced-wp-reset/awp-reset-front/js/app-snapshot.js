jQuery(document).ready(function(){

	let active = jQuery('#awr-activate-automated-snapshots').is(':checked') ? 1 : 0;
	show_settings_automated_snapshots ( active );

	jQuery("#awr-activate-automated-snapshots").on("click", function(e) {
		
		let active = jQuery(this).is(':checked') ? 1 : 0;

		show_settings_automated_snapshots(active);

		return true;
	});

});

function show_settings_automated_snapshots ( active ) {

	//console.log(active);
	//awr_show_success ();
	let content_panel = jQuery('#awr-settings-automated-settings'); 

	//console.log(content_panel);
	
	let handler = content_panel.find(".awpr_accordion_handler");
	let accordion = content_panel.find(".awpr_accordion_content_panel");
	
	if ( active ) {
		handler.addClass("is-open");
		accordion.removeClass('awpr-content-can-be-disabled');
		accordion.show();
		jQuery('#awr-automated-snapshot-on-off').text("ON");
	
	}else {

		handler.removeClass("is-open");
		accordion.addClass('awpr-content-can-be-disabled');
		accordion.hide();
		jQuery('#awr-automated-snapshot-on-off').html("OFF");
	}
}