<template>
  <v-banner class="hidden-lg-and-up" elevation="2" outlined sticky app>
    <span class="font-weight-black"> {{ donate }} </span> <span class="subheading"> {{ donateText }} </span> 
    <template v-slot:actions>
      <v-btn text class="btn-text btn-text--green" to="/" link>I support !</v-btn>
    </template>
  </v-banner>
</template>   

<script>
export default {
  name: "DonateBanner",
  data: () => ({
    donate: "Take part in the maintenance of this project: make a donation!",
    donateText:
      "SWAPP is an open source project and always will be that automates the detection of security vulnerabilities and / or code bugs. You have the possibility to support the project by making a donation to help us guarantee this service.",
  }),
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