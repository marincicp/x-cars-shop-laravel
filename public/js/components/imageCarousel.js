export const imageCarousel = () => {
    const carousel = document.querySelector(".car-images-carousel");
    if (!carousel) {
        return;
    }
    const thumbnails = document.querySelectorAll(".car-image-thumbnails img");
    const activeImage = document.getElementById("activeImage");
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");

    let currentIndex = 0;

    // Initialize active thumbnail class
    thumbnails.forEach((thumbnail, index) => {
        if (thumbnail.src === activeImage.src) {
            thumbnail.classList.add("active-thumbnail");
            currentIndex = index;
        }
    });

    // Function to update the active image and thumbnail
    const updateActiveImage = (index) => {
        activeImage.src = thumbnails[index].src;
        thumbnails.forEach((thumbnail) =>
            thumbnail.classList.remove("active-thumbnail")
        );
        thumbnails[index].classList.add("active-thumbnail");
    };

    // Add click event listeners to thumbnails
    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener("click", () => {
            currentIndex = index;
            updateActiveImage(currentIndex);
        });
    });

    // Add click event listener to the previous button
    prevButton.addEventListener("click", () => {
        currentIndex =
            (currentIndex - 1 + thumbnails.length) % thumbnails.length;
        updateActiveImage(currentIndex);
    });

    // Add click event listener to the next button
    nextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % thumbnails.length;
        updateActiveImage(currentIndex);
    });
};
