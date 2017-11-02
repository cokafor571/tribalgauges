(function( $ ) {
    $(window).on('scroll', function() { 
        var scrollTop = $(this).scrollTop(); /*
            gaugesDistance = $('.gauges').offset().top - 650,
            illusionDistance = $('.fake-gauges').offset().top - 650,
            accessoriesDistance = $('.accessories-block').offset().top - 650;

        if ( scrollTop >= gaugesDistance ) {
           $('.gauges').addClass( 'animate-element' );
        }

        if ( scrollTop >= illusionDistance ) {
           $('.fake-gauges').addClass( 'animate-element' );
        }

        if ( scrollTop >= accessoriesDistance ) {
           $('.accessories-block').addClass( 'animate-element' );
        } */
        if ( scrollTop >= 0 ) {
            $('.intro').addClass( 'animate-element' );
        }

    });
})( jQuery );