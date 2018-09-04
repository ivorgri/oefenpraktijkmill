<template>
  <main>
    <div v-if="page" v-html="page.content.rendered"/>
  </main>
</template>

<script>
export default {
  computed: {
    page() {
      return this.$store.getters.getPage(this.$route.params.slug);
    },
  }
}
</script>
