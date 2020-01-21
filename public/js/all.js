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

  $('div.alert').not('.alert-important').delay(30000).fadeOut(350);
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

    $('.collapsible-arrow').click( function () {
            if ($(this).hasClass("fa-angle-down")) {
                $(this).removeClass("fa-angle-down").addClass("fa-angle-left");
            }
             if  ($(this).hasClass("fa-angle-left")){
                $(this).removeClass("fa-angle-left").addClass("fa-angle-down");
            }
    });

    if($(window).width() < 768 ){
        $('.menu-body').removeClass('in');
        $('.navbar-brand').html('<i class="fa fa-shopping-cart"></i> <span class=""><span class="basket-count"></span></span> item/s: £<span class="basket-total">0</span>').attr('href','checkout');
        $('#sticky-block-left').hide();
        $('#main-menu').appendTo('#sticky-block-right');
        $('#sticky-block-right').show();
        $('.sticky-2').removeAttr('id');
        $("#sticky-block-right").children().removeClass(function (index, css) {
            return (css.match (/(^|\s)col-\S+/g) || []).join(' ');
        });
        $('.phone-for-mobile').show();
    }

});