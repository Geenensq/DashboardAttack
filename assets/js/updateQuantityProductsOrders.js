
// Fonction pour incrémenter la quantité produit size color dans la commande 
function AddQuantity($id_product, $row, $price_product, $id_size, $id_color) {

	var id_order = $("#current_id_order").val();
	// On récupère l'index du tableau html du nombre de produit
	var quantity_product = $row.cells[1];

	// On récupère la quantité du produit actuelle et on la parseFloat
	var current_quantity = parseFloat(quantity_product.innerHTML);

	// On affecte +1 à chaque click sur le boutton
	quantity_product.innerHTML = parseFloat(current_quantity + 1);

	// Appel de la fonction pour mettre à jour la quantité du product sizes et colors dans la base de donée
	updateQuantityProduct(id_order, $id_product, $id_color, $id_size, parseFloat(quantity_product.innerHTML));

	current_order_price = parseFloat($("#current_order_price").val());
	$("#current_order_price").val(parseFloat(current_order_price + $price_product));

	/*AJAX CALL FOR UPDATE THE PRICE*/
	priceUpdateDatabase(id_order, $("#current_order_price").val());
}
/***************************************************************************/



// Fonction pour décrémenter la quantité produit size color dans la commande 
function RemoveQuantity($id_product, $row, $price_product) {
	Quantity = $row.cells[1];
	actualQuantity = parseFloat(Quantity.innerHTML);
	if (actualQuantity <= 1) {
		notify("pe-7s-refresh-2", "<b>Erreur : </b> Vous devez obligatoirement au moins 1 exemplaire", "danger");

	} else {
		Quantity.innerHTML = actualQuantity - 1;

		updateQuantityProduct(id_order, $id_product, parseFloat(Quantity.innerHTML));

		current_order_price = parseFloat($("#current_order_price").val());
		$("#current_order_price").val(parseFloat(current_order_price - $price_product));

		/*AJAX CALL FOR UPDATE THE PRICE*/
		priceUpdateDatabase(id_order, $("#current_order_price").val());
	}
}
/********************************************************************************/




// Fonction pour mettre à jour dans la bdd le produit couleur size dans la commande
function updateQuantityProduct($id_order, $id_product, $id_color, $id_size, $new_quantity) {
	var url = "EditQuantityProducts.html"
	var form = {
		id_order: $id_order,
		id_product: $id_product,
		new_quantity: $new_quantity,
		id_size: $id_size,
		id_color: $id_color
	}

	send_post(form, url);
}
/************************************************************************************/
