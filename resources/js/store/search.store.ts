import { useStorage } from "@vueuse/core";
import axios from "axios";
import { defineStore } from "pinia";

interface Search {
    input?: string | null;
    showDialog: boolean;
    data?: [] | null;
    loading?: boolean;
}

const defaultValues: Search = {
    input: null,
    showDialog: false,
    data: [],
    loading: false,
};

export const useSearchStore = defineStore("search", {
    state: () => useStorage("search", defaultValues),
    getters: {
        getSearchInput: (state) => state.input,
        getShowDialog: (state) => state.showDialog,
        getSearchData: (state) => state.data,
        getLoading: (state) => state.loading,
    },
    actions: {
        displayDialog() {
            this.showDialog = true;
        },
        hideDialog() {
            this.showDialog = false;
        },
        async getData(input: string) {
            this.input = input;
            this.loading = true;
            const request = await axios.get(`https://catfact.ninja/fact`);
            this.loading = false;
            // this.data = [request.data];
            this.data = [
                {
                    type: "Poradnik",
                    title: "Zbiórka - prawo harcerskie",
                    author: "sam. Julia Piersionek Hufiec",
                    published: "28.12.2019",
                },
                {
                    type: "Poradnik1",
                    title: "Zbiórka - prawo harcerskie",
                    author: "sam. Julia Piersionek Hufiec",
                    published: "28.12.2019",
                },
                {
                    type: "Poradnik2",
                    title: "Zbiórka - prawo harcerskie",
                    author: "sam. Julia Piersionek Hufiec",
                    published: "28.12.2019",
                },
            ];
        },
    },
});
