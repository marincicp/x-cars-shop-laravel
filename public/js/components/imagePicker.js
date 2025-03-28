export default function initImagePicker() {
    const fileInput = document.querySelector("#carFormImageUpload");
    const imagePreview = document.querySelector("#imagePreviews");
    if (!fileInput) {
        return;
    }
    fileInput.onchange = (ev) => {
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
}
