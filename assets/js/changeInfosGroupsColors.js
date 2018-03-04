$(document).ready(function() {
    $("#modal_update_groups_colors").submit(function() {
        new_id_group_color = $(this).find("input[name=new_id_group_color]").val();
        new_name_group_colors = $(this).find("input[name=new_name_group_colors]").val();
       /* url = $(this).attr("action");*/
        url = "changeNameGroupsColors.html";
        $.post(url, {
            new_id_group_color: new_id_group_color,
            new_name_group_colors: new_name_group_colors
        }, function(data) {

            if (data.confirm == "success") {

                notify("pe-7s-refresh-2", "<b>Informations</b> : Le nom du groupe à été modifier avec succès ", "info");
                $('#new_name_group_colors').val('');
                $('#modal_update_groups_colors').modal('hide');
                $('#tab_groups_colors').DataTable().ajax.reload();


            } else if (data.errorNewNameGroup == "error") {
                notify("pe-7s-refresh-2", "<b>Erreur</b> : Le nom du groupe doit comporter au moins 3 caractères", "danger");
            }
        }, "json");
        return false;
    });


});


