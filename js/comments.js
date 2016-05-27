

$(document).ready(function () {

    $(".reply_button").on("click", function (e) {
        e.preventDefault();

        $this = $(this);
        e.preventDefault();
        var id = $this.attr("id");
        $(".li_comment_"+id).append($(".form_wrapper"));
        console.log(id);
        $(".reply_id").attr("value", id);

    });
    $(".edit_button").on("click", function (e) {
        e.preventDefault();
        $this = $(this);
        var id = $this.attr("id");
        $(".li_comment_"+id).append($(".form_wrapper"));
        $(".form-horizontal").attr('action',"edit.php");
        $(".reply_id").attr("value", id);
        $(".form-heading").text("Edit a comment");

    });
    $(".back_button").on("click", function (e) {
        e.preventDefault();

        $(".container").prepend($(".form_wrapper"));
        $(".form-horizontal").attr('action',"create.php");
        $(".reply_id").attr("value", "");

        $(".form-heading").text("Edit a comment");
    });

});

//$(function () {
//
//    $("#comment_form").bind("submit", function (e) {
//        console.log('sdsd');
//        e.preventDefault();
//
//        $.ajax({
//            type: "POST",
//            url: "add_comment.php",
//            dataType: "html",
//            success: function (comment) {
//                $("#comment_name").attr("value", "");
//                $("#comment_email").attr("value", "");
//                $("#comment_text").attr("value", "");
//
//            }
//        })
//    });
//});