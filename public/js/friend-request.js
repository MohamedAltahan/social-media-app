$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("body").on("click", ".add-friend-btn", function (e) {
        e.preventDefault();
        let url = $(this).data("url");
        let userId = $(this).data("id");
        $.ajax({
            method: "POST",
            url,
            data: { userId },
            success: function (data) {
                if (data == 1) {
                    $(".add-friend-btn").text("Request sent");
                } else {
                    $(".add-friend-btn").text("Add Friend");
                }
            },
            error: function (error) {
                alert("error");
            },
        });
    });
});
