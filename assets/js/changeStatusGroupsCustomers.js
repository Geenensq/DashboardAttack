function ajaxChangeStatusGroupCustomers($id){
   //TODO REFAIRE EN AJAX
   $url = "changeStatusGroupCustomer.html";
    $.post($url , {id:$id}, function(data) { }, "json");  

    $('#testLoad').DataTable().ajax.reload();
}
