import { imageCarousel } from "./components/index.js";

import { CityDropdownData, ModelDropdownData } from "./class/index.js";
import DropdownView from "./views/DropdownView.js";

import { initSingleClickBtns } from "./helpers/helpers.js";
document.addEventListener("DOMContentLoaded", function () {
    const submitBtns = document.querySelectorAll("button[data-single-click]");

    submitBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            btn.disabled = true;
            const form = btn.closest("form");
            if (form) {
                form.submit();
            }
            setTimeout(() => {
                btn.disabled = false;
            }, 900);
        });
    });

    const initSlider = () => {
        const slides = document.querySelectorAll(".hero-slide");
        let currentIndex = 0; // Track the current slide
        const totalSlides = slides.length;

        function moveToSlide(n) {
            slides.forEach((slide, index) => {
                slide.style.transform = `translateX(${-100 * n}%)`;
                if (n === index) {
                    slide.classList.add("active");
                } else {
                    slide.classList.remove("active");
                }
            });
            currentIndex = n;
        }

        // Function to go to the next slide
        function nextSlide() {
            if (currentIndex === totalSlides - 1) {
                moveToSlide(0); // Go to the first slide if we're at the last
            } else {
                moveToSlide(currentIndex + 1);
            }
        }

        // Function to go to the previous slide
        function prevSlide() {
            if (currentIndex === 0) {
                moveToSlide(totalSlides - 1); // Go to the last slide if we're at the first
            } else {
                moveToSlide(currentIndex - 1);
            }
        }

        console.log(imageCarousel);

        // Example usage with buttons
        // Assuming you have buttons with classes `.next` and `.prev` for navigation
        const carouselNextButton = document.querySelector(".hero-slide-next");
        if (carouselNextButton) {
            carouselNextButton.addEventListener("click", nextSlide);
        }
        const carouselPrevButton = document.querySelector(".hero-slide-prev");
        if (carouselPrevButton) {
            carouselPrevButton.addEventListener("click", prevSlide);
        }

        // Initialize the slider
        moveToSlide(0);
    };

    const initImagePicker = () => {
        const fileInput = document.querySelector("#carFormImageUpload");
        const imagePreview = document.querySelector("#imagePreviews");
        if (!fileInput) {
            return;
        }
        fileInput.onchange = (ev) => {
            console.log(ev);
            imagePreview.innerHTML = "";
            const files = ev.target.files;
            for (let file of files) {
                readFile(file).then((url) => {
                    const img = createImage(url);
                    imagePreview.append(img);
                });
            }
        };

        function readFile(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    resolve(ev.target.result);
                };
                reader.onerror = (ev) => {
                    reject(ev);
                };
                reader.readAsDataURL(file);
            });
        }

        function createImage(url) {
            const a = document.createElement("a");
            a.classList.add("car-form-image-preview");
            a.innerHTML = `
        <img src="${url}" />
      `;
            return a;
        }
    };

    const initMobileNavbar = () => {
        const btnToggle = document.querySelector(".btn-navbar-toggle");

        if (btnToggle) {
            btnToggle.onclick = () => {
                document.body.classList.toggle("navbar-opened");
            };
        }
    };

    const initMobileFilters = () => {
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
    };

    const initSortingDropdown = () => {
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
    };

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
