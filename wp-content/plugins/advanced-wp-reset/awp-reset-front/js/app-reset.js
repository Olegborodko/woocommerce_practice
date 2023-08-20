jQuery(document).ready(function(){
	
	/* ##############################  RESETS  ################################### */
	
	jQuery('.list-rows').hide();

	jQuery("body").on("click", '.awpr-cc-toggle-icon', function(e){
	
		let target = jQuery(this).data('target');

		jQuery(this).toggleClass('is-open');

		jQuery('#' + target).animate({
			opacity: "toggle",
			height: "toggle"
		}, "slow");

		// Change the icon
	});
	

	jQuery('.awr-reset-keep-radio').on('click', function (e) {

		//e.preventDefault();

		let custom_config_class = jQuery(this).data('custom-config');

		if ( jQuery(this).is(':checked') )
			jQuery('.' + custom_config_class).addClass('awpr-content-can-be-disabled');
		else
			jQuery('.' + custom_config_class).removeClass('awpr-content-can-be-disabled');

		//return true;
	})

	/**
	 * 
	 * For resets : this shows the danger popup
	 * 
	 */
	jQuery('.AWR_reset_button').on('click', function(e){

		// Prevent doaction button from its default behaviour
		e.preventDefault();

		let reset_type = jQuery(this).data('type');
		var confiramation_msg = jQuery('#AWR_reset_confirmation_' + reset_type).val();
		
		if(confiramation_msg.toLowerCase() != "reset"){
			// If confirmation != reset, show msg box
			awr_show_error( awr_ajax_obj.type_reset );
			empty_reset_confirmation_input();
			return;
			
		} else if( !reset_type ){
			// If confirmation != reset, show msg box
			awr_show_error( 'No reset type selected' );
			empty_reset_confirmation_input();
			return;
			
		} else if( reset_type != 'default' ){
			// If confirmation != reset, show msg box
			awr_show_error( 'Available in PRO version only' );
			empty_reset_confirmation_input();
			return;
			
		} else {

			let params = { 
				message: 'You are about to reset your database. All your data will be lost.', 
				ok_text: 'RESET NOW'
			};

			awr_show_confimation( params ).then( (result) => {

				// If the user clicked on "confirm", call reset function
				if(result.value){

					// Show processing msg box
					awr_show_processing_msg_box( 'Reseting your database, please wait ...' );

					let reset_form_data = {};
					reset_form_data['type'] = reset_type;

					data = {
						'action'	: 'awr_full_reset',
						'security'	: awr_ajax_obj.ajax_nonce,
						'reset_form_data' : reset_form_data
					};

					awr_send_request_ajax (data);
				}
			});
		}
	});

	jQuery('#AWR_reset_config_save').on('click', function(e){

		// Prevent doaction button from its default behaviour
		e.preventDefault();

		awr_show_error( 'Available in PRO only' );
		
		return;
		
	});
});


function awr_send_request_ajax ( data, method = 'post') {

	jQuery.ajax({
		type 	: method,
		url		: awr_ajax_obj.ajaxurl,
		cache	: false,
		data 	: data,
		
		success: function(result) {

			awr_show_success ('The reset of you website has been done.');

			empty_reset_confirmation_input();

			result_in_json = JSON.parse(result);

			if(result_in_json.action == 'reload' || result_in_json.action == 'keep') {
				location.reload();
			}else if(result_in_json.action == 'redirect') {
				window.location.href = result_in_json.redirect_to;
			} /*else if (result_in_json.action == 'keep') {
				jQuery('#AWR_full_reset_form').trigger("reset");
				awr_load_list ('reset_configuration');
			}*/ else {
				console.log('error');
				console.log(result_in_json);

				awr_show_error( result_in_json );
			}

		},
		error: function(jqXHR, textStatus, errorThrown) {
		    
			empty_reset_confirmation_input();

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

			if (jqXHR.status === 403) {
				awr_show_error ( 'Error 403, please refresh the page.' );
				return;
		    }/*else {
				// Handle other response codes
				awr_show_error ( 'Error ' + jqXHR.status );
				// Additional actions for other codes
		    }*/

			awr_show_error ( awr_ajax_obj.unknown_error );
		}
	});
}

function empty_reset_confirmation_input() {
	jQuery('#AWR_reset_confirmation').val('');
}