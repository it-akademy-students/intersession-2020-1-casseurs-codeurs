<template>
  <v-footer app style="padding: 1rem 0.8rem;" class="d-flex align-baseline justify-center">
    <span class="mostlyWhite--text text-center">
      &copy; {{ $tc("footer.copyright", 1)  }}
      <a
        class="btn-text btn-text--green"
        href="https://github.com/it-akademy-students/intersession-2020-1-casseurs-codeurs"
        target="_blank"
      >GitHub</a>
    </span>
    <v-icon>mdi-github</v-icon>
  </v-footer>
</template>

<script>
export default {
  name: "FooterApp",
};
</script>

<style scoped lang="scss">
// a {
//   &:link,
//   &:visited {
//     display: inline-block;
//     text-decoration: none;
//     padding: 3px;
//     transition: all 0.2s;
//     color: #62cb5c;
//   }
//   &:hover {
//     color: #967dff;
//     box-shadow: 0 1rem 2rem rgba(#272727, 0.15);
//     transform: translateY(-2px);
//   }
//   &:active {
//     box-shadow: 0 0.5rem 1rem rgba(#272727, 0.15);
//     transform: translateY(0);
//   }
// }
</style>