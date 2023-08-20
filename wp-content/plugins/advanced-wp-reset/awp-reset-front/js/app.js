jQuery(document).ready(function(){
		
	jQuery('.awr-no-action-for-tools').hide();

	// On clic on radio, gray->black
	jQuery(".awr-reset-activation-table").on("change", "input[type='radio'].awr_reset_activation_radio", function(event) {
	 	
	 	let closet = jQuery(this).closest('.awpr-single-table-item');

	 	closet.removeClass('awr-reset-element-active awr-reset-element-inactive awr-reset-element-uninstall');

	 	if (jQuery(this).data('action') == 'deactivate' )
	 		closet.addClass('awr-reset-element-inactive');
	 	else if (jQuery(this).data('action') == 'activate' )
	 		closet.addClass('awr-reset-element-activate');
	 	else if (jQuery(this).data('action') == 'uninstall' )
	 		closet.addClass('awr-reset-element-uninstall');
	 	
	});

	// On clic on radio, gray->black
	jQuery(".awr-reset-activation-table").on("change", "input[type='checkbox'].awr_reset_activation_checkbox", function(event) {
	 	
	 	let closet = jQuery(this).closest('.awpr-single-table-item');

	 	closet.removeClass('awr-reset-element-active awr-reset-element-inactive awr-reset-element-uninstall');

	 	if (jQuery(this).is (':checked'))
	 		closet.addClass('awr-reset-element-active');
	 	else 
	 		closet.addClass('awr-reset-element-uninstall');
	 	
	});
	
	// On clic on radio, gray->black
	jQuery("#awr-custom-reset-bloc").on("change", "input[type='checkbox'].awr-reset-keep-radio", function(event) {
	 	
	 	let closet = jQuery(this).closest('.awpr-single-check-item');

	 	closet.removeClass('awr-custom-reset-keep awr-custom-reset-dont-keep');

	 	if (jQuery(this).is(':checked') )
	 		closet.addClass('awr-custom-reset-keep');
	 	else 
	 		closet.addClass('awr-custom-reset-dont-keep');
	 	
	});

	// Main menu //
	jQuery("#awpr_tab_menu").on("click", "li", function(e) {
		
		e.preventDefault();
		// Get the target data attribute value
		var target = jQuery(this).data("target");

		if ( target == 'awpr-activation' )
			return;

		// Show the target content div and hide others
		jQuery(".awpr-single-tab-panel").hide();
		jQuery("#" + target).show();

		jQuery('.awpr-tab-item').removeClass('awpr-active');
		jQuery(this).addClass('awpr-active');

		jQuery.ajax({
			type 	: "get",
			url		: awr_ajax_obj.ajaxurl,
			cache	: false,
			data: {
				'action' : 'awr_change_nav_tab',
				'nav_anchor' : target,
				'security'	: awr_ajax_obj.ajax_nonce
			},

			success: function(result) {
				//console.log(result);
			},
			error: function(result){
				awr_show_error ( awr_ajax_obj.unknown_error );
			}
		});
	});

	// On clic on the accordion handler, show content
	jQuery("body").on("click", '.awpr_accordion_handler', function(e){
		//jQuery('.awpr_accordion_handler').click(function (e) {


		const accordionHeader = jQuery(this);
		const accordionContent = accordionHeader.siblings('.awpr_accordion_content_panel');

		// Toggle the clicked header's sibling content
		accordionContent.slideToggle();
		accordionHeader.toggleClass('is-open');

		let bloc_id = this.id;
		let hidden 	= accordionHeader.hasClass('is-open') ? 0 : 1;

		jQuery.ajax({
			type 	: "get",
			url		: awr_ajax_obj.ajaxurl,
			cache	: false,
			data: {
				'action' 	: 'awr_save_hidden_bloc',
				'bloc_id' 	: bloc_id,
				'hidden' 	: hidden, 
				'security'	: awr_ajax_obj.ajax_nonce
			},

			success: function(result) {
				//console.log(result);
			},
			error: function(result){
				awr_show_error ( awr_ajax_obj.unknown_error );
			}
		});

		e.stopPropagation(); // Stop event propagation from child accordions to their parent 
	});

	// Open the accordion item with the 'open-default' class
	const defaultAccordion = jQuery('.awpr_accordion_default_opener');
	defaultAccordion.children('.awpr_accordion_content_panel').slideDown(100);
	defaultAccordion.children('.awpr_accordion_handler').addClass('is-open');


	// Only for snapshots 
	jQuery(document).on("click", ".awpr-dropdown-toggle", function snapshot_dropdown_actions (e) {
		
		closeDropdowns();

		const drop_down_content = jQuery(this).next(".awpr-dropdown-content");			
		const is_open = drop_down_content.hasClass("open");
		
		if (!is_open) {
			drop_down_content.addClass("open");
		}

		e.stopPropagation();
	});

	function closeDropdowns() {
		jQuery(".awpr-dropdown-content").removeClass("open");
	}
		

	jQuery(document).on("click", function(e) {
		
		const targetElement = e.target;

		if ( !jQuery(targetElement).hasClass("dropdown-btn") && !jQuery(targetElement).hasClass("dropdown-menu-link") ) {
			closeDropdowns();
		}
	});

	jQuery(document).on("keyup", function(e) {
		if (e.key === "Escape") {
			closeDropdowns();
		}
	});

	jQuery('#awr-get-system-infos').on("click", function(e) {
		
		e.preventDefault();

		awr_show_processing_msg_box( 'Loading ...' );

		jQuery.ajax({
			type 	: "get",
			url		: awr_ajax_obj.ajaxurl,
			cache	: false,
			data: {
				'action' : 'awr_system_infos',
				'security'	: awr_ajax_obj.ajax_nonce
			},

			success: function(result) {
				awr_show_system_infos ( result );
				/*then((result) => {
					if (result.isConfirmed) {

						var copyContent = jQuery("#awr-system-infos-content");

						// Create a range object and select the content of the div
		                const range = document.createRange();
		                range.selectNode(copyContent[0]); // Pass the first element of the jQuery collection

		                // Create a selection object and add the range to it
		                const selection = window.getSelection();
		                selection.removeAllRanges(); // Clear any existing selections
		                selection.addRange(range);

		                // Execute the copy command
		                document.execCommand('copy');

		                // Clean up the selection
		                selection.removeAllRanges();

		                alert('Content has been copied to clipboard');
						
						awr_show_success();
					}
				});*/
			},
			error: function(result){
				awr_show_error ( awr_ajax_obj.unknown_error );
			}
		});
	});

});

