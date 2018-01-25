$("#form_add_products").submit(function(e){
e.preventDefault();
                        var formData = new FormData($(this)[0]);
                        $.ajax({
                            url: 'addProducts.html',
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
                               
                                } else {
                                    notify("pe-7s-refresh-2", "<b>Informations : </b>Tous les champs doivent être remplis", "danger");
                                }
                            }
                        });
                    });