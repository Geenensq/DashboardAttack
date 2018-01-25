$(document).ready(function() {

    $("#form_add_sizes").submit(function() {
        size_name = $(this).find("input[name=size_name]").val();
        size_price = $(this).find("input[name=size_price]").val();
        name_group_for_size = $("#name_group_for_size").val();

        url = "addSizes.html";
        $.post(url, {
            size_name:size_name,
            size_price:size_price,
            name_group_for_size:name_group_for_size

        }, function(data) {
            if (data.confirm == "success") {

                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b> La taille à été ajouté avec succès !", "info");
                $('#size_name').val('');
                $('#size_price').val('');
                $('#tab_sizes').DataTable().ajax.reload();
                

            } else if (data.confirm == "error") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");
                
            }
        }, "json");
        return false;
    });

});