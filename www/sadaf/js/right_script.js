$(document).ready(function() {
    var vis = false;
    $("#dropdownbtn").click(function() {
        if (vis == true) {
            $("#online").css({
                "visibility": "hidden"
            })
            vis = false;
        } else {
            $("#online").css({
                "visibility": "visible"
            })
            vis = true;
        }

    });
    $("#group-chats").click(function() {
        $("#group-chats").css({
            "border-color": "red"
        })
        $("#person-chats").css({
            "border-color": "black"
        })
        $(".group-chat").show(200);
        $(".person-chat").hide(200);
        $("#group-pic").attr("src", "./images/icons8-user-group-red.png");
        $("#person-pic").attr("src", "./images/icons8-person-30.png");
    });
    $("#person-chats").click(function() {
        $(".person-chat").show(200);
        $(".group-chat").hide(200);
        $("#group-pic").attr("src", "./images/icons8-user-group-30.png");
        $("#person-pic").attr("src", "./images/icons8-person-30-red.png");
        $("#group-chats").css({
            "border-color": "black"
        })
        $("#person-chats").css({
            "border-color": "red"
        })
    });

});