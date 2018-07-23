/**
 *
 *	JS for the Cutomizer Controls
 *
**/


jQuery(document).ready(function() {
	
	jQuery( '#post_search' ).on( 'input', function() {
		
		var titleInput	=	jQuery( this ).val();
		
		if ( titleInput	===	'' ) {
			jQuery(this).html('');
			return;
		}

		data = {
			action: 'post_title_list',
			post_title:	titleInput,
		}
		
		jQuery.post(ajaxurl, data, function( response ) {
			if ( response ) {
				jQuery('#search-results').html( response );
			}
		});
	});
	
	jQuery( '#search-results' ).on( 'click', 'li', function() {
		var currentValue	=	jQuery(this).text();
		jQuery( '#post_search' ).val( currentValue ).trigger( 'change' );
		jQuery(this).parents('#search-results').html('');
	});
});