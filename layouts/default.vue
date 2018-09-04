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
      <a href="mailto:">Verstuur e-mail</a>
      <a href="tel:">Bel ons</a>
      <address>
        Bedrijfsadres
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
      showNavMenu: false,
      toggleAnimation: false,
    };
  },
  methods: {
    toggleNavMenu () {
      this.showNavMenu = !this.showNavMenu;
      this.toggleAnimation = this.showNavMenu;
    },
    handleResize() {
      if(document.documentElement.clientWidth > 649) {
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

