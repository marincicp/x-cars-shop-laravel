export function initSingleClickBtns() {
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
}
