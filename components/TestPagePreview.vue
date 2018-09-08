<template>
  <section :id="slug">
    <div class="content">
      <h2>{{ title }}</h2>
      <div v-if="homepageText" v-html="homepageText"></div>
      <div v-if="!homepageText" v-html="excerpt"></div>
      <nuxt-link :to="slug">Lees meer</nuxt-link>
    </div>
    <div class="lead-image">
      <!-- <img :src="imageUrl" :alt="imageAlt"/> -->
      <div>Afbeelding hier</div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    excerpt: {
      type: String,
      required: true,
    },
    homepageText: {
      required: true,
    },
    image: {
      type: Array,
      required: false,
    },
    slug: {
      type: String,
      required: true,
    },
  },
  computed: {
    imageUrl() {
      return (this.image ? this.image[0].media_details.sizes.medium_large.source_url: '');
    },
    imageAlt() {
      return (this.image ? this.image[0].alt_test: '');
    },
  }
}
</script>
