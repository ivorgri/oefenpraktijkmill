<template>
  <main>
    <h2 class="title">
      Contact formulier
    </h2>
    <form v-on:submit.prevent="onSubmit">

      <label for="fname">Voornaam</label>
      <input type="text" id="fname" name="firstname" placeholder="Uw voornaam" v-model="firstname">

      <label for="lname">Achternaam</label>
      <input type="text" id="lname" name="lastname" placeholder="Uw achternaam" v-model="lastname">

      <label for="email">E-mail adres</label>
      <input type="email" id="email" name="email" placeholder="E-mail adres" v-model="email">

      <input type="submit" value="Verstuur verzoek">

    </form>
    <span v-if="errorMessage">{{ errorMessage }}</span>
  </main>
</template>

<script>
import AppLogo from '~/components/AppLogo.vue'

export default {
  components: {
    AppLogo
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
      let response;
      try {
        this.errorMessage = '';
        const formData = new FormData();
        formData.append('firstname', this.firstname);
        formData.append('lastname', this.lastname);
        formData.append('email', this.email);
        response = await this.$axios.$post('https://oefenpraktijkmill.ivrdesign.nl/stuur-bericht.php', formData);
      } catch (error) {
        console.log('An error occured', error);
        this.errorMessage = 'Er is iets fout gegaan met het versturen van de mail. Probeer het nog eens. Mocht het nogmaals fout gaan, neem dan contact op met ...@...nl.';
      }
      console.log('Response', response)
    },
  },
}
</script>

