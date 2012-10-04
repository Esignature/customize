$(document).ready(function () {
    function d() {
        return navigator.appName == "Microsoft Internet Explorer"
    }
    function c(b, a) {
        if (d()) {
            if (window.parent.tinyMCE) {
                window.parent.tinyMCE.selectedInstance.selection.moveToBookmark(window.parent.global_ie_bookmark)
            }
        }
        tinyMCE.execInstanceCommand(a, "mceInsertContent", false, b)
    }
    $("#closebtn").click(function () {
        $(this).parent("#swfupload-control").fadeOut("fast")
    });
    $("#insert_image").click(function () {
        $("#external_img_target").val("full_content");
        $("#swfupload-control").fadeIn("fast");
        $.scrollTo(0, 0, {
            easing: "jswing",
            duration: "2000"
        });
        return false
    });
    $("#insert_image2").click(function () {
        $("#external_img_target").val("intro");
        $("#swfupload-control").fadeIn("fast");
        $.scrollTo(0, 0, {
            easing: "jswing",
            duration: "2000"
        });
        return false
    });

    $("#list_image").click(function () {
        $("#external_img_target").val("full_content");
        $("#upload_imglist").fadeIn("fast");
        $.scrollTo(0, 0, {
            easing: "jswing",
            duration: "2000"
        });
        $("#upimgcontainer").html('<div class="populating">&nbsp;</div>');

        $.ajax({
            type: "POST",
            url: base_url() + "index.php/uploader/getImages",
            data: "",
            success: function (a) {
                $("#upimgcontainer").html(a).css({
                    display: "none"
                }).fadeIn("slow")
            }
        });
        return false
    });
    $("#list_image2").click(function () {
        $("#external_img_target").val("intro");
        $("#upload_imglist").fadeIn("fast");
        $.scrollTo(0, 0, {
            easing: "jswing",
            duration: "2000"
        });
        $("#upimgcontainer").html('<div class="populating">&nbsp;</div>');
        $.ajax({
            type: "POST",
            url: base_url() + "index.php/uploader/getImages",
            data: "",
            success: function (a) {
                $("#upimgcontainer").html(a).css({
                    display: "none"
                }).fadeIn("slow")
            }
        });
        return false
    });
    $("#closebtn1").click(function () {
        $("#upload_imglist").fadeOut("fast")
    });
    $("#insertImg").live("click", function () {
        var h = $(".just_uploaded_img").attr("src").split("160x100/");
        if (h.length == 2) {
            var i = h[0] + h[1]
        } else {
            var i = h[0]
        }
        var g = $("#selectAlign").val();
        var b = $("#imgtitle").val();
        var a = "full_content";
        if ($("#external_img_target").length == 1) {
            a = $("#external_img_target").val()
        }
        c('<img align="' + g + '" src="' + i + '" alt="' + b + '" title="' + b + '" />', a);
        $("#closebtn").trigger("click")
    });
    $("#imgtitle").live("keyup", function (a) {
        if (a.keyCode == 13) {
            $("#insertImg").trigger("click")
        }
    });
    $(".delete_uploadimg").live("click", function () {
        if (confirm("Remove this image from your list?")) {
            var a = $(this).attr("imgid");
            $.ajax({
                type: "POST",
                url: base_url() + "index.php/uploader/delete",
                data: "action=delete&id=" + a,
                success: function (b) {
                    if (b == "done") {
                        $("#list_image").trigger("click")
                    } else {
                        alert("Unable to Delete your image")
                    }
                }
            })
        }
    });
    $("#imgpaginate a").live("click", function () {
        var a = $(this).attr("href");
        $("#upimgcontainer").html('<div class="populating">&nbsp;</div>');
        $.ajax({
            type: "POST",
            url: a,
            data: "",
            success: function (b) {
                $("#upimgcontainer").html(b).css({
                    display: "none"
                }).fadeIn("slow")
            }
        });
        return false
    });
    $(".insert_up_imgs").live("click", function () {
        var b = $(this).attr("name");
        var e = $("li#my_image_" + b).attr("src");
        var a = "full_content";
        if ($("#external_img_target").length == 1) {
            a = $("#external_img_target").val()
        }
        c('<img align="left" src="' + e + '" alt="" title="" />', a);
        $("#closebtn1").trigger("click")
    });
    $("#view_my_images").click(function () {
        $("#closebtn").trigger("click");
        $("#list_image").trigger("click");
        return false
    });
    $("#show_img_uploader").live("click", function () {
        $("#closebtn1").trigger("click");
        $("#insert_image").trigger("click");
        return false
    })
});