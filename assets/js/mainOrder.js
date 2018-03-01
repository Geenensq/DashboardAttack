$(document).ready(function() {
    /*-----Declare my lets for acces to the DOM------*/
    let array = document.getElementById('tab_products_order');
    let count = 1;
    let totalPrice;
    let current_order_price;
    let qte_product;
    let product_added;
    let counterProducts = 0;
    let product_checked;
    let return_product_exist;
    let counter_datatable = 0;
    let Quantity;
    let actualQuantity;


    /*******************************************************************************/
    /***********ON CLICK FOR UPDATE THE PRICE FOR SHIPPING METHOD*******************/
    /******************************************************************************/
    $( "#shipping_order" ).change(function() {
        if ($('h4:contains("Edition de la commande existante")').length > 0) { 

            /******************************************************/
            /*Retrieving the current price of the delivery method*/
            /****************************************************/
            var id_order = $("#current_id_order").val();
            var url = "getShippingPriceOrders.html";
            var form = {id: id_order};
            var shipping_price_order = send_post(form, url);
            
            /******************************************************************/
            /* Update price to subtract current price and basic delivery price*/
            /******************************************************************/
            var shipping_price_order = shipping_price_order["price_method_shipping"];
            var actualPrice = $("#current_order_price").val();
            var new_price_order = (parseFloat(actualPrice) - parseFloat(shipping_price_order));
            $("#current_order_price").val(new_price_order);
            
            /************************************************************/
            /***************Updating the price in database***************/
            /************************************************************/
            var id_method_shipping = $( this ).val();
            var url = "getShippingInfos.html";
            var form = {id: id_method_shipping};
            var shipping_price = send_post(form, url);
            var actualPrice = $("#current_order_price").val();
            var new_price_order = (parseFloat(actualPrice) + parseFloat(shipping_price["price_method_shipping"]));
            $("#current_order_price").val(new_price_order);
            priceUpdate($("#current_id_order").val(), $("#current_order_price").val());

            /************************************************************/
            /******************Update method of delivery*****************/
            /************************************************************/
            var url = "changeShippingMethod.html";
            var form = {id_method_shipping:id_method_shipping, id_order:id_order};
            send_post(form, url);
            

        } else {

            var id_method_shipping = $( this ).val();
            var url = "getShippingInfos.html";
            var form = {id: id_method_shipping};
            var shipping_price = send_post(form, url);
            $("#current_order_price").val(parseFloat(shipping_price["price_method_shipping"]));
            
        }
        
    });

    /***************************************************/
    /**************************************************/

    $("#edit_orders").click(function() {
        counter_datatable++
        if (counter_datatable <= 1) {
            var myTable = $('#tab_orders').DataTable({
                ajax: "encodeGridOrders.html",
                order: [
                [0, "asc"]
                ],
                "columns": [

                {
                    "targets": 0,
                    data: 0
                },
                {
                    "targets": 1,
                    data: null
                },
                {
                    "targets": 2,
                    data: 1
                },
                {
                    "targets": 3,
                    data: null
                },
                {
                    "targets": 4,
                    data: null
                },
                {
                    "targets": 5,
                    data: 2
                },
                {
                    "targets": 6,
                    data: 6
                },
                {
                    "targets": 7,
                    data: 7
                },

                {
                    "targets": 8,
                    data: 8
                },
                {
                    "target": 9,
                    data:null
                },
                {
                 "target": 10,
                 data:null
             }



             ],


             columnDefs: [

             {
                "targets": 1,
                render: function(data, full) {
                    return '<p>' + data[5] + ' ' + data[4] + '<p>'
                }
            },
            {
                "targets": 3,
                render: function(data, full) {
                    return '<p>' + data[3] + '€' + '</p>'
                }
            },
            {
                "targets": 4,
                render: function(data, full) {
                    return '<p>' + parseFloat(data[3] *1.2).toFixed(2)  + '€' + '</p>'
                }
            },
            {
                "targets": 9,
                render: function(data, full) {
                    return '<a href="#title_order" id="btn_state" onclick="editOrders(' + data[0] + ')" class="btn btn-info btn-fill editOrder"><i class="fa fa-edit"></i></a>'
                }
            },

            {
                "targets": 10,
                render: function(data, full) {
                    return '<a id="btn_state" onclick="deleteOrders(' + data[0] + ')" class="btn btn-danger btn-fill editOrder"><i class="fa fa-trash-o"></i></a>'
                }
            },
            ]
        });

        } else {
            return;
        }

    })




    $("#edit_orders").click(function() {

        if ($("#collapse_edit_orders").is(":visible") == true) {
            $("#edit_orders").text("Commandes en cours");

        } else {
            $("#edit_orders").text("Fermer les commandes en cours");

        }
    })


    /*Event for validate order*/
    $("#valid_order").click(function() {
        let edit_mode = 0;
        /*close collapse orders*/
        $('[data-toggle=collapse]').prop('disabled', false);
        /*Change attribute disabled to false*/
        $('#edit_orders').attr("disabled", false);

        //////////////////////////////////////////////////////////////
        //*IF IS IN EDITION MODE UPDATE THE ORDER WITH REQUEST AJAX*/
        ////////////////////////////////////////////////////////////
        if ($('h4:contains("Edition de la commande existante")').length > 0) {
            $('#valid_order').text("Valider la commande");
            edit_mode = 1;
            id_order = $("#current_id_order").val();
            new_customer_order = $("#customer_order").val();
            new_date_order = $("#date_order").val();
            new_price_order = $("#current_order_price").val();
            new_comment_order = $("#comment_order").val();
            new_method_payment = $("#payments_order").val();
            shipping_order = $("#shipping_order").val();
            new_state_order = $("#state_order").val();

            url = "changeInfosOrders.html"

            $.post(url, {
                id_order: id_order,
                new_customer_order: new_customer_order,
                new_date_order: new_date_order,
                new_price_order: new_price_order,
                new_comment_order: new_comment_order,
                new_method_payment: new_method_payment,
                shipping_order: shipping_order,
                new_state_order: new_state_order
            }, function(data) {

                if (data.confirm == "success") {
                    notify("pe-7s-refresh-2", "<b>Informations : </b> Votre commande à été modifier avec succès !", "info");
                    
                } else {
                    notify("pe-7s-refresh-2", "<b>Erreur !", "danger");
                }

            }, "json");


        }
        ////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////

        if ($('#valid_order').prop("disabled") == false) {

            /*Enable the datatable buttons that allow the editing of the command*/
            $("a.editOrder").attr("disabled", false);


            unlockInputOrder();
            $("#title_order").text("Ajouter une commande");

            $('input').each(function() {
                let input = this;
                let name_input = $(input).attr("name");

                if (name_input == "current_id_order") {
                    $(input).val(0);
                } else if (name_input == "tab_orders_length") {
                    return;
                } else if (name_input === "current_order_price") {
                    $(input).val(0);
                } else {
                    $(input).val('');
                }


            })

            $('select').each(function() {
                let select = this;
                let name_select = $(select).attr("name");
                if (name_select === "tab_orders_length") {
                    return;
                } else {
                    $(select).val(0).change();
                }

            })

            $("#tab_products_order td").parent().remove();
            $("#collapse_products").hide("slow");
            $("#valid_order").attr('disabled', 'disabled');
            count = 1;
            counterProducts = 0;

            if (edit_mode === 0) {
                notify("pe-7s-refresh-2", "<b>Informations : </b> La commande à été ajoutée avec succès !", "info");

            }

            $("#title_order").css("font-weight", "300");
            $("#title_order").css("color", "#333333");


        } else {

            return;
        }



    });
    /**************************************************/

    /*---------------------Event for create order and products---------------------*/
    $("#add_product").click(function() {

        if ($("#customer_order #date_order,#state_order,#shipping_order,#payments_order , #qte_product_order").val() != null) {

            $('[data-toggle=collapse]').prop('disabled', true);
            $('#edit_orders').attr("disabled", true);

            /**********************************************************************/
            /****************if the command is in edit mode***********************/
            /*********************************************************************/
            if ($('h4:contains("Edition de la commande existante")').length > 0) {

                product_added = $('#select_product_order').val();
                qte_product = $('#qte_product_order').val();
                return_product_exist = addRowProduct(product_added);
                if (return_product_exist === "ok") {
                 /*call function javascript for add products in the order*/
                 addProductsOrder($("#current_id_order").val());
                 priceUpdate($("#current_id_order").val(), $("#current_order_price").val());

             }

         } else {
            lockInputOrder();
            product_added = $('#select_product_order').val();
            qte_product = $('#qte_product_order').val();

            /*Call function fo add an row in table*/
            return_product_exist = addRowProduct(product_added);

            if (return_product_exist === "ok") {

                if (counterProducts < 1) {
                    addOrders();

                    counterProducts++;
                } else {
                    /*call function javascript for add products in the order*/
                    addProductsOrder($("#current_id_order").val());

                    priceUpdate($("#current_id_order").val(), $("#current_order_price").val());

                }
            }
        }

    } else {
        notify("pe-7s-refresh-2", "<b>Informations : </b> Veuillez renseignez tous les champs de la commande avant d'ajouter un produit", "danger");
    }
});
    /*-----------------------------------------------*/
    function lockInputOrder() {

        $('#form_add_order select').each(function() {
            let select = this;
            let name_select = $(select).attr("name");

            if (name_select != "select_product_order") {
                if (name_select != "tab_orders_length") {
                    $(select).attr("disabled", true);
                } else {
                    return;
                }

            }

        });

        $('#form_add_order input').each(function() {
            let input = this;
            name_input = $(input).attr("name");
            type_input = $(input).attr("type");

            if (name_input != "qte_product_order") {
                if (type_input != "search") {
                    $(input).attr("disabled", true);
                } else {
                    return;
                }

            } else {
                return;
            }
        });

    }


    function unlockInputOrder() {

        $('#form_add_order select').each(function() {
            let select = this;
            let name_select = $(select).attr("name");
            $(select).attr("disabled", false);

        });

        $('#form_add_order input').each(function() {
            let input = this;

            name_input = $(input).attr("name");

            if (name_input != "current_order_price") {
                $(input).attr("disabled", false);
            } else {
                $(input).attr("disabled", true);
            }

        });

    }




    function addRowProduct($id) {
        if (product_added != null) {
            if (($('#qte_product_order').val() != '') && ($('#qte_product_order').val() > 0)) {
                /*******************************************/
                $("#collapse_products").show("slow");

                ////////////POST AJAX FOR GET INFORMATIONS OF MY PRODUCT FOR INSERT IN MY TABLE HTML/////////////
                let url = "getInfosProductsArray.html";
                let form = {
                    id: $id
                };
                let product = send_post(form, url);
                /////////////////////////////////////////////////////////////////////////////////////////////////


                product_checked = checkProductInOrder($id);

                if (product_checked == false) {
                    $totalPrice = (parseFloat(qte_product) * parseFloat(product.sizes_price)) + (parseFloat(product.base_price) * parseFloat(qte_product));
                    $current_order_price = parseFloat($("body").find('#current_order_price').val());

                    $("#current_order_price").val($totalPrice + $current_order_price);

                    constructViewTable(product, count, array, qte_product);
                    count++;
                    return_product_exist = "ok"
                    return return_product_exist;

                } else {
                    notify("pe-7s-refresh-2", "<b>Informations : </b> Ce produit est deja dans la commande", "danger");
                    return_product_exist = "error"
                    return return_product_exist;
                }

            } else {
                notify("pe-7s-refresh-2", "<b>Informations : </b> Le champ quantité du produit n'est pas correctement renseigné ", "danger");
            }

        } else {
            notify("pe-7s-refresh-2", "<b>Informations : </b> Veuillez sélectionner un produit avant de l'ajouter à la commande", "danger");
        }
    }

});




function checkProductInOrder($id_product) {
    url = "checkProductInOrder.html";
    form = {
        id_order: $("#current_id_order").val(),
        id_product_check: $id_product
    };
    product_checked = send_post(form, url);
    return product_checked;
}



function constructViewTable($product, $count, $array, $qte_product) {
    $("#valid_order").removeAttr("disabled");
    
    if ($('h4:contains("Edition de la commande existante")').length > 0) {
        if ($('#tab_products_order tr').length <= 1){
          $count =+  0;
          
      } else {
        $count =+ $("#tab_products_order tr:nth-child(2)").attr('id').replace("ligne" , "") + 1;
    }
    
} 


let row = $array.insertRow(1);
    row.id = "ligne" + $count; /// Pour chaques ligne on lui affecte un id "ligne" + la letiable count*/
    
    /*Insert an row in my table*/
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
    let cell11 = row.insertCell(10);

    cell1.innerHTML = $product.id_product
    cell2.innerHTML = $qte_product;
    cell3.innerHTML = $product.product_name;
    cell4.innerHTML = $product.reference;
    cell5.innerHTML = $product.description;
    cell6.innerHTML = $product.base_price;
    cell7.innerHTML = "<img src=\"" + "/local/assets/img/uploaded/" + $product.img_url + "\" width=\"80px\" height=\"80px\">";;
    cell8.innerHTML = $product.colors_names;
    cell9.innerHTML = $product.sizes_names;
    cell10.innerHTML = '<a onClick="deleteRow(' + $count + ',' + $product.id_product + ',' + $qte_product + ')" style="font-size:1.5em;" class="glyphicon glyphicon-remove" aria-hidden="true"></a>';

    cell11.innerHTML = '<i  role="button" onClick="AddQuantity(' + $product.id_product + ',' + row.id + ',' + $product.base_price + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf196;</i> <i  role="button" onClick="RemoveQuantity(' + $product.id_product + ',' + row.id + ',' + $product.base_price + ');" style="font-size:20px; color:#337ab7;" class="fa">&#xf147;</i>';


    notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été ajouté à la commande avec succès !", "info");
}

function AddQuantity($id_product, $row, $price_product) {
    Quantity = $row.cells[1];
    actualQuantity = parseFloat(Quantity.innerHTML);
    Quantity.innerHTML = actualQuantity + 1;

    updateQuantityProduct($("#current_id_order").val(), $id_product, parseFloat(Quantity.innerHTML));

    current_order_price = parseFloat($("#current_order_price").val());
    $("#current_order_price").val(parseFloat(current_order_price + $price_product));
    /*AJAX CALL FOR UPDATE THE PRICE*/
    priceUpdate($("#current_id_order").val(), $("#current_order_price").val());
}

function RemoveQuantity($id_product, $row, $price_product) {
    Quantity = $row.cells[1];
    actualQuantity = parseFloat(Quantity.innerHTML);
    if (actualQuantity <= 1) {
        notify("pe-7s-refresh-2", "<b>Erreur : </b> Vous devez obligatoirement au moins 1 exemplaire", "danger");

    } else {
        Quantity.innerHTML = actualQuantity - 1;

        updateQuantityProduct($("#current_id_order").val(), $id_product, parseFloat(Quantity.innerHTML));

        current_order_price = parseFloat($("#current_order_price").val());
        $("#current_order_price").val(parseFloat(current_order_price - $price_product));

        /*AJAX CALL FOR UPDATE THE PRICE*/
        priceUpdate($("#current_id_order").val(), $("#current_order_price").val());
    }
}

function updateQuantityProduct($id_order, $id_product, $new_quantity) {
    url = "EditQuantityProduct.html"
    $.post(url, {
        id_order: $id_order,
        id_product: $id_product,
        new_quantity: $new_quantity
    },

    function(data) {

        if (data.confirm == "success") {


        } else if (data.confirm == "error") {

        }
    }, "json");
}


function priceUpdate($id_order, $price) {
    url = "editPriceOrder.html";
    form = {
        id_order: $id_order,
        price: $price
    };
    let result_price_update = send_post(form, url);
}


/******************************************************************/
/**************DECLARATION SELECT 2 AUTOCOMPLETE*******************/
/******************************************************************/
$('#customer_order').select2({
 minimumInputLength: 2,
 placeholder: 'Chercher un client',
 ajax: {
  url: 'getCustomersAutoComplete.html',
  dataType: 'json',
  delay: 250,

  processResults: function (data) {
    return {
      results: data
  };
},
cache: true
}
});


$('#select_product_order').select2({
 minimumInputLength: 2,
 placeholder: 'Chercher un produit',
 ajax: {
  url: 'getProductsAutoComplete.html',
  dataType: 'json',
  delay: 250,

  processResults: function (data) {
    return {
      results: data
  };
},
cache: true
}
});
/************************************************************************/    
/************************************************************************/
