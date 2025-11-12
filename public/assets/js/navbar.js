const hamburger = document.getElementById("hamburger");
const mobileMenu = document.getElementById("mobileMenu");
const searchBox = document.getElementById("searchBox");
const searchToggle = document.getElementById("searchToggle");
const searchInput = document.getElementById("searchInput");
const searchBoxMobile = document.getElementById("searchBoxMobile");
const searchToggleMobile = document.getElementById("searchToggleMobile");
const searchInputMobile = document.getElementById("searchInputMobile");

// Desktop search
if (searchToggle && searchBox && searchInput) {
    searchToggle.addEventListener("click", (e) => {
        e.stopPropagation();
        searchBox.classList.toggle("active");
        if (searchBox.classList.contains("active")) searchInput.focus();
    });
    document.addEventListener("click", (e) => {
        if (!searchBox.contains(e.target)) searchBox.classList.remove("active");
    });
}

// Mobile search
if (searchToggleMobile && searchBoxMobile && searchInputMobile) {
    searchToggleMobile.addEventListener("click", (e) => {
        e.stopPropagation();
        searchBoxMobile.classList.toggle("active");
        if (searchBoxMobile.classList.contains("active"))
            searchInputMobile.focus();
    });
    document.addEventListener("click", (e) => {
        if (!searchBoxMobile.contains(e.target))
            searchBoxMobile.classList.remove("active");
    });
}

// Hamburger
if (hamburger && mobileMenu) {
    hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        mobileMenu.classList.toggle("active");
        document.body.style.overflow = mobileMenu.classList.contains("active")
            ? "hidden"
            : "";
    });
}

// Tutup menu jika klik di luar
document.addEventListener("click", (e) => {
    if (
        hamburger &&
        mobileMenu &&
        !hamburger.contains(e.target) &&
        !mobileMenu.contains(e.target)
    ) {
        hamburger.classList.remove("active");
        mobileMenu.classList.remove("active");
        document.body.style.overflow = "";
    }
});

// Escape key untuk close
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        if (hamburger) hamburger.classList.remove("active");
        if (mobileMenu) mobileMenu.classList.remove("active");
        searchBox?.classList.remove("active");
        searchBoxMobile?.classList.remove("active");
        document.body.style.overflow = "";
    }
});
