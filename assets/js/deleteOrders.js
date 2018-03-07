function deleteOrders($id) {
	url = "removeOrders.html";
	var form = {
		id: $id
	};
	var orders = send_post(form, url);

	$('#tab_orders').DataTable().ajax.reload();
	notify("pe-7s-refresh-2", "<b>Informations : </b> La commande à été supprimer avec succès !", "info");

}
