import axios from 'axios';
import { defineStore } from 'pinia';

const defaultValues = {
  input: null,
  tagIds: [],
  tagMode: 'or',
  showDialog: false,
  data: [],
  taxonomies: [],
  page: null,
  refreshedAt: null,
  hasNextPage: false,
  loading: false,
};

const searchUrl = route('api.materials.index');
const taxonomiesUrl = route('api.taxonomies.index');

export const useSearchStore = defineStore('search', {
  state: () => defaultValues,
  persist: {
    storage: sessionStorage
  },
  getters: {
    getSearchInput: (state) => state.input,
    getShowDialog: (state) => state.showDialog,
    getSearchData: (state) => state.data,
    getHasNextPage: (state) => state.hasNextPage,
    getRefreshedAt: (state) => state.refreshedAt,
    getLoading: (state) => state.loading,
    getTagIds: (state) => state.tagIds,
    getTaxonomiesData: (state) => state.taxonomies,
    getTagMode: (state) => state.tagMode,
    getTagDetails: (state) => {
      let flatTaxonomies = [];
      state.taxonomies.forEach((taxonomie) => {
        flatTaxonomies = [...flatTaxonomies, ...taxonomie.tags];
      });
      return flatTaxonomies.filter((taxonomie) => state.tagIds.includes(taxonomie.id));
    }
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
      this.data = [];
      this.page = null;
      this.hasNextPage = false;
      const params = {
        tags: null,
        search: null,
        mode: null
      }
      // case 1 - tag from url
      if (tagIds && !input) {
        this.input = null;
        this.tagIds = tagIds;
        params.tags = tagIds;
        if (tagIds.length) {
          params.mode = this.tagMode;
        }
      // case 2 any arguments
      } else if (input || tagIds) {
        this.input = input;
        this.tagIds = tagIds;
      }
      // case 3 no arguments - get already setted in store

      if (this.input?.length >= 3) {
        params.search = this.input;
      }
      params.tags = this.tagIds?.length ? this.tagIds : [];
      if (this.tagIds.length) {
        params.mode = this.tagMode;
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
          params.mode = this.tagMode;
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
        if (!this.taxonomies?.length) {
          const request = await axios.get(taxonomiesUrl);
          this.taxonomies = [...request.data];
        }
      } catch (error) {
        console.error('taxonimes get error');
      }
    },
    async pushTags(tagIds) {
      const tags = [...this.tagIds, ...tagIds];
      this.tagIds = [...new Set(tags)];
      return this.getData();
    },
    async removeTags(tagIds, skipRequest) {
      this.tagIds = this.tagIds.filter(tag => !tagIds.includes(tag));
      return skipRequest ?  Promise.resolve() : this.getData();
    },
    async setTagMode(mode) {
      if (mode !== this.tagMode) {
        this.tagMode = mode;
        return this.getData();
      }
    },
    async clearInput() {
      this.input = null;
      return this.getData();
    }
  },
});
