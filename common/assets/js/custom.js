// ==================================================
// * Project Name   :  School Management
// * File           :  JS Base
// * Version        :  1.0.0
// * Project Start  :  23 Oct 2022
// * Developer      :  Imran Hosain
// ==================================================
(function ($) {
    "use strict";
    // =============== back-to-top start ===============
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $(".backtotop:hidden").stop(true, true).fadeIn();
        } else {
            $(".backtotop").stop(true, true).fadeOut();
        }
    });
    $(function () {
        $(".scroll").on("click", function () {
            $("html,body").animate({ scrollTop: 0 }, "slow");
            return false;
        });
    });

    // =============== aos animation start ===============
    AOS.init();
    
})(jQuery);
