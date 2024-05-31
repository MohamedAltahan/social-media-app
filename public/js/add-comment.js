$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("body").on("click", "#add-comment-btn", function (e) {
        let url = $(this).data("url");
        let commentBody = $("#comment_body").val();
        let postId = $("#post_id").val();
        console.log(url + "/" + postId);
        $.ajax({
            method: "post",
            url,
            data: {
                postId,
                commentBody,
            },
            success: function (data) {
                $("#comment-list").load(url + "/" + postId);
                $("#comment_body").val("");
            },
            error: function (error) {
                alert("error");
            },
        });
    });
});
