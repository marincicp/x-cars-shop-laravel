export default function initSlider() {
    const slides = document.querySelectorAll(".hero-slide");
    let currentIndex = 0;
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

    function nextSlide() {
        if (currentIndex === totalSlides - 1) {
            moveToSlide(0);
        } else {
            moveToSlide(currentIndex + 1);
        }
    }

    function prevSlide() {
        if (currentIndex === 0) {
            moveToSlide(totalSlides - 1);
        } else {
            moveToSlide(currentIndex - 1);
        }
    }

    const carouselNextButton = document.querySelector(".hero-slide-next");
    if (carouselNextButton) {
        carouselNextButton.addEventListener("click", nextSlide);
    }
    const carouselPrevButton = document.querySelector(".hero-slide-prev");
    if (carouselPrevButton) {
        carouselPrevButton.addEventListener("click", prevSlide);
    }

    moveToSlide(0);
}
