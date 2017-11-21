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
                PasswordSuccesChange();
                $('#flip').removeAttr("disabled");
                //------------------------------------------//

                //--Si le retour Ajax me retourne errorConfirm--//      
            } else if (data.errorPasswordConfirm == "error") {
                PasswordErrorConfirm();
                //------------------------------------------------//

                //--Si le retour Ajax me retourne errorPassword--//
            } else if (data.errorPasswordActuel == "error") {
                PasswordError();
            }
            //-------------------------------------------------//

        }, "json");

        return false;
    });
});