$(document).ready(function() {
    
    //-------------------------At the user's click-------------------------------------------//
    $("#btnEditGroupsCustomers").click(function(){
        //---if the div of the edition is open or closed we change the text of the button---//
        if ($("#collapseEditGroupsCustomers").is(":visible") == true ){
             $("#btnEditGroupsCustomers").text( "Editer les groupes clients" );
        } else {
             $("#btnEditGroupsCustomers").text( "Annuler l'édition" );
        }
    });
    //-------------------------------------------------------------------------------------//



    //------------------------------------------------------------Declaration of datatable-------------------------------------------------------------------------//
    $('#testLoad').DataTable({
        ajax: "encodeGrid.html",
        order: [[ 0, "asc" ]],
        "columns": [

                    //target 0 = collone 0 Datatable
                    //data 0 = le tableaux php à l'index 0 
                    {"targets": 0, data: 0},
                    {"targets": 1, data: 1},
                    {"targets": 2, data: null},
                    {"targets": 3, data: null},
                    {"targets": 4, data: null},         
            ],
            //L'afficharge par defaut des collones de Datatable
            //Data represente dans ce cas les data de chaque ligne
            columnDefs:[

            {"targets": 2,render: function(data,full){return '<button onclick = "takeIdForChangeName('+data[0]+')" type="button"  class="btn btn-info" data-toggle="modal" data-target="#modalUpdate">Edition </button>';}},
        
            {"targets": 3,render: function(data,full){return '<a id="btn_state" onclick="ajaxChangeStatusGroupCustomers(' + data[0] + ')' + '"' +' class="btn btn-info"><i class="fa fa-edit"></a>';}},

            {"targets": 4,render: function(data,full) { 

                if (data[2] == 1) 
                {
                return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'
                
                } else if(data[2] == 0) 
                
                {
                return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
                }
                
            }}
           
            ]

        });

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

});