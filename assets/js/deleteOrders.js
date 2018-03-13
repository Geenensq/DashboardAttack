function confirmDelCmd($id_order) {

    $.confirm({
        boxWidth: '30%',
        icon: 'fa fa-warning',
        title: 'Suppression de la commande',
        content: 'Voulez vous supprimer la commande ?',
        type: 'blue',
        buttons: {
            Suppression: function() {
                deleteOrders($id_order);
            },
            Annulez: function() {
                $.alert('Votre commande n\'a pas été supprimée');
            },
        }
    });

}


function deleteOrders($id) {
	url = "removeOrders.html";
	var form = {
		id: $id
	};
	var orders = send_post(form, url);

	$('#tab_orders').DataTable().ajax.reload();
	notify("pe-7s-refresh-2", "<b>Informations : </b> La commande à été supprimer avec succès !", "info");

}
