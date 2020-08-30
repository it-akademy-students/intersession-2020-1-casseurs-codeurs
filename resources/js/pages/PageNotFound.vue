<template>
  <v-container class="pa-5 mt-16">
    <v-row justify="center" align="center" class="pa-5 mb-5 mt-16">
      <h2
        class="display-1 text-center pa-md-4 ma-auto"
      >{{ $tc("notFound.msg", 1)  }}</h2>
    </v-row>
    <v-spacer></v-spacer>
    <v-row justify="center" align="center" class="pa-5 my-5">
      <v-btn x-large class="px-10 ml-2 font-weight-black animated" color="colorSecondary" to="/">
        <v-icon left class="mr-5">mdi-home</v-icon>
        <div>{{ $tc("notFound.goBack", 1)  }}</div>
      </v-btn>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "PageNotFound",
};
</script>

<style lang="scss" scoped>
h2 {
  animation: moveInRight 1s ease-out;
}
.animated {
  animation: moveInBottom 0.5s ease-out 0.75s;
  animation-fill-mode: backwards;
}
@keyframes moveInRight {
  0% {
    opacity: 0;
    transform: translateX(10rem);
  }
  80% {
    transform: translateX(-1rem);
  }
  100% {
    opacity: 1;
    transform: translate(0);
  }
}
@keyframes moveInBottom {
  0% {
    opacity: 0;
    transform: translateY(3rem);
  }
  100% {
    opacity: 1;
    transform: translate(0);
  }
}
</style>