function addProductsSizes($id_product , $id_size) {
    let url = "addProductsSizes.html"
    let form = {id_product: $id_product,id_size: $id_size};
    let products_sizes = send_post(form, url);

};