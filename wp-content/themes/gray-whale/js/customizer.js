/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	var cd = gwOptions.copyrightDefault;
	var fid = gwOptions.frontImageDefault;

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
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title' ).add( '.site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a' ).add( '.site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
				$('.frontpage-description').add('.main-footer').css({'color' : to});
				$('.main-footer .footer-column').css({'border-color' : to});
			}
		} );
	} );
	//Header text background color
	wp.customize( 'graywhale_theme_settings[header_bg_color]', function( value ) {
		value.bind( function( to ) {
			$('.site-branding').add('.frontpage-description').add('.main-footer').css({'background-color' : to});
		} );
	} );
	//frontpage image
	wp.customize( 'graywhale_theme_settings[frontpage_img]', function( value ) {
		value.bind( function( to ) {
			if (to.length > 0) {
				$('.frontpage-image').css({'background-image' : 'url("' + to + '")'});
			} else {
				$('.frontpage-image').css({'background-image' : 'url("' + fid + '")'});
			}
		} );
	} );
	//splash screen description
	wp.customize( 'graywhale_theme_settings[frontpage_description]', function( value ) {
		value.bind( function( to ) {
			if (to.length > 0) {
				if ( $("#masthead .frontpage-description").length == 0 ) {
					$("#masthead").append('<div class="frontpage-description justified"></div>');
				}
				$("#masthead .frontpage-description").text(to);
			} else {
				$("#masthead .frontpage-description").remove();
			}
		} );
	} );
	//license info
	wp.customize( 'graywhale_theme_settings[site_license]', function( value ) {
		value.bind( function( to ) {
			if (to.length > 0) {
				$( '.site-license' ).text( to );
			} else {
				$( '.site-license' ).text( cd );
			}
		} );
	} );
} )( jQuery );
