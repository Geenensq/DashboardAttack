var btn_edit_groups_colors = document.getElementById("btn_edit_groups_colors");
var btn_edit_colors = document.getElementById("btn_edit_colors");

var btn_add_colors = document.getElementById('btn_add_colors');
var btn_update_colors = document.getElementById('btn_update_colors');

btn_edit_groups_colors.addEventListener("click", expandPanelGroupsColors, false);
btn_edit_colors.addEventListener("click", expandPanelColors, false);

btn_add_colors.addEventListener("click", addColors, false);
btn_update_colors.addEventListener("click", updateColors, false);



function expandPanelGroupsColors() {
	//---if the div of the edition is open or closed we change the text of the button---//
	if ($("#collapse_edit_groups_colors").is(":visible") == true) {
		$("#btn_edit_groups_colors").text("Editer les groupes de couleurs");
		$("#btn_add_group_colors").attr("disabled", false);
	} else {
		$("#btn_edit_groups_colors").text("Annuler l'édition");
		$("#btn_add_group_colors").attr("disabled", true);
	}
}



function expandPanelColors() {
	if ($("#collapse_edit_colors").is(":visible") == true) {

		$("#btn_edit_colors").text("Editer les couleurs");
		$("#btn_add_colors").attr("disabled", false);
	} else {
		$("#btn_edit_colors").text("Annuler l'édition");
		$("#btn_add_colors").attr("disabled", true);

	}
}


/**
 *Function for add an colors 
 */
function addColors() {
	//---Defines constant for errors and success messages---// 
	const confirm = "<b>Informations : </b> Le coloris à été ajouté avec succès !";
	const error = "<b>Informations : </b>Tous les champs doivent être remplis";

	//---Create my object---//
	let color = new Colors();
	color.setName(document.getElementById("color_name").value);
	color.setCode(document.getElementById("color_code").value);
	color.setGroup(document.getElementById("name_group_for_color").value);
	color.setUrl(document.getElementById('form_add_colors').action);
	//---Use method create for create my color---//
	let result = color.create();

	if (result.confirm == "success") {

		notify("pe-7s-refresh-2", confirm, "info");
		document.getElementById("color_name").value = "";
		$("#tab_colors").DataTable().ajax.reload();

	} else {

		notify("pe-7s-refresh-2", error, "danger");
	}

}


/**
 * Function for update an colors
 */
function updateColors() {
	//---Defines constant for errors and success messages---// 
	const confirm = "<b>Informations</b> : Le coloris à été modifier avec succès";
	const error = "<b>Erreur</b> : Le nom du groupe doit comporter au moins 3 caractères";

	//---Create my object---//
	let color = new Colors();
	color.setId(document.getElementById("id_color").value);
	color.setName(document.getElementById("new_name_color").value);
	color.setCode(document.getElementById("new_code_color").value);
	color.setGroup(document.getElementById("new_group_color").value);
	color.setUrl("changeNameColors.html");

	//---Use method update for update my color---//
	let result = color.update();

	//---conditions depending on the return of the request ajax---//
	if (result.confirm == "success") {

		notify("pe-7s-refresh-2", confirm, "info");
		document.getElementById("id_color").value = "";
		document.getElementById("new_name_color").value = "";
		document.getElementById("new_code_color").value = "";
		document.getElementById("new_group_color").value = "";
		$('#modal_update_colors').modal('hide');
		$('#tab_colors').DataTable().ajax.reload();

	} else {

		notify("pe-7s-refresh-2", error, "danger");
	}
}


/**
 * Function for load an colors
 */
function loadColors(id_color) {
	let color = new Colors();
	color.setId(id_color);
	color.setUrl("getInfosColorsModal.html");
	let result = color.load();

	document.getElementById("id_color").value = result.id_color;
	document.getElementById("new_name_color").value = result.color_name;
	$('#new_code_color').minicolors('value', result.color_code);
	document.getElementById("new_group_color").value = result.id_group_color;
}







$(document).ready(function () {

	var colpick = $('.color_pick').each(function () {
		$(this).minicolors({
			control: $(this).attr('data-control') || 'hue',
			inline: $(this).attr('data-inline') === 'true',
			letterCase: 'lowercase',
			opacity: false,
			change: function (hex, opacity) {
				if (!hex) return;
				if (opacity) hex += ', ' + opacity;
				try {

				} catch (e) {}
				$(this).select();
			},
			theme: 'bootstrap'
		});
	});


	$('#tab_colors').DataTable({
		ajax: "encodeGridColors.html",
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
				data: 4
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

		],

		//L'afficharge par defaut des collones de Datatable
		//Data represente dans ce cas les data de chaque ligne

		columnDefs: [

			{
				"targets": 4,
				render: function (data, full) {
					return '<button type="button" onclick="loadColors(' + data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_colors">Edition </button>'
				}
			},
			{
				"targets": 5,
				render: function (data, full) {
					return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' + '\'' + "changeStatusColors.html" + '\'' + ',' + '\'' + "#tab_colors" + '\'' + ')' + '"' + ' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'
				}
			},
			{
				"targets": 6,
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

	$('#tab_groups_colors').DataTable({
		ajax: "encodeGridGroupsColors.html",
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
					return '<button type="button" onclick="editGroupsColorsModal(' + data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_groups_colors">Edition </button>'
				}
			},
			{
				"targets": 3,
				render: function (data, full) {
					return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' + '\'' + "changeStatusGroupsColors.html" + '\'' + ',' + '\'' + "#tab_groups_colors" + '\'' + ')' + '"' + ' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'
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




});
