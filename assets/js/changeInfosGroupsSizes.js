$(document).ready(function() {
    $("#modal_update_groups_sizes").submit(function() {
        new_id_group_sizes = $(this).find("input[name=new_id_group_sizes]").val();
        new_name_group_sizes = $(this).find("input[name=new_name_group_sizes]").val();
        url = "changeNameGroupSizes.html";
        $.post(url, {
            new_id_group_sizes: new_id_group_sizes,
            new_name_group_sizes: new_name_group_sizes
        }, function(data) {

            if (data.confirm == "success") {

                notify("pe-7s-refresh-2", "<b>Informations</b> : Le nom du groupe à été modifier avec succès ", "info");
                $('#new_name_group_sizes').val('');
                $('#modal_update_groups_sizes').modal('hide');
                $('#tab_groups_sizes').DataTable().ajax.reload();


            } else if (data.errorNewNameGroup == "error") {
                notify("pe-7s-refresh-2", "<b>Erreur</b> : Le nom du groupe doit comporter au moins 1 caractères", "danger");
            }
        }, "json");
        return false;
    });


});


