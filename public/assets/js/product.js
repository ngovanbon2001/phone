$(document).ready(function() {
    var image = 0;
    var color = 0;
    $('#btn-image').on('click', function() {
        if (image == 0) {
            image = 1;
            $('section.image').css('display', 'block');
        } else {
            image = 0;
            $('section.image').css('display', 'none');
        }
    });
    $('#btn-color').on('click', function() {
        if (color == 0) {
            color = 1;
            $('section.color').css('display', 'block');
        } else {
            color = 0;
            $('section.color').css('display', 'none');
        }
    });
    $('.edit-button').on('click', function(e) {
        e.preventDefault();

        var colorId = $(this).data('color-id');
        var amount = $(this).data('amount');
        var colorName = $(this).data('color');

        $('#editModal').modal('show');
        $('#amount_color').val(amount);
        $('#color').val(colorId);
        $('span#color-name').text(colorName);
    });
    $('#update-color').on('click', function() {
        var amount = $('#amount_color').val();
        var colorId = $('#color').val();
        $.ajax({
            url: url.replace(':colorId', colorId),
            method: 'POST',
            data: {
                amount_color: amount,
                _token: token
            },
            success: function(res) {
                location.reload();
            },
            error: function(xhr, text, err) {
                $('label#amount-error').css('display', 'block');
                $('label#amount-error').text(xhr.responseJSON.errors.amount_color[0] ?? '');
            }
        });
    });
});
