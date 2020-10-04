<template>
  <v-footer
    app
    style="padding: 1rem 0.8rem"
    class="d-flex align-baseline justify-center"
  >
    <span class="mostlyWhite--text text-center">
      &copy; {{ $tc("footer.copyright", 1) }}
      <span
        style="font-family: 'VT323', monospace; font-size: 1.4rem"
        class="mostlyWhite--text"
        >{{ $tc("footer.brand", 1) }}</span
      >
      {{ $tc("footer.link", 1) }}
      <a
        class="btn-text btn-text--green"
        href="https://github.com/it-akademy-students/intersession-2020-1-casseurs-codeurs"
        target="_blank"
        >GitHub</a
      >
    </span>
    <v-icon>mdi-github</v-icon>
  </v-footer>
</template>

<script>
export default {
  name: "FooterApp",
};
</script>