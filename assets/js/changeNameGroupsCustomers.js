
    function takeIdForChangeName($id,$name){
    $("#id_group_customer").val($id);
    }
    
    $(document).ready(function() {
            $("#modal_update_name_group_customer").submit(function(){
                id_group_customer = $(this).find("input[name=id_group_customer]").val();
                new_name_group_customer = $(this).find("input[name=new_name_group_customer]").val();
                url = $(this).attr("action");
                $.post(url,{id_group_customer: id_group_customer , new_name_group_customer:new_name_group_customer},function(data){

                    if (data.confirm == "success") {
                 
                    notify("pe-7s-refresh-2","<b>Informations</b> : Le nom du groupe à été modifier avec succès ","info");
                    $('#new_name_group_customer').val('');
                    $('#modal_update').modal('hide');
                    $('#tab_groups_customers').DataTable().ajax.reload();


                } else if (data.errorNewNameGroup == "error") {
                     notify("pe-7s-refresh-2","<b>Erreur</b> : Le nom du groupe doit comporter au moins 3 caractères","danger");
                }
                }, "json");
                return false;
            });


    });
