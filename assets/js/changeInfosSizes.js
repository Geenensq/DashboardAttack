$(document).ready(function() {
    $("#modal_update_sizes").submit(function() {
        new_id_sizes = $(this).find("input[name=new_id_sizes]").val();
        new_name_sizes = $(this).find("input[name=new_name_sizes]").val();
        new_price_sizes = $(this).find("input[name=new_price_sizes]").val();
        new_group_sizes = $("#new_group_sizes").val();

        /* url = $(this).attr("action");*/
        url = "changeNameSizes.html";
        $.post(url, {
            new_id_sizes: new_id_sizes,
            new_name_sizes: new_name_sizes,
            new_price_sizes: new_price_sizes,
            new_group_sizes: new_group_sizes

        }, function(data) {
            console.log(data);

            if (data.confirm == "success") {

                notify("pe-7s-refresh-2", "<b>Informations</b> : La taille à été modifier avec succès ", "info");

                $('#new_id_sizes').val('');
                $('#new_name_color').val('');
                $('#new_price_sizes').val('');
                $('#new_group_sizes').val('');
                $('#modal_update_sizes').modal('hide');
                $('#tab_sizes').DataTable().ajax.reload();


            } else if (data.errorNewNameSize == "error") {

                notify("pe-7s-refresh-2", "<b>Erreur</b> : Le nom de la taille comporter au moins 1 caractère", "danger");

            }
        }, "json");
        return false;
    });


});