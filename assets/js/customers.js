$(document).ready(function() {
    $('#testLoad').DataTable({
        sAjaxSource: "testAjax.html",
        sAjaxDataProp: "",
        order: [[ 0, "asc" ]]
    });
});


     

