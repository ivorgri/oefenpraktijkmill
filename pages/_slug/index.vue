<template>
  <main>
    <div v-html="page.content.rendered"/>
  </main>
</template>

<script>
export default {
  async asyncData ({ app, params, error, payload }) {
    let page;
    if (payload) { page = payload; }
    else {
      page = await app.$axios.$get(`http://oefenpraktijkmill.ivrdesign.nl/wp-json/wp/v2/pages/?slug=${params.slug}`) ;
      page = page[0];
    }
    return { page };
  },
}
</script>
