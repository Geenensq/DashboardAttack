function deleteRow($row, $id_product, $id_size, $id_color, $qte) {

	var id_order = $("#current_id_order").val();


	/*SUPPRESION DE LA LIGNE DANS LA VUE*/
	$("#ligne" + $row).remove();
	/**************************/


	/*On apelle la méthode qui récupère les informations de mon produit AVANT de le supprimer pour mettre à jour mon prix**/
	var product = getProductFordelete($id_product, $id_size, id_order, $id_color);
	/*********************************************************************************************************************/

	// On apelle la fonction qui nous calcule prix de la commande après la suppression du produit//
	var new_price = decrementPrice(product);
	var new_price = parseFloat(new_price).toFixed(2);
	/*******************************************************************************************/

	//**Appel de la fonction pour mettre à jour le prix dans la vue**//
	priceUpdateView(new_price);
	//************************************************************//

	//**Appel de la fonction pour mettre à jour le prix dans la base de donnée**//
	priceUpdateDatabase(id_order, new_price);
	/**********************************************************************************/

	/* APPEL DE LA FONCTION POUR SUPPRIMER LE PRODUIT TAILLE ET LE PRODUIT COULEUR DE LA COMMANDE DANS LA BASE DE DONNEES*/
	deleteProductsDatabase($id_product, id_order, $id_size, $id_color);
	/***********************************************************************************************************************/

}

function deleteProductsDatabase($id_product, $id_order, $id_size, $id_color) {
	var url = "removeProductsOrders.html";
	var form = {
		id_product: $id_product,
		id_order: $id_order,
		id_size: $id_size,
		id_color: $id_color
	};

	var result_delete = send_post(form, url);

	if (result_delete.confirm == "success") {
		notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été supprimé de la commande avec succès !", "info");
	}
}



function getProductFordelete($id_product, $id_size, $id_order, $id_color) {
	var id_order = $id_order;
	var id_product = $id_product;
	var id_size = $id_size;
	var id_color = $id_color;

	var url = "getInfosProductsArray.html";
	var form = {
		id_product: id_product,
		id_color: id_color,
		id_size: id_size,
		id_order: id_order
	};
	product = send_post(form, url);
	return product;
}
