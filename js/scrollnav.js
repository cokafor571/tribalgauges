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