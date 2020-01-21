  jQuery(document).ready(function($) {
 
    var cookieExpiryDate = new Date();
    var minutes = 60;
    cookieExpiryDate.setTime(cookieExpiryDate.getTime() + (minutes * 60 * 1000));


    $('.add-new-item').click(function() { 
        add_item($(this).attr('data-item-id'));
    });   

    $('.basket-items').on('click', '.cancel-button', function () {
        var id = $(this).children("div").attr('data-item-id');
        var items_object = jQuery.parseJSON("["+Cookies.get("items")+"]");

        for (var i = 0; i < items_object.length; i++) {
            // console.log(items_object[i].id);
            if (items_object[i].id == id) {
                items_object.splice(i--, 1);
                break;  
            }
        }  
      
        items_json = JSON.stringify(items_object);
        // console.log(items_json);

     
        var items_json = items_json.slice(1, -1);
        // server side 
        remove_item(id);
        // set cookie again 
        set_items_cookie(items_json);
        $(this).parent().parent().parent().parent().remove();
     
        update_basket_calculation();


    });   

    $('.delivery-option-radio').click(function() { 

        $('#minimum-order-warning').html('');
        var delivery_option = $(this).attr('data-delivery-options');
        var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                async: false,
                type: "POST",
                url: "/set-delivery-option",
                dataType: "text",
                headers: {
                    'X-CSRF-TOKEN': token
                  },
                data: { 
                    delivery_option: delivery_option
                },
                success: function (data) {
                    set_delivery_option_cookie(delivery_option)
                },
                error: function (xhr, status, error) {
                    // ERROR
                    alert(xhr.error)
                    //alert("Error setting click delivery option")
                }
            });
    });

    $('.pay-option-radio').click(function() { 
        var pay_option = $(this).attr('data-pay-option');
        if(pay_option == 'cash'){
            $('#payment-form').hide();
            $('#place-order').show();
        }else if(pay_option == 'card'){
            $('#payment-form').show();
            $('#place-order').hide();
        }
    });  

    function add_item(item_id) {
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            async: false,
            type: "POST",
            url: "/add-item",
            dataType: "text",
            headers: {
                'X-CSRF-TOKEN': token
              },
            data: { 
                itemid: item_id
            },
            success: function (data) {
                  // alert(data);
                  update_items_cookie(data);
                  update_basket_view(data);
                  update_basket_calculation();
            },
            error: function (xhr, status, error) {
                // ERROR
                // alert(error)
                 alert("Error adding item to basket")
            }
        });
    } 

    function remove_item(item_id) {
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            async: false,
            type: "POST",
            url: "/checkout/remove-item",
            dataType: "text",
            headers: {
                'X-CSRF-TOKEN': token
              },
            data: { 
                itemid: item_id
            },
            success: function (data) {
                
            },
            error: function (xhr, status, error) {
                // ERROR
                //  alert("Error removing time from basket")
            }
        });
    } 

    function set_delivery_option_cookie(delivery_option){
        Cookies.set('delivery_option', delivery_option, { expires: cookieExpiryDate }, '/');
    }
    function set_items_cookie(json){
        Cookies.set('items', json, { expires: cookieExpiryDate }, '/');
    }
    function update_items_cookie(newItemJson){
        var items = "";
        if (Cookies.get("items") === undefined || Cookies.get("items") === null || Cookies.get("items") === '' ) {
            // console.log(" 'items' cookie is empty");
            items = newItemJson;
        }else{
            // console.log("items cookie is NOT empty");
            items =  Cookies.get("items") + "," + newItemJson;
            // console.log("items: "+items);
        }
        Cookies.set("items", items, { expires: cookieExpiryDate }, '/');
        // console.log("cookies items: "+Cookies.get("items"));
    }

    function update_basket_view(itemsJson){
        var parsedJson = jQuery.parseJSON(itemsJson);
        $("#basket-items").append('\
                    <table class="table table-condensed">\
                            <tr>\
                                <td class="col-md-1"><div class="cancel-button">\
                                    <div data-item-id="'+parsedJson.id+'" class="remove-data"><i class="fa fa-times" aria-hidden="true"></i></div>\
                                </td>\
                                <td class="col-md-8">'+ parsedJson.menu_title +'</td>\
                                <td class="col-md-3"><div class="pull-right">'+ parsedJson.price +'</div></td>\
                            </tr>\
                    </table>\
                ');
    }

   // this function is loaded every time the page is loaded
    function load_basket_view(){
        var items =  Cookies.get("items");
        if (Cookies.get("items") === undefined || Cookies.get("items") === null || Cookies.get("items") === '' ) {
            // console.log("Cookie is empty");
        }else{
            var parsedJson = jQuery.parseJSON("["+items+"]");
            for(var i = 0; i < parsedJson.length; i++) {
                $("#basket-items").append('\
                    <table class="table table-condensed">\
                            <tr>\
                                <td class="col-md-1"><div class="cancel-button">\
                                    <div data-item-id="'+parsedJson[i].id+'" class="remove-data"><i class="fa fa-times" aria-hidden="true"></i></div>\
                                </td>\
                                <td class="col-md-8">'+ parsedJson[i].menu_title +'</td>\
                                <td class="col-md-3"><div class="pull-right">'+ parsedJson[i].price +'</div></td>\
                            </tr>\
                    </table>\
                ');
            } 
        }

         if (Cookies.get("delivery_option") === undefined || Cookies.get("delivery_option") === null || Cookies.get("delivery_option") === '' ) {
           setDeliveryOption('delivery');
           $("#"+Cookies.get("delivery_option")).attr('checked', 'checked');
        }else{
            $("#"+Cookies.get("delivery_option")).attr('checked', 'checked');
        }
    }

    // this function only queries get-offers and triggers calculate function 
    function update_basket_calculation(){
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                async: false,
                type: "GET",
                url: "/get-offers",
                dataType: "text",
                headers: {
                    'X-CSRF-TOKEN': token
                  },
                success: function (offersData) {
                    calculate(offersData);
                },
                error: function (xhr, status, error) {
                    // alert(xhr.responseText)
                    alert("Error in getting offers")
                }
            });
    }

    function calculate(offersDataInJson) {
        var offersDataObject = jQuery.parseJSON(offersDataInJson);

        var percentage_discount="";
        var discount="0.00";
        var delivery_fee="";
        var sub_total="";
        var total="";
        var minimum_order="";

        for(var i = 0; i < offersDataObject.length; i++) {
            percentage_discount = offersDataObject[i].percentage_discount;
            delivery_fee = offersDataObject[i].delivery_fee;
            minimum_order = offersDataObject[i].minimum_order;
        }

        if (Cookies.get("items") === undefined || Cookies.get("items") === null || Cookies.get("items") === '' ) {
            // $(".basket-subtotals").hide();
            // $(".basket-totals").hide();
            // $(".basket").hide();
            // console.log("cookie is empty yo!");

            Cookies.set('minimum_order', minimum_order, { expires: cookieExpiryDate }, '/');
            Cookies.set('delivery_fee', delivery_fee, { expires: cookieExpiryDate }, '/');
            Cookies.set('percentage_discount', percentage_discount, { expires: cookieExpiryDate }, '/');

            Cookies.set('discount', "0.00", { expires: cookieExpiryDate }, '/');
            Cookies.set('sub_total', "0.00", { expires: cookieExpiryDate }, '/');
            Cookies.set('total', "0.00", { expires: cookieExpiryDate }, '/');


            $('#basket-minimum-order').text(minimum_order);   
            $('#basket-delivery-fee').text(delivery_fee);
            $('#basket-percentage-discount').text(percentage_discount);

            $('#basket-discount').text("0.00");
            $('#basket-subtotal').text("0.00");
            $('.basket-total').text("0.00"); 

            $('.basket-count').text("0");


        }else{
            $(".basket-subtotals").show();
            $(".basket-totals").show();
            $(".basket").show();

            var itemsJson = jQuery.parseJSON("["+Cookies.get("items")+"]");
            // console.log("no of items :"+itemsJson.length);
            for(var i = 0; i < itemsJson.length; i++) {
               sub_total = +sub_total + +itemsJson[i].price;
            }

            sub_total = (+sub_total).toFixed(2);

            if (+sub_total > +minimum_order ){
                discount = (+sub_total * (+percentage_discount/100)).toFixed(2);
                $('#minimum-order-warning').html('');
            }

            total = ((+sub_total - +discount ) + +delivery_fee).toFixed(2);

            delivery_fee = (+delivery_fee).toFixed(2);

            var delivery_option = Cookies.get("delivery_option");
            if ( delivery_option == "delivery" && +total < +minimum_order)
            {
                 $('#minimum-order-warning').html('<div class="alert alert-success">Minimum order: &pound;'+  minimum_order+'</div>');
            }
            
            Cookies.set('sub_total', sub_total, { expires: cookieExpiryDate }, '/');
            Cookies.set('delivery_fee', delivery_fee, { expires: cookieExpiryDate }, '/');
            Cookies.set('percentage_discount', percentage_discount, { expires: cookieExpiryDate }, '/');
            Cookies.set('discount', discount, { expires: cookieExpiryDate }, '/');
            Cookies.set('total', total, { expires: cookieExpiryDate }, '/');
            Cookies.set('minimum_order', minimum_order, { expires: cookieExpiryDate }, '/');


            $('.basket-count').text(itemsJson.length);
            $('.basket-total').text(total); 
            $('#basket-subtotal').text(sub_total);
            $('#basket-delivery-fee').text(delivery_fee);
            $('#basket-percentage-discount').text(percentage_discount);
            $('#basket-minimum-order').text(minimum_order);
            $('#basket-discount').text(discount);
        } 
    }


    function setDeliveryOption(delivery_option){

        var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                async: false,
                type: "POST",
                url: "/set-delivery-option",
                dataType: "text",
                headers: {
                    'X-CSRF-TOKEN': token
                  },
                data: { 
                    delivery_option: delivery_option
                },
                success: function (data) {
                    Cookies.set('delivery_option', delivery_option, { expires: cookieExpiryDate }, '/');
                },
                error: function (xhr, status, error) {
                    // ERROR
                    // alert(xhr.responseText)
                    // alert("Error setting delivery option")
                }
            });
    }

    // only loads item lines in the basket
    load_basket_view();
    // loads rest of the calculations etc. 
    update_basket_calculation();


});