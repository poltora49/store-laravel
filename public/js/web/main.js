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
                $('#totalCount').append( parseInt(value)+1);
                // quantity add 1
                quantity = $('#quantity'+id).text();
                $(`#quantity${id}`).text(parseInt(quantity)+1)
                //total price add 1 element
                totalPrice = parseInt($('#totalPrice').text())+parseInt($(`#price${id}`).text());
                console.log(totalPrice);
                $('#totalPrice').empty();
                $('#totalPrice').append(totalPrice);

            },
            error: function (data) {
                console.log('Error:', data);
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
                if(parseInt(total)!=1){
                    $('#totalCount').empty();
                    $('#totalCount').append( parseInt(total)-1);
                    let quantity = $(`#quantity${id}`).text();
                    let price = parseInt($(`#price${id}`).text())
                    //check quantity
                    if(quantity!=1){
                    //subtract quantity
                        $(`#quantity${id}`).text(parseInt(quantity)-1)
                        console.log(quantity);
                    }
                    else{
                    //clear card
                        $(`#card${id}`).empty();
                    }

                    //total price remove 1 element
                    totalPrice = parseInt($('#totalPrice').text())-price;
                    $('#totalPrice').empty();
                    $('#totalPrice').append(totalPrice);
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
                let total= parseInt($('#totalCount').text());
                if(total!=1){
                    let quantity = parseInt($(`#quantity${id}`).text());
                    let price = parseInt($(`#price${id}`).text());
                    let totalPrice = parseInt($('#totalPrice').text())-price*quantity;
                    //subtract quantity
                    $('#totalCount').empty();
                    $('#totalCount').append( total-quantity);
                    console.log(quantity);
                    //clear card
                    $(`#card${id}`).empty();

                    //total price remove 1 element
                    $('#totalPrice').empty();
                    $('#totalPrice').append(totalPrice);
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
