$(document).ready(function() {
    $('#testLoad').DataTable({
        ajax: "encodeGrid.html",
        order: [[ 0, "asc" ]],
        "columns": [

                    {"targets": 0, data: 0},
                    {"targets": 1, data: 1},
                    {"targets": 2, data: null},
                    {"targets": 3, data: null},

                    
            ],
            columnDefs:[

            {"targets": 2,render: function(data,type,full){return '<a ' + 'href=' +  '"' + data[0] + '"' + 'class="btn btn-info"><i class="fa fa-edit"></a>';}},
            
            {"targets": 3,render: function(data,type,full){return '<a onclick="test(' + data[0] + ')' + '"' +'class="btn btn-info"><i class="fa fa-edit"></a>';}}
           
            ]
        });



    

       

});