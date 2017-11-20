    $(document).ready(function(){
        $("#formAddGroupCustomers").submit(function(){
            name_group_customers = $(this).find("input[name=name_group_customers]").val();
            url = $(this).attr("action");
            $.post(url , {name_group_customers:name_group_customers} , function(data){
                if(data.confirm == "success"){
                    /*Call notifications*/
                    customersAddSuccess();
                    /*Delete content of the input*/
                    $('#name_group_customers').val('');  
                     $('#testLoad').DataTable().ajax.reload();
                } else if (data.confirm == "error"){
                    /*Call notifications*/
                    customersAddError();
                    /*Delete content of the input*/
                    $('#name_group_customers').val('');
                }
            }, "json");
            return false;
        });  

    });

