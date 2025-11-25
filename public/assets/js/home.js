(function ($) {
    "use strict";

    /* ---------------------------------------------------
        SPINNER
    --------------------------------------------------- */
    const spinner = () => {
        setTimeout(() => {
            const sp = $("#spinner");
            if (sp.length > 0) {
                sp.removeClass("show");
            }
        }, 1);
    };
    spinner();

    /* ---------------------------------------------------
        WOW INIT
    --------------------------------------------------- */
    if (typeof WOW !== "undefined") {
        new WOW().init();
    }

    /* ---------------------------------------------------
        STICKY NAVBAR
    --------------------------------------------------- */
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 45) {
            $(".nav-bar").addClass("sticky-top shadow-sm").css("top", "0px");
        } else {
            $(".nav-bar")
                .removeClass("sticky-top shadow-sm")
                .css("top", "-100px");
        }
    });

    /* ---------------------------------------------------
        HERO CAROUSEL (OwlCarousel)
    --------------------------------------------------- */

    // Count slides
    const slideCount = $(".header-carousel .header-carousel-item").length;
    console.log("Total slides:", slideCount);

    $(".header-carousel").owlCarousel({
        items: 1,
        margin: 0,
        stagePadding: 0,
        autoplay: slideCount > 1,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 800,
        dots: slideCount > 1,
        loop: slideCount > 1,
        rewind: slideCount > 1,
        nav: slideCount > 1,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>',
        ],
        lazyLoad: false,
        mouseDrag: slideCount > 1,
        touchDrag: slideCount > 1,
        pullDrag: slideCount > 1,
    });

    // Add class if only one slide
    if (slideCount === 1) {
        $(".header-carousel").addClass("single-slide");
        console.log("Single slide mode activated");
    }

    /* ---------------------------------------------------
        BACK TO TOP BUTTON
    --------------------------------------------------- */
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });

    $(".back-to-top").on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    /* ---------------------------------------------------
        MODAL HANDLER (ERROR & SUCCESS)
    --------------------------------------------------- */

    document.addEventListener("DOMContentLoaded", function () {
        // Check hidden indicators
        const hasError = document.querySelector("#modal-error-indicator");
        const hasSuccess = document.querySelector("#modal-success-indicator");

        if (hasError) {
            const modal = document.getElementById("errorModal");
            if (modal) {
                new bootstrap.Modal(modal).show();
            }
        }

        if (hasSuccess) {
            const modal = document.getElementById("successModal");
            if (modal) {
                new bootstrap.Modal(modal).show();
            }
        }
    });
})(jQuery);
