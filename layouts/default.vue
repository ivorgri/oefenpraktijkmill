<template>
  <div id="main-content">
    <header>
      <nuxt-link to="/">
        <h1 class="title">
          Oefenpraktijk Mill
        </h1>
      </nuxt-link>
      <div id="dropdown-menu" :class="{ 'change': toggleAnimation }" @click="toggleNavMenu">
        <div id="bar1"></div>
        <div id="bar2"></div>
        <div id="bar3"></div>
      </div>
      <nav v-if="showNavMenu">
        <nuxt-link v-for="page in $store.getters.pages"
          :key="page.id"
          :to="'/'+page.slug"
          class="nav-item">
          {{ page.title.rendered }}
        </nuxt-link>
      </nav>
    </header>
    <nuxt/>
    <footer>
      <a :href="`mailto:${address.emailadres}`">Verstuur e-mail</a>
      <a :href="`tel:${address.telefoonnummer}`">Bel ons</a>
      <address>
        {{ address.straatnaam }} {{address.huisnummer}} {{address.toevoegsel}}<br>
        {{ address.postcode }} {{ address.plaatsnaam }}<br>
        {{ address.land }}
      </address>
      <nuxt-link to="/contact">Neem contact met ons op</nuxt-link>
    </footer>
  </div>
</template>

<script>
export default {
  mounted() {
    this.handleResize();
    window.addEventListener('resize', this.handleResize);
  },
  data() {
    return {
      showNavMenu: undefined,
      toggleAnimation: false,
    };
  },
  computed: {
    address() {
      return this.$store.getters.getAddress;
    },
  },
  methods: {
    toggleNavMenu () {
      this.showNavMenu = !this.showNavMenu;
      this.toggleAnimation = this.showNavMenu;
    },
    handleResize() {
      if(document.documentElement.clientWidth > 649) {
        this.toggleAnimation = false;
        this.showNavMenu = true;
      } else {
        this.showNavMenu = false;
      }
    },
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize);
  },
}
</script>

<style lang="scss">
  @import '~assets/variables.scss';

  .title {
    width: 275px;
    min-width: 275px;
    float: left;
  }

  #dropdown-menu {
    @media screen and (min-width: $break-medium) {
      display: none;
    }
    cursor: pointer;
    float: right;
    margin: 18px 15px;
  }

  #bar1, #bar2, #bar3 {
    width: 35px;
    height: 5px;
    background-color: #333;
    margin: 6px 0;
    transition: 0.4s;
  }

  .change #bar1 {
    -webkit-transform: rotate(-45deg) translate(-9px, 6px);
    transform: rotate(-45deg) translate(-9px, 6px);
  }

  .change #bar2 {opacity: 0;}

  .change #bar3 {
    -webkit-transform: rotate(45deg) translate(-8px, -8px);
    transform: rotate(45deg) translate(-8px, -8px);
  }

  nav {
    @supports (display: flex) {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: space-evenly;
    }
    /* @media screen and (max-width: $break-small) {
      width: 100%;
    }
    @media screen and (max-width: $break-medium) {
      display: none;
    } */
    clear: both;

    .nav-item {
      padding: 5px;
      color: black;

      &:hover {
        color: red;
      }
    }
  }

  footer {
    clear: both;

    > a {
      width: 100%;
      @supports (display: flex) {
        width: auto;
      }
    }
    @supports (display: flex) {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: auto;
    }
  }
</style>

