function editCustomersModal($id) {
	url = "getInfosCustomersModal.html";
	// on declare un formulaire
	var form = {
		id: $id
	};
	//on post
	var customer = send_post(form, url);
	$('#id_customer').val(customer.id_customer);
	$('#new_firstname_customer').val(customer.firstname);
	$('#new_name_customer').val(customer.lastname);
	$('#new_mobil_phone_customer').val(customer.mobil_phone_number);
	$('#new_phone_customer').val(customer.phone_number);
	$('#new_mail_customer').val(customer.mail);
	$('#new_address_customer').val(customer.address);
	$('#new_cp_customer').val(customer.zip_code);
	$('#new_city_customer').val(customer.city);
	$("#new_group_customer").val(customer.id_group_customer);

}
