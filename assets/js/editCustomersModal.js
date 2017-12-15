/*Function for track duplicate entry in my select and delete dupliacte*/
function deleteMultipleEntrySelect(){
    var a = new Array();
    $("#new_group_customer").children("option").each(function(x){
        test = false;
        b = a[x] = $(this).val();
        for (i=0;i<a.length-1;i++){
            if (b ==a[i]) test =true;

        }
        if (test) $(this).remove();
    })




}
/*End*/




function editCustomersModal($id){
    url = "getAllInformationsOfcustomersForModal.html";
    // on declare un formulaire
    var form = {
        id:$id
    };

    //on post
    var customer  = send_post(form,url);

    $('#id_customer').val(customer.id_customer);
    $('#new_firstname_customer').val(customer.firstname);
    $('#new_name_customer').val(customer.lastname);
    $('#new_mobil_phone_customer').val(customer.mobil_phone_number);
    $('#new_phone_customer').val(customer.phone_number);
    $('#new_mail_customer').val(customer.mail);
    $('#new_address_customer').val(customer.address);
    $('#new_cp_group_customer').val(customer.zip_code);
    $('#new_city_customer').val(customer.city);
    $("#new_group_customer").append($("<option class=\"protected\" selected=\"selected\"></option>").val(customer.id_group_customer).html(customer.group_name));
    deleteMultipleEntrySelect();
}


function send_post(v,url) {
    var resultat = null;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        data: v,
        dataType: "json",
        cache: false,
        success: function(data) {
            resultat = data;
            return resultat;
        },
        error: function(error) {
            resultat = error;
            return resultat;
        }
    });
    return resultat;



}