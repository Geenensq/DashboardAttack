$("#modal_update_name_products").submit(function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: 'changeNameProducts.html',
        type: 'POST',
        dataType: 'json',
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
            if(data.confirm=="success")
            {
               notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été ajouté avec succès !", "info");
               $('#tab_products').DataTable().ajax.reload();
               $('#modal_update_products').modal('hide');

           } else if(data.confirm=="error") {
            notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");

        } else if(data.confirm=="errorformat"){
             notify("pe-7s-refresh-2", "<b>Informations : </b>L'image n'a pas été mises à jour, vous n'avez pas utilisez le bon format", "danger");
             $('#tab_products').DataTable().ajax.reload();
             $('#modal_update_products').modal('hide');
        }


    }
});
});


