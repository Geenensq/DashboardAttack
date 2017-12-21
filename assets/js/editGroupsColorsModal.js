

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