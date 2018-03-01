$(document).ready(function() {
    $("#modal_update_colors").submit(function() {
        id_color = $(this).find("input[name=id_color]").val();
        new_name_color = $(this).find("input[name=new_name_color]").val();
        new_code_color = $(this).find("input[name=new_code_color]").val();
        new_group_color = $("#new_group_color").val();

        /* url = $(this).attr("action");*/
        url = "changeNameColors.html";
        $.post(url, {
            id_color:id_color,
            new_name_color:new_name_color,
            new_code_color:new_code_color,
            new_group_color:new_group_color

        }, function(data) {
            console.log(data);
            
            if (data.confirm == "success") {

                notify("pe-7s-refresh-2", "<b>Informations</b> : Le coloris à été modifier avec succès ", "info");

                $('#id_color').val('');
                $('#new_name_color').val('');
                $('#new_code_color').val('');
                $('#new_group_color').val('');
                $('#modal_update_colors').modal('hide');
                $('#tab_colors').DataTable().ajax.reload();


            } else if (data.errorNewNameColor == "error") {

                notify("pe-7s-refresh-2", "<b>Erreur</b> : Le nom du groupe doit comporter au moins 3 caractères", "danger");

            }
        }, "json");
        return false;
    });


});


