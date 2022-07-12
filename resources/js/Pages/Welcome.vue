<template>
  <div>
    <header-menu :canLogin="canLogin" />
  </div>
</template>

<script>
import HeaderMenu from "@/Jetstream/HeaderMenu";
export default {
  components: {
    HeaderMenu,
  },

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
};
</script>
