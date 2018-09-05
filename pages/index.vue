<template>
  <main>
    <p>
      Beschrijving
    </p>
    <page-preview v-for="page in $store.getters.pages"
      :key="page.id"
      :title="page.title.rendered"
      :excerpt="page.excerpt.rendered"
      :homepage_text="page.acf.homepage_tekst"
      :slug="page.slug"/>
  </main>
</template>

<script>
import PagePreview from '~/components/PagePreview.vue'

export default {
  components: {
    PagePreview,
  },
}
</script>

