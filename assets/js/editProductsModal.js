function editProductsModal($id) {

    url = "getInfosProductsModal.html";
    // on declare un formulaire
    var form = {id:$id};
    //on post
    var product = send_post(form, url);
    $('#new_id_product').val(product.id_product);
    $('#new_name_product').val(product.product_name);
    $('#new_ref_products').val(product.reference);
    $('#new_desc_product').val(product.description);
    $('#new_price_product').val(product.base_price);
    $("#new_group_product").val(product.id_groups_products);
    $("#new_color_product").val(product.id_color);
    $("#new_size_product").val(product.id_size);

}

