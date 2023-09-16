$(document).ready(function() {
    $('#form-order').hide();

    toastr.options = {
        "positionClass": "toast-bottom-right",
    };

    const carts = $('.cart');
    var total = 0;

    carts.each(function() {
        total = total + (parseInt($(this).val()) * parseFloat($(this).data('price')));
    });

    $('#total').text(total.toFixed(2));

    $('#check-out').on('click', function() {
        var status = $(this).data('status');

        if (status == 0) {
            $('#form-order').show();
            $(this).data('status', 1);
        } else {
            $('#form-order').hide();
            $(this).data('status', 0);
            $('#customer_name').val(null);
            $('#customer_email').val(null);
            $('#customer_phone').val(null);
            $('#provinces').val(null);
            $('#districts').val(null);
            $('#wards').val(null);
        }
    });

    $('#update-cart').on('click', function() {
        var cartData = [];
        var cart_id = $(this).data('cart');
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
                console.log(response.data.data);
                $.each(response.data.data, function(key, item) {
                    $("#cart-" + item.product_id).data("qty", parseInt(item.quantity));
                    $("#quantity-" + item.product_id).prop('value', parseInt(item.quantity));
                    console.log($("#quantity-" + item.product_id).val());
                    totalNew = totalNew + (parseInt(item.quantity) * parseFloat(item.price));
                });
                setTimeout(function() {
                    toastr.success('Cart updated successfully!', 'Success');

                }, 2000);
                $('#total').text(totalNew.toFixed(2));
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
        if (confirm('Do you want to delete item?')) {
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
                        toastr.success('Cart deleted successfully!', 'Success');
                    }, 2000);
                    $('#total').text(totalNew.toFixed(2));
                    $('#total-items').text(Object.keys(response.data).length + ' items');
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
});
