jQuery(function(){
    //add product btn
    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);

        $(this).removeClass('btn-success').addClass('btn-default disabled') ;

        var html=
        `<tr>
        <input type='hidden' name='products[]' value='${id}'>
        <td>${name}</td>
        <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
        <td class="product-price">${price}</td>
        <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
         </tr>`;

         $('.order-list').append(html);

         calculate_totalPrice();

    });//end of click function

    $('body').on('click','.disabled',function(e){
        e.preventDefault();
    });


    $('body').on('click','.remove-product-btn',function(e){

        $(this).closest('tr').remove();
        var id = $(this).data('id');
        $('#product-' + id ).removeClass('btn-default disabled').addClass('btn-success');

        calculate_totalPrice();
    });

    $('body').on('keyup change','.product-quantity' ,function(e){
        var quantity=parseInt( $(this).val() );
        var unitprice=parseFloat($(this).data('price').replace(/,/g,''));
        $(this).closest('tr').find('.product-price').html($.number(quantity*unitprice,2));
        calculate_totalPrice();
    })

    function calculate_totalPrice(){
        var price=0;
        $('.order-list .product-price').each(function(index){
            price+=parseFloat($(this).html().replace(/,/g,''));
        })

        $('.total-price').html($.number(price,2));

        if (price > 0) {

            $('#add-order-form-btn').removeClass('disabled')

        } else {

            $('#add-order-form-btn').addClass('disabled')

        }//end of else

    }




});

