       //-------------------------At the user's click-------------------------------------------//
	   $("#btn_edit_shipping").click(function () {
		//---if the div of the edition is open or closed we change the text of the button---//
		if ($("#collapse_edit_shipping_method").is(":visible") == true) {
			$("#btn_edit_shipping").text("Editer les modes de livraisons");
			$("#btn_add_shipping").attr("disabled", false);
		} else {
			$("#btn_edit_shipping").text("Annuler l'édition");
			$("#btn_add_shipping").attr("disabled", true);
		}
	});
	//-------------------------------------------------------------------------------------//

	//-------------------------At the user's click-------------------------------------------//
	$("#btn_edit_payment").click(function () {
		//---if the div of the edition is open or closed we change the text of the button---//
		if ($("#collapse_edit_payments_method").is(":visible") == true) {
			$("#btn_edit_payment").text("Editer les modes de paiements");
			$("#btn_add_payment").attr("disabled", false);
		} else {
			$("#btn_edit_payment").text("Annuler l'édition");
			$("#btn_add_payment").attr("disabled", true);
		}
	});
	//-------------------------------------------------------------------------------------//
	 
	//-------------------------At the user's click-------------------------------------------//
	 $("#btn_edit_states").click(function () {
		//---if the div of the edition is open or closed we change the text of the button---//
		if ($("#collapse_edit_states").is(":visible") == true) {
			$("#btn_edit_states").text("Editer les status de commandes");
			$("#btn_add_states").attr("disabled", false);
		} else {
			$("#btn_edit_states").text("Annuler l'édition");
			$("#btn_add_states").attr("disabled", true);
		}
	});
	//-------------------------------------------------------------------------------------//
 
 $('#tab_management_shipping').DataTable({
 	ajax: "encodeGriShipping.html",
 	order: [
 		[0, "asc"]
 	],
 	"columns": [
 		//target 0 = collone 0 Datatable
 		//data 0 = le tableaux php à l'index 0
 		{
 			"targets": 0,
 			data: 0
 		},
 		{
 			"targets": 1,
 			data: 1
 		},
 		{
 			"targets": 2,
 			data: 2
 		},
 		{
 			"targets": 3,
 			data: null
 		},
 		{
 			"targets": 4,
 			data: null
 		},
 		{
 			"targets": 5,
 			data: null
 		}
 	],

 	//L'afficharge par defaut des collones de Datatable
 	//Data represente dans ce cas les data de chaque ligne

 	columnDefs: [

 		{
 			"targets": 3,
 			render: function (data, full) {
 				return '<button type="button" onclick="editShippingsMethodsModal(' + data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_shipping">Edition de la méthode de livraison </button>'
 			}
 		},
 		{
 			"targets": 4,
 			render: function (data, full) {
 				return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' + '\'' + "changeStatusShippingsMethods.html" + '\'' + ',' + '\'' + "#tab_management_shipping" + '\'' + ')' + '"' + ' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'
 			}
 		},
 		{
 			"targets": 5,
 			render: function (data, full) {

 				if (data[3] == 1) {
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'

 				} else if (data[3] == 0)

 				{
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
 				}

 			}
 		}


 	]

 });


 $('#tab_management_states').DataTable({
 	ajax: "encodeGridStates.html",
 	order: [
 		[0, "asc"]
 	],
 	"columns": [
 		//target 0 = collone 0 Datatable
 		//data 0 = le tableaux php à l'index 0
 		{
 			"targets": 0,
 			data: 0
 		},
 		{
 			"targets": 1,
 			data: 1
 		},
 		{
 			"targets": 2,
 			data: null
 		},
 		{
 			"targets": 3,
 			data: null
 		},
 		{
 			"targets": 4,
 			data: null
 		}

 	],

 	//L'afficharge par defaut des collones de Datatable
 	//Data represente dans ce cas les data de chaque ligne

 	columnDefs: [

 		{
 			"targets": 2,
 			render: function (data, full) {
 				return '<button type="button" onclick="editStatesModal(' + data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_states">Edition du status de la commande</button>'
 			}
 		},
 		{
 			"targets": 3,
 			render: function (data, full) {
 				return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' + '\'' + "changeStatusStates.html" + '\'' + ',' + '\'' + "#tab_management_states" + '\'' + ')' + '"' + ' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'
 			}
 		},
 		{
 			"targets": 4,
 			render: function (data, full) {

 				if (data[2] == 1) {
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'

 				} else if (data[2] == 0)

 				{
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
 				}

 			}
 		}
 	]

 });


 $('#tab_management_payments').DataTable({
 	ajax: "encodeGridPayments.html",
 	order: [
 		[0, "asc"]
 	],
 	"columns": [
 		//target 0 = collone 0 Datatable
 		//data 0 = le tableaux php à l'index 0
 		{
 			"targets": 0,
 			data: 0
 		},
 		{
 			"targets": 1,
 			data: 1
 		},
 		{
 			"targets": 2,
 			data: null
 		},
 		{
 			"targets": 3,
 			data: null
 		},
 		{
 			"targets": 4,
 			data: null
 		}

 	],

 	//L'afficharge par defaut des collones de Datatable
 	//Data represente dans ce cas les data de chaque ligne

 	columnDefs: [

 		{
 			"targets": 2,
 			render: function (data, full) {
 				return '<button type="button" onclick="editPaymentsModal(' + data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_payment">Edition de la méthode de paiement</button>'
 			}
 		},
 		{
 			"targets": 3,
 			render: function (data, full) {
 				return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' + '\'' + "changeStatusPaymentsMethods.html" + '\'' + ',' + '\'' + "#tab_management_payments" + '\'' + ')' + '"' + ' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'
 			}
 		},
 		{
 			"targets": 4,
 			render: function (data, full) {

 				if (data[2] == 1) {
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'

 				} else if (data[2] == 0)

 				{
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
 				}

 			}
 		}


 	]

 });




 $('#tab_management').DataTable({
 	ajax: "encodeGridMembers.html",
 	order: [
 		[0, "asc"]
 	],
 	"columns": [

 		//target 0 = collone 0 Datatable
 		//data 0 = le tableaux php à l'index 0 
 		{
 			"targets": 0,
 			data: 0
 		},
 		{
 			"targets": 1,
 			data: 1
 		},
 		{
 			"targets": 2,
 			data: 3
 		},
 		{
 			"targets": 3,
 			data: 5
 		},
 		{
 			"targets": 4,
 			data: null
 		},
 		{
 			"targets": 5,
 			data: null
 		},
 		{
 			"targets": 6,
 			data: null
 		},
 		{
 			"targets": 7,
 			data: null
 		}

 	],
 	//L'afficharge par defaut des collones de Datatable
 	//Data represente dans ce cas les data de chaque ligne
 	columnDefs: [

 		{
 			"targets": 4,
 			render: function (data, full) {
 				return '<button type="button" onclick="editMembersModal(' + data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_members">Edition du compte</button>';
 			}
 		},

 		{
 			"targets": 5,
 			render: function (data, full) {
 				return '<button type="button" onclick="editPasswordModal(' + data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_members_password" >Modifier le mot de passe du compte </button>';
 			}
 		},

 		{
 			"targets": 6,
 			render: function (data, full) {
 				return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' + '\'' + "changeStatusMembers.html" + '\'' + ',' + '\'' + "#tab_management" + '\'' + ')' + '"' + ' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>';
 			}
 		},

 		{
 			"targets": 7,
 			render: function (data, full) {

 				if (data[2] == 1) {
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'

 				} else if (data[2] == 0)

 				{
 					return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
 				}

 			}
 		}

 	]

 });
