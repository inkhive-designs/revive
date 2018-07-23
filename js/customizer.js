/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    // Site title and description.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    //Site Identity
    wp.customize( 'revive_hide_title_tagline', function ( value ) {
        value.bind( function ( to ) {
            $( '#text-title-desc' ).toggle();
        });
    } );

    wp.customize( 'revive_branding_below_logo', function ( value ) {
        value.bind( function ( to ) {
            if(to == true ) {
                $( '#text-title-desc' ).css({
                    'display' : 'block',
                });
            }
            else {
                $( '#text-title-desc' ).css( {
                    'display' : 'inline-block',
                });
            }
        });
    } );

    wp.customize( 'revive_center_logo', function ( value ) {
        value.bind( function ( to ) {
            if( to == true ) {
                $( '.site-branding' ).css('text-align', 'center' );
                $( '#text-title-desc' ).css('text-align', 'center' );
            }
            else {
                $( '.site-branding' ).css('text-align', 'left' );
                $( '#text-title-desc' ).css('text-align', 'left' );
            }
        });
    } );

    //Design & Layouts
    //Colors
    wp.customize( 'revive_site_titlecolor', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).css( 'color', to );
        } );
    } );
    wp.customize( 'revive_header_desccolor', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).css( 'color', to );
        } );
    } );

    //Footer Text
    wp.customize( 'revive_footer_text', function( value ) {
       value.bind( function( to ) {
           $( '.sep' ).text( to );
       });
    });
    wp.customize( 'revive_fc_line_disable', function(value) {
        value.bind(function(to) {
            $('.credit-line').toggle();
        });
    } );
    wp.customize('revive_disable_footer_menu', function ( value ) {
        value.bind( function( to ) {
            $('.footer-menu').toggle();
        });
    });

    //Social Icons
    // wp.customize( 'revive_disable_social_sticky', function( value ) {
    //     value.bind( function( to ) {
    //         if ( false === to ) {
    //             $('#social-icons-sticky').css( 'display', 'none !important');
    //         }
    //         else {
    //             $('#social-icons-sticky').css( 'display', 'block !important');
    //         }
    //     });
    // });

    wp.customize( 'revive_social_icon_style_set', function( value ) {
        value.bind( function( to ) {
            var	ChangeClass	=	'social-icon ' + to;
            $( '#social-icons a' ).attr( 'class', ChangeClass );
        });
    });

    wp.customize( 'revive_social_1', function( value ) {
        value.bind( function( to ) {
            var ClassNew	=	'fab fa-' + to;
            jQuery('#social-icons' ).find( 'i:eq(0)' ).attr( 'class', ClassNew );
        });
    });

    wp.customize( 'revive_social_2', function( value ) {
        value.bind( function( to ) {
            var ClassNew	=	'fab fa-' + to;
            jQuery('#social-icons' ).find( 'i:eq(1)' ).attr( 'class', ClassNew );
        });
    });

    wp.customize( 'revive_social_3', function( value ) {
        value.bind( function( to ) {
            var ClassNew	=	'fab fa-' + to;
            jQuery('#social-icons' ).find( 'i:eq(2)' ).attr( 'class', ClassNew );
        });
    });

    wp.customize( 'revive_social_4', function( value ) {
        value.bind( function( to ) {
            var ClassNew	=	'fab fa-' + to;
            jQuery('#social-icons' ).find( 'i:eq(3)' ).attr( 'class', ClassNew );
        });
    });

    wp.customize( 'revive_social_5', function( value ) {
        value.bind( function( to ) {
            var ClassNew	=	'fab fa-' + to;
            jQuery('#social-icons' ).find( 'i:eq(4)' ).attr( 'class', ClassNew );
        });
    });

    wp.customize( 'revive_social_6', function( value ) {
        value.bind( function( to ) {
            var ClassNew	=	'fab fa-' + to;
            jQuery('#social-icons' ).find( 'i:eq(5)' ).attr( 'class', ClassNew );
        });
    });

    //Featured Areas
    wp.customize('revive_box_enable', function( value ) {
        value.bind(function( to ) {
            $( '#featured-area-1' ).toggle();
        });
    });
    wp.customize('revive_box_title', function( value ) {
        value.bind( function( to ) {
            $( '#featured-area-1 .section-title' ).text( to );
        });
    });

    wp.customize('revive_fa2_enable', function( value ) {
        value.bind(function( to ) {
            $( '#featured-area-2' ).toggle();
        });
    });
    wp.customize( 'revive_fa2_title', function( value ) {
        value.bind( function( to ) {
            $( '#featured-area-2 .section-title' ).text( to );
        });
    });

    wp.customize( 'revive_fposts_slider_enable', function( value ) {
        value.bind( function( to ) {
            $( '#post-slider' ).toggle();
        });
    });
    wp.customize( 'revive_posts_slider_title', function( value ) {
        value.bind( function( to ) {
            $( '#post-slider .section-title' ).text( to );
        });
    });

    wp.customize( 'revive_fm_post_enable', function( value ) {
        value.bind( function( to ) {
            $( '#featured-mega-post' ).toggle();
        });
    });
    wp.customize( 'revive_fm_post_title', function( value ) {
        value.bind( function( to ) {
            $( '#featured-mega-post .section-title' ).text( to );
        });
    });

} )( jQuery );
