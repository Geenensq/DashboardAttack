function checkProductInOrders($id_product, $id_order, $id_color, $id_size) {
	url = "checkProductInOrders.html";
	form = {
		id_order: $id_order,
		id_product_check: $id_product,
		id_color: $id_color,
		id_size: $id_size

	};
	product_checked = send_post(form, url);
	return product_checked;
}
