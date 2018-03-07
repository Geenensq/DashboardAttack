$(function () {
	$('#customer_order').select2({
		language: "fr",
		minimumInputLength: 2,
		placeholder: 'Chercher un client',
		ajax: {
			url: 'getCustomersAutoComplete.html',
			dataType: 'json',
			delay: 250,

			processResults: function (data) {
				return {
					results: data
				};
			},
			cache: true
		}
	});


	$('#select_product_order').select2({
		minimumInputLength: 2,
		placeholder: 'Chercher un produit',
		ajax: {
			url: 'getProductsAutoComplete.html',
			dataType: 'json',
			delay: 250,

			processResults: function (data) {
				return {
					results: data
				};
			},
			cache: true
		}
	});

});
