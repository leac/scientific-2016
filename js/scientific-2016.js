jQuery( document ).ready( function ( $ ) {
	$( '[class*="popover-parent"] > a' ).on( 'click', function () {
		$( '[class*="popover-parent"] > a' ).not( this ).parent().removeClass( 'active' );
		$( this ).parent().toggleClass( 'active' );
		/*for some reason, putting focus on the search input, needs setTimeot,
		 * as described here: http://stackoverflow.com/questions/15859113/focus-not-working/15859155#15859155 */
		setTimeout( function () {
			$( '.search-field' ).focus()
		}, 500 );
	} );

//Hide the menu when click off
	$( 'html' ).on( 'click focus', function () {
		$( '[class*="popover-parent"].active' ).removeClass( 'active' );
	} );

//Don't include button or menu in 'html' click function
	$( '.popover, [class*="popover-parent"] > a, .search-form, .mp-accessibility-plugin' ).click( function ( event ) {
		event.stopPropagation();
	} );

	/* in Opinions on front page, move the entry meta before the entry title in higher resolutions */
	var mql = window.matchMedia( "screen and (min-width: 960px)" );
	mql.addListener( moveOpinionsEntryMeta );
	moveOpinionsEntryMeta( mql );
	function moveOpinionsEntryMeta( mql ) {
		if ( mql.matches ) {

			var entryMeta = $( '.block-columns_and_opinions .entry-meta' );
			entryMeta.each( function ( index ) {
				var titleSibling = $( this ).siblings( '.entry-title' );
				$( this ).insertBefore( titleSibling );
			} );
		}
	}
} );

/*!
 * **********************************
 * THIS IS FOR COVER IMAGE
 * **********************************
 */
objectFit.polyfill( {
	selector: '.block-newest-posts .entry-header img, .single .entry-header img',
	fittype: 'cover'
} );

/*!
 * **********************************
 * THIS IS FOR STYLED COMMENTS
 * **********************************
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * based on: http://tympanus.net/codrops/2015/01/08/inspiration-text-input-effects/
 *
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function ( window ) {

	'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

	function classReg( className ) {
		return new RegExp( "(^|\\s+)" + className + "(\\s+|$)" );
	}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
	var hasClass, addClass, removeClass;

	if ( 'classList' in document.documentElement ) {
		hasClass = function ( elem, c ) {
			return elem.classList.contains( c );
		};
		addClass = function ( elem, c ) {
			elem.classList.add( c );
		};
		removeClass = function ( elem, c ) {
			elem.classList.remove( c );
		};
	}
	else {
		hasClass = function ( elem, c ) {
			return classReg( c ).test( elem.className );
		};
		addClass = function ( elem, c ) {
			if ( !hasClass( elem, c ) ) {
				elem.className = elem.className + ' ' + c;
			}
		};
		removeClass = function ( elem, c ) {
			elem.className = elem.className.replace( classReg( c ), ' ' );
		};
	}

	function toggleClass( elem, c ) {
		var fn = hasClass( elem, c ) ? removeClass : addClass;
		fn( elem, c );
	}

	var classie = {
		// full names
		hasClass: hasClass,
		addClass: addClass,
		removeClass: removeClass,
		toggleClass: toggleClass,
		// short names
		has: hasClass,
		add: addClass,
		remove: removeClass,
		toggle: toggleClass
	};

// transport
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( classie );
	} else {
		// browser global
		window.classie = classie;
	}

} )( window );