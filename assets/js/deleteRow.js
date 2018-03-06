function deleteRow($row, $id_product, $id_size, $id_color, $qte) {

	let new_price;
	let id_order = $("#current_id_order").val();


	/*SUPPRESION DE LA LIGNE DANS LA VUE*/
	$("#ligne" + $row).remove();
	/**************************/


	/*On apelle la méthode qui récupère les informations de mon produit AVANT de le supprimer pour mettre à jour mon prix**/
	var product = getProductFordelete($id_product, $id_size, id_order, $id_color);
	/*********************************************************************************************************************/

	// Une fois le produit récupérer je récupère le prix actuel de la commande je le traite en float//
	var current_price = $("#current_order_price").val();
	var current_price = parseFloat(current_price).toFixed(2);
	/***********************************************************************************************/

	// Ensuite je récupère le prix du produit de la taille multiplié par le nombre de fois ou il est dans la commande et je le traite en float//
	var product_price = (parseFloat(product.base_price) + parseFloat(product.size_price) * parseFloat(product.quantity_product));
	var product_price = product_price.toFixed(2);
	console.log(product_price);
	/********************************************************************************************************************************************/

	
	
	/* APPEL DE LA FONCTION POUR SUPPRIMER LE PRODUIT TAILLE ET LE PRODUIT COULEUR DE LA COMMANDE*/
	deleteProductsDatabase($id_product, id_order, $id_size, $id_color);
	/**********************************************************************************************/





	/************************UPDATE THE PRICE OF ORDER IN DB**************************/
	// priceUpdateDatabase(id_order, new_price);
	/**********************************************************************************/
}

function deleteProductsDatabase($id_product, $id_order, $id_size, $id_color) {
	let url = "removeProductsOrders.html";
	let form = {
		id_product: $id_product,
		id_order: $id_order,
		id_size: $id_size,
		id_color: $id_color
	};
	let result_delete = send_post(form, url);

	if (result_delete.confirm == "success") {
		notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été supprimé de la commande avec succès !", "info");
	}
}



function getProductFordelete($id_product, $id_size, $id_order, $id_color) {
	var id_order = $id_order;
	var id_product = $id_product;
	var id_size = $id_size;
	var id_color = $id_color;

	let url = "getInfosProductsArray.html";
	let form = {
		id_product: id_product,
		id_color: id_color,
		id_size: id_size,
		id_order: id_order
	};
	product = send_post(form, url);
	return product;
}
