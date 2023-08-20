jQuery(document).ready(function(){

	awr_tools_load_list ();

	// Reset items when clicking on "Run reset now" button in "Custom reset" tab
	jQuery('.AWR-custom-reset-button').on('click', function(){

		// Get item name and title to delete
		var item_name			= jQuery(this).attr('name');
		var item_title			= jQuery(this).attr('value');
		
		var keep_active_theme 	= jQuery("#awr-keep-current-theme").prop("checked") == true ? 1 : 0;

		let params = { message:awr_ajax_obj.custom_warning + '<br /><b>' + item_title + '</b>' };
		let options = {};
		let process_message = item_title + ' ...';
		let done_message = item_title + ' done';
		// When clicking on 'Delete themes' button, check if keep active theme and keep current plugin are checked
		if(item_name == "themes-files"){

			if ( keep_active_theme == 0 )
				params = { message:awr_ajax_obj.custom_warning + '<br /><b>' + item_title + ', the current one too</b>' };
			else
				params = { message:awr_ajax_obj.custom_warning + '<br /><b>' + item_title + ', except the current one</b>' };
			
			options['keep_active_theme'] = keep_active_theme;

		}
		
		awr_show_confimation( params ).then( (result) => {

			// If the user clicked on "confirm", call reset function
			if(result.value){

				// Show processing icon
				awr_show_processing_msg_box( process_message );

				// If the user clicked on "Reset Local Data" tools
				if(item_name == "local-storage"){

					localStorage.clear();					
					awr_show_success (); 

					return;
				}

				// If the user clicked on all other reset tools except "Reset Local Data"

				jQuery.ajax({
					type 	: "post",
					url		: awr_ajax_obj.ajaxurl,
					cache	: false,
					data: {
						'action'				: 'awr_reset_options',
						'security'				: awr_ajax_obj.ajax_nonce,
						'item_to_reset' 		: item_name,
						'options' 				: options,
						
					},
					success: function(result){

						result_in_json = JSON.parse(result);

						if ( result.code == 0 ) {
							awr_show_error ( result_in_json.message );
						} else {

							if(result_in_json.action == 'reload') {
								awr_show_success (done_message);
								location.reload();
							}else if(result_in_json.action == 'redirect') {
								awr_show_success (done_message);
								window.location.href = result_in_json.redirect_to;
							}else if (result_in_json.action == 'keep') {
								awr_show_success (done_message);
								awr_get_total_data_of (item_name);
								//jQuery('#AWR_full_reset_form').trigger("reset");
								//load_list ('reset_configuration');
							}else {
								console.log('error');
								console.log(result_in_json);
							}		
						}
										
						var dependent_types = ["pending-comments", "spam-comments", "trashed-comments", "pingbacks", "trackbacks"];
						if(jQuery.inArray(item_name, dependent_types) != -1){
							awr_get_total_data_of("all-comments");
						}
										
						var dependent_types = ["revisions", "drafts", "auto-draft", "empty-trash"];
						if(jQuery.inArray(item_name, dependent_types) != -1){
							awr_get_total_data_of("posts");
							awr_get_total_data_of("pages");
						}
										
						var dependent_types = ["drop-custom-tables"];
						if(jQuery.inArray(item_name, dependent_types) != -1){
							awr_get_total_data_of("empty-custom-tables");
						}
										
						var dependent_types = ["cache"];
						if(jQuery.inArray(item_name, dependent_types) != -1){
							awr_get_total_data_of("transients");
						}

					},
					error: function(jqXHR, textStatus, errorThrown) {
						
						if ( jqXHR.hasOwnProperty('responseJSON') ) {
							
							result_in_json = jqXHR.responseJSON;

							if ( result_in_json.hasOwnProperty('message') ){
								awr_show_error ( result_in_json.message );
							} else {
								awr_show_error (JSON.stringify( result_in_json ))
							}

							return;
						} 

						if (jqXHR.hasOwnProperty('responseText') ) {
							awr_show_error(jqXHR.responseText);
							return ;
						} 

						awr_show_error ( awr_ajax_obj.unknown_error );
						
					}

				});
			}
		})
	});
	
	jQuery('#awr-keep-current-theme').on('click', function(){
		awr_get_total_data_of ( 'themes-files' );
	});

});

function show_loading_and_hide_number ( item_name ) {
	jQuery('#AWR_total_'  + item_name + '_loading').show();
	jQuery('#AWR_total_' + item_name).hide();
}


function hide_loading () {
	
	jQuery('.AWR_tools_loading').hide();
}

function show_number( item_name, total ) {
	
	//console.log('Showing number ' + item_name + ' ' + total);
	jQuery('#AWR_total_' + item_name).show();
	jQuery('#AWR_total_' + item_name).text('(' + total + ')');

	jQuery('#AWR_total_' + item_name).show();

	if ( total == 0 || total == '0' ) {
		jQuery('#no_action_for_' + item_name).show();
		jQuery('#button_for_' + item_name).hide(); 
	} else {
		jQuery('#no_action_for_' + item_name).hide();
		jQuery('#button_for_' + item_name).show(); 
	}
}

function awr_get_total_data_of ( item_name ) {

	if(item_name == "cookies" || item_name == "session" || item_name == "local-storage" ){
		return '-';
	} else {
		return awr_count_other_item ( item_name );
	}
}

function awr_count_other_item (item_name ){

	// Get "keep active theme" checkbox value
	var awr_keep_active_theme = jQuery("#awr-keep-current-theme").is(":checked") == true ? 1 : 0;

	show_loading_and_hide_number ( item_name );

	jQuery.ajax({
		type 	: "post",
		url		: awr_ajax_obj.ajaxurl,
		cache	: false,
		data: {
			'action'				: 'awr_count_option_items',
			'security'				: awr_ajax_obj.ajax_nonce,
			'awr_item_type' 		: item_name,
			'awr_keep_active_theme' : awr_keep_active_theme,
		},
		success: function(result){

			//console.log(result);

			result_in_json = JSON.parse(result);
			//console.log(result_in_json);

			count = result_in_json.message;
			code = result_in_json.code;


			show_number ( item_name, count );
		},
		complete: function(){
			hide_loading();
		}
	});
}

function awr_tools_load_list () {
			
	// console.log('awr_tools_load_list');

	jQuery.ajax({

		type 	: "get",
		url		: awr_ajax_obj.ajaxurl,
		cache	: false,
		data: {
			'action'	: 'awr_get_tools_counts',
			'security'	: awr_ajax_obj.ajax_nonce
		},
		success: function(result){
			
			result_in_json = JSON.parse(result);

			if ( result.code == 0 ) {
				awr_show_error ( result_in_json.message );
			} else {

				let tasks_array = JSON.parse(result_in_json.message);

				if ( Array.isArray(tasks_array) ) {

					for (let i = 0; i < tasks_array.length; i++) {
						// Get the current row
						const task = tasks_array[i];
						const item_name = task[0];
						const count = task[1];
						
						show_number ( item_name, count );
						//awr_get_total_data_of (item_name);
					}

				} else {
					console.log( tasks_array + ' is not array' );
				}		
			}

		},
		complete: function(){
			hide_loading();
		}
	});
}

/*
function awr_display_list( array, element_name ) {

	if ( element_name == 'reset_configuration' ) {
		// Empty all existant configs
		jQuery('.awr-user-custom-reset-config').not('#awr-user-custom-reset-config-template').remove(); 
	}

	if ( element_name == 'snapshot' ) {
		// Empty all existant snapshots
		jQuery('.awr-snapshot').not('#awr-snapshot-template').remove(); 
	}

	if ( element_name == 'collection' ) {
		// Empty all existant snapshots
		jQuery('.awr-collection').not('#awr-collection-template').remove(); 
	}
	// Add the elements within array
	
	console.log(element_name);
	console.log(array);
	if ( Array.isArray(array) && array.length > 0 ) {
		
		jQuery('#awr-no-custom-' + element_name ).hide();

		for (let index in array) { 
			array_item = array[index];
			awr_display_item( array_item, element_name );
		}
	} else {
		jQuery('#awr-no-custom-' + element_name ).show();
	}
}*/