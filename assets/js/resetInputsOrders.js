// Fonction qui permet de remettre à 0 les champs du formulaire apres la valisation
function resetInputsOrders() {
	$('input').each(function () {
		let input = this;
		let name_input = $(input).attr("name");

		if (name_input == "current_id_order") {
			$(input).val(0);
		} else if (name_input == "tab_orders_length") {
			return;
		} else if (name_input == "current_order_price") {
			$(input).val(0);
		} else if (name.input == "qte_product_order") {

			$(input).val('1');
		} else {
			$(input).val('1');
		}


	})

	$('select').each(function () {
		let select = this;
		let name_select = $(select).attr("name");
		if (name_select === "tab_orders_length") {
			return;
		} else {
			$(select).val(0).change();
		}

	})

}
