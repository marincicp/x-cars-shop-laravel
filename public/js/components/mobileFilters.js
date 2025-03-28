export default function initMobileFilters() {
    const filterButton = document.querySelector(".show-filters-button");
    const sidebar = document.querySelector(".search-cars-sidebar");
    const closeButton = document.querySelector(".close-filters-button");

    if (!filterButton) return;

    console.log(filterButton.classList);
    filterButton.addEventListener("click", () => {
        if (sidebar.classList.contains("opened")) {
            sidebar.classList.remove("opened");
        } else {
            sidebar.classList.add("opened");
        }
    });

    if (closeButton) {
        closeButton.addEventListener("click", () => {
            sidebar.classList.remove("opened");
        });
    }
}
