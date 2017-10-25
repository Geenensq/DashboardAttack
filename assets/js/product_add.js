// Création de mes variables pour accèder au DOM
///////////////Création du tableau et envoi des donnée au moteur PHP
var qte = document.getElementById('order-content-qte');
var ref = document.getElementById('order-content');
var color = document.getElementById('order-content-color');
var taille = document.getElementById('order-content-taille');
var addarticle = document.getElementById('add_article');
var tr = document.createElement('tr');
var tableau = document.getElementById('productdata');
var produit = 0;
var inserthere = document.getElementById('div_articles');
var nbarticles = document.getElementById('nb_articles');
var clicked = false;
//////////////////////////////// EDITION ET SUPPRESSION DES LIGNES DU TABLEAU

// Gestionnaire d'évenement
addarticle.addEventListener('click', addArticleOrder);
////// function

/**
 * [addArticleOrder Permet l'ajout des produits dans le tableau html]
 */

function addArticleOrder() {
    if (qte.value.length == 0 || ref.value.length == 0 || color.value.length == 0 || taille.value.length == 0) {
        /// Si les input pour remplir le tableaux est vide on alert l'utilisateur , sinon on passe au bloc d'insctructions suivant
        alert('Il faut remplir tout les champs de l\'article');

    } else {

        /// Mon tableau est caché via la css , je l'affiche au moment de l'editer uniquement
        tableau.style.display = "inline-table"

        var ligne = tableau.insertRow(1); ///Insertion d'une ligne dans le tableau

        ligne.id = "ligne" + produit; /// Pour chaques ligne on lui affecte un id "ligne" + la variable produit

        var cell1 = ligne.insertCell(0); /// Insertion des 6 cellule
        var cell2 = ligne.insertCell(1);///
        var cell3 = ligne.insertCell(2);///
        var cell4 = ligne.insertCell(3);///
        var cell5 = ligne.insertCell(4);///
        var cell6 = ligne.insertCell(5);///


        cell1.innerHTML = qte.value; //Insertion dans les céllules les valeurs des inputs
        cell1.id = "tdQte_" + produit; /// Insertion d'un ID

        cell2.innerHTML = ref.value; ///////
        cell2.id = "tdRef_" + produit;///////   

        cell3.innerHTML = color.value;
        cell3.id = "tdColor_" + produit;

        cell4.innerHTML = taille.value;
        cell4.id = "tdTaille_" + produit;
        
        cell5.innerHTML = '<p onClick="editRow(' + "ligne" + produit + ')" style="font-size:1.5em;" class="glyphicon glyphicon-pencil" aria-hidden="true"></p>'; 
        /// Dans mes cellules j'ajoute , des paragraphe cliquable , vers ma fonction editRow et je lui passe le numéro de ma ligne via des paramettres
         /// Dans mes cellules j'ajoute , des paragraphe cliquable , vers ma fonction deleteRow et je lui passe le numéro de produit actuel
        cell6.innerHTML = '<p onClick="deleteRow(' + produit + ')" style="font-size:1.5em;" class="glyphicon glyphicon-remove" aria-hidden="true"></p>';
        ///
        ///
        produit++; /// Création d'une variable pour les ID des produits

        // APPEND D'UNE DIV CONTENANT LES INPUTS, DANS LA DIV_ARTICLES
        var newDiv = document.createElement('div');
        newDiv.id = "div_input_" + produit;

        inserthere.appendChild(newDiv);
        // Creattion de mes input caché
        /// Input quantité
        var newInputQte = document.createElement('input');
        newInputQte.type = "text";
        newInputQte.id = "qte_" + produit;
        newInputQte.name = "qte_" + produit;
        newInputQte.style.display = "none";
        newInputQte.value = qte.value;
        newDiv.appendChild(newInputQte);

        /// Input ref
        var newInputRef = document.createElement('input');
        newInputRef.type = "text";
        newInputRef.id = "Ref_" + produit;
        newInputRef.name = "Ref_" + produit;
        newInputRef.style.display = "none";
        newInputRef.value = ref.value;
        newDiv.appendChild(newInputRef);

        ///Input color
        var newInputColor = document.createElement('input');
        newInputColor.type = "text";
        newInputColor.id = "Color_" + produit;
        newInputColor.name = "Color_" + produit;
        newInputColor.style.display = "none";
        newInputColor.value = color.value;
        newDiv.appendChild(newInputColor);

        ////Input taille
        var newInputTaille = document.createElement('input');
        newInputTaille.type = "text";
        newInputTaille.id = "Taille_" + produit;
        newInputTaille.name = "Taille_" + produit;
        newInputTaille.style.display = "none";
        newInputTaille.value = taille.value;
        newDiv.appendChild(newInputTaille);

        ///Update nb_articles
        nb_articles.value = produit;

        ///Vidage des champs de saisies
        qte.value = "";
        ref.value = "";
        color.value = "";
        taille.value = "";
    }
}


/**
 * [editRow met en editable les cellules de mon tableau]
 * @param  {[node]} rowTableau [élément html <tr> qui contient mes cellules à editer]
 * @return void         
 */
 
function editRow(rowTableau) {

    if (clicked === false) { /// si le boutton n'à pas été cliqué on entre dans la condition
        clicked = true; /*on passe cliqué a true*/
        rowTableau.childNodes[4].style.color = "red"; /*On colorise le boutton d'édition en rouge*/

        for (var i = 0; i < 4; i++) { /// Boucle pour parcourir les céllules de mon tableau
            rowTableau.childNodes[i].setAttribute("contenteditable", "true"); /// On met les céllules du tableau en editable
            /*Cela permettras à mon utilisateur de modifier les champs et lors de l'autre clic on sauvegarde*/
            rowTableau.childNodes[i].style.backgroundColor = "#d9edf7"; /// Couleur de fond de la ligne à editer
            rowTableau.childNodes[i].style.color = "black"; /// Colorisation du texte en noir
            rowTableau.childNodes[i].style.fontWeight = "600"; /// Plus grosse police d'écriture
        }

    } else if (clicked === true) {  /// Si le boutton à déja été cliqué on entre dans la condition
        clicked = false; /// On passe le click a false pour pouvoir le ,rediter par la suitet 
        rowTableau.childNodes[4].style.color = "black"; // on re passe le boutton d'édition en noir

        /*boucle pour parcourir mes TD*/ 
        for (var i = 0; i < 4; i++) {
            rowTableau.childNodes[i].setAttribute("contenteditable", "false"); /*On repsse l'attribut des TD en non editables*/
            rowTableau.childNodes[i].style.backgroundColor = ""; /*on enleve le background color*/
            rowTableau.childNodes[i].style.color = "black"; /*On remet la couleur du texte en noir*/
            rowTableau.childNodes[i].style.fontWeight = ""; /*On enlève la police d'écriture grace*/
        }

            /*On boucle jusqu'a mon nom d'articles*/
        for (var i = 0; i < nbarticles.value; i++) {

            /*on effecte à mes inputs caché les valeurs de mes td*/
            document.getElementById("qte_" + (i + 1)).value = document.getElementById("tdQte_" + i).textContent;
            document.getElementById("Ref_" + (i + 1)).value = document.getElementById("tdRef_" + i).textContent;
            document.getElementById("Color_" + (i + 1)).value = document.getElementById("tdColor_" + i).textContent;
            document.getElementById("Taille_" + (i + 1)).value = document.getElementById("tdTaille_" + i).textContent;
        }
    }
}

/**
 * 
 * 
 * @param  {[variable]} iTableau [Itableau me retourne un compteur pour construire mon instruction]
 * @return {[none]} 
 */
/*Itableau me retourne un compteur pour construire mon instruction*/
function deleteRow(iTableau) {
    eval('ligne' + iTableau + '.remove()'); /// On auto  execute  et on delete la ligne du tableaux

    iTableau++; /*On ajoute 1 a la variable pour la prochaine construction*/ 
    produit--; /*On enlève le produit */
    document.getElementById('div_input_' + iTableau).innerHTML = ""; /*On supprime la div des input hidden*/
}

/*TODO*/