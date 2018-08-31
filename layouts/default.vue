<template>
  <div id="main-content">
    <header>
      <h1>
        Oefenpraktijk Mill
      </h1>
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
    </footer>
  </div>
</template>

