$(document).ready(function () {
	$("#form_add_colors").submit(function () {
		color_name = $(this).find("input[name=color_name]").val();
		color_code = $(this).find("input[name=color_code]").val();
		name_group_for_color = $("#name_group_for_color").val();

		url = $(this).attr("action");
		$.post(
			url, {
				color_name: color_name,
				color_code: color_code,
				name_group_for_color: name_group_for_color
			},
			function (data) {
				if (data.confirm == "success") {
					/*Call notifications*/
					notify(
						"pe-7s-refresh-2", "<b>Informations : </b> Le coloris à été ajouté avec succès !", "info"
					);
					$("#color_name").val("");
					$("#tab_colors").DataTable().ajax.reload();
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
