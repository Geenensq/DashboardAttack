function addProductsColors($id_product , $id_color) {


    url = "addProductsColors.html"
    $.post(url, {
        id_product: $id_product,
        id_color: $id_color

    }, function(data) {

        if (data.confirm == "success") {


        } else if (data.confirm == "error") {

        }
    }, "json");
    return false;

};