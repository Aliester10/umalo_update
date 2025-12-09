(function ($) {
    "use strict";

    /* ============================
        SPINNER
    ============================ */
    const spinner = () => {
        setTimeout(() => {
            const sp = $("#spinner");
            if (sp.length > 0) sp.removeClass("show");
        }, 1);
    };
    spinner();

    /* ============================
        WOW
    ============================ */
    if (typeof WOW !== "undefined") {
        new WOW().init();
    }

    /* ============================
        STICKY NAV
    ============================ */
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 45) {
            $(".nav-bar").addClass("sticky-top shadow-sm").css("top", "0px");
        } else {
            $(".nav-bar")
                .removeClass("sticky-top shadow-sm")
                .css("top", "-100px");
        }
    });

    /* ============================
        ✅ FINAL MOBILE DESKTOP SWITCH (ANTI BUG)
    ============================ */
    function updateCarouselBackground() {
        const isMobile = window.innerWidth <= 768;

        $(".header-carousel-item").each(function () {
            const desktopImg = $(this).data("desktop");
            const mobileImg = $(this).data("mobile");

            const finalDesktop = desktopImg;
            const finalMobile = mobileImg ? mobileImg : desktopImg;

            // ✅ DESKTOP = background langsung
            $(this).css("background-image", `url('${finalDesktop}')`);

            // ✅ MOBILE = lewat CSS Variable utk ::before
            this.style.setProperty("--mobile-bg", `url('${finalMobile}')`);
        });
    }

    /* ============================
        OWL INIT
    ============================ */
    const slideCount = $(".header-carousel .header-carousel-item").length;

    const owl = $(".header-carousel").owlCarousel({
        items: 1,
        margin: 0,
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
    });

    // ✅ WAJIB ADA INIT INI
    owl.on("initialized.owl.carousel", function () {
        updateCarouselBackground();
    });

    owl.on("changed.owl.carousel", function () {
        updateCarouselBackground();
    });

    $(window).on("resize orientationchange", function () {
        updateCarouselBackground();
    });

    /* ============================
        BACK TO TOP
    ============================ */
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
})(jQuery);
