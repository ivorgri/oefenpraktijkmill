<template>
  <section>
    <h2>{{ title }}</h2>
    <p v-html="description"></p>
    <img :src="image_url" :alt="image_alt"/>
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
    }
  },
  data() {
    return {
      email: '',
      firstname: '',
      lastname: '',
      errorMessage: '',
    };
  },
  methods: {
    async onSubmit(e) {
      const data = {
        firstname: this.firstname,
        lastname: this.lastname,
        email: this.email,
      };
      console.log(data);
      let response;
      try {
        this.errorMessage = '';
        response = await this.$axios.$post('https://oefenpraktijkmill.ivrdesign.nl/contact-form.php', data);
      } catch (error) {
        console.log('An error occured', error);
        this.errorMessage = 'Er is iets fout gegaan met het versturen van de mail. Probeer het nog eens. Mocht het nogmaals fout gasn, neem dan contact op met ...@...nl.';
      }
      console.log(response);
    },
  },
}
</script>
