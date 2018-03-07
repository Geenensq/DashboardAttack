$(document).ready(function () {
	$("#changeInfosMembersModal").submit(function () {

		id_member = $(this).find("input[name=id_member]").val();
		login_member = $(this).find("input[name=login_member]").val();
		email_member = $(this).find("input[name=email_member]").val();
		new_group_member = $("#new_group_member").val();

		/* url = $(this).attr("action");*/
		url = "changeInfosMembersModal.html";
		$.post(url, {
			id_member: id_member,
			login_member: login_member,
			email_member: email_member,
			new_group_member: new_group_member

		}, function (data) {
			console.log(data);

			if (data.confirm == "success") {

				notify("pe-7s-refresh-2", "<b>Informations</b> : La membre à été modifier avec succès ! ", "info");

				$('#id_member').val('');
				$('#login_member').val('');
				$('#email_member').val('');
				$('#new_group_member').val('');
				$('#modal_update_members').modal('hide');
				$('#tab_management').DataTable().ajax.reload();


			} else if (data.errorNewNameSize == "error") {

				notify("pe-7s-refresh-2", "<b>Erreur</b> : Les champs ne sont pas correctement remplis", "danger");

			}
		}, "json");
		return false;
	});


});
