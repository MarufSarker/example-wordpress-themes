/**
 * File customizer.js.
 *
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

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	// Custom Header Background Color
	wp.customize( 'header_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-header, .mdl-layout__header--transparent.mdl-layout__header--transparent' ).css( {
				'background-color': to
			});
		} );
	} );
	
	// Custom MDL Drawer Button Color
	wp.customize( 'mdl_drawer_button_color', function( value ) {
		value.bind( function( to ) {
			$( '.mdl-layout__drawer-button i, form#fixed-header-search-form i' ).css( {
				'color': to
			});
		} );
	} );
	
	// Default Fallback Featured Image (enable if 'transport' => 'refresh' is set)
	// wp.customize( 'default_fallback_featured_image', function( value ) {
	// 	value.bind( function( to ) {
	// 		$( '.default_fallback_featured_image' ).css( {
	// 			'background-image': to
	// 		});
	// 	} );
	// } );
	
	// Custom Layout Options
	wp.customize( 'layout_setting', function( value ) {
		value.bind( function( to ) {
			$( '#page' ).removeClass( 'no-sidebar sidebar-left sidebar-right' );
			$( '#page' ).addClass( to );
		} );
	} );
	
} )( jQuery );
