<template>
  <div class="full-page">
    <header-menu :canLogin="canLogin" />
    <div class="title-public">
      <h2>Contact</h2>
    </div>
    <div class="container mx-auto">
      <div class="contact-page">
        <div class="contact1" v-html="general.map_url"></div>
        <div class="contact2">
          <div class="contact-fields">
            <label>Email: </label>
            <a
              class="hover:text-yellow-500"
              :href="'mailto:' + general.email"
              >{{ general.email }}</a
            >
          </div>
          <div class="contact-fields">
            <label>Telefon: </label>
            <a class="hover:text-yellow-500" :href="'tel:' + general.tel">{{
              general.tel
            }}</a>
          </div>
          <div class="contact-fields">
            <label>Facebook: </label>
            <a class="hover:text-yellow-500" :href="general.facebook_url">{{
              general.facebook_url
            }}</a>
          </div>
          <div class="contact-fields" v>
            <label>Adresa: </label>
            <p>{{ general.address }}</p>
          </div>
        </div>
      </div>
    </div>
    <footer-component />
  </div>
</template>

<script>
import HeaderMenu from "@/Jetstream/HeaderMenu";
import FooterComponent from "@/Jetstream/FooterComponent";
export default {
  components: {
    HeaderMenu,
    FooterComponent,
  },

  props: {
    general: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
};
</script>
