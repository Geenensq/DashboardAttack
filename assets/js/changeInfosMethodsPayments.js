$(document).ready(function () {
	$("#modal_update_payment").submit(function () {

		id_method_payment = $(this).find("input[name=id_method_payment]").val();
		new_name_method_payment = $(this).find("input[name=new_name_method_payment]").val();

		url = "editPaymentsMethods.html";

		$.post(url, {
			id_method_payment: id_method_payment,
			new_name_method_payment: new_name_method_payment
		}, function (data) {

			if (data.confirm == "success") {

				notify("pe-7s-refresh-2", "<b>Informations</b> : La méthode de paiment à été modifier avec succès ", "info");

				$('#new_name_method_payment').val('');
				$('#modal_update_payment').modal('hide');
				$('#tab_management_payments').DataTable().ajax.reload();


			} else if (data.confirm == "error") {
				notify("pe-7s-refresh-2", "<b>Erreur</b> : Les champs n'ont pas été correctement renseignés", "danger");
			}
		}, "json");
		return false;
	});


});
