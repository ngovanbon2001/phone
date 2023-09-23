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
