  jQuery(document).ready(function($) {
 
        $('#myCarousel').carousel({
                interval: 15000
        });
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
            var id_selector = $(this).attr("id");
            try {
                var id = /-(\d+)$/.exec(id_selector)[1];
                console.log(id_selector, id);
                jQuery('#myCarousel').carousel(parseInt(id));
            } catch (e) {
                console.log('Regex failed!', e);
            }
        });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });



    $("#datetimepicker").datetimepicker({
        minDate: 0,
        minTime: 0,
         format:'Y-m-d H:i',
        step: 30
    });



    $('#myTabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    });

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);



    /* STICKY BIT */

    function sticky_relocate_1() {
        var nav = $('#sticky-anchor-1');
        if (nav.length) {
            var window_top = $(window).scrollTop();
            var div_top = $('#sticky-anchor-1').offset().top;
            if (window_top > div_top) {
                $('#sticky-1').addClass('stick');
                $('#sticky-anchor-1').height($('#sticky-1').outerHeight());
            } else {
                $('#sticky-1').removeClass('stick');
                $('#sticky-anchor-1').height(0);
            }
        }
    }

    function sticky_relocate_2() {
        var nav = $('#sticky-anchor-2');
        if (nav.length) {
            var window_top = $(window).scrollTop();
            var div_top = $('#sticky-anchor-2').offset().top;
            if (window_top > div_top) {
                $('#sticky-2').addClass('stick');
                $('#sticky-anchor-2').height($('#sticky-2').outerHeight());
            } else {
                $('#sticky-2').removeClass('stick');
                $('#sticky-anchor-2').height(0);
            }
        }
    }


    $(function() {
        $(window).scroll(sticky_relocate_1);
        sticky_relocate_1();

        $(window).scroll(sticky_relocate_2);
        sticky_relocate_2();
    });


    Cookies.set('sub_total', '00.00', { expires: 365 }, '/');
    Cookies.set('delivery_fee', '00.00', { expires: 365 }, '/');
    Cookies.set('discount_percentage', '00.00', { expires: 365 }, '/');
    Cookies.set('total', '00.00', { expires: 365 }, '/');





    $('.add-new-item').click(function() { 

        add_item($(this).attr('data-item-id'));
    });   

    $('.delivery-option-radio').click(function() { 
        var delivery_option = $(this).attr('data-delivery-options');
        Cookies.set('delivery_option', delivery_option, { expires: 365 }, '/');
        //
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
                    update_cookie(data);
                    update_basket(data);
                    basket_calculation();
                },
                error: function (xhr, status, error) {
                    // ERROR
                    alert(xhr.responseText)
                }
            });
    } 


    function remove_item(item_id) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                async: false,
                type: "POST",
                url: "/remove-item",
                dataType: "text",
                headers: {
                    'X-CSRF-TOKEN': token
                  },
                data: { 
                    itemid: item_id
                },
                success: function (data) {
                    
                    // update_cookie(data);
                    // update_basket(data);
                    // basket_calculation();
                },
                error: function (xhr, status, error) {
                    // ERROR
                    alert(xhr.responseText)
                }
            });
    } 

    function update_cookie(newItem){
        var items = "";

        if (Cookies.get("items") === undefined || Cookies.get("items") === null || Cookies.get("items") === '' ) {
            console.log("Cookie is empty");
            items = newItem;
        }else{
            console.log("Cookie is NOT empty");
            items =  Cookies.get("items") + "," + newItem;
        }
        Cookies.set("items", items, { expires: 365 }, '/');


    }

    function update_basket(newItem){
        var parsedJson = jQuery.parseJSON(newItem);
        $("#basket-items").append('\
                <table class="table table-condensed">\
                        <tr>\
                            <td class="col-md-1"><div class="cancel-button">\
                                <div data-item-id="'+parsedJson.id+'" class="remove-item"><i class="fa fa-times" aria-hidden="true"></i></div></div>\
                            </td>\
                            <td class="col-md-9">'+ parsedJson.menu_title +'</td>\
                            <td class="col-md-2">'+ parsedJson.price +'</td>\
                        </tr>\
                </table>\
            ');
    }

    function load_basket(){
        var items =  Cookies.get("items");
        if (Cookies.get("items") === undefined || Cookies.get("items") === null || Cookies.get("items") === '' ) {
            console.log("Cookie is empty");
        }else{
            var parsedJson = jQuery.parseJSON("["+items+"]");
            for(var i = 0; i < parsedJson.length; i++) {
                $("#basket-items").append('\
                    <table class="table table-condensed">\
                            <tr>\
                                <td class="col-md-1"><div class="cancel-button">\
                                    <div data-item-id="'+parsedJson[i].id+'" class="remove-data"><i class="fa fa-times" aria-hidden="true"></i></div></div>\
                                </td>\
                                <td class="col-md-9">'+ parsedJson[i].menu_title +'</td>\
                                <td class="col-md-2">'+ parsedJson[i].price +'</td>\
                            </tr>\
                    </table>\
                ');
            } 
        }

         if (Cookies.get("delivery_option") === undefined || Cookies.get("delivery_option") === null || Cookies.get("delivery_option") === '' ) {
           // 
        }else{
            $("#"+Cookies.get("delivery_option")).attr('checked', 'checked');
        }
    }

    function basket_calculation(){
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                async: false,
                type: "GET",
                url: "/get-offers",
                dataType: "text",
                headers: {
                    'X-CSRF-TOKEN': token
                  },
                success: function (data) {
                    calculate(data);
                },
                error: function (xhr, status, error) {
                    // ERROR
                    alert(xhr.responseText)
                }
            });

    }


    function calculate(offersData) {
        var parsedJson = jQuery.parseJSON(offersData);
        console.log(parsedJson);
        var discount_percentage="";
        var discount="0.00";
        var delivery_fee="";
        var sub_total="";
        var total="";
        var minimum_order="";

        for(var i = 0; i < parsedJson.length; i++) {
            percentage_discount = parsedJson[i].percentage_discount;
            delivery_fee = parsedJson[i].delivery_fee;
            minimum_order = parsedJson[i].minimum_order;
        }

        if (Cookies.get("items") === undefined || Cookies.get("items") === null || Cookies.get("items") === '' ) {
            $(".basket-subtotals").hide();
            $(".basket-totals").hide();
            $(".basket").hide();
        }else{
            $(".basket-subtotals").show();
            $(".basket-totals").show();
            $(".basket").show();

            var parsedJson = jQuery.parseJSON("["+Cookies.get("items")+"]");
            for(var i = 0; i < parsedJson.length; i++) {
               sub_total = +sub_total + +parsedJson[i].price;
            }
            sub_total = (+sub_total).toFixed(2);

            if (+sub_total > +minimum_order ){
                discount = (+sub_total * (+percentage_discount/100)).toFixed(2);
                $('#minimum-order-warning').html('');
            }else{
                $('#minimum-order-warning').html('<div class="alert alert-success">Minimum order: &pound;'+  minimum_order+'</div>');
               
            }
            
            total = ((+sub_total - +discount ) + +delivery_fee).toFixed(2);

            delivery_fee = (+delivery_fee).toFixed(2);

            Cookies.set('sub_total', sub_total, { expires: 365 }, '/');
            Cookies.set('delivery_fee', delivery_fee, { expires: 365 }, '/');
            Cookies.set('percentage_discount', percentage_discount, { expires: 365 }, '/');
            Cookies.set('discount', discount, { expires: 365 }, '/');
            Cookies.set('total', total, { expires: 365 }, '/');
            Cookies.set('minimum_order', minimum_order, { expires: 365 }, '/');

            $('#basket-subtotal').text(sub_total);
            $('#basket-delivery-fee').text(delivery_fee);
            $('#basket-percentage-discount').text(percentage_discount);
            $('#basket-minimum-order').text(minimum_order);
            $('#basket-total').text(total); 
            $('#basket-discount').text(discount);

        } 
    }



   //  $('.remove-data').click(function() { 
    $('.basket-items').on('click', '.cancel-button', function () {
     

        var id = $(this).children("div").attr('data-item-id');
        var parsedJson = jQuery.parseJSON("["+Cookies.get("items")+"]");
        console.log(parsedJson);
        var parsedJson = $.grep(parsedJson, function(e){ 
             return e.id != id; 
        });
        // console.log(parsedJson);
        parsedJson =JSON.stringify(parsedJson);
        var parsedJson = parsedJson.slice(1, -1);
        // console.log(parsedJson);
        Cookies.set('items', parsedJson, { expires: 365 }, '/');
        remove_item(id);


        // load_basket();
        $(this).parent().parent().parent().parent().remove();
        basket_calculation();
    });   


    $('.collapsible-arrow').click( function () {
            if ($(this).hasClass("fa-angle-down")) {
                $(this).removeClass("fa-angle-down").addClass("fa-angle-left");
            }else if  ($(this).hasClass("fa-angle-left")){
                $(this).removeClass("fa-angle-left").addClass("fa-angle-down");
            }
    });

    if($(window).width() < 768 ){
        $('.menu-body').removeClass('in');
    }


    load_basket();
    basket_calculation();
    
});
