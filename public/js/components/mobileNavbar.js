export default function initMobileNavbar() {
    const btnToggle = document.querySelector(".btn-navbar-toggle");

    if (btnToggle) {
        btnToggle.onclick = () => {
            document.body.classList.toggle("navbar-opened");
        };
    }
}
