function addProductsSizes($id_product , $id_size) {

    url = "addProductsSizes.html"
    $.post(url, {
        id_product: $id_product,
        id_size: $id_size

    }, function(data) {

        if (data.confirm == "success") {


        } else if (data.confirm == "error") {

        }
    }, "json");
    return false;

};