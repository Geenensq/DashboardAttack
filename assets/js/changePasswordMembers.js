$(document).ready(function() {

    //---------On lance la function lors du submit--------///
    $("#formEditPassword").submit(function() {
        //-------------------Stockage des informations du mot de passe actuel et du nouveau mot de passe-----------------//
        currentPassword = $(this).find("input[name=currentPassword]").val();
        newPassword = $(this).find("input[name=newPassword]").val();
        newPasswordConfirmation = $(this).find("input[name=newPasswordConfirmation]").val();
        //--------------------------------------------------------------------------------------------------------------//

        //--------------------Stockage de l'url via l'attribut action du formulaire-------------//
        url = $(this).attr("action");
        //-------------------------------------------------------------------------------------//

        //----------------Utilisation de la méthode post en jquery pour envoyer à php les informations à php sous forme de tableau associatif------------------//
        //------------Lors du post on appelle une fonction. Le paramettre data sont les données qui seront récupérés lors de la soumission en ajax------------//
        $.post(url, {
            currentPassword: currentPassword,
            newPassword: newPassword,
            newPasswordConfirmation: newPasswordConfirmation
        }, function(data) {
            //---------------------------------------------------------------------------------------------------------------------------------------------------//

            //--Si le retour Ajax me retourne success--//
            if (data.confirm == "success") {
                $("#panel").fadeOut();
                notify("pe-7s-refresh-2","<b>Informations : </b> Votre mot de passe à été modifier avec succès !","info");
                $('#flip').removeAttr("disabled");
                //------------------------------------------//

                //--Si le retour Ajax me retourne errorConfirm--//      
            } else if (data.errorPasswordConfirm == "error") {
               notify("pe-7s-refresh-2","<b>Erreur : </b> Les 2 mots de passes ne sont pas identiques !","danger");
                //------------------------------------------------//

                //--Si le retour Ajax me retourne errorPassword--//
            } else if (data.errorPasswordActuel == "error") {
                notify("pe-7s-refresh-2","<b>Erreur : </b> Le mot de passe actuel n'est pas valide !","danger");
            }
            //-------------------------------------------------//

        }, "json");

        return false;
    });
});