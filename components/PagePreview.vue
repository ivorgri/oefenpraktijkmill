<template>
  <section>
    <h2>{{ title }}</h2>
    <div v-html="description"></div>
    <img :src="image_url" :alt="image_alt"/>
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
    description: {
      type: String,
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
