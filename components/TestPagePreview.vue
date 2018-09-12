<template>
  <section :id="slug">
    <div class="content">
      <h2>{{ title }}</h2>
      <div v-if="homepageText" v-html="homepageText"></div>
      <div v-if="!homepageText" v-html="excerpt"></div>
      <nuxt-link :to="slug">Lees meer</nuxt-link>
    </div>
    <div class="lead-image">
      <img :src="imageUrl" :alt="imageAlt"/>
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
      type: Object,
      required: false,
    },
    slug: {
      type: String,
      required: true,
    },
  },
  computed: {
    imageUrl() {
      return (this.image ? this.image.source_url: '');
    },
    imageAlt() {
      return (this.image ? this.image.alt_test: '');
    },
  }
}
</script>

<style lang="scss">
  @import '~assets/variables.scss';

  section {
    grid-column: 1 / span 1;
    display: flex;

    > .content, {
      width: 50%;
      box-sizing: border-box;
    }

    > .lead-image {
      width: 50%;
      height: 300px;
      box-sizing: border-box;
      overflow: hidden;

      > img {
        width: 100%;
      }
    }
  }

  section:nth-child(odd) {
    // border: 1px solid red;

    > .content {
      order: 1;
      padding: $lead-element-spacing * 1px $lead-element-spacing * 2px $lead-element-spacing * 1px $lead-element-spacing * 1px;
    }

    > .lead-image {
      order: 0;
      padding: 0 $lead-element-spacing * 1px 0 $lead-element-spacing * 2px;
    }
  }

  section:nth-child(even) {
    // border: 1px solid green;

    > .content {
      order: 0;
      padding: $lead-element-spacing * 1px 0 $lead-element-spacing * 1px $lead-element-spacing * 4px;
    }

    > .lead-image {
      order: 1;
      padding: 0 $lead-element-spacing * 2px 0 0;
    }
  }

  @supports (clip-path: polygon($lead-image-clip-path-odd)) or (-webkit-clip-path: polygon($lead-image-clip-path-odd)) {
    section:nth-child(odd) {
      > .lead-image {
        -webkit-clip-path: polygon($lead-image-clip-path-odd);
        clip-path: polygon($lead-image-clip-path-odd);
      }
    }
  }

  @supports (clip-path: polygon($lead-image-clip-path-even)) or (-webkit-clip-path: polygon($lead-image-clip-path-even)) {
    section:nth-child(even) {
      > .lead-image {
        -webkit-clip-path: polygon($lead-image-clip-path-even);
        clip-path: polygon($lead-image-clip-path-even);
      }
    }
  }

</style>
