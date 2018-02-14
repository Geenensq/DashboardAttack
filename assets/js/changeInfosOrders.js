$(document).ready(function() {

    $("#formEditOrder").submit(function() {
        //-------------------Stockage des informations du mot de passe actuel et du nouveau mot de passe-----------------//
        id_order = $(this).find("input[name=id_order]").val();
        new_customer_order = $("#new_customer_order").val();
        new_date_order = $(this).find("input[name=new_date_order]").val();
        new_price_order = $(this).find("input[name=new_price_order]").val();
        new_comment_order = $(this).find("input[name=new_comment_order]").val();
        new_method_payment = $("#new_method_payment").val();
        shipping_order = $("#shipping_order").val();
        new_state_order = $("#new_state_order").val();
        //--------------------------------------------------------------------------------------------------------------//

        //--------------------Stockage de l'url via l'attribut action du formulaire-------------//
        url = "changeInfosOrders.html"
        //-------------------------------------------------------------------------------------//

        //----------------Utilisation de la méthode post en jquery pour envoyer à php les informations à php sous forme de tableau associatif------------------//
        //------------Lors du post on appelle une fonction. Le paramettre data sont les données qui seront récupérés lors de la soumission en ajax------------//
        $.post(url, {
            id_order: id_order,
            new_customer_order: new_customer_order,
            new_date_order: new_date_order,
            new_price_order: new_price_order,
            new_comment_order: new_comment_order,
            new_method_payment: new_method_payment,
            shipping_order: shipping_order,
            new_state_order: new_state_order
        }, function(data) {
            //---------------------------------------------------------------------------------------------------------------------------------------------------//

            //--Si le retour Ajax me retourne success--//
            if (data.confirm == "success") {
                notify("pe-7s-refresh-2", "<b>Informations : </b> Votre commande à été modifier avec succès !", "info");

                //------------------------------------------//

                //--Si le retour Ajax me retourne errorConfirm--//
            } else {
                notify("pe-7s-refresh-2", "<b>Erreur !", "danger");
            }
                //------------------------------------------------//

           

        }, "json");

        return false;
    });
});