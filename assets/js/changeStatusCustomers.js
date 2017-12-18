function ajaxChangeStatusCustomers($id) {
    //TODO REFAIRE EN AJAX
    $url = "changeStatusCustomer.html";
    $.post($url, {
        id: $id
    }, function(data) {}, "json");

    $('#tab_customers').DataTable().ajax.reload();
}