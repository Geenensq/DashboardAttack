$(document).ready(function () {
	$("#modal_update_shipping").submit(function () {

		id_method_shipping = $(this).find("input[name=id_method_shipping]").val();
        new_name_method_shipping = $(this).find("input[name=new_name_method_shipping]").val();
        new_price_method_shipping = $(this).find("input[name=new_price_method_shipping]").val();
        
        url = "editShippingsMethods.html";
        
        $.post(url, {
			id_method_shipping: id_method_shipping,
            new_name_method_shipping: new_name_method_shipping,
            new_price_method_shipping: new_price_method_shipping
    }, function (data) {

			if (data.confirm == "success") {

				notify("pe-7s-refresh-2", "<b>Informations</b> : La méthode de livraison à été modifier avec succès ", "info");
                
                $('#new_name_method_shipping').val('');
                $('#new_price_method_shipping').val('');

				$('#modal_update_shipping').modal('hide');
				$('#tab_management_shipping').DataTable().ajax.reload();


			} else if (data.confirm == "error") {
				notify("pe-7s-refresh-2", "<b>Erreur</b> : Les champs n'ont pas été correctement renseignés", "danger");
			}
		}, "json");
		return false;
	});


});
