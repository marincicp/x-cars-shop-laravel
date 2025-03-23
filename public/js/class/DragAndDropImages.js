export default class DragAndDropImages {
    draggedEl = null;
    imageRows = document.querySelectorAll(".image-row");

    constructor() {
        this.init();
    }

    init = () => {
        this.addEventListners();
    };

    addEventListners = () => {
        this.imageRows.forEach((imageRow) => {
            imageRow.addEventListener("dragstart", (e) =>
                this.dragStart(e, imageRow)
            );
            imageRow.addEventListener("dragend", this.dragEnd);
            imageRow.addEventListener("dragover", this.dragOver);
            imageRow.addEventListener("dragleave", this.dragLeave);
            imageRow.addEventListener("drop", this.dragDrop);
        });
    };

    dragStart = (e, imageRow) => {
        e.stopPropagation();

        this.toggleHoldClass(e);

        this.draggedEl = e.target;

        this.setDataToTransfer(e, imageRow);
    };

    toggleHoldClass = (e, action = "add") => {
        if (action === "add") {
            e.target.classList.add("draggable-row-bg");
        }
        if (action === "remove") {
            e.target.classList.remove("draggable-row-bg");
        }
    };

    setDataToTransfer = (e, imageRow) => {
        const inputPositionValue = imageRow.querySelector("input").value;
        const imagePath = imageRow
            .querySelector(".car-image")
            .getAttribute("src");
        const deleteBtn = imageRow.querySelector(".delete-car-image-btn");
        const imageId = deleteBtn.getAttribute("data-image_id");
        const carId = deleteBtn.getAttribute("data-car_id");
        e.dataTransfer.setData("car_id", carId);
        e.dataTransfer.setData("image_id", imageId);
        e.dataTransfer.setData("position", inputPositionValue);
        e.dataTransfer.setData("img_path", imagePath);
    };

    dragOver = (e) => {
        e.preventDefault();
        this.toggleHoldClass(e, "add");
    };

    dragEnd = (e) => {
        this.toggleHoldClass(e, "remove");
    };

    dragLeave = (e) => {
        e.preventDefault();
        this.toggleHoldClass(e, "remove");
    };

    dragDrop = (e) => {
        e.preventDefault();

        const hoveredEl = e.target.closest(".image-row");
        const hoveredElInput = hoveredEl.querySelector("input");
        const hoveredElImg = hoveredEl.querySelector(".car-image");
        const hoveredElDeleteBtn = hoveredEl.querySelector(
            ".delete-car-image-btn"
        );
        /// Old values
        const hoveredElPosition = hoveredElInput.value;
        const hoveredElImgPath = hoveredElImg.src;

        const draggedElPosition = e.dataTransfer.getData("position");
        const draggedElImgPath = e.dataTransfer.getData("img_path");
        const draggedElCarId = e.dataTransfer.getData("car_id");
        const draggedElImgId = e.dataTransfer.getData("image_id");
        hoveredElDeleteBtn.setAttribute("data-car_id", draggedElCarId);
        hoveredElDeleteBtn.setAttribute("data-image_id", draggedElImgId);
        hoveredElImg.src = draggedElImgPath;
        hoveredElInput.value = draggedElPosition;

        if (this.draggedEl) {
            this.draggedEl.querySelector(".car-image").src = hoveredElImgPath;
            this.draggedEl.querySelector("input").value = hoveredElPosition;
            const draggedElDeleteBtn = this.draggedEl.querySelector(
                ".delete-car-image-btn"
            );
            draggedElDeleteBtn.setAttribute("data-car_id", hoveredElPosition);
            draggedElDeleteBtn.setAttribute(
                "data-img_id",
                hoveredElDeleteBtn.dataset.image_id
            );
        }
    };
}
