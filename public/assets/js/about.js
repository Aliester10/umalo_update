document.addEventListener("DOMContentLoaded", function () {
    // Production Timeline
    const productionSteps = document.querySelectorAll(".production-step");
    const timelineLine = document.querySelector(".timeline-line");

    const observerOptions = {
        threshold: 0.3,
        rootMargin: "0px 0px -100px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("in-view");

                if (timelineLine) {
                    const stepIndex = Array.from(productionSteps).indexOf(
                        entry.target
                    );
                    const percentage =
                        ((stepIndex + 1) / productionSteps.length) * 100;
                    timelineLine.style.height = percentage + "%";
                }
            }
        });
    }, observerOptions);

    productionSteps.forEach((step) => observer.observe(step));

    // Smooth reveal animations
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        },
        { threshold: 0.1 }
    );

    document
        .querySelectorAll(".core-value-item, .team-card, .vm-card")
        .forEach((el) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(20px)";
            el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
            revealObserver.observe(el);
        });
});
