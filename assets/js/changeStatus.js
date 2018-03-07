function ajaxChangeStatus($id, $url_controller, $data_table) {

	$url = $url_controller;

	$.post($url, {
		id: $id
	}, function (data) {}, "json");

	$($data_table).DataTable().ajax.reload();
}
