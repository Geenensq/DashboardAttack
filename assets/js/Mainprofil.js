$(document).ready(function() {
   
    $("#flipPassword").click(function() {

        $("#panel").slideDown("slow");
        $(this).attr("disabled", true);
        $("#updateEmail").attr("disabled", true);

        });

    $("#cancelChangePassword").click(function() {

        $("#panel").fadeOut();
        $('#flipPassword').removeAttr("disabled");
        $("#updateEmail").removeAttr("disabled");
    });

});