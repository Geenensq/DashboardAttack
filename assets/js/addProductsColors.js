function addProductsColors($id_product , $id_color) {
    let url = "addProductsColors.html"
    let form = {id_product: $id_product,id_color: $id_color};
    let products_colors = send_post(form, url);
};