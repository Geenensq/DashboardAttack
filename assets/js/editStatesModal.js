function editStatesModal($id) {
	url = "getInfosStatesModal.html";
	// on declare un formulaire
	var form = {
		id: $id
	};

	//on post
	var state = send_post(form, url);

	$('#id_state').val(state.id_state);
	$('#new_name_state').val(state.name_state);


}
