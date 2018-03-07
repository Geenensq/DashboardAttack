$(document).ready(function () {
	$("#modal_update_name_group_products").submit(function () {
		new_id_group_products = $(this).find("input[name=new_id_group_products]").val();
		new_name_group_products = $(this).find("input[name=new_name_group_products]").val();
		new_desc_group_products = $(this).find("input[name=new_desc_group_products]").val();
		/* url = $(this).attr("action");*/
		url = "changeNameGroupsProducts.html";
		$.post(url, {
			new_id_group_products: new_id_group_products,
			new_name_group_products: new_name_group_products,
			new_desc_group_products: new_desc_group_products
		}, function (data) {

			if (data.confirm == "success") {

				notify("pe-7s-refresh-2", "<b>Informations</b> : Le nom du groupe à été modifier avec succès ", "info");
				$('#new_name_group_products').val('');
				$('#new_desc_group_products').val('');
				$('#modal_update_groups_products').modal('hide');

				$('#tab_groups_products').DataTable().ajax.reload();


			} else if (data.errorNewNameGroup == "error") {
				notify("pe-7s-refresh-2", "<b>Erreur</b> : Le nom du groupe doit comporter au moins 3 caractères", "danger");
				console.log(new_desc_group_products);
			}
		}, "json");
		return false;
	});


});
