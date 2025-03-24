import { DropdownData } from "./index.js";

export default class CityDropdownData extends DropdownData {
    getData = async (stateId) => {
        if (this.data[stateId]) {
            return this.data[stateId];
        }

        const url = `/states/${stateId}/cities`;
        const data = await this.fetchData(url);
        if (!data) return [];

        this.data[stateId] = data;
        return data;
    };
}
