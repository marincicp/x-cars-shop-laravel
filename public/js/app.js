import { imageCarousel } from "./components/index.js";
import { CityDropdownData, ModelDropdownData } from "./class/index.js";
import DropdownView from "./views/DropdownView.js";
import initSlider from "./components/slider.js";
import initImagePicker from "./components/imagePicker.js";
import initSortingDropdown from "./components/sortingDropdown.js";
import { initSingleClickBtns } from "./helpers/helpers.js";
import initMobileNavbar from "./components/mobileNavbar.js";
import initMobileFilters from "./components/mobileFilters.js";

document.addEventListener("DOMContentLoaded", function () {
    initSingleClickBtns();
    initSlider();
    initImagePicker();
    initMobileNavbar();
    imageCarousel();
    initMobileFilters();
    initSortingDropdown();

    const dropdownModelView = new DropdownView(
        "#makerSelect",
        "#modelSelect",
        ModelDropdownData
    );
    const dropdownCityView = new DropdownView(
        "#stateSelect",
        "#citySelect",
        CityDropdownData
    );

    ScrollReveal().reveal(".hero-slide.active .hero-slider-title", {
        delay: 200,
        reset: true,
    });
    ScrollReveal().reveal(".hero-slide.active .hero-slider-content", {
        delay: 200,
        origin: "bottom",
        distance: "50%",
    });
});
