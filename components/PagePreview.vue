<template>
  <section>
    <h2>{{ title }}</h2>
    <div v-if="homepage_text" v-html="homepage_text"></div>
    <div v-if="!homepage_text" v-html="excerpt"></div>
    <img :src="image_url" :alt="image_alt"/>
    <nuxt-link :to="slug">Lees meer</nuxt-link>
    <hr>
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
    homepage_text: {
      required: true,
    },
    image_url: {
      type: String,
      required: false,
    },
    image_alt: {
      type: String,
      required: false,
      default: 'Beschrijving afbeelding',
    },
    slug: {
      type: String,
      required: true,
    },
  },
}
</script>
