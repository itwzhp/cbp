import { useSessionStorage } from "@vueuse/core";
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
    state: () => useSessionStorage("search", defaultValues),
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
        async getData(input: string, nextPage: boolean) {
            this.input = input;
            this.loading = true;
            if (!nextPage) {
                this.data = [];
            }
            const params = new URLSearchParams();
            if (input.length >= 3) {
                params.append("search", input);
            }
            if (nextPage) {
                params.append("nextPage", String(nextPage));
            }
            const request = await axios.get(`http://127.0.0.1:8000/api/materials`, { params });
            this.loading = false;
            if (nextPage) {
                this.data = [...this.data, ...request.data];
            } else {
                this.data = request.data;
            }
        },
    },
});
