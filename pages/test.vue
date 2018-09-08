<template>
  <main id="main">
    <page-preview v-for="page in $store.getters.pages"
      :key="page.id"
      :title="page.title.rendered"
      :excerpt="page.excerpt.rendered"
      :homepageText="page.acf.homepage_tekst"
      :image="page._embedded['wp:featuredmedia']"
      :slug="page.slug"/>
  </main>
</template>

<script>
import PagePreview from '~/components/PagePreview.vue'

export default {
  layout: 'test',
  components: {
    PagePreview,
  },
}
</script>

