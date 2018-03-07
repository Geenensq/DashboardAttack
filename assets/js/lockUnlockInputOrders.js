// Fonction qui vérouille les inputs et les select de la commande sauf certainnes exceptions//
function lockInputOrder() {
	$('#form_add_order select').each(function () {
		let select = this;
		let name_select = $(select).attr("name");

		if (name_select != "select_product_order") {
			if (name_select != "select_size_product") {
				if (name_select != "select_color_product") {
					if (name_select != "tab_orders_length") {
						$(select).attr("disabled", true);
					} else {
						return;
					}
				}
			}

		}
	});

	$('#form_add_order input').each(function () {
		let input = this;
		name_input = $(input).attr("name");
		type_input = $(input).attr("type");

		if (name_input != "qte_product_order") {
			if (type_input != "search") {
				$(input).attr("disabled", true);
			} else {
				return;
			}

		} else {
			return;
		}
	});
}

/***************************************************************************/


// Fonction qui dévérouille les inputs de la commande sauf certainnes exceptions//
function unlockInputOrder() {

	$('#form_add_order select').each(function () {
		let select = this;
		let name_select = $(select).attr("name");
		$(select).attr("disabled", false);

	});

	$('#form_add_order input').each(function () {
		let input = this;

		name_input = $(input).attr("name");

		if (name_input != "current_order_price") {
			$(input).attr("disabled", false);
		} else {
			$(input).attr("disabled", true);
		}

	});

}
/***************************************************************************/
