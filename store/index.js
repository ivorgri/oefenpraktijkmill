import Vuex from 'vuex';
import axios from 'axios';

const pagesApi = 'https://oefenpraktijkmill.ivrdesign.nl/wp-json/wp/v2/pages';
const afcPagesApi = 'https://oefenpraktijkmill.ivrdesign.nl//wp-json/acf/v3/pages ';

const createStore = () => {
  return new Vuex.Store({
    state: {
      pages: [],
      customPageFields: [],
    },
    mutations: {
      SET_PAGES (state, pages) {
        state.pages = pages;
      },
      SET_CUSTOM_PAGE_FIELDS (state, customPageFields) {
        state.customPageFields = customPageFields;
      },
    },
    getters: {
      pages: state => {
        return state.pages.sort((a, b) => {
          return a.menu_order - b.menu_order;
        });
      },
      getPage: (state) => (slug) => {
        return state.pages.find((page) => page.slug === slug);
      },
      isPageContactForm: (state) => (pageId) => {
        const page = state.customPageFields.find((page) => page.id === pageId);
        return page.acf.is_contactformulier;
      },
    },
    actions: {
      async nuxtServerInit ({ commit }) {
        let pages, customPageFields;
        pages = await axios.get(pagesApi);
        commit('SET_PAGES', pages.data);
        customPageFields = await axios.get(afcPagesApi);
        commit('SET_CUSTOM_PAGE_FIELDS', customPageFields.data);
      }
    }
  })
}

export default createStore;