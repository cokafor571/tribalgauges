(function( $ ) {

    //var tripHeader = sessionStorage.getItem( 'tripHeader' );

    //if ( tripHeader ) { 
        //$('.page-header').css({
            //display: 'none'
       // });
       // console.log( 'tripHeader' );
   // }

    $( '.fa-times' ).on( 'click', function() {
        $( '.control-header-height' ).css({
            top: '-40px'
        });
        //sessionStorage.setItem('tripHeader', 'none');
    });
})( jQuery );
(function( $ ) {

        $( '.secondary-cart' ).on( 'hover', function() {
            $( '.cart-dropdown' ).addClass( 'show-dropdown' );
            $('.secondary-cart').addClass('show-arrow');
        });

        $( '.secondary-cart' ).on( 'mouseleave', function() {
            $( '.cart-dropdown' ).removeClass( 'show-dropdown' );
            $('.secondary-cart').removeClass('show-arrow');
        });

})( jQuery );
(function( $ ) {
    $(window).on('scroll', function() {
        var scrollTop = $(this).scrollTop(),
            navDistance = $('.main-navigation').offset().top,
            nav = $('.main-navigation');

        if ( navDistance + 100 < scrollTop ) {
            nav.addClass('fixed-nav');
            nav.animate({
                top: 0 //This value of 0 is how far you want the sidebar to animate.
            });
            $( '.menu-toggle' ).css({
                top: '0'
            });
        } else if ( $(window).width() > 600  && scrollTop < 40 ) {
            nav.removeClass( 'fixed-nav' ); 
            $( '.menu-toggle' ).css({
                top: '35px'
            });
        }
    });
})( jQuery );
/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();
