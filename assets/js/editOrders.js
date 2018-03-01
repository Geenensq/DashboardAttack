let array = document.getElementById('tab_products_order');

function editOrders($id) {
    $( "#customer_order" ).click(function() {
        $customer = $("#customer_order");
    });
    if ($('h4:contains("Edition de la commande existante")').length > 0) {
     notify("pe-7s-refresh-2", "<b>Informations : </b>Une commande est déja en cours d'édition !", "danger");
 } else{
    /*Disable the datatable buttons that allow the editing of the command*/
    $("a.editOrder").attr("disabled", true);

    url = "getInfosOrdersForEdit.html";
    var form = {id:$id};
    var order = send_post(form, url);
    /*change id of submit form*/
    $("#form_add_order").attr("id", "form_edit_order");
    /***************************/    
    $("#title_order").text("Edition de la commande existante n°" + order.id_order);
    $("#valid_order").text("Valider la modification de la commande n°" + order.id_order);
    $("#valid_order").removeAttr("disabled");

    $("#title_order").css("font-weight", "bold");
    $("#title_order").css("color", "#337ab7");

    $('#current_id_order').val(order.id_order);

    var data = {id: order.id_customer , text: order.firstname + " " + order.lastname};
    var newOption = new Option(data.text, data.id, true, false);
    $('#customer_order').append(newOption).trigger('change');

    $('#date_order').val(order.date_order);
    $('#current_order_price').val(order.price_order);
    $('#comment_order').val(order.comment_order);
    $("#payments_order").val(order.id_method_payment);
    $("#shipping_order").val(order.id_method_shipping);
    $("#state_order").val(order.id_state);

    url = "getInfosProductsOrdersForEdit.html";
    var form = {id:$id};
    var order_product = send_post(form, url);
    $("#collapse_products").show("slow");


    for (var i = 0; i < order_product.length; i++){
        let row = array.insertRow(1);
        row.id = "ligne" + i;
        let cell1 = row.insertCell(0);
        let cell2 = row.insertCell(1);
        let cell3 = row.insertCell(2);
        let cell4 = row.insertCell(3);
        let cell5 = row.insertCell(4);
        let cell6 = row.insertCell(5);
        let cell7 = row.insertCell(6);
        let cell8 = row.insertCell(7);
        let cell9 = row.insertCell(8);
        let cell10 = row.insertCell(9);
        let cell11 = row.insertCell(10);

        cell1.innerHTML = order_product[i]["id_product"];
        cell2.innerHTML = order_product[i]["quantity_product"];
        cell3.innerHTML = order_product[i]["product_name"];
        cell4.innerHTML = order_product[i]["reference"];
        cell5.innerHTML = order_product[i]["description"];
        cell6.innerHTML = order_product[i]["base_price"];
        cell7.innerHTML = "<img src=\"" + "/local/assets/img/uploaded/" + order_product[i]["img_url"] + "\" width=\"80px\" height=\"80px\">";
        cell8.innerHTML = order_product[i]["color_name"];
        cell9.innerHTML = order_product[i]["size_name"];
        cell10.innerHTML = '<a onClick="deleteRow(' + i + ',' + order_product[i]["id_product"] + ',' + order_product[i]["quantity_product"] + ')" style="font-size:1.5em;" class="glyphicon glyphicon-remove" aria-hidden="true"></a>';
        cell11.innerHTML = '<i  role="button" onClick="AddQuantity(' + order_product[i]["id_product"] + ',' + row.id + ',' + order_product[i]["base_price"] + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf196;</i> <i  role="button" onClick="RemoveQuantity(' + order_product[i]["id_product"] + ',' + row.id + ',' + order_product[i]["base_price"] + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf147;</i>';   

    }        
}





}
