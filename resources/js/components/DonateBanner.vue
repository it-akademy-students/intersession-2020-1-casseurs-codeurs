<template>
  <v-banner class="hidden-lg-and-up" elevation="2" outlined sticky app>
    <span class="font-weight-black">{{ $tc("mainWelcomeDonate.donate", 1) }}</span>
    <span class="subheading">{{ $tc("mainWelcomeDonate.donateText", 1) }}</span>
    <template v-slot:actions>
      <v-btn
        text
        class="btn-text btn-text--green"
        to="/"
        link
      >{{ $tc("mainWelcomeDonate.donateBtn", 1) }}</v-btn>
    </template>
  </v-banner>
</template>   

<script>
export default {
  name: "DonateBanner",
  data: () => ({}),
};
</script>

<style scoped lang="scss">
span {
  font-size: 0.7rem;
  color: #9ade96;
}

.theme--dark.v-btn--active::before,
.theme--dark.v-btn--active:hover::before,
.theme--dark.v-btn:focus::before {
  opacity: 0;
}
</style>