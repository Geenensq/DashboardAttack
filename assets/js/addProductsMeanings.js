function addProductsMeanings($id_product, $id_meaning) {
	let url = "addProductsMeanings.html"
	let form = {
		id_product: $id_product,
		id_meaning: $id_meaning
	};
	let products_meanings = send_post(form, url);

};
