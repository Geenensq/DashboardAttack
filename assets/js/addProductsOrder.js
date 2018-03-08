function addProductsOrder($id_order, $qte, $id_size, $id_color, $id_product_order, $id_meaning) {
	let url = "addProductsOrders.html"
	let form = {
		id_product_order: $id_product_order,
		quantity_product_order: $qte,
		id_order: $id_order,
		id_size: $id_size,
		id_color: $id_color,
		id_meaning: $id_meaning

	};
	let products_orders = send_post(form, url);
};
