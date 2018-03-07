$(document).ready(function () {
	$("#form_add_groups_sizes").submit(function () {
		name_group_sizes = $(this).find("input[name=name_group_sizes]").val();

		url = "addGroupsSizes.html"
		$.post(url, {
			name_group_sizes: name_group_sizes,

		}, function (data) {
			if (data.confirm == "success") {

				/*Call notifications*/
				notify("pe-7s-refresh-2", "<b>Informations : </b> Le groupe de tailles à été ajouté avec succès !", "info");
				$('#name_group_sizes').val('');
				$('#tab_groups_sizes').DataTable().ajax.reload();


			} else if (data.confirm == "error") {
				/*Call notifications*/
				notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

			}
		}, "json");
		return false;
	});

});
