$(function() {

    $('.add-to-cart').on('click', function(e){
        e.preventDefault();
        let id =$(this).data('id');
        let quantity=0;
        let totalPrice = 0;
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:'/add-to-cart',
            type: 'GET',
            data: {'id': id},
            success: function (data) {
                let value= $('#totalCount').text();
                if(value=='')value='0';

                // total count add 1
                $('#totalCount').empty();
                $('#totalCount').append( parseFloat(value)+1);

                // quantity add 1
                quantity = $('#quantity'+id).text();
                $(`#quantity${id}`).text(parseFloat(quantity)+1)

                //total price add 1 element
                totalPrice = parseFloat($('#totalPrice').text())+parseFloat($(`#price${id}`).text());
                console.log(totalPrice);
                $('#totalPrice').empty();
                $('#totalPrice').append(totalPrice.toFixed(2));

                //notification
                if($(!`#alertNoAddToCart`).hasClass('d-none')){
                    $(`#alertTextNoAddToCart`).empty();
                    $(`#alertNoAddToCart`).addClass('d-none');
                }
                if( $(`#alertAddToCart`).hasClass('d-none') )
                    $(`#alertAddToCart`).removeClass('d-none');

                $(`#alertTextAddToCart`).empty();
                $(`#alertTextAddToCart`).text('Success add to cart');

            },
            error: function (data) {
                console.log('Error:', data);
                //notification
                if($(!`#alertAddToCart`).hasClass('d-none')){
                    $(`#alerTextAddToCart`).empty();
                    $(`#alertAddToCart`).addClass('d-none');
                }
                if( $(`#alertNoAddToCart`).hasClass('d-none') )
                    $(`#alertNoAddToCart`).removeClass('d-none');
                $(`#alertTextNoAddToCart`).empty();
                $(`#alertTextNoAddToCart`).text('Oops, something went wrong"');
            }
        });
    });
    $('.remove-from-cart').on('click', function(e){
        e.preventDefault();
        let id =$(this).data('id');

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:'/remove-one-from-cart',
            type: 'GET',
            data: {'id': id},
            success: function (data) {
                var total= $('#totalCount').text();
                if(parseFloat(total)!=1){
                    $('#totalCount').empty();
                    $('#totalCount').append( parseFloat(total)-1);
                    let quantity = $(`#quantity${id}`).text();
                    let price = parseFloat($(`#price${id}`).text())
                    //check quantity
                    if(quantity!=1){
                    //subtract quantity
                        $(`#quantity${id}`).text(parseFloat(quantity)-1)
                        console.log(quantity);
                    }
                    else{
                    //clear card
                        $(`#card${id}`).empty();
                    }

                    //total price remove 1 element
                    totalPrice = parseFloat($('#totalPrice').text())-price;
                    $('#totalPrice').empty();
                    $('#totalPrice').append(totalPrice.toFixed(2));
                }
                else {
                    // all clear
                    $('#totalCount').empty();
                    $('#summary').empty();
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    $('.delete-from-cart').on('click', function(e){
        e.preventDefault();
        let cart_id =$(this).data('id');
        let id =$(this).data('id_product')

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:'/remove-from-cart',
            type: 'GET',
            data: {'id': cart_id},
            success: function (data) {
                let total= parseFloat($('#totalCount').text());
                if(total!=1){
                    let quantity = parseFloat($(`#quantity${id}`).text());
                    let price = parseFloat($(`#price${id}`).text());
                    let totalPrice = parseFloat($('#totalPrice').text())-price*quantity;

                    // total count remove all
                    $('#totalCount').empty();
                    $('#totalCount').append( total-quantity);
                    console.log(quantity);

                    //clear card
                    $(`#card${id}`).empty();

                    //total price remove elements
                    $('#totalPrice').empty();
                    $('#totalPrice').append(totalPrice.toFixed(2));
                }
                else {
                    // all clear
                    $('#totalCount').empty();
                    $('#summary').empty();
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    $('.favorite_change').on('click', function(e){
        e.preventDefault();
        let id =$(this).data('id');
        let url = $(this).hasClass( "add-to-favorite" ) ? '/add-to-favorite' : '/remove-from-favorite';
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            type: 'GET',
            data: {'id': id},
            success: function (data) {
                if($(`#favorite_change${id}`).hasClass( "add-to-favorite" )){
                    $(`#heart${id}`).attr('fill', 'red');
                    $(`#favorite_change${id}`).removeClass('add-to-favorite');
                }
                else{
                    $(`#heart${id}`).attr('fill', 'grey');
                    $(`#favorite_change${id}`).addClass('add-to-favorite');
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
})
