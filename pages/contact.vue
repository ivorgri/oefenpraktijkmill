<template>
  <section class="container">
    <div>
      <h1 class="title">
        Contact formulier
      </h1>
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
    </div>
  </section>
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
      console.log(data);
      let response;
      try {
        this.errorMessage = '';
        response = await this.$axios.$post('https://oefenpraktijkmill.ivrdesign.nl/stuur-bericht.php', data);
      } catch (error) {
        console.log('An error occured', error);
        this.errorMessage = 'Er is iets fout gegaan met het versturen van de mail. Probeer het nog eens. Mocht het nogmaals fout gasn, neem dan contact op met ...@...nl.';
      }
      console.log(response);
    },
  },
}
</script>

