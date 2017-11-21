function PasswordSuccesChange() {

    $.notify({
        icon: 'pe-7s-refresh-2',
        message: "<b>Informations : </b> Votre mot de passe à été modifier avec succès !"

    }, {
        type: 'info',
        timer: 4000
    });

};


function PasswordErrorConfirm() {

    $.notify({
        icon: 'pe-7s-refresh-2',
        message: "<b>Erreur : </b> Les 2 mots de passes ne sont pas identiques !"

    }, {
        type: 'danger',
        timer: 4000
    });
};



function PasswordError() {

    $.notify({
        icon: 'pe-7s-refresh-2',
        message: "<b>Erreur : </b> Le mot de passe actuel n'est pas valide !"

    }, {
        type: 'danger',
        timer: 4000
    });
};