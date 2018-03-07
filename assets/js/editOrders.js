let array = document.getElementById('tab_products_order');
var clicked = false;

function editOrders($id_order) {
	$("#customer_order").click(function () {
		$customer = $("#customer_order");
	});
	if ($('h4:contains("Edition de la commande existante")').length > 0) {

		notify("pe-7s-refresh-2", "<b>Informations : </b>Une commande est déja en cours d'édition !", "danger");

	} else {

		// Desactivation des bouttons d'edition et suppression des commande
		$("a.editOrder").attr("disabled", true);
		/*****************************************************************/

		// Récupération des informations de la commande//
		url = "getInfosOrdersForEdit.html";
		var form = {
			id: $id_order
		};
		var order = send_post(form, url);
		/*********************************************/


		/*********Changement de l'id du formulaire**********/
		$("#form_add_order").attr("id", "form_edit_order");
		/**************************************************/

		/**************Changement des texte et de la css sur la page*************/
		$("#title_order").text("Edition de la commande existante n°" + order.id_order);
		$("#valid_order").text("Valider la modification de la commande n°" + order.id_order);
		$("#title_order").css("font-weight", "bold");
		$("#title_order").css("color", "#337ab7");
		/**********************************************************************/


		// Réactivation du bouton de la validation de la commande/
		$("#valid_order").removeAttr("disabled");
		/*******************************************************/

		// On stocke l'id de la commande dans l'input caché
		$('#current_id_order').val(order.id_order);
		//************************************************/

		// Création d'un objet javascript pour remplir l'autocomplétion
		var data = {
			id: order.id_customer,
			text: order.firstname + " " + order.lastname
		};
		//************************************************************/

		// Création du select avec mon objet javascript et ajout dans le champ
		var customer_autocomplete = new Option(data.text, data.id, true, false);
		$('#customer_order').append(customer_autocomplete).trigger('change');
		/********************************************************************/

		// Remplissage des champs de la commande via notre object order
		$('#date_order').val(order.date_order);
		$('#current_order_price').val(order.price_order);
		$('#comment_order').val(order.comment_order);
		$("#payments_order").val(order.id_method_payment);
		$("#shipping_order").val(order.id_method_shipping);
		$("#state_order").val(order.id_state);
		/************************************************************/


		// Récupération des informations des produits de la commande//
		url = "getInfosProductsOrdersForEdit.html";
		var form = {
			id: $id_order
		};

		var order_product = send_post(form, url);
		/**********************************************************/

		// Affichage de la div qui contient mon tableau de produits associé à la commande
		$("#collapse_products").show("slow");
		/*******************************************************************************/

		for (var i = 0; i < order_product.length; i++) {
			let row = array.insertRow(1);
			row.id = "ligne" + i;
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

			cell1.innerHTML = order_product[i]["id_product"];
			cell2.innerHTML = order_product[i]["quantity_product"];
			cell3.innerHTML = order_product[i]["product_name"];
			cell4.innerHTML = order_product[i]["reference"];
			cell5.innerHTML = order_product[i]["description"];
			cell6.innerHTML = order_product[i]["base_price"];
			cell7.innerHTML = "<img src=\"" + "/local/assets/img/uploaded/" + order_product[i]["img_url"] + "\" width=\"80px\" height=\"80px\">";
			cell8.innerHTML = order_product[i]["color_name"];
			cell9.innerHTML = order_product[i]["size_name"];
			/*Pour supprimé la ligne et l'entrée en base on lui passe i de la boucle pour supprimer la ligne*/
			/*On lui passe aussi l'id du produit , l'id de la taille et de la couleur et la commande*/
			cell10.innerHTML = '<a onClick="deleteRow(' + i + ',' + order_product[i]["id_product"] + ',' + order_product[i]["id_size"] + ',' + order_product[i]["id_color"] + ',' + order_product[i]["quantity_product"] + ')" style="font-size:1.5em;" class="glyphicon glyphicon-remove" aria-hidden="true"></a>';
			/*Pour incrémenter ou décrémenter la quantité du produit on lui passe aussi l'id du produit , 
	        l'id de la taille et de la couleur et la commande*/
			cell11.innerHTML = '<i  role="button" onClick="AddQuantity(' + order_product[i]["id_product"] + ',' + row.id + ',' + order_product[i]["base_price"] + ',' + order_product[i]["id_size"] + ',' + order_product[i]["id_color"] + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf196;</i> <i  role="button" onClick="RemoveQuantity(' + order_product[i]["id_product"] + ',' + row.id + ',' + order_product[i]["base_price"] + ',' + order_product[i]["id_size"] + ',' + order_product[i]["id_color"] + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf147;</i>';
			cell12.innerHTML = '<a id="editRow" onClick="editRowOrder(' + row.id + ')" style="font-size:1.5em;" class="glyphicon glyphicon-edit" aria-hidden="true"></a>';
		}
	}

}


function editRowOrder(rowTableau) {

	if (clicked === false) { /// si le boutton n'à pas été cliqué on entre dans la condition
		clicked = true;
		$("#editRow").css("color", "#FF4A55");

		rowTableau.childNodes[5].setAttribute("contenteditable", "true");
		rowTableau.childNodes[7].setAttribute("contenteditable", "true");
		rowTableau.childNodes[8].setAttribute("contenteditable", "true");

		rowTableau.childNodes[5].style.color = "#FF4A55";
		rowTableau.childNodes[5].style.fontWeight = "600";
		rowTableau.childNodes[7].style.color = "#FF4A55";
		rowTableau.childNodes[7].style.fontWeight = "600";
		rowTableau.childNodes[8].style.color = "#FF4A55";
		rowTableau.childNodes[8].style.fontWeight = "600";

	} else if (clicked === true) {
		clicked = false;

		$("#editRow").css("color", "#337ab7");

		rowTableau.childNodes[5].setAttribute("contenteditable", "false");
		rowTableau.childNodes[7].setAttribute("contenteditable", "false");
		rowTableau.childNodes[8].setAttribute("contenteditable", "false");

		rowTableau.childNodes[5].style.color = "#333";
		rowTableau.childNodes[5].style.fontWeight = "";
		rowTableau.childNodes[7].style.color = "#333";
		rowTableau.childNodes[7].style.fontWeight = "";
		rowTableau.childNodes[8].style.color = "#333";
		rowTableau.childNodes[8].style.fontWeight = "";

	}



}
