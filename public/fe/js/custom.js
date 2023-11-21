setTimeout(function() {
    $(".alert").alert("close");
}, 3000);

function showToasrt(message, status) {    
    if (status) {
        setTimeout(function() {
            toastr.success(message, 'Success');
        }, 2000);
    } else {
        setTimeout(function() {
            toastr.error(message, 'Error');
        }, 2000);
    }
}

function hiddenTable(tabs)
{
    const countOrder = $(tabs + ' tr').length;
    
    if (countOrder <= 1) {
        $(tabs + ' div.table-responsive').empty();
        $(tabs + ' div.table-responsive').append("<div><p>" + order_empty + "</p></div>");
    }
}