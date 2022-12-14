import { useSessionStorage } from "@vueuse/core";
import axios from "axios";
import { defineStore } from "pinia";

const defaultValues = {
  input: null,
  tagIds: [],
  showDialog: false,
  data: [],
  taxonomies: [],
  page: null,
  refreshedAt: null,
  hasNextPage: false,
  loading: false,
};

const searchUrl = `${import.meta.env.VITE_API_URL}/api/materials`;
const taxonomiesUrl = `${import.meta.env.VITE_API_URL}/api/taxonomies`;

export const useSearchStore = defineStore("search", {
  state: () => useSessionStorage("search", defaultValues),
  getters: {
    getSearchInput: (state) => state.input,
    getShowDialog: (state) => state.showDialog,
    getSearchData: (state) => state.data,
    getHasNextPage: (state) => state.hasNextPage,
    getRefreshedAt: (state) => state.refreshedAt,
    getLoading: (state) => state.loading,
    getTagIds: (state) => state.tagIds,
    getTaxonomiesData: (state) => state.taxonomies
  },
  actions: {
    displayDialog() {
      this.showDialog = true;
    },
    hideDialog() {
      this.showDialog = false;
    },
    async getData(input, tagIds) {
      this.loading = true;
      this.input = input;
      this.data = [];
      this.page = null;
      this.hasNextPage = false;
      const params = {
        tags: null,
        search: null
      }
      if (tagIds) {
        this.input = null;
        this.tagIds = tagIds;
        params.tags = tagIds;
      } else if (input?.length >= 3) {
        params.search = input;
      }
      try {
        const request = await axios.get(searchUrl, { params });
        this.loading = false;
        this.page = request.data.meta.page;
        this.hasNextPage = request.data.meta.hasNextPage;
        this.data = request.data.content;
        this.refreshedAt = new Date();
      } catch (error) {
        this.loading = false;
      }
    },
    async getNextPage() {
      if (!this.loading && this.getHasNextPage) {
        this.loading = true;
        const params = {
          page: String(this.page + 1),
          search: null,
          tags: null
        }
        if (this.input?.length >= 3) {
          params.search = this.input;
        }
        if (this.tagIds?.length) {
          params.tags = this.tagIds;
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
    },
    async getTaxonomies() {
      try {
        const request = await axios.get(taxonomiesUrl);
        this.taxonomies = [...request.data];
      } catch (error) {
        console.error('taxonimes get error');
      }
    },
    pushTags(tagIds) {
      const tags = [...this.tagIds, ...tagIds];
      this.tagIds = [...new Set(tags)];
      this.getData(this.input, this.tagIds.map(tag => tag));
    },
    removeTags(tagIds) {
      this.tagIds = this.tagIds.filter(tag => !tagIds.includes(tag));
      this.getData(this.input, this.tagIds.map(tag => tag));
    }
  },
});
