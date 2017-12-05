$(document).ready(function () {
    $("#formAddCustomers").submit(function () {
        nameCustomers = $(this).find("input[name=nameCustomers]").val();
        firstNameCustomers = $(this).find("input[name=firstNameCustomers]").val();
        mobilPhoneNumberCustomers = $(this).find("input[name=mobilPhoneNumberCustomers]").val();
        phoneNumberCustomers = $(this).find("input[name=phoneNumberCustomers]").val();
        emailCustomers = $(this).find("input[name=emailCustomers]").val();
        addressCustomers = $(this).find("input[name=addressCustomers]").val();
        codePostalCustomers = $(this).find("input[name=codePostalCustomers]").val();
        cityCustomers = $(this).find("input[name=cityCustomers]").val();
        nameGroupForCustomers = $(this).find("input[name=nameGroupForCustomers]").val();

        url = $(this).attr("action");
        $.post(url, {
            nameCustomers: nameCustomers,
            firstNameCustomers: firstNameCustomers,
            mobilPhoneNumberCustomers: mobilPhoneNumberCustomers,
            phoneNumberCustomers:phoneNumberCustomers,
            emailCustomers:emailCustomers,
            addressCustomers:addressCustomers,
            codePostalCustomers:codePostalCustomers,
            cityCustomers:cityCustomers,
            nameGroupForCustomers:nameGroupForCustomers

        }, function (data) {
            if (data.confirm == "success") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b> Votre groupe à été créer avec succès !", "info");

                /*Delete content of the input*/
                /*DOIT*/
            } else if (data.confirm == "error") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b> Le groupe doit contenir au moins 3 caracteres !", "danger");
                /*Delete content of the input*/
                /*DOIT*/
            }
        }, "json");
        return false;
    });

});