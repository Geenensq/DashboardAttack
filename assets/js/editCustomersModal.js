/*Function for track duplicate entry in my select and delete dupliacte*/
function deleteMultipleEntrySelect() {
    var a = new Array();
    $("#new_group_customer").children("option").each(function(x) {
        test = false;
        b = a[x] = $(this).val();
        for (i = 0; i < a.length - 1; i++) {
            if (b == a[i]) test = true;
        }
        if (test) $(this).remove();
    })
}
/*End*/




function editCustomersModal($id) {
    url = "getInfosCustomersModal.html";
    // on declare un formulaire
    var form = {
        id: $id
    };

    //on post
    var customer = send_post(form, url);


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