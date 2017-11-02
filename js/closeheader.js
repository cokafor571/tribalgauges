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
            transform: 'translate3d(0,-40px,0)'
        });
        //sessionStorage.setItem('tripHeader', 'none');
    });
})( jQuery );