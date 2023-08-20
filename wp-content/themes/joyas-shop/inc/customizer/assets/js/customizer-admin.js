/*admin css*/
( function( joyas_shop_api ) {

	joyas_shop_api.sectionConstructor['joyas_shop_upsell'] = joyas_shop_api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
