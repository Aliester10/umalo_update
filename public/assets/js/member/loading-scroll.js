/**
 * Umalo - Minimalist Loading with Curtain Effect
 * Version: 3.0.0
 */

(function () {
    "use strict";

    // ==================== CONFIGURATION ====================
    const CONFIG = {
        minLoadingTime: 1000, // Minimum loading time
        maxLoadingTime: 3000, // Maximum loading time
        curtainDuration: 1200, // Curtain animation duration
        transitionDuration: 600, // Page transition duration
        scrollRevealThreshold: 0.15,
    };

    // ==================== PAGE LOADER WITH CURTAIN ====================

    const loadStartTime = Date.now();
    let imagesLoaded = false;
    let minTimeElapsed = false;

    // Track image loading
    function checkImagesLoaded() {
        const images = document.querySelectorAll("img");
        let loadedCount = 0;
        const totalImages = images.length;

        if (totalImages === 0) {
            imagesLoaded = true;
            checkReadyToHideLoader();
            return;
        }

        images.forEach(function (img) {
            if (img.complete) {
                loadedCount++;
            } else {
                img.addEventListener("load", function () {
                    loadedCount++;
                    if (loadedCount === totalImages) {
                        imagesLoaded = true;
                        checkReadyToHideLoader();
                    }
                });
                img.addEventListener("error", function () {
                    loadedCount++;
                    if (loadedCount === totalImages) {
                        imagesLoaded = true;
                        checkReadyToHideLoader();
                    }
                });
            }
        });

        if (loadedCount === totalImages) {
            imagesLoaded = true;
            checkReadyToHideLoader();
        }
    }

    // Minimum time check
    setTimeout(function () {
        minTimeElapsed = true;
        checkReadyToHideLoader();
    }, CONFIG.minLoadingTime);

    // Check if ready to hide
    function checkReadyToHideLoader() {
        if (imagesLoaded && minTimeElapsed) {
            hideLoaderWithCurtain();
        }
    }

    // Hide loader with curtain effect
    function hideLoaderWithCurtain() {
        const loader = document.querySelector(".page-loader");
        if (!loader) return;

        // Trigger curtain animation (bottom to top)
        loader.classList.add("curtain-up");

        // Remove loader after curtain animation
        setTimeout(function () {
            loader.style.display = "none";
            document.body.style.overflow = "";
            document.body.classList.remove("loading");
            document.body.classList.add("loaded");

            // Trigger scroll reveal
            triggerScrollReveal();
        }, CONFIG.curtainDuration);
    }

    // Force hide after max time
    setTimeout(function () {
        hideLoaderWithCurtain();
    }, CONFIG.maxLoadingTime);

    // Initialize loader
    function initLoader() {
        document.body.style.overflow = "hidden";
        document.body.classList.add("loading");

        if (document.readyState === "complete") {
            checkImagesLoaded();
        } else {
            window.addEventListener("load", function () {
                checkImagesLoaded();
            });
        }
    }

    // ==================== PAGE TRANSITION WITH CURTAIN ====================

    function initPageTransition() {
        let overlay = document.querySelector(".page-transition-overlay");
        if (!overlay) {
            overlay = document.createElement("div");
            overlay.className = "page-transition-overlay";
            document.body.appendChild(overlay);
        }

        const links = document.querySelectorAll(
            'a:not([target="_blank"]):not([href^="#"]):not([href^="mailto:"]):not([href^="tel:"])'
        );

        links.forEach(function (link) {
            link.addEventListener("click", function (e) {
                const href = this.getAttribute("href");

                // Check if internal link
                if (
                    href &&
                    !href.startsWith("http://") &&
                    !href.startsWith("https://") &&
                    !href.startsWith("//") &&
                    !this.classList.contains("no-transition") &&
                    !this.hasAttribute("download")
                ) {
                    e.preventDefault();

                    // Activate curtain from bottom
                    overlay.classList.add("active");

                    // Navigate after curtain covers screen
                    setTimeout(function () {
                        window.location.href = href;
                    }, CONFIG.transitionDuration);
                }
            });
        });
    }

    // ==================== SMOOTH SCROLLING ====================

    function initSmoothScroll() {
        // Anchor links
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(function (link) {
            link.addEventListener("click", function (e) {
                const targetId = this.getAttribute("href");

                if (
                    targetId !== "#" &&
                    targetId !== "#!" &&
                    targetId.length > 1
                ) {
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        e.preventDefault();
                        targetElement.scrollIntoView({
                            behavior: "smooth",
                            block: "start",
                        });

                        if (history.pushState) {
                            history.pushState(null, null, targetId);
                        }
                    }
                }
            });
        });

        // Back to top
        const backToTop = document.querySelector(".back-to-top");
        if (backToTop) {
            backToTop.addEventListener("click", function (e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
            });
        }
    }

    // ==================== SCROLL REVEAL ====================

    function initScrollReveal() {
        if (!("IntersectionObserver" in window)) {
            document
                .querySelectorAll(".smooth-section")
                .forEach(function (section) {
                    section.classList.add("visible");
                });
            return;
        }

        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                    }
                });
            },
            {
                threshold: CONFIG.scrollRevealThreshold,
                rootMargin: "0px 0px -80px 0px",
            }
        );

        document
            .querySelectorAll(".smooth-section")
            .forEach(function (section) {
                observer.observe(section);
            });
    }

    function triggerScrollReveal() {
        // Force check visible sections after load
        const sections = document.querySelectorAll(".smooth-section");
        sections.forEach(function (section) {
            const rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.8) {
                section.classList.add("visible");
            }
        });
    }

    // ==================== UTILITY FUNCTIONS ====================

    window.smoothScrollTo = function (target, duration) {
        duration = duration || 1000;
        const targetElement =
            typeof target === "string"
                ? document.querySelector(target)
                : target;
        if (!targetElement) return;

        const targetPosition =
            targetElement.getBoundingClientRect().top + window.pageYOffset;
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = easeInOutCubic(
                timeElapsed,
                startPosition,
                distance,
                duration
            );
            window.scrollTo(0, run);
            if (timeElapsed < duration) {
                requestAnimationFrame(animation);
            }
        }

        function easeInOutCubic(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return (c / 2) * t * t * t + b;
            t -= 2;
            return (c / 2) * (t * t * t + 2) + b;
        }

        requestAnimationFrame(animation);
    };

    // ==================== INITIALIZATION ====================

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", function () {
            initLoader();
            initPageTransition();
            initSmoothScroll();
            initScrollReveal();
        });
    } else {
        initLoader();
        initPageTransition();
        initSmoothScroll();
        initScrollReveal();
    }

    // Debug log (only on localhost)
    if (
        window.location.hostname === "localhost" ||
        window.location.hostname === "127.0.0.1"
    ) {
        console.log(
            "%c✨ Umalo Loading System with Curtain Effect Initialized",
            "color: #015fc9; font-weight: bold; font-size: 14px; font-family: monospace;"
        );
        console.log(
            "%c🎭 Curtain Duration: " + CONFIG.curtainDuration + "ms",
            "color: #6c757d; font-size: 12px;"
        );
    }
})();
