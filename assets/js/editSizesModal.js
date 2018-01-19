/*Function for track duplicate entry in my select and delete dupliacte*/
function deleteMultipleEntrySelect() {
    var a = new Array();
    $("#new_group_sizes").children("option").each(function(x) {
        test = false;
        b = a[x] = $(this).val();
        for (i = 0; i < a.length - 1; i++) {
            if (b == a[i]) test = true;
        }
        if (test) $(this).remove();
    })
}
/*End*/


function editSizesModal($id) {

    url = "getInfosSizesModal.html";
    // on declare un formulaire
    var form = {
        id:$id
    };

    //on post
    var size = send_post(form, url);

    $('#new_id_sizes').val(size.id_size);
    $('#new_name_sizes').val(size.size_name);
    $('#new_price_sizes').val(size.price);
    $("#new_group_sizes").prepend($("<option selected=\"selected\"></option>").val(size.id_group_size).html(size.name_group_size));
    deleteMultipleEntrySelect();
}


function send_post(v, url) {
    var resultat = null;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        data: v,
        dataType: "json",
        cache: false,
        success: function(data) {
            resultat = data;
            return resultat;
        },
        error: function(error) {
            resultat = error;
            return resultat;
        }
    });
    return resultat;


}