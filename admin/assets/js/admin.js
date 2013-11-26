(function ( $ ) {
	"use strict";

	$(function () {

		var $currentRow, $page;

		// For each of the table rows...
		$('tr').each(function() {

			// Determine if we're looking a page row that has a page ID in the ID attribute
			if( undefined !== ( $page = $(this).attr('id') ) && 0 === $page.indexOf( 'post-' ) ) {

				// If so, find the page ID
				var iPageId = $page.match( /\d+/g );

				// Now request name of the page template from the server
				$.get( ajaxurl, {

					action:   'get_page_template',
					page_id:  iPageId

				}, function ( data, response ) {

					// If the request is successful and there is a name...
					if ( 'success' === response.toLowerCase() && 0 < $.trim( data ).length ) {

						// ...Then let's write it out to the client side
						$('#post-' + iPageId )
							.children( '.page-title' )
							.children( 'strong' )
							.after(function() {
								return data;
							});

					} // end if

				});

			} // end if

		});

	});

}(jQuery));