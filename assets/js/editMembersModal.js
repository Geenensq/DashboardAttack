function editMembersModal($id) {

	url = "getInfosMembersModal.html";
	// on declare un formulaire
	var form = {
		id: $id
	};

	//on post
	var members = send_post(form, url);

	$('#id_member').val(members.id_member);
	$('#login_member').val(members.login);
	$('#email_member').val(members.email);
	$("#new_group_member").val(members.id_group_member);
}


function editPasswordModal($id) {
	$("#changePasswordMembers").submit(function () {

		id_member_password = $id;
		password_member = $(this).find("input[name=password_member]").val();
		password_member_confirmation = $(this).find("input[name=password_member_confirmation]").val();
		url = "changePasswordMembers.html";
		$.post(url, {
			password_member: password_member,
			password_member_confirmation: password_member_confirmation,
			id_member_password: id_member_password
		}, function (data) {

			if (data.confirm == "success") {

				notify("pe-7s-refresh-2", "<b>Informations</b> : Le mot de passe à été modifier avec succès ", "info");
				$('#password_member_confirmation').val('');
				$('#password_member').val('');
				$('#modal_update_members_password').modal('hide');

			} else if (data.errorPasswordConfirm == "error") {
				notify("pe-7s-refresh-2", "<b>Erreur</b> : Le mot de passe doit comporter au moins 3 caractères", "danger");

			}
		}, "json");
		return false;
	});
}
