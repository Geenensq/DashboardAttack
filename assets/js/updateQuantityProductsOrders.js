// Fonction pour incrémenter la quantité produit size color dans la commande 
function AddQuantity($id_product, $row, $price_product, $id_size, $id_color, $id_meaning) {

	var id_order = $("#current_id_order").val();
	// On récupère l'index du tableau html du nombre de produit
	var quantity_product = $row.cells[1];

	// On récupère la quantité du produit actuelle et on la parseFloat
	var current_quantity = parseFloat(quantity_product.innerHTML);

	// On affecte +1 à chaque click sur le boutton
	quantity_product.innerHTML = parseFloat(current_quantity + 1);

	// Appel de la fonction pour mettre à jour la quantité du product sizes et colors dans la base de donée
	updateQuantityProduct(id_order, $id_product, $id_color, $id_size, parseFloat(quantity_product.innerHTML), $id_meaning);

	current_order_price = parseFloat($("#current_order_price").val());
	var new_order_price = parseFloat(current_order_price + $price_product);

	// Appel de la fonction pour mettre à jour le prix de la commande dans la vue
	priceUpdateView(new_order_price);

	/*AJAX CALL FOR UPDATE THE PRICE*/
	priceUpdateDatabase(id_order, new_order_price);
}
/***************************************************************************/



// Fonction pour décrémenter la quantité produit size color dans la commande 
function RemoveQuantity($id_product, $row, $price_product, $id_size, $id_color, $id_meaning) {

	var id_order = $("#current_id_order").val();
	// On récupère l'index du tableau html du nombre de produit
	var quantity_product = $row.cells[1];

	// On récupère la quantité du produit actuelle et on la parseFloat
	var current_quantity = parseFloat(quantity_product.innerHTML);

	// Si l'utilisateur essaie de desecencre en dessous de 1 on affiche 1 message
	if (current_quantity <= 1) {
		notify("pe-7s-refresh-2", "<b>Erreur : </b> Vous devez obligatoirement au moins 1 exemplaire", "danger");

	} else {
		quantity_product.innerHTML = parseFloat(current_quantity - 1);

		// Appel de la fonction pour mettre à jour la quantité du product sizes et colors dans la base de donée
		updateQuantityProduct(id_order, $id_product, $id_color, $id_size, parseFloat(quantity_product.innerHTML), $id_meaning);

		var current_order_price = parseFloat($("#current_order_price").val());
		var new_order_price = parseFloat(current_order_price - $price_product);

		// Appel de la fonction pour mettre à jour le prix de la commande dans la vue
		priceUpdateView(new_order_price);

		/*AJAX CALL FOR UPDATE THE PRICE*/
		priceUpdateDatabase(id_order, new_order_price);
	}
}
/********************************************************************************/




// Fonction pour mettre à jour dans la bdd le produit couleur size dans la commande
function updateQuantityProduct($id_order, $id_product, $id_color, $id_size, $new_quantity, $id_meaning) {
	var url = "EditQuantityProducts.html";
	var form = {
		id_order: $id_order,
		id_product: $id_product,
		new_quantity: $new_quantity,
		id_size: $id_size,
		id_color: $id_color,
		id_meaning: $id_meaning
	}

	send_post(form, url);
}
/************************************************************************************/
