<template>
  <main>
    <p>
      Beschrijving
    </p>
    <page-preview v-for="page in $store.getters.pages"
      :key="page.id"
      :title="page.title.rendered"
      :description="page.excerpt.rendered"
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

