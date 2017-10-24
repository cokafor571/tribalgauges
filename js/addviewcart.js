(function( $ ) {
    $('.add_to_cart_button, .single_add_to_cart_button').click(function(e) {
		e.preventDefault();
		var prodID = $(this).attr('data-product_id');
        $(this).addClass('adding-cart');
		$('.cart-dropdown-inner').empty();

		$.ajax ({
            url: starterpack_ajax_object.ajax_url,
            type:'POST',
            data:'action=starterpack_add_cart&prodID=' + prodID,

            success:function(results) {
                $('.cart-dropdown-inner').html(results);
                var cartcount = $('.item-count').html();
                $('.cart-totals span').html(cartcount);
                $('.products .add_to_cart_button').removeClass('adding-cart');
                $('.secondary-cart').addClass('show-arrow');
                $('.cart-dropdown').addClass('show-dropdown');
                setTimeout(function () { 
                    $('.cart-dropdown').removeClass('show-dropdown');
                }, 3000);
                setTimeout(function () { 
                    $('.secondary-cart').removeClass('show-arrow');
                }, 3000);
            }
       });
	});
})( jQuery );