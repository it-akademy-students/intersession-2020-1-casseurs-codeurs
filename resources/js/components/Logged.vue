<template>
  <v-container class="pa-0 ma-0">
    <v-row align-content="center" justify="space-around" no-gutters class="pa-0 ma-0">
      <v-col xs="12">
        <v-row justify="center" align-content="center" class="pa-0 ma-0">
          <v-col cols="12">
            <h2
              class="text-center"
            >{{ $tc("logged.title.hello", 1) }} {{ this.$auth.user().name | capitalize }} {{ $tc("logged.title.welcome", 1) }}</h2>
          </v-col>
          <v-col cols="12">
            <p class="text-center">
              {{ $tc("logged.stats.textPart1", 1) }}
              <span
                class="colorTertiaryLight--text text-h6"
              >{{ user.stats }}</span>
              {{ $tc("logged.stats.textPart2", 1) }}
            </p>
          </v-col>
          <!-- dashboard -->
          <v-col cols="12">
            <dashboard />
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Dashboard from "@/js/components/Dashboard";

export default {
  name: "Logged",
  components: {
    Dashboard,
  },
  data: () => ({
    dialog: false,
    user: {
      stats: 1200,
      repository: "1200",
      errorsFound: 24,
      scannedFiles: "",
      numberOfScans: "",
      files: "",
      created_at: "",
    },
    interval: {},
    start: 0,
    values: [423, 446, 675, 510, 590, 610, 760],
  }),
};
</script>

<style scoped>
.v-progress-circular {
  margin: 1rem;
}
</style>