const form = document.querySelector(".edit-form");
const btn = document.querySelector(".btn-submit");
form.addEventListener("change", (e) => {
    if (e) {
        btn.disabled = false;
    }
});
