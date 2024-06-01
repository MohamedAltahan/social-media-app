$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("body").on("click", ".delete-post", function (e) {
        e.preventDefault();
        let url = $(this).data("url");
        $.ajax({
            method: "DELETE",
            url,
            data: {},
            success: function (data) {
                if (data == "deleted") {
                    location.reload();
                }
            },
            error: function (error) {
                alert("error");
            },
        });
    });
});
