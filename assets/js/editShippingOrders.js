    /*******************************************************************************/
    /***********ON CLICK FOR UPDATE THE PRICE FOR SHIPPING METHOD*******************/
    /******************************************************************************/
    $("#shipping_order").change(function() {
       if ($('h4:contains("Edition de la commande existante")').length > 0) {

          /******************************************************/
          /*Retrieving the current price of the delivery method*/
          /****************************************************/
          var id_order = $("#current_id_order").val();
          var url = "getShippingsPriceOrders.html";
          var form = {
             id: id_order
         };
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
         var id_method_shipping = $(this).val();
         var url = "getShippingsInfos.html";
         var form = {
             id: id_method_shipping
         };
         var shipping_price = send_post(form, url);
         var actualPrice = $("#current_order_price").val();
         var new_price_order = (parseFloat(actualPrice) + parseFloat(shipping_price["price_method_shipping"]));
         $("#current_order_price").val(new_price_order);
         priceUpdate($("#current_id_order").val(), $("#current_order_price").val());

         /************************************************************/
         /******************Update method of delivery*****************/
         /************************************************************/
         var url = "changeShippingsMethod.html";
         var form = {
             id_method_shipping: id_method_shipping,
             id_order: id_order
         };
         send_post(form, url);


     } else {

      var id_method_shipping = $(this).val();
      var url = "getShippingsInfos.html";
      var form = {
         id: id_method_shipping
     };
     var shipping_price = send_post(form, url);
     $("#current_order_price").val(parseFloat(shipping_price["price_method_shipping"]));

 }

});