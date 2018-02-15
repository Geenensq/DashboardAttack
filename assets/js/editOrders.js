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

    
}
