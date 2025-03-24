export default class DropdownView {
    constructor(parentSelector, childSelector, DropdownData) {
        this.parentDropdown = document.querySelector(parentSelector);
        this.childDropdown = document.querySelector(childSelector);
        this.dropdownData = new DropdownData();

        if (!parentSelector || !childSelector || !DropdownData) {
            throw new Error("Invalid parametars");
        }

        this.onInit();
    }

    onInit = () => {
        // this.hideOptions();
        this.parentDropdownOnChange();
    };

    parentDropdownOnChange = () => {
        this.parentDropdown?.addEventListener("change", async (e) => {
            this.hideOptions();
            this.childDropdown.value = "";

            if (e.target.value) {
                const data = await this.dropdownData.getData(e.target.value);
                this.renderOptions(data);
            }
        });
    };

    hideOptions = () => {
        const options = this.childDropdown.querySelectorAll("option");

        options.forEach((option) => {
            if (option.value === "") {
                option.style.display = "block";
            } else {
                option.style.display = "none";
            }
        });
    };

    renderOptions = (data) => {
        console.log(data, "data");
        data.forEach((item) => {
            const html = `<option value='${item?.id}'>${item?.name}</option>  `;
            this.childDropdown.insertAdjacentHTML("beforeEnd", html);
        });
    };
}
