<template>
  <main id="main"
    :style="templateRows">
    <page-preview v-for="(page, index) in $store.getters.subPages"
      :key="page.id"
      :title="page.title.rendered"
      :excerpt="page.excerpt.rendered"
      :homepageText="page.acf.homepage_tekst"
      :image="pageImage(page)"
      :slug="page.slug"
      :style="setStartingRow(index)"/>
  </main>
</template>

<script>
import PagePreview from '~/components/PagePreview.vue'

export default {
  layout: 'test',
  components: {
    PagePreview,
  },
  computed: {
    templateRows() {
      const imageOverlap = '30px'
      let templateRows = `${imageOverlap} auto ${imageOverlap}`;
      for (let i = 1; i < this.$store.getters.subPages.length; i++) {
        templateRows += ` auto ${imageOverlap}`;
      }
      return {
        'grid-template-rows': `${templateRows}`,
      }
    }
  },
  methods: {
    setStartingRow(index) {
      const startingRow = index + (index + 1);
      return {
        'grid-row': `${startingRow} / span 3`,
      }
    },
    pageImage(page) {
      const images = page['_embedded']['wp:featuredmedia'];
      if(images) {
        return images[0].media_details.sizes.medium_large;
      }
      return {};
    }
  },
}
</script>

<style lang="scss">
  @import '~assets/variables.scss';

  #main {
    padding: 25px 0;
    display: grid;
    grid-template-columns: auto;
  }
</style>
