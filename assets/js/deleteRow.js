function deleteRow($row, $id, $qte) {
    let quantity = parseFloat($qte);
    let current_order_price;
    let new_price;
    /*Url which retrieves the product information to delete in the table */
    const url = "getInfosProductsArray.html";
    /********************************************************************/

    /*Delete row of the table*/
    $("#ligne" + $row).remove();
    /*End of delete*/


    /*** declaration of a form***/ //
    let form = {
        id: $id
    };

    /***Post ajax request and get the result in product***/
    let product = send_post(form, url);

    current_order_price = parseFloat($("body").find('#current_order_price').val());

    new_price = parseFloat(current_order_price) - (parseFloat(product.sizes_price) + parseFloat(product.base_price) * parseFloat(quantity));
    $("#current_order_price").val(new_price);


}