(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner(0);

    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $(".nav-bar").addClass("sticky-top shadow-sm").css("top", "0px");
        } else {
            $(".nav-bar")
                .removeClass("sticky-top shadow-sm")
                .css("top", "-100px");
        }
    });

    // Header carousel - NO FADE ANIMATION (Prevents white flash)
    $(".header-carousel").owlCarousel({
        items: 1,
        margin: 0,
        stagePadding: 0,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        smartSpeed: 800, // Smooth transition speed
        dots: true,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>',
        ],
        lazyLoad: false,
        // No fade effect - uses slide animation instead
        onInitialized: function (event) {
            // Preload images on initialization
            $(".header-carousel .header-carousel-item").each(function () {
                var bgImage = $(this).css("background-image");
                if (bgImage && bgImage !== "none") {
                    var imageUrl = bgImage.replace(
                        /url\(['"]?(.*?)['"]?\)/i,
                        "$1"
                    );
                    var img = new Image();
                    img.src = imageUrl;
                }
            });
        },
        onTranslate: function (event) {
            // Ensure smooth transition without white background
            $(".header-carousel").css("background", "transparent");
        },
        onTranslated: function (event) {
            // Maintain transparency after transition
            $(".header-carousel").css("background", "transparent");
        },
    });

    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
            '<i class="fa fa-arrow-right"></i>',
            '<i class="fa fa-arrow-left"></i>',
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 2,
            },
        },
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });

    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });
})(jQuery);
