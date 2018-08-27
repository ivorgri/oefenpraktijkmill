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
    };
  },
  methods: {
    async onSubmit(e) {
      const response = await this.$axios.$post('http://oefenpraktijkmill.ivrdesign.nl/contact-form.php')
      console.log(response);
    },
  },
}
</script>

<style>
.container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; /* 1 */
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>

