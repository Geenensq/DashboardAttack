  //-------------------------At the user's click-------------------------------------------//
  $("#btn_edit_groups_products").click(function(){
        //---if the div of the edition is open or closed we change the text of the button---//
        if ($("#collapse_edit_groups_products").is(":visible") == true ){
           $("#btn_edit_groups_products").text( "Editer les groupes de couleurs" );
           $("#btn_add_group_products").attr("disabled", false);
       } else {
           $("#btn_edit_groups_products").text( "Annuler l'édition" );
           $("#btn_add_group_products").attr("disabled", true);
       }
   });
    //-------------------------------------------------------------------------------------//
    //
    
        //-------------------------At the user's click-------------------------------------------//
        $("#btn_edit_colors").click(function(){
        //---if the div of the edition is open or closed we change the text of the button---//
        if ($("#collapse_edit_colors").is(":visible") == true ){
            
           $("#btn_edit_colors").text( "Editer les couleurs" );
           $("#btn_add_colors").attr("disabled", false);
       } else {
           $("#btn_edit_colors").text( "Annuler l'édition" );
           $("#btn_add_colors").attr("disabled", true);

       }
   });
    //-------------------------------------------------------------------------------------//



    $('#tab_groups_products').DataTable({
        ajax: "encodeGridGroupsProducts.html",
        order: [[ 0, "asc" ]],
        "columns": [
        //target 0 = collone 0 Datatable
        //data 0 = le tableaux php à l'index 0
        {"targets": 0, data: 0},
        {"targets": 1, data: 1},
        {"targets": 2, data: 2},
        {"targets": 3, data: null},
        {"targets": 4, data: null},
        {"targets": 5, data: null}
        ],

    //L'afficharge par defaut des collones de Datatable
    //Data represente dans ce cas les data de chaque ligne

    columnDefs:[

    {"targets": 3,render: function(data,full) {return '<button type="button" onclick="editGroupsProductsModal('+ data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_groups_products">Edition </button>'}},
    {"targets": 4,render: function(data,full) {return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' +'\''+"changeStatusGroupProducts.html" + '\'' + ',' + '\'' + "#tab_groups_products" + '\'' + ')' + '"' +' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'}},
    {"targets": 5,render: function(data,full) { 

        if (data[3] == 1) 
        {
            return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'

        } else if(data[3] == 0) 

        {
            return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
        }

    }}


    ]

});



    $('#tab_colors').DataTable({
        ajax: "encodeGridColors.html",
        order: [[ 0, "asc" ]],
        "columns": [
        //target 0 = collone 0 Datatable
        //data 0 = le tableaux php à l'index 0
        {"targets": 0, data: 0},
        {"targets": 1, data: 1},
        {"targets": 2, data: 2},
        {"targets": 3, data: 4},
        {"targets": 4, data: null},
        {"targets": 5, data: null},
        {"targets": 6, data: null},

        ],

    //L'afficharge par defaut des collones de Datatable
    //Data represente dans ce cas les data de chaque ligne

    columnDefs:[

    {"targets": 4,render: function(data,full) {return '<button type="button" onclick="editColorsModal('+ data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_colors">Edition </button>'}},
    {"targets": 5,render: function(data,full) {return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' +'\''+"changeStatusColors.html" + '\'' + ',' + '\'' + "#tab_colors" + '\'' + ')' + '"' +' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'}},
    {"targets": 6,render: function(data,full) { 

        if (data[3] == 1) 
        {
            return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'

        } else if(data[3] == 0) 

        {
            return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
        }

    }}

    ]

});