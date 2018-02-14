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



function editOrdersModal($id) {
    url = "getInfosOrdersModal.html";
    // on declare un formulaire&
    var form = {id:$id};

    //on post
    var order = send_post(form, url);


    $('#id_order').val(order.id_order);
    $("#new_customer_order").prepend($("<option selected=\"selected\"></option>").val(order.id_customer).html(order.lastname + ' ' + order.firstname));
    deleteMultipleEntrySelect("#new_customer_order");
    $('#new_date_order').val(order.date_order);
    $('#new_price_order').val(order.price_order);
    $('#new_comment_order').val(order.comment_order);
    $("#new_method_payment").prepend($("<option selected=\"selected\"></option>").val(order.id_method_payment).html(order.method_payment));
    deleteMultipleEntrySelect("#new_method_payment");
    $("#new_method_shipping").prepend($("<option selected=\"selected\"></option>").val(order.id_method_payment).html(order.method_shipping));
    deleteMultipleEntrySelect("#new_method_shipping");
    $("#new_state_order").prepend($("<option selected=\"selected\"></option>").val(order.id_method_payment).html(order.method_shipping));
    deleteMultipleEntrySelect("#new_state_order");
    


    
}
