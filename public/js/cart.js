$(document).ready(function(){


    $('.js-remove-cartline').on('click', function(e) {
        e.preventDefault();

        var $el = $(this).closest('.js-product');

        $.ajax({
            url: $(this).data('url'),
            method: 'DELETE'
        }).done(function() {
            $el.fadeOut();
        });

    });



    // const cartline = document.getElementById('cartline');
    //
    // if (cartline) {
    //     cartline.addEventListener('click', (e) =>{
    //         if (e.target.className === 'delete-btn'){
    //             const id = e.target.getAttribute('data-id');
    //
    //             fetch(`/account/cart/${cart_id}/${cartline_id}`, {
    //                 method: 'DELETE'
    //             }).then(res =>window.location.reload());//.then(res =>window.location.reload())
    //         }
    //     });
    // }


    $('.bminus').click(function(e){
        e.preventDefault();

        var $this = $(this);
        var $input = $this.closest("div").find("input.counter");
        var value = parseInt($input.val());
        if(value > 1){value = value - 1;}
        else{value = 0;}
        input.val(value);
    });

    $('.bplus').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var input = $('#counter');
        var value = parseInt(input.val());
        if(value < 100){value = value + 1;}
        else{value = 100;}
        input.val(value);
    });
});