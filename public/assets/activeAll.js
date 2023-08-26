$(document).ready(function () {
    $(".toggle-position").on("change", function () {
        var status = $(this).prop("checked") == true ? 1 : 0;
        var id = $(this).data("id");
        var url = $(this).data("url");
        var name = $(this).data("name");

        $.ajax({
            url: url,
            method: "GET",
            data: {
                status: status,
                id: id,
            },
            success: function () {
                var alertHTML =
                    '<div class="alert alert-primary alert-dismissible fade show" role="alert">' + name +
                    ' has been updated!</div>';

                $("#message").append(alertHTML);

                setTimeout(function () {
                    $(".alert").alert("close");
                }, 3000);
            },
        });
    });

    $("#imageInput").change(function () {
        readURL(this);
    });
});

setTimeout(function () {
    $(".alert").alert("close");
}, 3000);

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#imagePreview").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
