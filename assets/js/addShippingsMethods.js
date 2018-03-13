    $(document).ready(function () {
    	$("#form_add_shipping").submit(function () {
    		name_method_shipping = $(this).find("input[name=name_method_shipping]").val();
    		price_method_shipping = $(this).find("input[name=price_method_shipping]").val();

    		url = "addShippingsMethods.html"
    		$.post(url, {
    			name_method_shipping: name_method_shipping,
    			price_method_shipping: price_method_shipping

    		}, function (data) {
    			if (data.confirm == "success") {

    				/*Call notifications*/
    				notify("pe-7s-refresh-2", "<b>Informations : </b> Le mode de livraison à été ajouté avec succès !", "info");
    				$('#tab_management_shipping').DataTable().ajax.reload();
    				$('#name_method_shipping').val('');
    				$('#price_method_shipping').val('');


    			} else if (data.confirm == "error") {
    				/*Call notifications*/
    				notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

    			}
    		}, "json");
    		return false;
    	});

    });
