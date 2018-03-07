function editSizesModal($id) {

	url = "getInfosSizesModal.html";
	// on declare un formulaire
	var form = {
		id: $id
	};

	//on post
	var size = send_post(form, url);

	$('#new_id_sizes').val(size.id_size);
	$('#new_name_sizes').val(size.size_name);
	$('#new_price_sizes').val(size.price);
	$("#new_group_sizes").val(size.id_group_size);
}
