/*Function for track duplicate entry in my select and delete dupliacte*/
function deleteMultipleEntrySelect() {
    var a = new Array();
    $("#new_group_color").children("option").each(function(x) {
        test = false;
        b = a[x] = $(this).val();
        for (i = 0; i < a.length - 1; i++) {
            if (b == a[i]) test = true;
        }
        if (test) $(this).remove();
    })
}
/*End*/


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
    $("#new_group_color").prepend($("<option selected=\"selected\"></option>").val(color.id_group_color).html(color.name_groups_products));
    deleteMultipleEntrySelect();
}


