function addProductsSizes($id_order) {
    /*DEFINES VARIABLES */
    let id_product = $('#select_product_order').val();
    let id_size = $('#select_size_product').val();
    /*    let id_order = $id_order;*/
    /*END DEFINES VARIABLES*/

    url = "addProductsSizes.html"
    $.post(url, {
        id_product: id_product,
        id_size: id_size,
        /*        id_order: id_order*/

    }, function(data) {

        if (data.confirm == "success") {


        } else if (data.confirm == "error") {

        }
    }, "json");
    return false;

};