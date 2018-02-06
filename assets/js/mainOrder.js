$(document).ready(function() {

    /*-----Declare my lets for acces to the DOM------*/
    let array = document.getElementById('tab_products_order');
    let count = 1;
    let totalPrice;
    let current_order_price;
    let qte_product;
    let product_added;
    let counterProducts = 0;
    /*------------------------------------------------*/

    /*---------------------Event---------------------*/
    $("#add_product").click(function() {
        if ($("#customer_order,#date_order,#state_order,#shipping_order,#payments_order , #qte_product_order").val() != null) {
            product_added = $('#select_product_order').val();
            qte_product = $('#qte_product_order').val();
            /*Call function fo add an row in table*/
            addRowProduct(product_added);

            if (counterProducts < 1) {
                addOrders();
                counterProducts++;
            } else {
                /*call function javascript for add products in the order*/
                addProductsOrder($("#current_id_order").val());
            }

        } else {
            notify("pe-7s-refresh-2", "<b>Informations : </b> Veuillez renseignez tous les champs de la commande avant d'ajouter un produit", "danger");
        }
    });
    /*-----------------------------------------------*/


    function addRowProduct($id) {
        if (product_added != null) {

            if (($('#qte_product_order').val() != '') && ($('#qte_product_order').val() > 0)) {
                /*******************************************/
                $("#collapse_products").show("slow");

                ////////////POST AJAX FOR GET INFORMATIONS OF MY PRODUCT FOR INSERT IN MY TABLE HTML/////////////
                let url = "getInfosProductsArray.html";
                let form = {id: $id};
                let product = send_post(form, url);
                /////////////////////////////////////////////////////////////////////////////////////////////////
                

                /*IF A FIRST PRODUCT HAS ALREADY BE ADDED*/
                if (count > 1 ){
                ///////////////////////////POST AJAX TO CHECK THAT THE PRODUCT IS NOT IN ORDER////////////////////
                url = "toto.html";
                form = {id:$id , id_product_check:product.id_product};
                let product_checked = send_post(form , url);
                console.log($("#current_id_order").val());
                //////////////////////////////////////////////////////////////////////////////////////////////////
                } 

                /****************************************************/
                /*Calculation of price of sizes + price of products * number of products*/
                $totalPrice = (parseFloat(qte_product) * parseFloat(product.sizes_price)) + (parseFloat(product.base_price) * parseFloat(qte_product));
                $current_order_price = parseFloat($("body").find('#current_order_price').val());
                $("#current_order_price").val($totalPrice + $current_order_price);

                /*Insert an row in my table*/
                let row = array.insertRow(1);
                row.id = "ligne" + count; /// Pour chaques ligne on lui affecte un id "ligne" + la letiable count*/

                let cell1 = row.insertCell(0);
                let cell2 = row.insertCell(1);
                let cell3 = row.insertCell(2);
                let cell4 = row.insertCell(3);
                let cell5 = row.insertCell(4);
                let cell6 = row.insertCell(5);
                let cell7 = row.insertCell(6);
                let cell8 = row.insertCell(7);
                let cell9 = row.insertCell(8);
                let cell10 = row.insertCell(9);

                cell1.innerHTML = product.id_product
                cell2.innerHTML = qte_product;
                cell3.innerHTML = product.product_name;
                cell4.innerHTML = product.reference;
                cell5.innerHTML = product.description;
                cell6.innerHTML = product.base_price;
                cell7.innerHTML = "<img src=\"" + "/local/assets/img/uploaded/" + product.img_url + "\" width=\"80px\" height=\"80px\">";;
                cell8.innerHTML = product.colors_names;
                cell9.innerHTML = product.sizes_names;
                cell10.innerHTML = '<a onClick="deleteRow(' + count + ',' + product.id_product + ',' + qte_product + ')" style="font-size:1.5em;" class="glyphicon glyphicon-remove" aria-hidden="true"></a>';
                count++;
                notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été ajouté à la commande avec succès !", "info");

            } else {
                notify("pe-7s-refresh-2", "<b>Informations : </b> Le champ quantité du produit n'est pas correctement renseigné ", "danger");
            }

        } else {
            notify("pe-7s-refresh-2", "<b>Informations : </b> Veuillez sélectionner un produit avant de l'ajouter à la commande", "danger");
        }
    }

});