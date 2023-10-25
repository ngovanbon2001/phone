$(document).ready(function() {
    toastr.options = {
        "positionClass": "toast-bottom-right",
    };

    const carts = $('input.cart');
    var total = 0;

    carts.each(function() {
        total = total + (parseInt($(this).val()) * parseFloat($(this).data('price')));
    });

    $('#total').text(numeral(total).format('0,0.00'));
    $('#sub_total').text(numeral(total).format('0,0.00'));

    $('#check-out').on('click', function() {
        var status = $(this).data('status');

        if (status == 0) {
            $('#form-order').css('display', 'block');
            $(this).data('status', 1);
        } else {
            $('#form-order').css('display', 'none');
            $(this).data('status', 0);
        }
    });

    $('#update-cart').on('click', function() {
        update(this);
    });

    $('.choose').on('change', function() {
        var action = $(this).attr('id');
        var id = $(this).val();
        var _token = token;
        var result = "";
        if (action == 'provinces') {
            result = 'districts';
        } else {
            result = 'wards';
        }
        $.ajax({
            url: urlAddress,
            method: 'POST',
            data: {
                action: action,
                id: id,
                _token: _token
            },
            success: function(data) {
                $('#' + result).html(data);
            },
        });
    });

    $('.delete-cart').on('click', function (){
        if (confirm(delete_confirm)) {
            const _this = $(this);
            const productId = $(this).data('id');
            const url = deleteUrl.replace(':productId', productId);
            var totalNew = 0;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {
                    $.each(response.data, function(key, item) {
                        $("#cart-" + item.product_id).data("qty", parseInt(item.quantity));
                        $("#quantity-" + item.product_id).prop('value', parseInt(item.quantity));
                        totalNew = totalNew + (parseInt(item.quantity) * parseFloat(item.price));
                    });
                    _this.parent().parent().remove();
                    setTimeout(function() {
                        toastr.success(cart_delete_success, 'Success');
                    }, 2000);
                    $('#total').text(numeral(totalNew).format('0,0.00'));
                    $('#sub_total').text(numeral(totalNew).format('0,0.00'));
                    $('#total-items').text(Object.keys(response.data).length);
                    (Object.keys(response.data).length < 1) ? $('#check-out').hide() : $('#check-out').show();
                },
                error: function(xhr, text, err) {
                    var responseData = JSON.parse(xhr.responseText);
                    var errorMessage = responseData.message;
                    setTimeout(function() {
                        toastr.error(errorMessage, 'Error');
                    }, 2000);
                }
            });
        }
    });

    setTimeout(function () {
        $(".alert").alert("close");
    }, 3000);

    $("#check-out-form").validate({
        rules: {
            customer_name: {
                required: true
            },
            customer_email: {
                required: true,
                email: true,
            },
            customer_phone: {
                required: true,
                number: true,
            },
            provinces: {
                required: true
            },
            districts: {
                required: true
            },
            wards: {
                required: true
            },
        },
    });

    $("input.cart").on('change', function(){
        productId = $(this).data('id');
        cost = parseFloat($(this).data('price')) * parseInt($(this).val());
        $('#total-'+productId).text('$'+cost.toFixed(2));

        update(this);
    });

    $("button.update-cart").on('click', function(){
        productId = $(this).data('id');
        cart = $('#cart-' + productId);
        quantity(cart, productId);

        update(cart);
    });

    function update(_this) {
        var cartData = [];
        var cart_id = $(_this).data('cart');
        var totalNew = 0;

        carts.each(function() {
            cartData.push({
                product_id: $(this).data('id'),
                quantity: $(this).val(),
                name: $(this).data('name'),
                price: $(this).data('price'),
                options: {
                    image: $(this).data('image')
                },
                color: $(this).data('color'),
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: updateUrl,
            method: 'POST',
            data: {
                cart_id: cart_id,
                data: cartData,
            },
            success: function(response) {
                $.each(response.data.data, function(key, item) {
                    $("#cart-" + item.product_id).data("qty", parseInt(item.quantity));
                    $("#quantity-" + item.product_id).prop('value', parseInt(item.quantity));
                    totalNew = totalNew + (parseInt(item.quantity) * parseFloat(item.price));
                });
                $('#total').text(numeral(totalNew).format('0,0.00'));
                $('#sub_total').text(numeral(totalNew).format('0,0.00'));
            },
            error: function(xhr, text, err) {
                var responseData = JSON.parse(xhr.responseText);
                var errorMessage = responseData.message;
                setTimeout(function() {
                    toastr.error(errorMessage, 'Error');
                }, 2000);

                var inputElement = $("#cart-" + responseData.id);
                var previousQuantity = inputElement.data('qty');
                inputElement.val(previousQuantity);
            }
        });
    }

    (carts.length < 1) ? $('#check-out').hide() : $('#check-out').show();

    function quantity(input, productId) {
        var value = parseFloat(input.val());
        if (value < 1) {
            input.val(1);
        } else {
            cost = parseFloat(cart.data('price')) * parseInt(cart.val());
            $('#total-'+productId).text(numeral(cost).format('0,0.00')+currency);
        }
    }
});