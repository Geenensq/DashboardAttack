function addProductsOrder($id_order) {
    /*DEFINES VARIABLES */
    let id_product_order = $('#select_product_order').val();
    let quantity_product_order = $('#qte_product_order').val();
    let id_order = $id_order;
    let id_size = $('#select_size_product').val();
    let id_color = $('#select_color_product').val();
    /*END DEFINES VARIABLES*/

    url = "addProductsOrders.html"
    $.post(url, {
        id_product_order: id_product_order,
        quantity_product_order: quantity_product_order,
        id_order: id_order,
        id_size: id_size,
        id_color: id_color

    }, function(data) {

        if (data.confirm == "success") {
           

        } else if (data.confirm == "error") {

        }
    }, "json");
    return false;

};