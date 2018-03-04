function AddQuantity($id_product, $row, $price_product) {
    Quantity = $row.cells[1];
    actualQuantity = parseFloat(Quantity.innerHTML);
    Quantity.innerHTML = actualQuantity + 1;

    updateQuantityProduct($("#current_id_order").val(), $id_product, parseFloat(Quantity.innerHTML));

    current_order_price = parseFloat($("#current_order_price").val());
    $("#current_order_price").val(parseFloat(current_order_price + $price_product));
    /*AJAX CALL FOR UPDATE THE PRICE*/
    priceUpdate($("#current_id_order").val(), $("#current_order_price").val());
}




function RemoveQuantity($id_product, $row, $price_product) {
    Quantity = $row.cells[1];
    actualQuantity = parseFloat(Quantity.innerHTML);
    if (actualQuantity <= 1) {
        notify("pe-7s-refresh-2", "<b>Erreur : </b> Vous devez obligatoirement au moins 1 exemplaire", "danger");

    } else {
        Quantity.innerHTML = actualQuantity - 1;

        updateQuantityProduct($("#current_id_order").val(), $id_product, parseFloat(Quantity.innerHTML));

        current_order_price = parseFloat($("#current_order_price").val());
        $("#current_order_price").val(parseFloat(current_order_price - $price_product));

        /*AJAX CALL FOR UPDATE THE PRICE*/
        priceUpdate($("#current_id_order").val(), $("#current_order_price").val());
    }
}




function updateQuantityProduct($id_order, $id_product, $new_quantity) {
    url = "EditQuantityProducts.html"
    $.post(url, {
        id_order: $id_order,
        id_product: $id_product,
        new_quantity: $new_quantity
    },

    function(data) {

        if (data.confirm == "success") {


        } else if (data.confirm == "error") {

        }
    }, "json");
}