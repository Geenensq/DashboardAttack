function editShippingsMethodsModal($id) {
	url = "getInfosShippingModal.html";
	// on declare un formulaire
	var form = {
		id: $id
	};

	//on post
	var shipping = send_post(form, url);

	$('#id_method_shipping').val(shipping.id_method_shipping);
	$('#new_name_method_shipping').val(shipping.name_method_shipping);
	$('#new_price_method_shipping').val(shipping.price_method_shipping);


}