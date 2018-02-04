$(document).ready(function() {

    /*Create my variables for acces to the DOM*/
    var array = document.getElementById('tab_products_order');
    var count = 1;
    
    function send_post(v, url) 
    {
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


    $("#add_product").click(function() {
        $( "#collapse_products" ).show( "slow");
        $product_added = $('#select_product').val();
        $qte_product = $('#qte_product').val();
        addRowProduct($product_added);
    });


    function addRowProduct($id) {

        /*******************************************/
        url = "getInfosProductsArray.html";

        // on declare un formulaire
        var form = {
            id: $id
        };

        /***Post ajax request and get the result in product***/
        var product = send_post(form, url);
        /****************************************************/

        /*Insert an row in my table*/
        var row = array.insertRow(1);
        row.id = "ligne" + count; /// Pour chaques ligne on lui affecte un id "ligne" + la variable count*/

        var cell1 = row.insertCell(0); /// Insertion des 6 cellule
        var cell2 = row.insertCell(1); ///
        var cell3 = row.insertCell(2); ///
        var cell4 = row.insertCell(3); ///
        var cell5 = row.insertCell(4); ///
        var cell6 = row.insertCell(5); ///
        var cell7 = row.insertCell(6); ///
        var cell8 = row.insertCell(7); ///
        var cell9 = row.insertCell(8); ///

        cell1.innerHTML = $qte_product;
        cell2.innerHTML = product.product_name;
        cell3.innerHTML = product.reference;
        cell4.innerHTML = product.description;
        cell5.innerHTML = product.base_price;
        cell6.innerHTML = "<img src=\"" + "/local/assets/img/uploaded/" + product.img_url + "\" width=\"80px\" height=\"80px\">";;
        cell7.innerHTML = product.colors_names;
        cell8.innerHTML = product.sizes_names;
        cell9.innerHTML = '<a onClick="deleteRow(' + count + ')" style="font-size:1.5em;" class="glyphicon glyphicon-remove" aria-hidden="true"></a>';
        count++;

    }






    



});