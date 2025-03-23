import { Alert } from "../components/index.js";
const alert = new Alert();
const deleteBtns = document.querySelectorAll(".delete-car-image-btn");
const BASE_URL = "http://127.0.0.1:8000";

deleteBtns.forEach((btn) => {
    btn.addEventListener("click", async function (e) {
        e.preventDefault();
        this.disabled = true;

        const token = document
            .querySelector("meta[name='csrf-token']")
            .getAttribute("content");

        const carId = e.target.getAttribute("data-car_id");
        const imageId = e.target.getAttribute("data-image_id");

        try {
            const res = await fetch(
                `${BASE_URL}/car/${carId}/images/${imageId}`,
                {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                    },
                    body: JSON.stringify({
                        _method: "DELETE",
                        car_id: carId,
                        image_id: imageId,
                    }),
                }
            );

            if (!res.ok) {
                throw new Error("Failed to delete the image");
            }

            const data = await res.json();

            alert.render("success", data?.message);

            setTimeout(() => location.reload(), 1000);
        } catch (err) {
            alert.render("error", err?.message);
            this.disabled = false;
        }
    });
});
