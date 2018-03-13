function editPaymentsModal($id) {
	url = "getInfosPaymentsModal.html";
	// on declare un formulaire
	var form = {
		id: $id
	};

	//on post
	var payment = send_post(form, url);

	$('#id_method_payment').val(payment.id_method_payment);
	$('#new_name_method_payment').val(payment.name_method_payment);


}
