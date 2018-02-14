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
    /*------------------------------------------------*/
    /*call an secret function*/
    secret();
    /***************************************************/

    $("#edit_orders").click(function() {
        counter_datatable++
        if (counter_datatable <= 1) {
            var myTable = $('#tab_orders').DataTable({
                ajax: "encodeGridOrders.html",
                order: [
                    [0, "asc"]
                ],
                "columns": [
                    //target 0 = collone 0 Datatable
                    //data 0 = le tableaux php à l'index 0
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
                        data: 2
                    },
                    {
                        "targets": 5,
                        data: 6
                    },
                    {
                        "targets": 6,
                        data: 7
                    },
                    {
                        "targets": 7,
                        data: 8
                    },

                    {
                        "targets": 8,
                        data: null 
                    },

                    {
                        "targets": 9,
                        data: null

                    },


                ],

                //L'afficharge par defaut des collones de Datatable
                //Data represente dans ce cas les data de chaque ligne

                columnDefs: [

                    {"targets": 1,render: function(data, full) {return '<p>' + data[5] + ' ' + data[4] + '<p>'}},
                    {"targets": 3,render: function(data, full) {return '<p>' + data[3] + '€' + '</p>'}},
                    {"targets": 3,render: function(data, full) {return '<p>' + data[3] + '€' + '</p>'}},
                    {"targets": 8,render: function(data, full) {return '<a id="btn_state" onclick="editOrdersModal('+ data[0] +')" data-toggle="modal" data-target="#modal_orders" class="btn btn-info btn-fill"><i class="fa fa-edit"></i></a>'}},
                    {"targets": 9,render: function(data, full) {return '<a id="btn_state" class="btn btn-info btn-fill"><i class="fa fa-file-text-o"></i></a>'}},

                ]
            });

        } else {
            return;
        }

    })


        $('#edit_orders').on( 'click', 'tbody tr', function () {
        myTable.row( this ).edit( {
            buttons: [
                { label: 'Cancel', fn: function () { this.close(); } },
                'Edit'
            ]
        } );
    } );

    $("#edit_orders").click(function(){

          if ($("#collapse_edit_orders").is(":visible") == true) {
              $("#edit_orders").text("Editer les commandes");

          } else {
              $("#edit_orders").text("Annuler l'édition");

          }
    })


    /*Event for validate order*/
    $("#valid_order").click(function() {

        if ($('#valid_order').prop("disabled") == false) {
            unlockInputOrder();
            $("#title_order").text("Ajouter une commande");

            $('input').each(function() {
                let input = this;
                let name_input = $(input).attr("name");
                
                if (name_input == "current_id_order"){
                    $(input).val(0);
                } else if (name_input == "tab_orders_length"){
                    return;
                } else if(name_input ==="current_order_price"){
                    $(input).val(0);
                } else {
                     $(input).val('');
                }


            })

            $('select').each(function() {
                let select = this;
                let name_select = $(select).attr("name");
                if (name_select === "tab_orders_length"){
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
            notify("pe-7s-refresh-2", "<b>Informations : </b> La commande à été ajoutée avec succès !", "info");
            /*$('#tab_orders').DataTable().ajax.reload();*/

        } else {
            return;
        }



    });
    /**************************************************/

    /*---------------------Event for create order and products---------------------*/
    $("#add_product").click(function() {
        if ($("#customer_order,#date_order,#state_order,#shipping_order,#payments_order , #qte_product_order").val() != null) {
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

        } else {
            notify("pe-7s-refresh-2", "<b>Informations : </b> Veuillez renseignez tous les champs de la commande avant d'ajouter un produit", "danger");
        }
    });
    /*-----------------------------------------------*/
    function lockInputOrder() {

        $('select').each(function() {
            let select = this;
            let name_select = $(select).attr("name");

            if (name_select != "select_product_order") {
                if(name_select != "tab_orders_length"){
                     $(select).attr("disabled", true);
                 } else {
                    return;
                 }
               
            }

        });

        $('input').each(function() {
            let input = this;
            name_input = $(input).attr("name");
            type_input = $(input).attr("type");

            if (name_input != "qte_product_order") 
            {
                if(type_input != "search"){
                    $(input).attr("disabled", true);
                } else{
                    return;
                }
                
            } else {
                return;
            }
        });

    }


    function unlockInputOrder() {

        $('select').each(function() {
            let select = this;
            let name_select = $(select).attr("name");
            $(select).attr("disabled", false);

        });

        $('input').each(function() {
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
    /*Insert an row in my table*/
    let row = $array.insertRow(1);
    row.id = "ligne" + $count; /// Pour chaques ligne on lui affecte un id "ligne" + la letiable count*/

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
    notify("pe-7s-refresh-2", "<b>Informations : </b> Le produit à été ajouté à la commande avec succès !", "info");
}

function priceUpdate($id_order, $price) {
    url = "editPriceOrder.html";
    form = {
        id_order: $id_order,
        price: $price
    };
    let result_price_update = send_post(form, url);
}