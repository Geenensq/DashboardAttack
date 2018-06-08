//---Declaration of DOM variables---//
var btn_add_group_colors = document.getElementById("btn_add_group_colors");
var btn_update_groups_colors = document.getElementById("btn_update_groups_colors");

//---Declaration of  events to the event handler---/
btn_add_group_colors.addEventListener("click", addGroupColors, false);
btn_update_groups_colors.addEventListener("click", updateGroupColors, false);


/**
 *Function for add an group of colors 
 */
function addGroupColors() {
	//---Defines constant for errors and success messages---// 
	const confirm = "<b>Informations : </b> Le groupe de couleurs à été ajouté avec succès !";
	const error = "<b>Informations : </b>Tous les champs doivent être remplis";
	//---Create my object---//
	let groupColors = new GroupsColors();
	groupColors.setName(document.getElementById("name_group_colors").value);
	groupColors.setUrl(document.getElementById('form_add_groups_colors').action);

	//---Use method create for create my color---//
	let result = groupColors.create();

	if (result.confirm == "success") {
		notify("pe-7s-refresh-2", confirm, "info");
		document.getElementById("name_group_colors").value = "";
		$("#tab_groups_colors").DataTable().ajax.reload();

	} else {
		notify("pe-7s-refresh-2", error, "danger");
	}
}


/**
 * Function for update an group colors
 */
function updateGroupColors() {
	//---Defines constant for errors and success messages---// 
	const confirm = "<b>Informations</b> : Le nom du groupe à été modifier avec succès";
	const error = "<b>Erreur</b> : Le nom du groupe doit comporter au moins 3 caractères";

	//---Create my object---//
	let groupColors = new GroupsColors();

	groupColors.setId(document.getElementById("new_id_group_color").value);
	groupColors.setName(document.getElementById("new_name_group_colors").value);
	groupColors.setUrl("changeNameGroupsColors.html");

	//---Use method update for update my color---//
	let result = groupColors.update();

	//---conditions depending on the return of the request ajax---//
	if (result.confirm == "success") {

		notify("pe-7s-refresh-2", confirm, "info");
		document.getElementById("new_name_group_colors").value = "";
		$('#modal_update_groups_colors').modal('hide');
		$('#tab_groups_colors').DataTable().ajax.reload();

	} else {

		notify("pe-7s-refresh-2", error, "danger");
	}
}


/**
 * Function for load an group of colors
 */
function loadGroupColors(id_group_colors) {
	let groupColors = new GroupsColors();
	groupColors.setId(id_group_colors);
	groupColors.setUrl("getInfosGroupsColorsModal.html");
	let result = groupColors.load();
	document.getElementById("new_id_group_color").value = result.id_group_color;
	document.getElementById("new_name_group_colors").value = result.name_group_color;
}