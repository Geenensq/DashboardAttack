$(document).ready(function () {
	$("#form_add_groups_colors").submit(function () {
		name_group_colors = $(this).find("input[name=name_group_colors]").val();

		url = $(this).attr("action");
		$.post(url, {
			name_group_colors: name_group_colors,

		}, function (data) {
			if (data.confirm == "success") {

				/*Call notifications*/
				notify("pe-7s-refresh-2", "<b>Informations : </b> Le groupe de couleurs à été ajouté avec succès !", "info");
				$('#name_group_colors').val('');
				$('#tab_groups_colors').DataTable().ajax.reload();



			} else if (data.confirm == "error") {
				/*Call notifications*/
				notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

			}
		}, "json");
		return false;
	});

});
