//(function(jQuery) {

    "use strict";
    jQuery(document).ready(function() {

        //jQuery(window).on('load', function(e) {
            
            jQuery(window).on('scroll', function() {
                if (jQuery(this).scrollTop() > 20) {
                    jQuery('header.has-sticky').addClass('menu-sticky');
                } else {
                    jQuery('header.has-sticky').removeClass('menu-sticky');
                }
            });
        
       // });
    });
//})(jQuery);