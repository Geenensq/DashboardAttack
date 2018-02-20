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
    $('#new_code_color').minicolors('value', color.color_code);
    $("#new_group_color").val(color.id_group_color);
}


