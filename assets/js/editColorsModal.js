function editColorsModal($id) {

    url = "getInfosColorsModal.html";
    // on declare un formulaire
    var form = {
        id:$id
    };

    //on post
    var color = send_post(form, url);

    $('#id_color').val(color.id_color);
    $('#new_name_color').val(color.color_name);
    $('#new_code_color').attr("value",color.color_code);
    $('#new_group_color').val(color.name_group_color);
}


function send_post(v, url) {
    var resultat = null;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        data: v,
        dataType: "json",
        cache: false,
        success: function(data) {
            resultat = data;
            return resultat;
        },
        error: function(error) {
            resultat = error;
            return resultat;
        }
    });
    return resultat;



}