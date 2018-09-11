jQuery(document).ready( function() {
	jQuery('#searchicon').click(function() {
		jQuery('#jumbosearch').fadeIn();
		jQuery('#jumbosearch input').focus();
	});
	jQuery('#jumbosearch .closeicon').click(function() {
		jQuery('#jumbosearch').fadeOut();
	});
	jQuery('body').keydown(function(e){
	    
	    if(e.keyCode == 27){
	        jQuery('#jumbosearch').fadeOut();
	    }
	});
	
	jQuery('.flex-images').flexImages({rowHeight: 200, object: 'img', truncate: true});
	
	//For the Revive Layout
	jQuery('.site-main').flexImages({rowHeight: 200, object: 'img'});
	
	
jQuery(document).ready( function() {
	jQuery('#top-menu ul.menu').mobileMenu({
		switchWidth: 767
		});
	jQuery('#top-menu div.menu ul').mobileMenu({
		switchWidth: 767
		});	

	jQuery('#site-navigation .container ul.menu').mobileMenu({
		switchWidth: 767
		});
	jQuery('#site-navigation .container div.menu ul').mobileMenu({
		switchWidth: 767
		});	
});
	
});//endready

jQuery(window).load(function() {
        jQuery('#nivoSlider').nivoSlider({
	        prevText: "<i class='fa fa-chevron-circle-left'></i>",
	        nextText: "<i class='fa fa-chevron-circle-right'></i>",
        });
    });

//Posts Slider
jQuery(window).load(function() {
    jQuery('#nivoSliderPosts').nivoSlider({
        prevText: "<i class='fa fa-chevron-circle-left'></i>",
        nextText: "<i class='fa fa-chevron-circle-right'></i>",
        manualAdvance: true,
		beforeChange: function() {
        	jQuery('.slider-wrapper .nivo-caption').animate({
                opacity: 0,
                marginLeft: -10,
            },500, 'linear');
		},
		afterChange: function(){
        	jQuery('.slider-wrapper .nivo-caption').animate({
				opacity: 1,
				marginLeft: 0,
			}, 500, 'linear');
		},
    });
});

//sticky social menu bar
jQuery( document ).scroll(function() {
    var y = jQuery(this).scrollTop();
    if (y > 700) {
        jQuery('#social-icons-sticky').fadeIn(200);
	 }
    else {
        jQuery('#social-icons-sticky').fadeOut(200);
    }
});

//sticky sidebar
jQuery(window).load(function() {
    jQuery('.sticky-sidebar').scrollToFixed({
        marginTop: 30,
        limit: jQuery('#primary').offset().top + jQuery('#primary').height() - jQuery('.sticky-sidebar').height(),
    });
});