$(document).ready(function () {
	$("#modal_update_states").submit(function () {

		id_state = $(this).find("input[name=id_state]").val();
		new_name_state = $(this).find("input[name=new_name_state]").val();

		url = "editStatesMethods.html";

		$.post(url, {
			id_state: id_state,
			new_name_state: new_name_state
		}, function (data) {

			if (data.confirm == "success") {

				notify("pe-7s-refresh-2", "<b>Informations</b> : La status de commande à été modifier avec succès ", "info");

				$('#new_name_state').val('');
				$('#modal_update_states').modal('hide');
				$('#tab_management_states').DataTable().ajax.reload();


			} else if (data.confirm == "error") {
				notify("pe-7s-refresh-2", "<b>Erreur</b> : Les champs n'ont pas été correctement renseignés", "danger");
			}
		}, "json");
		return false;
	});


});
