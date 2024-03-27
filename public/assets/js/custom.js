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

    function onScroll() {
    var scrollPos = $(window).scrollTop();

    // Check if we are at the top of the page
    if (scrollPos === 0) {
        $(".nav a").removeClass("active"); // Remove active class from all links
        $(".nav a[href='#home']").addClass("active"); // Add active class to the home link
        
        // Remove hash fragment from the URL
        history.replaceState(null, document.title, window.location.pathname);
        
        return;
    }

    $(".nav a").each(function () {
        var currLink = $(this);
        var targetId = currLink.attr("href");

        if (targetId && targetId.charAt(0) === '#') {
            var targetSection = $(targetId);
            var targetTop = targetSection.offset().top;
            var targetBottom = targetTop + targetSection.outerHeight();

            if (targetTop <= scrollPos && targetBottom > scrollPos) {
                $(".nav ul li a").removeClass("active");
                currLink.addClass("active");

                // Update URL
                history.pushState(null, '', targetId);
            } else {
                currLink.removeClass("active");
            }
        }
    });
}

// Click event handler for navigation links
// $(".nav a").on("click", function (event) {
//     event.preventDefault();

//     var currLink = $(this);
//     var targetId = currLink.attr("href");

//     // Update URL
//     history.pushState(null, '', targetId);

//     // Update active navigation link
//     $(".nav a").removeClass("active");
//     currLink.addClass("active");

//     // Scroll to target section smoothly
//     $('html, body').animate({
//         scrollTop: $(targetId).offset().top
//     }, 800);
// });

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
