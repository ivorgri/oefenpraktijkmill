<template>
  <div id="main-content">
    <header>
      <img id="header-image" :src="homepageImageUrl" :alt="homepageImageAlt"/>
      <h1 id="header-title">Oefenpraktijk Dianne van Dongen</h1>
      <button id="header-button-1" class="header-button" @click="scrollTo('contact')">Inschrijven</button>
      <button id="header-button-2" class="header-button" @click="scrollTo('main')">Informatie</button>
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
  computed: {
    address() {
      return this.$store.getters.getAddress;
    },
    homepageImage() {
      return this.$store.getters.getHomepage["_embedded"]["wp:featuredmedia"][0].media_details.sizes["twentyseventeen-featured-image"];
    },
    homepageImageUrl() {
      return (this.homepageImage.source_url ? this.homepageImage.source_url : '');
    },
    homepageImageAlt() {
      return (this.homepageImage.alt_text ? this.homepageImage.alt_text: '');
    },
  },
  methods: {
    scrollTo(elementId) {
      const element = document.getElementById(elementId);
      element.scrollIntoView({behavior: 'smooth', block: 'start', inline: 'start'});
    },
  },
}
</script>

<style lang="scss">
  header {
    display: grid;
    grid-template-columns: [start-col] 1fr 1fr 1fr 1fr [end-col];
    grid-column-gap: 100px;
    grid-template-rows: [start-row] 25vh 30vh 5vh 20vh 20vh [end-row];
    grid-template-areas: "none none none none"
      "title title title title"
      "empty3 empty3 empty3 empty3"
      "empty4 button1 button2 empty5"
      "empty6 empty6 empty6 empty6";
    height: 100vh;
    width: 100%;
    overflow: hidden;
    justify-items: center;
    align-items: center;
  }

  #header-image {
    grid-area: start-row / start-col / end-row / end-col;
    width: 100vw;
    filter: opacity(80%) grayscale(25%);
  }

  #header-title {
    font-size: 50px;
  }

  .header-button {
    width: 350px;
    height: 50px;
    z-index: 10;
    font-size: 35px;
    color: white;
    border: 2px solid white;
    border-radius: 10px;
    background-color: rgba(192,192,192,0.5);
    cursor:pointer;
    text-shadow: 1px 1px rgb(192,192,192);

    &:hover {
      background-color: rgba(192,192,192,0.9);
    }
  }

  @media screen and (min-width: 1160px) {
    #header-title {
      font-size:70px;
    }

    .header-button {
      width: 350px;
      height: 50px;
      font-size: 35px;
    }
  }
  @media screen and (max-width: 1160px) {
    #header-title {
      font-size:50px;
    }

    .header-button {
      width: 250px;
      height: 40px;
      font-size: 25px;
    }
  }

  #header-title {
    grid-area: title;

    margin: 0;
    z-index: 10;
    color: white;
    text-shadow: 1px 1px rgb(192,192,192);
    height:100%;

  }

  #header-button-1 {
    grid-area: button1;
  }

  #header-button-2 {
    grid-area: button2;
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

