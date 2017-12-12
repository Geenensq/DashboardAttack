$(document).ready(function() {
    
    //-------------------------At the user's click-------------------------------------------//
    $("#btn_edit_groups_customers").click(function(){
        //---if the div of the edition is open or closed we change the text of the button---//
        if ($("#collapse_edit_groups_customers").is(":visible") == true ){
             $("#btn_edit_groups_customers").text( "Editer les groupes clients" );
        } else {
             $("#btn_edit_groups_customers").text( "Annuler l'édition" );
        }
    });
    //-------------------------------------------------------------------------------------//
    //
    
        //-------------------------At the user's click-------------------------------------------//
    $("#btn_edit_customers").click(function(){
        //---if the div of the edition is open or closed we change the text of the button---//
        if ($("#collapse_edit_customers").is(":visible") == true ){
             $("#btn_edit_customers").text( "Editer les clients" );
        } else {
             $("#btn_edit_customers").text( "Annuler l'édition" );
        }
    });
    //-------------------------------------------------------------------------------------//



    //------------------------------------------------------------Declaration of datatable-------------------------------------------------------------------------//
    $('#tab_groups_customers').DataTable({
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

            {"targets": 2,render: function(data,full){return '<button onclick = "takeIdForChangeName('+data[0]+')" type="button"  class="btn btn-info" data-toggle="modal" data-target="#modal_update">Edition </button>';}},
        
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

    //------------------------------------------------------------Declaration of datatable-------------------------------------------------------------------------//
    $('#tab_customers').DataTable({
        ajax: "encodeGrid2.html",
        order: [[ 0, "asc" ]],
        "columns": [
                    //target 0 = collone 0 Datatable
                    //data 0 = le tableaux php à l'index 0 
                    {"targets": 0, data: 0},
                    {"targets": 1, data: 1},
                    {"targets": 2, data: 2},
                    {"targets": 3, data: 3},
                    {"targets": 4, data: 4},
                    {"targets": 5, data: 5},
                    {"targets": 6, data: 6},
                    {"targets": 7, data: 7},
                    {"targets": 8, data: 8},
                    {"targets": 9, data: 9},
                    {"targets": 10, data: null},
                    {"targets": 11, data: null},



        ],
            //L'afficharge par defaut des collones de Datatable
            //Data represente dans ce cas les data de chaque ligne
            columnDefs:[

                {"targets": 10,render: function(data,full){return '<button  type="button"  class="btn btn-info">Edition </button>';}},
                {"targets": 11,render: function(data,full){return '<a id="btn_state" class="btn btn-info"><i class="fa fa-edit"></a>';}}


            ]

        });

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------//



});