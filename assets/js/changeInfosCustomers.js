$(document).ready(function() {
    $("#modal_update_customer").submit(function() {
        id_customer = $(this).find("input[name=id_customer]").val();
        new_name_customer = $(this).find("input[name=new_name_customer]").val();
        new_firstname_customer = $(this).find("input[name=new_firstname_customer]").val();
        new_mobil_phone_customer = $(this).find("input[name=new_mobil_phone_customer]").val();
        new_phone_customer = $(this).find("input[name=new_phone_customer]").val();
        new_mail_customer = $(this).find("input[name=new_mail_customer]").val();
        new_address_customer = $(this).find("input[name=new_address_customer]").val();
        new_cp_customer = $(this).find("input[name=new_cp_customer]").val();
        new_city_customer = $(this).find("input[name=new_city_customer]").val();
        new_group_customer = $("#new_group_customer").val();

        url = $(this).attr("action");
        $.post(url, {
            id_customer: id_customer,
            new_name_customer: new_name_customer,
            new_firstname_customer: new_firstname_customer,
            new_mobil_phone_customer: new_mobil_phone_customer,
            new_phone_customer: new_phone_customer,
            new_mail_customer: new_mail_customer,
            new_address_customer: new_address_customer,
            new_cp_customer: new_cp_customer,
            new_city_customer: new_city_customer,
            new_group_customer: new_group_customer

        }, function(data) {

            if (data.confirm == "success") {

                notify("pe-7s-refresh-2", "<b>Informations</b> : Le client à été modifier avec succès ", "info");
                $('#tab_customers').DataTable().ajax.reload();
                $('#modal_update_customers').modal('hide');


            } else if (data.error == "error") {
                notify("pe-7s-refresh-2", "<b>Erreur</b> : Le client n'a pas été modifier", "danger");
            }
        }, "json");
        return false;
    });


});