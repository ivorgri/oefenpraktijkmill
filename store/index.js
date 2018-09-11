import Vuex from 'vuex';
import axios from 'axios';

const pagesApi = 'https://oefenpraktijkmill.ivrdesign.nl/wp-json/wp/v2/pages?_embed';
const addressesApi = 'https://oefenpraktijkmill.ivrdesign.nl/wp-json/wp/v2/addresses';

const createStore = () => {
  return new Vuex.Store({
    state: {
      pages: [],
      address: {},
    },
    mutations: {
      SET_PAGES (state, pages) {
        state.pages = pages;
      },
      SET_ADDRESS (state, address) {
        state.address = address;
      },
    },
    getters: {
      getHomepage: state => {
        return state.pages.find((page) => page.parent === 0);
      },
      subPages: state => {
        const subPages = state.pages.filter((page) => page.parent !== 0);
        return subPages.sort((a, b) => {
          return a.menu_order - b.menu_order;
        });
      },
      getPage: (state) => (slug) => {
        return state.pages.find((page) => page.slug === slug);
      },
      getAddress: state => {
        return state.address;
      },
    },
    actions: {
      async nuxtServerInit ({ commit }) {
        let pages;
        pages = await axios.get(pagesApi);
        commit('SET_PAGES', pages.data);
        let address;
        address = await axios.get(addressesApi);
        commit('SET_ADDRESS', address.data[0].acf);
      }
    }
  })
}

export default createStore;