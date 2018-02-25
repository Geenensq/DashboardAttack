
$('#tab_rapid_orders').DataTable({
    ajax: "encodeGridLastOrders.html",
    order: [[ 0, "asc" ]],
    "columns": [
        //target 0 = collone 0 Datatable
        //data 0 = le tableaux php à l'index 0
        {"targets": 0, data: null},
        {"targets": 1, data: null},
        {"targets": 2, data: 1}
        ],

    //L'afficharge par defaut des collones de Datatable
    //Data represente dans ce cas les data de chaque ligne

    columnDefs:[
    {"targets": 0,render: function(data,full) {return  "Commande n°" + " " + data[0]}},
    {"targets": 1,render: function(data,full) {return  data[3] + " " + data[2]}},
    ]

});




