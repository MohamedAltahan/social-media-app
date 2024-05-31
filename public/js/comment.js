$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("body").on("click", ".post-comment", function (e) {
        let url = $(this).data("url");
        $.ajax({
            method: "GET",
            url,
            data: {},
            success: function (data) {
                $(".show-comments").html(data);
                $("#comments-modal").modal("show");
            },
            error: function (error) {
                alert("e");
            },
        });
    });
});
