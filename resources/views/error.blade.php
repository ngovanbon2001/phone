<h1>Lỗi rồi</h1>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-cart').on('click', function() {
            var user_id = '{{auth()->user()->id ?? ""}}';
            var cart = JSON.parse(localStorage.getItem('cart')) ?? [];
            var productId = $(this).data("id");
            var productName = $(this).data("name");
            var productPrice = $(this).data("price");
            var productImage = $(this).data("image");
            var amount = parseInt($('#amount').val() ?? 1);
            var filter = cart.filter(x => x['id'] == productId);
            if (filter.length == 0) {
                cart.push({
                    'id': productId,
                    'user_id': user_id,
                    'name': productName,
                    'price': productPrice,
                    'amount': amount,
                    'image': productImage
                });
            } else {
                filter.map(x => {
                    x['amount'] = parseInt(x['amount']) + parseInt(amount);
                });
            }
            localStorage.setItem('cart', JSON.stringify(cart));

            console.log(JSON.parse(localStorage.getItem('cart')));
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var user_id = '{{auth()->user()->id ?? ""}}';
        var cart = JSON.parse(localStorage.getItem('cart')) ?? [];
        if (cart.length > 0) {
            cart.map(x => {
                x['user_id'] =  parseInt(user_id);
                console.log(x['user_id']);
            });
            localStorage.removeItem("cart");
            localStorage.setItem('cart_login', JSON.stringify(cart));
        } 
        console.log(JSON.parse(localStorage.getItem('cart_login')));
    });
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/test',
            method: 'GET',
            success: function(data) {
                console.log('success');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                console.log('Lỗi:', error);
            }
        });
    });
</script>