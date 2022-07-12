<template>
  <div class="h-screen max-h-screen hero-home">
    <header-menu :canLogin="canLogin" />
    <div class="hero-text">
      <div
        class="bg-green-600 bg-opacity-75 mx-5 md:bg-opacity-80 rounded-2xl h-3/6 w-10/12 flex flex-col justify-center"
      >
        <h1
          class="text-center uppercase text-white text-5xl lg:text-6xl font-bold leading-none tracking-normal"
        >
          Hotel International Unirea
        </h1>
        <h2
          class="text-center my-8 mx-5 uppercase text-white text-3xl lg:text-6xl font-bold leading-none tracking-normal"
        >
          Revederea cu cea mai buna prietena a ta e mai dulce la Hotel
          International Unirea.
        </h2>
        <h3
          class="text-center mt-5 uppercase text-white text-2xl lg:text-6xl font-bold leading-none tracking-normal"
        >
          Hotel de <span class="text-yellow-300">5 stele</span> la cele mai bune
          preturi!
        </h3>
      </div>
    </div>
    <footer-component class="absolute bottom-0" />
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
    rooms: Array,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
};
</script>
