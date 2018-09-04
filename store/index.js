import Vuex from 'vuex';
import axios from 'axios';

const pagesApi = 'https://oefenpraktijkmill.ivrdesign.nl/wp-json/wp/v2/pages';

const createStore = () => {
  return new Vuex.Store({
    state: {
      pages: [],
    },
    mutations: {
      SET_PAGES (state, pages) {
        state.pages = pages;
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
    },
    actions: {
      async nuxtServerInit ({ commit }) {
        let pages;
        pages = await axios.get(pagesApi);
        commit('SET_PAGES', pages.data);
      }
    }
  })
}

export default createStore;