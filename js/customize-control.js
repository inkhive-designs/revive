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
	
		// Code for the Slider.
		// If there is any value stored in the Control, render the Slides
	
	jQuery('body').on( 'click', '.add_slide_button', function() {
		
		var imgContainer		=	jQuery(this).closest('.slider-container').find('.slide_thumbs'),
		valInput				=	jQuery(this).closest('.slider-container').find('.slide_values');
		
		
		if ( typeof wp === 'undefined' || !wp.media ) {
			return;
		}
		
		var frame	=	new wp.media.view.MediaFrame.Select({
			title: 'Select an Image for Slider',
			button: {
				text: 'Add Slide'
			},
			multiple: false,
		});
		
		event.preventDefault();
		
		frame.open();
		
		frame.on( 'select', function() {
			
			var attachment = frame.state().get('selection').first().toJSON();
			
			var metaString	= attachment.compat.item
			, parser		=	new DOMParser()
			, metaHTML		=	parser.parseFromString(metaString, "text/html")
			, slideURL		=	metaHTML.getElementsByTagName('input')[1].value
			, ctaTEXT		=	metaHTML.getElementsByTagName('input')[2].value;
			
 			imgContainer.append('<div class="slide-image"><h2><span>Slide</span><span class="dashicons dashicons-arrow-up-alt2"></span></h2><div class="img-container"><img src="' + attachment.url + '" data-id="' + attachment.id + '"></div><div class="slide-title"><h3>Title</h3><input type="text" class="text slide_title" value="' + attachment.title + '"><br></div><div class="slide-description"><h3>Description</h3><textarea style="width: 100%">' + attachment.description + '</textarea><br></div><div class="slide-url"><h3>Slide URL</h3><input type="text" class="text rtslider_link" value="' + slideURL + '"><br></div><div class="slide-cta"><h3>CTA Button Text</h3><input type="text" class="text cta_button" value="' + ctaTEXT + '"><br></div><button type="button" class="button remove_slide_button">Remove Slide</button></div>');
 			
 			//AccordionToggle();
			
			var finalInputString	=	getAllValues( jQuery('.slide_thumbs').find( 'img' ) );
			
			jQuery(valInput).val(finalInputString).trigger('change');
			
		});
		
	});
	
	function getAllValues(element) {
		
		var values	=	{};
		
		element.each(function( i, val ) {
			
			values[i]	=	{};
			values[i]['id']				=	jQuery(this).attr('data-id');
			values[i]['title']			=	jQuery(this).parents('.slide-image').find('.slide_title').val();
			values[i]['description']	=	jQuery(this).parents('.slide-image').find('textarea').val();
			values[i]['url']			=	jQuery(this).parents('.slide-image').find('.rtslider_link').val();
			values[i]['cta']			=	jQuery(this).parents('.slide-image').find('.cta_button').val();
		});
		
		var valuesString	=	JSON.stringify( values );
		
		return valuesString;
	}
	
	// Check for changes in any of the fields in Slider
	jQuery('.slide_thumbs input, .slide_thumbs textarea').on('input propertychange paste', function() {
		var finalInputString	=	getAllValues( jQuery('.slide_thumbs').find( 'img' ) ),
			valInput			=	jQuery(this).closest('.slider-container').find('.slide_values');
		
		jQuery(valInput).val(finalInputString).trigger('change');
	});
	

	// The Reset Button
	jQuery('.reset_slide_button').click(function() {
		
		var imgContainer		=	jQuery(this).closest('.slider-container').find('.slide_thumbs'),
			valInput			=	jQuery(this).closest('.slider-container').find('.slide_values');
		
		if ( imgContainer.html() == '') {
			return;
		}
		
		imgContainer.find('div').remove();
		valInput.val('').trigger('change');
	});
	
	
	// The 'Remove Slide' Button
	jQuery('body').on( 'click', '.remove_slide_button', function() {
		
		var valInput			=	jQuery(this).closest('.slider-container').find('.slide_values');
		
		jQuery(this).parent().remove();
		
		var finalInputString	=	getAllValues( jQuery( '.slide_thumbs' ).find('img') );
		
		jQuery(valInput).val(finalInputString).trigger('change');
	});
	
	// Accordion functionality
	
	jQuery('.slide_thumbs h2').siblings().hide();
	
	function AccordionToggle() {

		jQuery('.slide_thumbs').on( 'click', 'h2', function() {
			jQuery(this).siblings().slideToggle(200, 'swing', function() {
					if(jQuery(this).is(':visible')) {
						jQuery(this).parents('.slide-image').find('span.dashicons').attr('class', 'dashicons dashicons-arrow-up-alt2');
					} else {
						jQuery(this).parents('.slide-image').find('span.dashicons').attr('class', 'dashicons dashicons-arrow-down-alt2');
					}
				});
		});
	}
	
	AccordionToggle();
	
	
	// Customizer Notification for WPForms
	jQuery('body').find('#accordion-section-themes').after('<div class="wpforms-notice"><p><i>Install and activate the <b>WPForms Lite</b> plugin to enable the <b>Contact Us</b> Section of the Customizer. </i></p></div>');
});