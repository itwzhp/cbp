import { useSessionStorage } from "@vueuse/core";
import axios from "axios";
import { defineStore } from "pinia";

interface Search {
    input: string | null;
    showDialog: boolean;
    data: [] | null;
    page: number;
    hasNextPage: boolean;
    loading: boolean;
}

const defaultValues: Search = {
    input: null,
    showDialog: false,
    data: [],
    page: null,
    hasNextPage: false,
    loading: false,
};

const searchUrl = "http://127.0.0.1:8000/api/materials";

export const useSearchStore = defineStore("search", {
    state: () => useSessionStorage("search", defaultValues),
    getters: {
        getSearchInput: (state) => state.input,
        getShowDialog: (state) => state.showDialog,
        getSearchData: (state) => state.data,
        getHasNextPage: (state) => state.hasNextPage,
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
            this.loading = true;
            this.input = input;
            this.data = [];
            this.page = null;
            this.hasNextPage = false;
            const params = new URLSearchParams();
            if (input?.length >= 3) {
                params.append("search", input);
            }
            try {
                const request = await axios.get(searchUrl, { params });
                this.loading = false;
                this.page = request.data.meta.page;
                this.hasNextPage = request.data.meta.hasNextPage;
                this.data = request.data.content;
            } catch (error) {
                this.loading = false;
            }
        },
        async getNextPage() {
            if (!this.loading && this.getHasNextPage) {
                this.loading = true;
                const params = new URLSearchParams([["page", String(this.page + 1)]]);
                if (this.input?.length >= 3) {
                    params.append("search", this.input);
                }
                try {
                    const request = await axios.get(searchUrl, { params });
                    this.loading = false;
                    this.page = request.data.meta.page;
                    this.hasNextPage = request.data.meta.hasNextPage;
                    this.data = [...this.data, ...request.data.content];
                } catch (error) {
                    this.loading = false;
                }
            }
        }
    },
});
