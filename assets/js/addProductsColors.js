function addProductsColors($id_order) {
    /*DEFINES VARIABLES */
    let id_product = $('#select_product_order').val();
    let id_color = $('#select_color_product').val();
    /*    let id_order = $id_order;*/
    /*END DEFINES VARIABLES*/

    url = "addProductsColors.html"
    $.post(url, {
        id_product: id_product,
        id_color: id_color,
        id_order: $id_order

    }, function(data) {

        if (data.confirm == "success") {


        } else if (data.confirm == "error") {

        }
    }, "json");
    return false;

};