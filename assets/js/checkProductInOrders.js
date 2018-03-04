function checkProductInOrders($id_product) {
    url = "checkProductInOrders.html";
    form = {
        id_order: $("#current_id_order").val(),
        id_product_check: $id_product
    };
    product_checked = send_post(form, url);
    return product_checked;
}
