  //-------------------------At the user's click-------------------------------------------//
  $("#btn_edit_groups_products").click(function(){
        //---if the div of the edition is open or closed we change the text of the button---//
        if ($("#collapse_edit_groups_products").is(":visible") == true ){
           $("#btn_edit_groups_products").text( "Editer les groupes de produits" );
           $("#btn_add_group_products").attr("disabled", false);
       } else {
           $("#btn_edit_groups_products").text( "Annuler l'édition" );
           $("#btn_add_group_products").attr("disabled", true);
       }
   });
    //-------------------------------------------------------------------------------------//
    //
    
        //-------------------------At the user's click-------------------------------------------//
        $("#btn_edit_products").click(function(){
        //---if the div of the edition is open or closed we change the text of the button---//
        if ($("#collapse_edit_products").is(":visible") == true ){
            
           $("#btn_edit_products").text( "Editer les produits" );
           $("#btn_add_products").attr("disabled", false);
       } else {
           $("#btn_edit_products").text( "Annuler l'édition" );
           $("#btn_add_products").attr("disabled", true);

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
    {"targets": 4,render: function(data,full) {return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' +'\''+"changeStatusGroupsProducts.html" + '\'' + ',' + '\'' + "#tab_groups_products" + '\'' + ')' + '"' +' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'}},
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



    $('#tab_products').DataTable({
        ajax: "encodeGridProducts.html",
        order: [[ 0, "asc" ]],
        "columns": [
        //target 0 = collone 0 Datatable
        //data 0 = le tableaux php à l'index 0
        {"targets": 0, data: 0},
        {"targets": 1, data: 1},
        {"targets": 2, data: 2},
        {"targets": 3, data: 3},
        {"targets": 4, data: 4},
        {"targets": 5, data: null},
        {"targets": 6, data: 6},
        {"targets": 7, data: null},
        {"targets": 8, data: null},
        {"targets": 9, data: null},

        ],

    //L'afficharge par defaut des collones de Datatable
    //Data represente dans ce cas les data de chaque ligne

    columnDefs:[

    {"targets": 5,render: function(data,full) {return '<img src="../assets/img/uploaded/' +data[5] +' " height="80" width="80">'}},
    {"targets": 7,render: function(data,full) {return '<button type="button" onclick="editProductsModal('+ data[0] + ')" class="btn btn-info btn-fill" data-toggle="modal" data-target="#modal_update_products">Edition </button>'}},
    {"targets": 8,render: function(data,full) {return '<a id="btn_state" onclick="ajaxChangeStatus(' + data[0] + ',' +'\''+"changeStatusProducts.html" + '\'' + ',' + '\'' + "#tab_products" + '\'' + ')' + '"' +' class="btn btn-danger btn-fill"><i class="fa fa-edit"></a>'}},
    {"targets": 9,render: function(data,full) { 

        if (data[7] == 1) 
        {
            return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:green;" class="fa fa-check"></a>'

        } else if(data[7] == 0) 

        {
            return '<a style="border-color:transparent;" disabled class="btn btn-info"><i style="color:red;" class="fa fa-times"></a>'
        }

    }}

    ]

});