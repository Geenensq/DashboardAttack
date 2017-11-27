
    function takeIdForChangeName($id,$name){
    $("#idGroupCustomer").val($id);
    }
    
    $(document).ready(function() {
            $("#modalUpdateNameGroupCustomer").submit(function(){
                idGroupCustomer = $(this).find("input[name=idGroupCustomer]").val();
                newNameGroupCustomer = $(this).find("input[name=newNameGroupCustomer]").val();
                url = $(this).attr("action");
                $.post(url,{idGroupCustomer: idGroupCustomer , newNameGroupCustomer:newNameGroupCustomer},function(data){

                    if (data.confirm == "success") {
                 
                    notify("pe-7s-refresh-2","<b>Informations</b> : Le nom du groupe à été modifier avec succès ","info");
                    $('#newNameGroupCustomer').val('');
                    $('#modalUpdate').modal('hide');
                    $('#testLoad').DataTable().ajax.reload();


                } else if (data.errorNewNameGroup == "error") {
                     notify("pe-7s-refresh-2","<b>Erreur</b> : Le nom du groupe doit comporter au moins 3 caractères","danger");
                }
                }, "json");
                return false;
            });


    });
