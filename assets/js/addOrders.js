    function addOrders() {
        customer_order = $("#customer_order").val();
        date_order = $("#date_order").val();
        state_order = $("#state_order").val();
        shipping_order = $("#shipping_order").val();
        payments_order = $("#payments_order").val();
        comment_order = $("#comment_order").val();


        url = "addOrders.html"
        $.post(url, {
            customer_order: customer_order,
            date_order: date_order,
            state_order: state_order,
            shipping_order: shipping_order,
            payments_order: payments_order,
            comment_order:comment_order

        }, function(data) {

            if (data.confirm == "success") {

                /*Affecte l'id enresitré de la commande pour ajouter les produits à la bonne commande*/
                $("#current_id_order").val(data.id_order);
                /*call function javascript for add products in the order*/
                addProductsOrder($("#current_id_order").val());
            } else if (data.confirm == "error") {
                
            }
        }, "json");
        return false;
    };
