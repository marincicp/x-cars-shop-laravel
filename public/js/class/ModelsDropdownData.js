import { DropdownData } from "./index.js";

export default class ModelDropdownData extends DropdownData {
    getData = async (makerId) => {
        if (this.data[makerId]) {
            return this.data[makerId];
        }

        const url = `/makers/${makerId}/models`;
        const data = await this.fetchData(url);
        if (!data) return [];

        this.data[makerId] = data;
        return data;
    };
}
