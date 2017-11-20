$(document).ready(function() {
    $('#testLoad').DataTable({
        ajax: "testAjax.html",
        order: [[ 0, "asc" ]],
        "columns": [

                    {"targets": 0, data: 0},
                    {"targets": 1, data: 1},
                    {"targets": 2, data: null},
                    
            ],
            columnDefs:[{
                    "targets": 2,
                        render: function(){
                        return '<button class="btn btn-info"><i class="fa fa-edit"></button>';
                    }
                }
        ]
        });
});