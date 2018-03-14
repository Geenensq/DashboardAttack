$(document).ready(function () {
	$("#form_add_states").submit(function () {
		name_states = $(this).find("input[name=name_states]").val();
		url = "addStates.html"
		$.post(
			url, {
				name_states: name_states
			},
			function (data) {
				if (data.confirm == "success") {
					/*Call notifications*/
					notify(
						"pe-7s-refresh-2", "<b>Informations : </b> Le status à été ajouté avec succès !", "info"
                    );
                    
					$("#name_states").val("");
					$("#tab_management_states").DataTable().ajax.reload();
				} else if (data.confirm == "error") {
					/*Call notifications*/
					notify(
						"pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger"
					);
				}
			},
			"json"
		);
		return false;
	});
});
