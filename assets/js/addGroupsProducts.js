$(document).ready(function() {
    $("#form_add_groups_products").submit(function() {
        name_group_products = $(this).find("input[name=name_group_products]").val();
        description_group_products = $(this).find("input[name=description_group_products]").val();
        url = "addGroupProducts.html"
        $.post(url, {
            name_group_products:name_group_products,
            description_group_products:description_group_products,

        }, function(data) {
            if (data.confirm == "success") {

                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b> Le groupe de produits à été ajouté avec succès !", "info");
                $('#name_group_products').val('');
                $('#description_group_products').val('');


            } else if (data.confirm == "error") {
                /*Call notifications*/
                notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

            }
        }, "json");
        return false;
    });

});