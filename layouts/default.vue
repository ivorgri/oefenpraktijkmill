<template>
  <div id="main-content">
    <header>
      <nuxt-link to="/">
        <h1>
          Oefenpraktijk Mill
        </h1>
      </nuxt-link>
      <!-- <nav>
        <a v-for="page in $store.getters.pages"
          :key="page.id"
          :href="page.slug"
          class="nav-item">
          {{ page.title.rendered }}
        </a>
      </nav> -->
    </header>
    <nuxt/>
    <footer>
      <a href="mailto:">Verstuur e-mail</a>
      <a href="tel:">Bel ons</a>
      <address>
        Bedrijfsadres
      </address>
      <nuxt-link to="/contact">Neem contact op</nuxt-link>
    </footer>
  </div>
</template>

