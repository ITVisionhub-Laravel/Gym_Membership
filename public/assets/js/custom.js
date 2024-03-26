(function ($) {
    "use strict";

    $(function () {
        $("#tabs").tabs();
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        var box = $(".header-text").height();
        var header = $("header").height();

        if (scroll >= box - header) {
            $("header").addClass("background-header");
        } else {
            $("header").removeClass("background-header");
        }
    });

$(".schedule-filter li").on("click", function () {
    var tsfilter = $(this).data("tsfilter"); 
    $(".schedule-filter li").removeClass("active");
    $(this).addClass("active");
    
    $(".ts-item").hide(); // Hide all rows
   
    $(".ts-item[data-tsmeta='" + tsfilter + "']").show(); // Show rows with matching data-tsmeta
});

    // Window Resize Mobile Menu Fix
    mobileNav();

    // Scroll animation init
    window.sr = new scrollReveal();

    // Menu Dropdown Toggle
    if ($(".menu-trigger").length) {
        $(".menu-trigger").on("click", function () {
            $(this).toggleClass("active");
            $(".header-area .nav").slideToggle(200);
        });
    }

    $(document).ready(function () {
        $(".schedule-filter li[data-tsfilter='Monday']").click();

        $(document).on("scroll", onScroll);

        //smoothscroll
        $('.scroll-to-section a[href^="#"]').on("click", function (e) {
            e.preventDefault();
            $(document).off("scroll");

            $("a").each(function () {
                $(this).removeClass("active");
            });
            $(this).addClass("active");

            var target = this.hash,
                menu = target;
            var target = $(this.hash);
            $("html, body")
                .stop()
                .animate(
                    {
                        scrollTop: target.offset().top + 1,
                    },
                    500,
                    "swing",
                    function () {
                        window.location.hash = target;
                        $(document).on("scroll", onScroll);
                    }
                );
        });
    });

    // function onScroll(event) {
    //     var scrollPos = $(document).scrollTop();
    //     $(".nav a").each(function () {
    //         var currLink = $(this);
    //         var refElement = $(currLink.attr("href"));
    //         if (
    //             refElement.position().top <= scrollPos &&
    //             refElement.position().top + refElement.height() > scrollPos
    //         ) {
    //             $(".nav ul li a").removeClass("active");
    //             currLink.addClass("active");
    //         } else {
    //             currLink.removeClass("active");
    //         }
    //     });
    // }

    
$(".nav a").on("click", function () { 
    var currLink = $(this);
    var targetId = currLink.attr("href");
    history.pushState(null, '', targetId);
});

 function onScroll(event) {
    var scrollPos = $(document).scrollTop();
    // var activeLinkFound = false;

    $(".nav a").each(function () {
        var currLink = $(this);
        var targetId = currLink.attr("href");

        // Check if targetId is a valid ID (starts with '#')
        if (targetId && targetId.charAt(0) === '#') {
            // Smooth scrolling to the target section
            var targetSection = $(targetId);
            var targetTop = targetSection.offset().top;
            var targetBottom = targetTop + targetSection.outerHeight();

            if (targetTop <= scrollPos && targetBottom > scrollPos) {
                $(".nav ul li a").removeClass("active");
                currLink.addClass("active"); 
                
                // Update the URL with the target ID
                // history.pushState(null, '', targetId);

                // // Set flag to indicate that an active link was found
                // activeLinkFound = true;
            } else {
                currLink.removeClass("active");
            }
        }
    });

    // If no active link was found, reset the URL to remove the target ID
    // if (!activeLinkFound) {
    //     history.pushState(null, '', window.location.pathname);
    // }
}


    // Page loading animation
    $(window).on("load", function () {
        $("#js-preloader").addClass("loaded");
    });

    // Window Resize Mobile Menu Fix
    $(window).on("resize", function () {
        mobileNav();
    });

    // Window Resize Mobile Menu Fix
    function mobileNav() {
        var width = $(window).width();
        $(".submenu").on("click", function () {
            if (width < 767) {
                $(".submenu ul").removeClass("active");
                $(this).find("ul").toggleClass("active");
            }
        });
    }
})(window.jQuery);
