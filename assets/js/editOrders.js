let array = document.getElementById('tab_products_order');


function deleteMultipleEntrySelect($id_select) {
    var a = new Array();
    $($id_select).children("option").each(function(x) {
        test = false;
        b = a[x] = $(this).val();
        for (i = 0; i < a.length - 1; i++) {
            if (b == a[i]) test = true;
        }
        if (test) $(this).remove();
    })
}



function editOrders($id) {

    url = "getInfosOrdersForEdit.html";
    var form = {id:$id};
    var order = send_post(form, url);

    $("#title_order").text("Edition de la commande existante n°" + order.id_order);
    $("#title_order").css("font-weight", "bold");
    $("#title_order").css("color", "#1DC7EA");

    $('#current_id_order').val(order.id_order);
    $("#customer_order").prepend($("<option selected=\"selected\"></option>").val(order.id_customer).html(order.lastname + ' ' + order.firstname));
    deleteMultipleEntrySelect("#customer_order");
    $('#date_order').val(order.date_order);
    $('#current_order_price').val(order.price_order);
    $('#comment_order').val(order.comment_order);
    $("#payments_order").prepend($("<option selected=\"selected\"></option>").val(order.id_method_payment).html(order.method_payment));
    deleteMultipleEntrySelect("#payments_order");
    $("#shipping_order").prepend($("<option selected=\"selected\"></option>").val(order.id_method_payment).html(order.method_shipping));
    deleteMultipleEntrySelect("#shipping_order");
    $("#state_order").prepend($("<option selected=\"selected\"></option>").val(order.id_method_payment).html(order.method_shipping));
    deleteMultipleEntrySelect("#state_order");


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
        cell11.innerHTML = '<i style="font-size:20px; color:#1DC7EA;" class="fa">&#xf147;</i>';   

}


    
}
