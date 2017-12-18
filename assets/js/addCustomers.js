$(document).ready(function() {
    $("#form_add_customers").submit(function() {
        name_customers = $(this).find("input[name=name_customers]").val();
        first_name_customers = $(this).find("input[name=first_name_customers]").val();
        mobil_phone_number_customers = $(this).find("input[name=mobil_phone_number_customers]").val();
        phone_number_customers = $(this).find("input[name=phone_number_customers]").val();
        email_customers = $(this).find("input[name=email_customers]").val();
        address_customers = $(this).find("input[name=address_customers]").val();
        code_postal_customers = $(this).find("input[name=code_postal_customers]").val();
        city_customers = $(this).find("input[name=city_customers]").val();
        name_group_for_customers = $("#name_group_for_customers").val();

        url = $(this).attr("action");
        $.post(url, {
            name_customers: name_customers,
            first_name_customers: first_name_customers,
            mobil_phone_number_customers: mobil_phone_number_customers,
            phone_number_customers: phone_number_customers,
            email_customers: email_customers,
            address_customers: address_customers,
            code_postal_customers: code_postal_customers,
            city_customers: city_customers,
            name_group_for_customers: name_group_for_customers

        }, function(data) {
            if (data.confirm == "success") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b> L'utilisateur à été créer avec succès !", "info");
                /*Delete content of the input*/
                $("#name_customers").val('');
                $("#first_name_customers").val('');
                $("#mobil_phone_number_customers").val('');
                $("#phone_number_customers").val('');
                $("#email_customers").val('');
                $("#address_customers").val('');
                $("#code_postal_customers").val('');
                $("#city_customers").val('');
                $("#name_group_for_customers").val('');
                $('#tab_customers').DataTable().ajax.reload();

            } else if (data.confirm == "error") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b> Tous les champs doivent etre remplis", "danger");

            }
        }, "json");
        return false;
    });

});