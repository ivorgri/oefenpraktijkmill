<template>
  <main id="main"
    :style="templateRows">
    <test-page-preview v-for="(page, index) in $store.getters.subPages"
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
import TestPagePreview from '~/components/TestPagePreview.vue'

export default {
  layout: 'test',
  components: {
    TestPagePreview,
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

    > section {
      grid-column: 1 / span 1;
      display: flex;

      /* > img {
        width: 50vw;
      } */
      > .content, {
        width: 60%;
      }

      > .lead-image {
        width: 40%;
        height: 300px;

        > img {
          background-color: red;
          height: 100%;
        }
      }
    }

    > section:nth-child(odd) {
      // border: 1px solid red;

      > .content {
        order: 1;
        margin: $lead-element-spacing * 1px $lead-element-spacing * 2px $lead-element-spacing * 1px $lead-element-spacing * 1px;
      }

      > .lead-image {
        order: 0;
        margin: 0 $lead-element-spacing * 1px 0 $lead-element-spacing * 2px;
      }
    }

    > section:nth-child(even) {
      // border: 1px solid green;

      > .content {
        order: 0;
        margin: $lead-element-spacing * 1px 0 $lead-element-spacing * 1px $lead-element-spacing * 4px;
      }

      > .lead-image {
        order: 1;
        margin: 0 $lead-element-spacing * 2px 0 0;
      }
    }
  }
</style>
