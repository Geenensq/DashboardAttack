$(document).ready(function() {

    $("#edit_order").click(function() {

        //-------------------Stockage des informations du mot de passe actuel et du nouveau mot de passe-----------------//
        id_order = $("#current_id_order").val();
        new_customer_order = $("#customer_order").val();
        new_date_order = $("#date_order").val();
        new_price_order = $("#current_order_price").val();
        new_comment_order = $("#comment_order").val();
        new_method_payment = $("#payments_order").val();
        shipping_order = $("#shipping_order").val();
        new_state_order = $("#state_order").val();


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