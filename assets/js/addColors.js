$(document).ready(function() {
    $("#form_add_colors").submit(function() {
        name_color = $(this).find("input[name=name_color]").val();
        code_color = $(this).find("input[name=code_color]").val();
        name_group_for_color = $("#name_group_for_color").val();

        url = $(this).attr("action");
        $.post(url, {
            name_color:name_color,
            code_color:code_color,
            name_group_for_color:name_group_for_color

        }, function(data) {
            if (data.confirm == "success") {

                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b> Le coloris à été ajouté avec succès !", "info");

       

            } else if (data.confirm == "error") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");
     
            }
        }, "json");
        return false;
    });

});