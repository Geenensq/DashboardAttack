

function editGroupsColorsModal($id) {
    url = "getInfosGroupsColorsModal.html";
    // on declare un formulaire
    var form = {
        id:$id
    };

    //on post
    var customer = send_post(form, url);

    $('#new_id_group_color').val(customer.id_group_color);
    $('#new_name_group_colors').val(customer.name_group_color);
    
}



