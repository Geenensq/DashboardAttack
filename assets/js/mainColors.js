$('#tab_groups_colors').DataTable({
    ajax: "encodeGridGroupsColors.html",
    order: [[ 0, "asc" ]],
    "columns": [
        //target 0 = collone 0 Datatable
        //data 0 = le tableaux php à l'index 0
        {"targets": 0, data: 0},
        {"targets": 1, data: 1},
        {"targets": 2, data: null},
        {"targets": 3, data: null},
        {"targets": 4, data: null}

    ],

    //L'afficharge par defaut des collones de Datatable
    //Data represente dans ce cas les data de chaque ligne

    columnDefs:[

        {"targets": 2,render: function(data,full) {return '<p>hello</p>'}},
        {"targets": 3,render: function(data,full) {return '<p>hello</p>'}},
        {"targets": 4,render: function(data,full) {return '<p>hello</p>'}}


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
        {"targets": 3, data: 3},
        {"targets": 4, data: null},
        {"targets": 5, data: null},
        {"targets": 6, data: null},

    ],

    //L'afficharge par defaut des collones de Datatable
    //Data represente dans ce cas les data de chaque ligne

    columnDefs:[

        {"targets": 4,render: function(data,full) {return '<p>hello</p>'}},
        {"targets": 5,render: function(data,full) {return '<p>hello</p>'}},
        {"targets": 6,render: function(data,full) {return '<p>hello</p>'}}

    ]

});