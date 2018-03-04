function addProductsOrder($id_order) {
    /*DEFINES VARIABLES */
    let id_product_order = $('#select_product_order').val();
    let quantity_product_order = $('#qte_product_order').val();
    let id_order = $id_order;
    /*END DEFINES VARIABLES*/

    url = "addProductsOrders.html"
    $.post(url, {
        id_product_order: id_product_order,
        quantity_product_order: quantity_product_order,
        id_order: id_order

    }, function(data) {

        if (data.confirm == "success") {
           

        } else if (data.confirm == "error") {

        }
    }, "json");
    return false;

};