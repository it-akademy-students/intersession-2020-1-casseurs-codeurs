<template>
  <v-banner class="hidden-lg-and-up" elevation="2" outlined sticky app>
    <span>Lorem ipsum dolor sit amet, mel at clita quando. Te sit oratio vituperatoribus, nam ad ipsum posidonium mediocritatem, explicari dissentiunt cu mea. Repudiare disputationi vim in, mollis iriure nec cu, alienum argumentum ius ad. Pri eu justo aeque torquatos. Participez vous aussi au maintiens de ce projet ! Faites un don pour nous permettre de garantir ce service.</span>
    <template v-slot:actions>
      <v-btn text class="btn-text btn-text--green" to="/" link>Je fais un don</v-btn>
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