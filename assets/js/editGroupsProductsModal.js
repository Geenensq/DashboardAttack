

function editGroupsProductsModal($id) {
    url = "getInfosGroupsProductsModal.html";
    // on declare un formulaire
    var form = {
        id:$id
    };

    //on post
    var products = send_post(form, url);

    $('#new_id_group_products').val(products.id_group_product);
    $('#new_name_group_products').val(products.name_group_product);
    $('#new_desc_group_products').val(products.description);

    
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


