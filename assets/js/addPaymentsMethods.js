$(document).ready(function () {
	$("#form_add_payments").submit(function () {
		name_method_payment = $(this).find("input[name=name_method_payment]").val();

		url = "addPaymentsMethod.html"
		$.post(url, {
			name_method_payment: name_method_payment

		}, function (data) {
			if (data.confirm == "success") {

				/*Call notifications*/
				notify("pe-7s-refresh-2", "<b>Informations : </b> Le mode de paiment à été ajouté avec succès !", "info");
				$('#tab_management_payments').DataTable().ajax.reload();
				$('#name_method_payment').val('');


			} else if (data.confirm == "error") {
				/*Call notifications*/
				notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

			}
		}, "json");
		return false;
	});

});
