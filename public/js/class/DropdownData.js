const BASE_URL = "http://127.0.0.1:8000";

export default class DropdownData {
    data = {};

    fetchData = async (endPoint) => {
        try {
            const res = await fetch(`${BASE_URL}${endPoint}`);

            if (!res.ok) {
                throw new Error("Someting went wrong");
            }
            return await res.json();
        } catch (e) {
            console.error(e?.message);
        }
    };
}
