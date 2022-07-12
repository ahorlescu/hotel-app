<template>
  <div class="full-page">
    <header-menu :canLogin="canLogin" />
    <div class="title-public">
      <h2>Galerie media</h2>
    </div>
    <div class="container mx-auto py-10">
      <v-gallery :images="list" :caption="false"> </v-gallery>
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
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
  data() {
    return {
      list: [],
    };
  },
  mounted() {
    for (let count = 0; count < 18; count++) {
      let image_url = {
        title: "Image" + count,
        url: "../storage/" + count + ".jpg",
      };
      this.list.push(image_url);
    }
  },
};
</script>
