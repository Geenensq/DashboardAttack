function ajaxChangeStatusGroupCustomers($id){
    $url = "changeStatusGroupCustomer.html";
    $.post($url, {id:$id}, function(data) { }, "json");  
    
    $('#testLoad').DataTable().ajax.reload();
}
