/*
Template: sofbox - Modern Web Applications WordPress Theme
Author: iqonicthemes.in
Version: 1.0
Design and Developed by: iqonicthemes.in
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

1.Page Loader
2.Isotope
3.Masonry
4.Slick
5.Swiper
6.Progress Bar
7.Counter
8.Coming soon
6.Timer
7.Back To Top
8.Accordion
9.Magnific Popup
10.Owl Carousel
11.Wow Animation
12.Skrollr
13.Tab

------------------------------------------------
Index Of Script
----------------------------------------------*/
(function(jQuery) {

    "use strict";
    jQuery(document).ready(function() {

        jQuery(window).on('load', function(e) {

             jQuery('ul.page-numbers').addClass('justify-content-center');

            /*------------------------
            Page Loader
            --------------------------*/
            jQuery("#load").fadeOut();
            jQuery("#loading").delay(0).fadeOut("slow");

            /*------------------------
            Back To Top
            --------------------------*/
            jQuery('#back-to-top').fadeOut();
            jQuery(window).on("scroll", function() {
                if (jQuery(this).scrollTop() > 250) {
                    jQuery('#back-to-top').fadeIn(1400);
                } else {
                    jQuery('#back-to-top').fadeOut(400);
                }
            });

            // scroll body to 0px on click
            jQuery('#top').on('click', function() {
                jQuery('top').tooltip('hide');
                jQuery('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

            /*------------------------
            Header
            --------------------------*/
           

            // jQuery('.sub-menu').css('display', 'none');
            // jQuery('.sub-menu').prev().addClass('isubmenu');
            // jQuery(".sub-menu").before('<i class="fa fa-angle-down toggledrop" aria-hidden="true"></i>');

            // jQuery('.widget .fa.fa-angle-down, #main .fa.fa-angle-down').on('click', function() {
            //     jQuery(this).next('.children, .sub-menu').slideToggle();
            // });

            // jQuery("#top-menu .menu-item .toggledrop").off("click");
            // if (jQuery(window).width() < 992) {
            //     jQuery('#top-menu .menu-item .toggledrop').on('click', function(e) {
            //         e.preventDefault();
            //         jQuery(this).next('.children, .sub-menu').slideToggle();
            //     });
            // }
     
            // jQuery(window).on('resize', function() {
            //     "use strict";
            //     jQuery('.widget .fa.fa-angle-down, #main .fa.fa-angle-down').on('click', function() {
            //         jQuery(this).next('.children, .sub-menu').slideToggle();
            //     });

            //     jQuery("#top-menu .menu-item .toggledrop").off("click");
            //     if (jQuery(window).width() < 992) {
            //         jQuery('#top-menu .menu-item .toggledrop').on('click', function(e) {
            //             e.preventDefault();
            //             jQuery(this).next('.children, .sub-menu').slideToggle();
            //         });
            //     }
            // });


        /*---------------------------
        Sidebar
        ---------------------------*/
        jQuery( "#menu-btn-side-open" ).click(function() {
            jQuery( "body" ).toggleClass("side-bar-open");

        });

        jQuery( "#menu-btn-side-close" ).click(function() {
            jQuery( "body" ).toggleClass("side-bar-open");
        });

         jQuery('body').mouseup(function (e) { 
            if (jQuery(e.target).closest(".iq-menu-side-bar").length === 0) { 
                jQuery( "body" ).removeClass("side-bar-open"); 
            } 
        });

        let options;
        let ScrollbarSidebar = window.Scrollbar; 

        jQuery(window).scroll(function() {    
            let scroll = jQuery(window).scrollTop();    
            if (scroll >= 10 && jQuery( "body" ).hasClass("side-bar-open")) {
                jQuery( "body" ).removeClass("side-bar-open");
            }
        });

        if (jQuery('#sidebar-scrollbar').length)
        {
            ScrollbarSidebar.init(document.querySelector('#sidebar-scrollbar'), {continuousScrolling: false} );
        }
    
   
        /*---------------------------
        Vertical Menu
        ---------------------------*/
        let ScrollbarMenu = window.Scrollbar;
        if (jQuery('#menu-sidebar-scrollbar').length){
            ScrollbarMenu.init(document.querySelector('#menu-sidebar-scrollbar'), options);

        }

        if(jQuery('.vertical').length > 0 ){

            jQuery('.vertical ul .sub-menu').addClass('iq-has-sub-menu');
            jQuery('.vertical ul').removeClass('sub-menu');
            jQuery('#vertical-menu > li > ul').attr('data-parent','#vertical-menu');
           
            jQuery(".vertical li.menu-item-has-children").each(function() {

                
            let href = jQuery(this).find('a:first').attr('href');
            let id = href.replace('#','');

            if(id == '')
            { 
                id = 'menuId-'+Math.floor((Math.random() * 100000) + 1);
                jQuery(this).find('a:first').attr('href','#'+id);
            }

            jQuery(this).find('a:first').prepend( "<i class='fa fa-angle-right iq-arrow-right'></i>" );
            jQuery(this).find('a:first').attr('data-toggle','collapse');
            jQuery(this).find('a:first').attr('aria-expanded','false');
            jQuery(this).find('a:first').addClass('iq-waves-effect');
            jQuery(this).find('ul.iq-has-sub-menu:first').addClass('collapse');
            jQuery(this).find('ul.iq-has-sub-menu:first').attr('id',id);

            });

        }

        jQuery(document).on("click", '#vertical-menu > li > a', function() {
            jQuery('#vertical-menu > li > a').parent().removeClass('active');
            jQuery(this).parent().addClass('active');
        });

        jQuery( "#vertical-menu-btn-close" ).click(function() {
            jQuery( "body" ).toggleClass("vertical-menu-close");

        });

        jQuery( "#vertical-menu-btn-open" ).click(function() {
            jQuery( "body" ).toggleClass("vertical-menu-close");
        });

         jQuery('body').mouseup(function (e) { 
            if (jQuery(e.target).closest(".style-vertical").length === 0) {
                  jQuery( "body" ).removeClass("vertical-menu-close");
            } 
        });

        /*---------------------------------------------------------------------
        Ripple Effect
        -----------------------------------------------------------------------*/
        jQuery(document).on('click', ".iq-waves-effect", function(e) {
            // Remove any old one
            jQuery('.ripple').remove();
            // Setup
            let posX = jQuery(this).offset().left,
                posY = jQuery(this).offset().top,
                buttonWidth = jQuery(this).width(),
                buttonHeight = jQuery(this).height();

            // Add the element
            jQuery(this).prepend("<span class='ripple'></span>");


            // Make it round!
            if (buttonWidth >= buttonHeight) {
                buttonHeight = buttonWidth;
            } else {
                buttonWidth = buttonHeight;
            }

            // Get the center of the element
            let x = e.pageX - posX - buttonWidth / 2;
            let y = e.pageY - posY - buttonHeight / 2;


            // Add the ripples CSS and start the animation
            jQuery(".ripple").css({
                width: buttonWidth,
                height: buttonHeight,
                top: y + 'px',
                left: x + 'px'
            }).addClass("rippleEffect");
        });


            /*------------------------
            Wow Animation
            --------------------------*/
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: false,
                live: true
            });
            wow.init();

        });
            /*------------------------
            scroller
            --------------------------*/
            if (jQuery(window).width() > 992) {
                skrollr.init({
                forceHeight: false
               });
            }

        /*---------------------------
        Tabs
        ---------------------------*/
        jQuery(document).ready(function() {
            var a = jQuery('#iq-features .nav.nav-tabs').each(function() {
                var b = jQuery(this).find('a.active').addClass('active');
                activaTab(b);
            })
        });

        function activaTab(pill) {
            jQuery(pill).addClass('active show');
        };

        var count_tabs = jQuery("#count-tabs").val();
        for(var i =0; i<=count_tabs; i++) {
            var maxnumber = jQuery("#number_user_"+i).val();
            jQuery('#user_range_'+i).range({
                min: 1,
                max: maxnumber,
                start: 1,
                step:1,
                input:'#user_text_'+i
          });
        }

        for(var i =0; i<=count_tabs; i++) {
            var maxnumber = jQuery("#number_time"+i).val();
            jQuery('#time_range_'+i).range({
                min: 1,
                max: maxnumber,
                start: 1,
                step:1,
                input:'#time_text_'+i
          });
        }

        jQuery(".input-range").on("click",function(){
           var check = jQuery(this).attr('id');


           var id = jQuery(this).attr('id').match(/\d+/);
           var user_range = jQuery('#user_range_'+id);
           var time_range = jQuery('#time_range_'+id);
           var user_text = jQuery('#user_text_'+id);
           var time_text = jQuery('#time_text_'+id);
           var total = jQuery('#total_'+id);
           var base = jQuery('#base_'+id);
           total.val(user_text.val()*time_text.val()*base.val());
           console.log(user_text.val()*time_text.val()*base.val());
        });

        jQuery(".price-checkbox").on("click",function(){
            var a = [];
            var id =  jQuery(this).attr('primary').match(/\d+/);
            var price = 0;
            var user_range = jQuery('#user_range_'+id);
            var time_range = jQuery('#time_range_'+id);
            var user_text = jQuery('#user_text_'+id);
            var time_text = jQuery('#time_text_'+id);
            var total = jQuery('#total_'+id);
            var base = jQuery('#base_'+id);
            // console.log(id);
            // console.log(base);

            jQuery(".chk_"+id+":checked").each(function() {
                price+=parseInt(jQuery(this).val());
            });

            base.val(price);
            total.val(user_text.val()*time_text.val()*base.val());
            console.log(price);
        });


       


    });
})(jQuery);