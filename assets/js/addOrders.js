function addOrders() {

	var form = {
		customer_order: $("#customer_order").val(),
		date_order: $("#date_order").val(),
		state_order: $("#state_order").val(),
		shipping_order: $("#shipping_order").val(),
		payments_order: $("#payments_order").val(),
		comment_order: $("#comment_order").val()
	}

	url = "addOrders.html"

	var orders = send_post(form, url);
	$("#current_id_order").val(orders["id_order"]);

}
