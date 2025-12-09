// Sort functionality
document.getElementById("sort-by").addEventListener("change", function () {
    var sort = this.value;
    window.location.href = "?sort=" + sort;
});

// Search functionality
const searchInput = document.getElementById("searchActivities");
const clearSearchBtn = document.getElementById("clearSearch");
const activitiesGrid = document.getElementById("activitiesGrid");

if (searchInput) {
    searchInput.addEventListener("input", function () {
        const searchTerm = this.value.toLowerCase();
        const cards = activitiesGrid.querySelectorAll(
            ".activity-card-international"
        );

        if (searchTerm.length > 0) {
            clearSearchBtn.style.display = "flex";
        } else {
            clearSearchBtn.style.display = "none";
        }

        cards.forEach((card) => {
            const title = card
                .querySelector(".card-title-international a")
                .textContent.toLowerCase();
            const description = card
                .querySelector(".card-excerpt")
                .textContent.toLowerCase();
            const category =
                card
                    .querySelector(".card-category")
                    ?.textContent.toLowerCase() || "";
            const tags = Array.from(card.querySelectorAll(".tag-international"))
                .map((tag) => tag.textContent.toLowerCase())
                .join(" ");
            const location =
                Array.from(card.querySelectorAll(".info-item"))
                    .find((item) => item.textContent.includes("location"))
                    ?.textContent.toLowerCase() || "";

            if (
                title.includes(searchTerm) ||
                description.includes(searchTerm) ||
                category.includes(searchTerm) ||
                tags.includes(searchTerm) ||
                location.includes(searchTerm)
            ) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    });
}

if (clearSearchBtn) {
    clearSearchBtn.addEventListener("click", function () {
        searchInput.value = "";
        searchInput.dispatchEvent(new Event("input"));
    });
}

// Initialize AOS if available
if (typeof AOS !== "undefined") {
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
    });
}
