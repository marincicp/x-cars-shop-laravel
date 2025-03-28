export default function initSortingDropdown() {
    const sortingDropdown = document.querySelector(".sort-dropdown");
    if (!sortingDropdown) return;

    // Init sorting dropdown with the current value
    const url = new URL(window.location.href);
    const sortValue = url.searchParams.get("sort");
    if (sortValue) {
        sortingDropdown.value = sortValue;
    }

    sortingDropdown.addEventListener("change", (ev) => {
        const url = new URL(window.location.href);
        url.searchParams.set("sort", ev.target.value);
        window.location.href = url.toString();
    });
}
