export class Alert {
    constructor(parentEl = "body") {
        this.parentEL = document.querySelector("body");
    }

    markup = (type, message) => {
        const alertBox = document.createElement("div");
        alertBox.classList.add("alert", `alert-${type}`, "mt-large");
        alertBox.innerHTML = `<div>${message}</div>`;
        this.parentEL.appendChild(alertBox);

        return alertBox;
    };

    render = (type, message) => {
        const alertBox = this.markup(type, message);

        setTimeout(() => {
            alertBox.remove();
        }, 1000);
    };
}
