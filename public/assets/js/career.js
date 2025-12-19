// ==========================================
// MODAL FUNCTIONS
// ==========================================
function openModal(index, positionId, positionTitle) {
    document.getElementById("positionId").value = positionId || "";
    document.getElementById("positionTitle").textContent = positionTitle;
    document.getElementById("applicationModal").classList.add("active");
    document.getElementById("errorAlert").style.display = "none";
    document.getElementById("applicationForm").reset();
    document.getElementById("fileName").textContent = "";
    document.body.style.overflow = "hidden";
}

function closeModal() {
    document.getElementById("applicationModal").classList.remove("active");
    document.getElementById("applicationForm").reset();
    document.getElementById("fileName").textContent = "";
    document.getElementById("errorAlert").style.display = "none";
    document.body.style.overflow = "";
}

function closeSuccessModal() {
    document.getElementById("successModal").classList.remove("active");
    document.body.style.overflow = "";
    closeModal();
}

// ==========================================
// FILE UPLOAD HANDLER
// ==========================================
document.getElementById("resume").addEventListener("change", function (e) {
    const fileName = e.target.files[0]?.name;
    if (fileName) {
        document.getElementById("fileName").textContent = fileName;
    }
});

// ==========================================
// FORM SUBMIT HANDLER - AJAX
// ==========================================
document
    .getElementById("applicationForm")
    .addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const actionUrl = this.action;

        const submitBtn = document.getElementById("submitBtn");
        const submitText = document.getElementById("submitText");
        const submitSpinner = document.getElementById("submitSpinner");

        submitBtn.disabled = true;
        submitText.style.display = "none";
        submitSpinner.style.display = "inline";

        fetch(actionUrl, {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then((response) => {
                if (response.ok) {
                    return response.json().then((data) => ({
                        status: response.status,
                        data: data,
                    }));
                } else if (response.status === 422) {
                    return response.json().then((data) => ({
                        status: response.status,
                        data: data,
                    }));
                } else {
                    return response.json().then((data) => ({
                        status: response.status,
                        data: data,
                    }));
                }
            })
            .then((result) => {
                submitBtn.disabled = false;
                submitText.style.display = "inline";
                submitSpinner.style.display = "none";

                if (result.status === 200 && result.data.success) {
                    document
                        .getElementById("applicationModal")
                        .classList.remove("active");
                    document
                        .getElementById("successModal")
                        .classList.add("active");
                    document.getElementById("applicationForm").reset();
                    document.getElementById("fileName").textContent = "";
                } else {
                    const errorAlert = document.getElementById("errorAlert");
                    const errorMessage =
                        document.getElementById("errorMessage");

                    if (result.data.errors) {
                        const errorList = Object.values(result.data.errors)
                            .flat()
                            .join(", ");
                        errorMessage.textContent = errorList;
                    } else {
                        errorMessage.textContent =
                            result.data.message ||
                            "An error occurred.Please try again.";
                    }

                    errorAlert.style.display = "flex";
                    document.querySelector(".modal-container").scrollTop = 0;
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                submitBtn.disabled = false;
                submitText.style.display = "inline";
                submitSpinner.style.display = "none";

                const errorAlert = document.getElementById("errorAlert");
                const errorMessage = document.getElementById("errorMessage");
                errorMessage.textContent = "Network error.Please try again.";
                errorAlert.style.display = "flex";
                document.querySelector(".modal-container").scrollTop = 0;
            });
    });

// ==========================================
// JOB FILTER FUNCTIONS
// ==========================================
function filterJobs() {
    const searchTerm = document.getElementById("searchJob").value.toLowerCase();
    const typeFilter = document.getElementById("typeFilter").value;

    const jobItems = document.querySelectorAll(".job-item");
    let visibleCount = 0;

    jobItems.forEach((item) => {
        const title = item
            .querySelector(".job-title")
            .textContent.toLowerCase();
        const description = item
            .querySelector(".job-description")
            .textContent.toLowerCase();
        const type = item.dataset.type;

        const matchSearch =
            title.includes(searchTerm) || description.includes(searchTerm);
        const matchType = typeFilter === "all" || type === typeFilter;

        if (matchSearch && matchType) {
            item.style.display = "";
            visibleCount++;
        } else {
            item.style.display = "none";
        }
    });

    document.getElementById("noResults").style.display =
        visibleCount === 0 ? "block" : "none";
}

// ==========================================
// MODAL OVERLAY CLICK HANDLER
// ==========================================
document
    .getElementById("applicationModal")
    .addEventListener("click", function (e) {
        if (e.target === this || e.target.classList.contains("modal-overlay")) {
            closeModal();
        }
    });

document.getElementById("successModal").addEventListener("click", function (e) {
    if (e.target === this || e.target.classList.contains("modal-overlay")) {
        closeSuccessModal();
    }
});

// ==========================================
// INITIALIZATION
// ==========================================
document.addEventListener("DOMContentLoaded", function () {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href !== "#" && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const offsetTop = target.offsetTop - 90;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: "smooth",
                    });
                }
            }
        });
    });

    // Close modal with ESC key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            if (
                document
                    .getElementById("applicationModal")
                    .classList.contains("active")
            ) {
                closeModal();
            }
            if (
                document
                    .getElementById("successModal")
                    .classList.contains("active")
            ) {
                closeSuccessModal();
            }
        }
    });

    // Animation on scroll for elements
    const observerOptions = {
        threshold: 0.2,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document
        .querySelectorAll(".stat-box, .benefit-card, .job-item")
        .forEach((el) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(30px)";
            el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
            observer.observe(el);
        });

    // Touch device detection
    const isTouchDevice =
        "ontouchstart" in window || navigator.maxTouchPoints > 0;
    if (isTouchDevice) {
        document.body.classList.add("touch-device");
    }

    // Viewport height fix for mobile browsers
    const setVH = () => {
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty("--vh", `${vh}px`);
    };
    setVH();
    window.addEventListener("resize", setVH);
    window.addEventListener("orientationchange", setVH);

    // ==========================================
    // FIX BACK TO TOP BUTTON ON MOBILE
    // ==========================================
    const fixBackToTop = () => {
        const backToTopSelectors = [
            ".back-to-top",
            "#backToTop",
            "#back-to-top",
            ".scroll-to-top",
            ".scrollToTop",
            ".scroll-top",
            ".btn-scroll-top",
            '[class*="back-top"]',
            '[class*="scroll-top"]',
            '[class*="totop"]',
        ];

        backToTopSelectors.forEach((selector) => {
            const elements = document.querySelectorAll(selector);
            elements.forEach((el) => {
                if (el) {
                    // Force apply styles via JavaScript
                    el.style.cssText = `
              position: fixed ! important;
              bottom: 20px !important;
              right: 20px !important;
              left: auto !important;
              top: auto !important;
              width: 48px !important;
              height: 48px !important;
              min-width: 48px !important;
              min-height: 48px !important;
              max-width: 48px !important;
              max-height:  48px !important;
              border-radius: 50% !important;
              background:  #1a1a1a ! important;
              color: #ffffff !important;
              display: flex !important;
              align-items: center !important;
              justify-content: center !important;
              box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
              z-index:  9999 ! important;
              cursor: pointer !important;
              border: none !important;
              padding: 0 ! important;
              margin: 0 ! important;
              transform: none !important;
              font-size: 18px !important;
              overflow: hidden !important;
            `;

                    // Adjust for smaller mobile screens
                    if (window.innerWidth <= 479) {
                        el.style.width = "42px";
                        el.style.height = "42px";
                        el.style.minWidth = "42px";
                        el.style.minHeight = "42px";
                        el.style.maxWidth = "42px";
                        el.style.maxHeight = "42px";
                        el.style.bottom = "14px";
                        el.style.right = "14px";
                        el.style.fontSize = "14px";
                    } else if (window.innerWidth <= 767) {
                        el.style.width = "44px";
                        el.style.height = "44px";
                        el.style.minWidth = "44px";
                        el.style.minHeight = "44px";
                        el.style.maxWidth = "44px";
                        el.style.maxHeight = "44px";
                        el.style.bottom = "16px";
                        el.style.right = "16px";
                        el.style.fontSize = "15px";
                    }

                    // Fix icon inside button
                    const icon = el.querySelector("i");
                    if (icon) {
                        icon.style.cssText = `
                font-size: inherit !important;
                line-height: 1 !important;
                margin:  0 !important;
                padding: 0 !important;
              `;
                    }
                }
            });
        });
    };

    // Run fix on load
    fixBackToTop();

    // Run fix on resize
    window.addEventListener("resize", fixBackToTop);

    // Run fix after a short delay (in case the button is added dynamically)
    setTimeout(fixBackToTop, 500);
    setTimeout(fixBackToTop, 1000);
    setTimeout(fixBackToTop, 2000);

    // Console log
    console.log(
        "%c╔═══════════════════════════════════════════════════════╗",
        "color: #228B22; font-weight: bold; font-size: 14px"
    );
    console.log(
        "%c║   UMALO CAREER PAGE - FULLY RESPONSIVE               ║",
        "color: #228B22; font-weight: bold; font-size: 16px"
    );
    console.log(
        "%c║   Back to Top Button Fixed for Mobile                ║",
        "color: #228B22; font-weight: bold; font-size: 14px"
    );
    console.log(
        "%c║   Updated:  2025-12-09                                ║",
        "color: #228B22; font-weight:  bold; font-size: 14px"
    );
    console.log(
        "%c╚═══════════════════════════════════════════════════════╝",
        "color: #228B22; font-weight:  bold; font-size: 14px"
    );
});
