<template>
  <form id="contact-form" v-on:submit.prevent="onSubmit">

    <label class="contact-label" for="fname">Voornaam</label>
    <input class="contact-input" type="text" id="fname" name="firstname" placeholder="Uw voornaam" v-model="firstname"
      :disabled="submitting">

    <label class="contact-label" for="lname">Achternaam</label>
    <input class="contact-input" type="text" id="lname" name="lastname" placeholder="Uw achternaam" v-model="lastname"
      :disabled="submitting">

    <label class="contact-label" for="email">E-mail adres</label>
    <input class="contact-input" type="email" id="email" name="email" placeholder="E-mail adres" v-model="email"
      :disabled="submitting">

    <input id="contact-submit" type="submit" value="Verstuur verzoek"
      :disabled="submitting || invalidEntries">

    <span v-if="errorMessage">{{ errorMessage }}</span>
    <span v-if="message">{{ message }}</span>

  </form>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      firstname: '',
      lastname: '',
      errorMessage: '',
      message: '',
      submitting: false,
    };
  },
  computed: {
    invalidEntries() {
      return (this.email===''||this.firstname===''||this.lastname==='');
    }
  },
  methods: {
    async onSubmit() {
      this.submitting = true;
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
      if(response === undefined) {
        this.errorMessage = 'Er is iets fout gegaan met het versturen van de mail. Probeer het nog eens. Mocht het nogmaals fout gaan, neem dan contact op met ...@...nl.';
      } else if (!response.success) {
        this.errorMessage = response.errorMessage;
      } else {
        this.message = response.message;
      }
    },
  },
}
</script>
