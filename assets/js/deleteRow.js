function deleteRow($row, $id, $qte) {
    let quantity = parseFloat($qte);
    let current_order_price;
    let new_price;
    let product;
    let current_id_order = $("#current_id_order").val();
   
    /*DELETE THE ROW IN VIEW*/
    $("#ligne" + $row).remove();
    /**************************/
    
    /*DELETE THE PRODUCT IN DB*/
    deleteProductBase($id , current_id_order );
    /**************************/


    /*GET INFORMATIONS FOR UPDATE THE VIEW PRICE*/
    product = getProductFordelete($id);
    /*********************************************/

    /******************************************************PRINT UPDATE IN HTML5 VIEW*************************************************************/
    current_order_price = parseFloat($("body").find('#current_order_price').val());
    new_price = parseFloat(current_order_price) - (parseFloat(product.sizes_price) + parseFloat(product.base_price) * parseFloat(quantity));
    $("#current_order_price").val(new_price);
    /*********************************************************************************************************************************************/

    /************************UPDATE THE PRICE OF ORDER IN DB**************************/
    priceUpdate(current_id_order , new_price);
    /**********************************************************************************/
}

function deleteProductBase($id_product , $id_order){
    let url = "removeProductsOrders.html";
    let form = {id_product : $id_product , id_order:$id_order};
    let result_delete = send_post(form , url);
    
   if(result_delete.confirm == "success"){
        notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été supprimé de la commande avec succès !", "info");
    }
}



function getProductFordelete($id){
    let url = "getInfosProductsArray.html";
    let form = {id: $id};
    product = send_post(form, url);
    return product;
}