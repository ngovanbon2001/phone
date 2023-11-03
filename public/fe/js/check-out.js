$(document).ready(function() {
    const carts = $('input.cart');
    var total = 0;

    carts.each(function() {
        total = total + (parseInt($(this).val()) * parseFloat($(this).data('price')));
    });

    $('#total').text(numeral(total).format('0,0.00'));
    $('#sub_total').text(numeral(total).format('0,0.00'));

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
        messages: {
            customer_name: {
                required: messages.customer_name,
            },
            customer_email: {
                required: messages.customer_email_required,
                email: messages.customer_email,
            },
            customer_phone: {
                required: messages.customer_phone,
            },
            provinces: {
                required: messages.provinces,
            },            
            districts: {
                required: messages.districts,
            },            
            wards: {
                required: messages.wards,
            },
        },
    });
});