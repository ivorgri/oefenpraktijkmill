<template>
  <main>
    <h1>
      Oefenpraktijk Mill
    </h1>
    <p>
      Beschrijving
    </p>
    <page-preview v-for="page in $store.getters.pages"
      :key="page.id"
      :title="page.title.rendered"
      :description="page.excerpt.rendered"
      :slug="page.slug"></page-preview>
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

