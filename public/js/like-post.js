$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("body").on("click", ".post-like", function (e) {
        let url = $(this).data("url");
        let postId = $(this).data("id");
        $.ajax({
            method: "POST",
            url,
            data: {
                postId,
            },
            success: function (data) {
                let likebtn = "#like_btn" + postId;
                $(likebtn).load(" " + likebtn + " > *");
            },
            error: function (error) {
                alert("e");
            },
        });
    });

    $("body").on("click", ".show-like", function (e) {
        let url = $(this).data("url");
        let postId = $(this).data("id");
        $.ajax({
            method: "GET",
            url,
            data: {
                postId,
            },
            success: function (data) {
                $(".show-likes").html(data);
                $("#likes-modal").modal("show");
            },
            error: function (error) {
                alert("error");
            },
        });
    });
});
