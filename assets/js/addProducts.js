$("#form_add_products").submit(function (e) {
	e.preventDefault();
	var formData = new FormData($(this)[0]);
	$.ajax({
		url: 'addProducts.html',
		type: 'POST',
		dataType: 'json',
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		data: formData,
		success: function (data) {
			if (data.confirm == "success") {
				notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été ajouté avec succès !", "info");
				$("#product_name").val('');
				$("#product_ref").val('');
				$("#product_desc").val('');
				$("#product_price").val('');
				$("#product_color").val('');
				$("#product_group").val('');
				$("#product_size").val('');

				$('#tab_products').DataTable().ajax.reload();

			} else if (data.confirm == "error") {
				notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

			} else if (data.confirm == "errorformat") {

				notify("pe-7s-refresh-2", "<b>Informations : </b>Le format de l'image n'est pas correct !", "danger");
			}
		}
	});
});
