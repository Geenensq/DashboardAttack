



// FONCTION DE CONFIRMATION DE COMMANDE
function confirmDelCmd(id_commande) {

    $.confirm({
        boxWidth: '30%',
        icon: 'glyphicon glyphicon-heart',
        title: 'Suppression de la commande',
        content: 'Voulez vous supprimer la commande ?',
        type: 'blue',
        buttons: {
            Suppression: function() {
                self.location.href = "delete.php?id=" + id_commande;
            },
            Annulez: function() {
                $.alert('Votre commande n\'a pas été supprimée');
            },
        }
    });

}

// LORS DU CLIC SUR L'AJOUT DE COMMANDE PETITE ALERTE POUR INDIQUER QUE LA COMMANDE A BIEN ETE AJOUTER EN BASE
function add_order() {

    $.confirm({
        boxWidth: '70%',
        icon: 'glyphicon glyphicon-heart',
        title: 'Ajout de la commande',
        content: 'Voulez vous ajouter la commande ?',
        type: 'blue',
        buttons: {
            Ajoutez: function() {
                document.commande_form.submit();
            },
            Annulez: function() {
                $.alert('Votre commande n\'a pas été ajoutée');
            },
        }
    });

}

///FIN


// var iCountOrder = 0;
// // FONCTION POUR AJOUTER DES COMMANDES DANS LA FENETRE MODALE
// function addorder() {
//     // SI LES CHAMPS SONT VIDES ON ALERT SINON ON TRAITE LE BLOC D'INSCTRUCTION
//
//     if ($('#order-content-qte' && '#order-content-content' && '#order-content-color' && '#order-content-taille').val() == '') {
//         $.iaoAlert({
//             msg: "Vous n'avez pas correctement renseigné tous les champs.",
//             type: "error",
//             mode: "dark",
//         })
//         autoHide: false
//     } else {
//
//         $.iaoAlert({
//             msg: "Félicitation votre commande à été ajouter à la commande.",
//             type: "success",
//             mode: "dark",
//         })
//         autoHide: true
//         alertTime: "500",
//
//             $('#div_liste_articles').append("Article " + (iCountOrder + 1) + " :" + " " + $('#order-content-qte').val() + "x" + " " +
//                 $('#order-content').val() + " " + $('#order-content-color').val() + " " +
//                 $('#order-content-taille').val() + "<br>");
//
//         iCountOrder++;
//
//         $('#div_liste_articles').append("<input type='hidden' name='qte_" + iCountOrder + "' value='" + $('#order-content-qte').val() + "'>");
//         $('#div_liste_articles').append("<input type='hidden' name='ref_" + iCountOrder + "' value='" + $('#order-content').val() + "'>");
//         $('#div_liste_articles').append("<input type='hidden' name='color_" + iCountOrder + "' value='" + $('#order-content-color').val() + "'>");
//         $('#div_liste_articles').append("<input type='hidden' name='taille_" + iCountOrder + "' value='" + $('#order-content-taille').val() + "'>");
//     }
// }
//
// function addorder_count() {
//     $('#div_liste_articles').append("<input type='hidden' name='nb_articles' value='" + iCountOrder + "'>");
//     $(".arr_plan , .f_modale").animate({
//             'opacity': '0'
//         }, 350,
//         function() {
//             $(".arr_plan , .f_modale").css("display", "none");
//         }
//     );
// }


/* Fonction pour la colorisation des commandes */

window.onload = function() {

    $("td:contains('Réglé')").css("background-color", "#32CD32");
    $("td:contains('Livré')").css("background-color", "#108510");
    $("td:contains('En cours de production')").css("background-color", "#FF8C00");
    $("td:contains('En attente de paiement')").css("background-color", "#4169E1");
    $("td:contains('Annulé')").css("background-color", "#f44242");
    $("td:contains('Acompte versé')").css("background-color", "#e95325");
    $("td:contains('Prêt')").css("background-color", "#64cdff");
    $("td:contains('Expédié')").css("background-color", "#8A2BE2");

    //// AU chargement détection si il y'a plus de 0 commande en préparation pour changer le texte

    ///Selection de l'élément
    var alert = document.getElementById('textAlert');
    ///////////////////////////
    if (alert.innerText === "Attention ! Vous avez 0 commandes en cours de préparation"){
        alert.innerText = "Bravo , vous n'avez aucune commande en cours de préparation";
        document.querySelector('.alert').className= 'alert alert-success';

    }

};
