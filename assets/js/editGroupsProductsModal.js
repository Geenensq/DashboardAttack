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




