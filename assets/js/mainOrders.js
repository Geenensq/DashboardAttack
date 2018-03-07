$(document).ready(function () {
	/*-----Declare my lets for acces to the DOM------*/
	let array = document.getElementById('tab_products_order');
	let count = 1;
	let counterProducts = 0;
	let product_checked;
	let return_product_exist;
	var id_color;
	var id_size;
	var id_order;


	/********Onclick for change text on button*****************/
	$("#edit_orders").click(function () {

		if ($("#collapse_edit_orders").is(":visible") == true) {
			$("#edit_orders").text("Commandes en cours");

		} else {
			$("#edit_orders").text("Fermer les commandes en cours");

		}
	})
	/*******************************************************/


	/********Onclick for valid order*****************/
	$("#valid_order").click(function () {

		var edit_mode = 0;
		/*close collapse orders*/
		$('[data-toggle=collapse]').prop('disabled', false);

		/*Change attribute disabled to false*/
		$('#edit_orders').attr("disabled", false);


		// Si on clique sur la validation de la commande et que la commande est en mode edition
		if ($('h4:contains("Edition de la commande existante")').length > 0) {

			// On change le texte du bouton de validation pour le remettre par defaut
			$('#valid_order').text("Valider la commande");
			edit_mode = 1;

			var url = "changeInfosOrders.html"

			var form = {
				id_order: $("#current_id_order").val(),
				new_customer_order: $("#customer_order").val(),
				new_date_order: $("#date_order").val(),
				new_price_order: $("#current_order_price").val(),
				new_comment_order: $("#comment_order").val(),
				new_method_payment: $("#payments_order").val(),
				shipping_order: $("#shipping_order").val(),
				new_state_order: $("#state_order").val()
			};

			var order = send_post(form, url);

			if (order.confirm == "success") {
				notify("pe-7s-refresh-2", "<b>Informations : </b> Votre commande à été modifier avec succès !", "info");
				$("#tab_orders").DataTable().ajax.reload();
			}
		}
		////////////////////////////////////////////////////////////


		// Si le boutton de validation de la commande n'est pas désactivé
		if ($('#valid_order').prop("disabled") == false) {

			/*Enable the datatable buttons that allow the editing of the command*/
			$("a.editOrder").attr("disabled", false);

			// fonction qui réactive les champs en disabled
			unlockInputOrder();

			// Changement du titre de la page
			$("#title_order").text("Ajouter une commande");

			// Appel de la fonction qui me vide mes champs de saisies après la validation
			resetInputsOrders();

			// Suppréssion dans la vue des commandes dans le tableau
			$("#tab_products_order td").parent().remove();

			// Fermeture du panneau qui contient le tableau des produits de la commande
			$("#collapse_products").hide("slow");

			// On met en desactivé le bouton de validation de la commande
			$("#valid_order").attr('disabled', 'disabled');

			count = 1;
			counterProducts = 0;

			if (edit_mode == 0) {
				notify("pe-7s-refresh-2", "<b>Informations : </b> La commande à été ajoutée avec succès !", "info");
				$("#tab_orders").DataTable().ajax.reload();
			}

			// On remet la css de base du titre 
			$("#title_order").css("font-weight", "300");
			$("#title_order").css("color", "#333333");


		} else {

			return;
		}
	});


	/*---------------------Event for create order and products---------------------*/
	$("#add_product").click(function () {

		// Si tous les champs relatifs à la commande en elle même sont remplis 
		if ($("#customer_order #date_order,#state_order,#shipping_order,#payments_order , #qte_product_order").val() != null) {

			$('[data-toggle=collapse]').prop('disabled', true);
			$('#edit_orders').attr("disabled", true);


			// Si on ajoute un produit et que la commande est en mode edition
			if ($('h4:contains("Edition de la commande existante")').length > 0) {

				// On récupère l'id de la commande
				id_order = $('#current_id_order').val();

				// On récupere les informations relatives au produit
				var id_product = $('#select_product_order').val();
				var qte_product = $('#qte_product_order').val();
				var size_product = $('#select_size_product').val();
				var color_product = $('#select_color_product').val();
				//*************************************************/

				// Si les champs sont correctement remplis
				if (id_product && qte_product && size_product && color_product != null) {
					/*On crée le product_colors et le product_size dans la base de donnée*/
					addProductsColors(id_product, color_product);
					addProductsSizes(id_product, size_product);
					/********************************************************************/

					/*On vérifie que ce produit avec cette taille et cette couleur n'existe deja pas en BDD pour la commande*/
					return_product_exist = checkProductInOrders(id_product, id_order, color_product, size_product);

					/*Si le retour est égal à false le produit n'est pas dans la commande alors on peut l'ajouter*/
					if (return_product_exist == false) {
						/*On ajoute le produit la taille et la couleur à products_order*/
						addProductsOrder(id_order, qte_product, size_product, color_product, id_product);

						/*On récupere les infos du produits pour les passer apres à la fonction qui va créerla vue*/
						var product = getInfosProducts(id_product, color_product, size_product, id_order);

						// On apelle la fonction qui nous calcule prix de la commande après la l'ajout du produit
						var new_price = incrementPrice(product);
						var new_price = parseFloat(new_price).toFixed(2);
						/***************************************************************************************/

						//**Appel de la fonction pour mettre à jour le prix dans la vue**//
						priceUpdateView(new_price);
						//************************************************************//

						//**Appel de la fonction pour mettre à jour le prix dans la base de donnée**//
						priceUpdateDatabase(id_order, new_price);

						/*On apelle la fonction qui permet de générer la vue en lui passant le produit , 
						le counteur pour générer la ligne , l'id du tableau et la quantité de chque produit*/
						constructViewTable(product, count, array, $("#qte_product_order").val());

						notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été ajouté à la commande avec succès !", "info");


					} else {
						notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit est deja dans la commande dans la meme couleur et taille", "danger");
					}

				} else {
					notify("pe-7s-refresh-2", "<b>Informations : </b> Les champs du produit ne sont pas correctement renseigné ", "danger");
				}


			} else {

				/*SI LE CHAMPS PRODUIT EST BIEN REMPLIS*/
				if ($("#select_product_order").val() != null) {
					/*Verouillage des champs de la commande*/
					lockInputOrder();
					/**************************************/

					/*On affiche la div qui cache le tableau html des produits*/
					$("#collapse_products").show("slow");

					// SI c'est le premier produit ajouté à la commande alors on créer la commande
					if (counterProducts < 1) {
						/*On ajoute la commande et on récupere l'id de la commande pour l'affecter à l'input hidden*/
						var id_order = addOrders();

						/*On modifie le texte pour voir qu'on vient de créer la commande*/
						$("#title_order").text("Création de la commande n°" + $("#current_id_order").val());

						counterProducts++;
					}

					/*On crée le product_colors et le product_size*/
					addProductsColors($('#select_product_order').val(), $('#select_color_product').val());
					addProductsSizes($('#select_product_order').val(), $('#select_size_product').val());
					/*********************************************/


					/*On vérifie que ce produit avec cette taille et cette couleur n'existe deja pas en BDD pour la commande*/
					return_product_exist = checkProductInOrders($('#select_product_order').val(), $('#current_id_order').val(), $('#select_color_product').val(), $('#select_size_product').val());
					/*******************************************************************************************************/

					/*Si le retour est égal à false le produit n'est pas dans la commande alors on peut l'ajouter*/
					if (return_product_exist == false) {

						/*On ajoute le produit la taille et la couleur à products_order*/
						addProductsOrder($("#current_id_order").val(), $('#qte_product_order').val(), $('#select_size_product').val(), $('#select_color_product').val(), $('#select_product_order').val());

						/*On récupere les infos du produits pour les passer apres à la fonction qui va créerla vue*/
						var product = getInfosProducts($('#select_product_order').val(), $('#select_color_product').val(), $('#select_size_product').val(), $("#current_id_order").val());


						// On apelle la fonction qui nous calcule prix de la commande après la l'ajout du produit
						var new_price = incrementPrice(product);
						var new_price = parseFloat(new_price).toFixed(2);
						/***************************************************************************************/

						//**Appel de la fonction pour mettre à jour le prix dans la vue**//
						priceUpdateView(new_price);
						//************************************************************//

						//**Appel de la fonction pour mettre à jour le prix dans la base de donnée**//
						priceUpdateDatabase($("#current_id_order").val(), new_price);
						/**********************************************************************************/


						/*On apelle la fonction qui permet de générer la vue en lui passant le produit , le counteur pour générer la ligne , l'id du tableau et la quantité de chque produit*/
						constructViewTable(product, count, array, $("#qte_product_order").val());

						notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été ajouté à la commande avec succès !", "info");
						/*On incrémente le compteur pour générer la ligne dans la fonction de génération du tableau*/
						count++;
					} else if (return_product_exist == true) {

						notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit est deja dans la commande dans la meme couleur et taille", "danger");
					}

				} else {
					notify("pe-7s-refresh-2", "<b>Informations : </b>  Veuillez renseignez le champ du produit", "danger");
				}
			}
		} else {
			notify("pe-7s-refresh-2", "<b>Informations : </b> Veuillez renseignez tous les champs de la commande avant d'ajouter un produit", "danger");
		}
	});

});



function getInfosProducts($id_product, $id_color, $id_size, $id_order) {
	let url = "getInfosProductsArray.html";
	let form = {
		id_product: $id_product,
		id_color: $id_color,
		id_size: $id_size,
		id_order: $id_order
	};
	let product = send_post(form, url);
	return product;
}




function constructViewTable($product, $count, $array, $qte_product) {
	$("#valid_order").removeAttr("disabled");

	if ($('h4:contains("Edition de la commande existante")').length > 0) {
		if ($('#tab_products_order tr').length <= 1) {
			$count = +0;

		} else {
			$count = +$("#tab_products_order tr:nth-child(2)").attr('id').replace("ligne", "") + 1;
		}
	}


	let row = $array.insertRow(1);
	row.id = "ligne" + $count; /// Pour chaques ligne on lui affecte un id "ligne" + la letiable count*/

	/*Insert an row in my table*/
	let cell1 = row.insertCell(0);
	let cell2 = row.insertCell(1);
	let cell3 = row.insertCell(2);
	let cell4 = row.insertCell(3);
	let cell5 = row.insertCell(4);
	let cell6 = row.insertCell(5);
	let cell7 = row.insertCell(6);
	let cell8 = row.insertCell(7);
	let cell9 = row.insertCell(8);
	let cell10 = row.insertCell(9);
	let cell11 = row.insertCell(10);
	let cell12 = row.insertCell(11);

	cell1.innerHTML = $product.id_product
	cell2.innerHTML = $qte_product;
	cell3.innerHTML = $product.product_name;
	cell4.innerHTML = $product.reference;
	cell5.innerHTML = $product.description;
	cell6.innerHTML = $product.base_price;
	cell7.innerHTML = "<img src=\"" + "/local/assets/img/uploaded/" + $product.img_url + "\" width=\"80px\" height=\"80px\">";;
	cell8.innerHTML = $product.color_name;
	cell9.innerHTML = $product.size_name;

	/*Pour supprimé la ligne et l'entrée en base on lui passe count pour supprimer la ligne*/
	/*On lui passe aussi l'id du produit , l'id de la taille et de la couleur et la commande*/
	cell10.innerHTML = '<a onClick="deleteRow(' + $count + ',' + $product.id_product + ',' + $product.id_size + ',' + $product.id_color + ',' + $qte_product + ')" style="font-size:1.5em;" class="glyphicon glyphicon-remove" aria-hidden="true"></a>';

	/*Pour incrémenter ou décrémenter la quantité du produit on lui passe aussi l'id du produit , 
	l'id de la taille et de la couleur et la commande*/
	cell11.innerHTML = '<i role="button" onClick="AddQuantity(' + $product.id_product + ',' + row.id + ',' + $product.base_price + ',' + $product.id_size + ',' + $product.id_color + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf196;</i> <i  role="button" onClick="RemoveQuantity(' + $product.id_product + ',' + row.id + ',' + $product.base_price + ',' + $product.id_size + ',' + $product.id_color + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf147;</i>';

	cell12.innerHTML = '<a id="editRow" onClick="editRowOrder()" style="font-size:1.5em;" class="glyphicon glyphicon-edit" aria-hidden="true"></a>';
}


// Fonction qui permet d'incrémenter le prix de la commande quand on ajoute un produit
function incrementPrice($product) {

	// Une fois le produit récupérer je récupère le prix actuel de la commande je le traite en float//
	var current_price = $("#current_order_price").val();
	var current_price = parseFloat(current_price);

	/***********************************************************************************************/
	// Ensuite je récupère le prix du produit de la taille multiplié par le nombre de fois ou il est dans la commande et je le traite en float//
	var product_price = (parseFloat($product.base_price) + parseFloat($product.size_price)) * parseFloat($product.quantity_product);
	/********************************************************************************************************************************************/

	//******************Calcul du nouveau prix*********************//
	var new_price = (current_price + product_price);
	//************************************************************//
	return new_price;
}
/*************************************************************************************/


// Fonction qui permet de décrémenter le prix de la commande quand on supprime un produit
function decrementPrice($product) {

	// Une fois le produit récupérer je récupère le prix actuel de la commande je le traite en float//
	var current_price = $("#current_order_price").val();
	var current_price = parseFloat(current_price);
	/***********************************************************************************************/

	// Ensuite je récupère le prix du produit de la taille multiplié par le nombre de fois ou il est dans la commande et je le traite en float//
	var product_price = (parseFloat($product.base_price) + parseFloat($product.size_price)) * parseFloat($product.quantity_product);
	/********************************************************************************************************************************************/

	//******************Calcul du nouveau prix*********************//
	var new_price = (current_price - product_price);
	//************************************************************//

	return new_price;
}
/****************************************************************************************/



// Fonction qui me permet d'ajouter le nouveau prix dans la vue//
function priceUpdateView($new_price) {

	// Récupération du prix dans la variablle et conversion en foat avec 2 chiffres après la virgule
	var new_price = parseFloat($new_price).toFixed(2);

	$("#current_order_price").val(new_price);
}
//*************************************************************/



// Fonction qui me permet d'ajouter le nouveau prix dans la base de données//
function priceUpdateDatabase($id_order, $price) {
	url = "editPriceOrders.html";
	form = {
		id_order: $id_order,
		price: $price
	};
	let result_price_update = send_post(form, url);
}
//************************************************************************/



/******************DATA TABLE DECLARATION**********************/
var myTable = $('#tab_orders').DataTable({
	ajax: "encodeGridOrders.html",
	order: [
		[0, "asc"]
	],
	"columns": [

		{
			"targets": 0,
			data: 0
		}, {
			"targets": 1,
			data: null
		}, {
			"targets": 2,
			data: 1
		}, {
			"targets": 3,
			data: null
		}, {
			"targets": 4,
			data: null
		}, {
			"targets": 5,
			data: 2
		}, {
			"targets": 6,
			data: 6
		}, {
			"targets": 7,
			data: 7
		}, {
			"targets": 8,
			data: 8
		}, {
			"target": 9,
			data: null
		}, {
			"target": 10,
			data: null
		}

	],

	columnDefs: [

		{
			"targets": 1,
			render: function (data, full) {
				return '<p>' + data[5] + ' ' + data[4] + '<p>'
			}
		}, {
			"targets": 3,
			render: function (data, full) {
				return '<p>' + data[3] + '€' + '</p>'
			}
		}, {
			"targets": 4,
			render: function (data, full) {
				return '<p>' + parseFloat(data[3] * 1.2).toFixed(2) + '€' + '</p>'
			}
		}, {
			"targets": 9,
			render: function (data, full) {
				return '<a href="#title_order" id="btn_state" onclick="editOrders(' + data[0] + ')" class="btn btn-info btn-fill editOrder"><i class="fa fa-edit"></i></a>'
			}
		}, {
			"targets": 10,
			render: function (data, full) {
				return '<a id="btn_state" onclick="deleteOrders(' + data[0] + ')" class="btn btn-danger btn-fill editOrder"><i class="fa fa-trash-o"></i></a>'
			}
		},
	]
});
