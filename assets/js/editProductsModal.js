/*Function for track duplicate entry in my select and delete dupliacte*/
function deleteMultipleEntrySelect() {
    var a = new Array();
    $("#new_group_product").children("option").each(function(x) {
        test = false;
        b = a[x] = $(this).val();
        for (i = 0; i < a.length - 1; i++) {
            if (b == a[i]) test = true;
        }
        if (test) $(this).remove();
    })
}
/*End*/


function editProductsModal($id) {

    url = "getInfosProductsModal.html";
    // on declare un formulaire
    var form = {
        id:$id
    };

    //on post
    var product = send_post(form, url);

    $('#new_id_product').val(product.id_product);
    $('#new_name_product').val(product.product_name);
    $('#new_ref_products').val(product.reference);
    $('#new_desc_product').val(product.description);
    $('#new_price_product').val(product.base_price);
    $("#new_group_product").prepend($("<option selected=\"selected\"></option>").val(product.id_groups_products).html(product.name_groups_products));

    deleteMultipleEntrySelect();
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