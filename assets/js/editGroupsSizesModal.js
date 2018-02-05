

function editGroupsSizesModal($id) {
    url = "getInfosGroupsSizesModal.html";
    // on declare un formulaire
    var form = {
        id:$id
    };

    //on post
    var customer = send_post(form, url);

    $('#new_id_group_sizes').val(customer.id_group_size);
    $('#new_name_group_sizes').val(customer.name_group_size);
    
}



