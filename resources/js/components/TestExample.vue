<template>
  <v-btn
    class="mr-3 elevation-21"
    fab
    button
    color="colorTertiary"
    fixed
    right
    bottom
    @click="top()"
  >
    <v-icon>mdi-chevron-up</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "TestExample",
  data: () => ({
    offsetTop: 0,
  }),
  methods: {
    top() {
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth",
      });
    },
  },
};
</script>