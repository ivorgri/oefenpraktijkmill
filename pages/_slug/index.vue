<template>
  <main>
    <div v-if="page" v-html="page.content.rendered"/>
    <contact-form v-if="isContactPage"></contact-form>
  </main>
</template>

<script>
import ContactForm from '~/components/ContactForm.vue'

export default {
  components: {
    ContactForm,
  },
  computed: {
    page() {
      return this.$store.getters.getPage(this.$route.params.slug);
    },
    isContactPage() {
      if(this.page) {
        return this.page.acf.is_contactformulier;
      }
      return false;
    },
  }
}
</script>
