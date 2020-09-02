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
          <!-- <v-col cols="12">
            <v-row justify="center" align="center" class="pa-0 ma-0">
              <div class="text-center mx-5">
                <h4>Files scan</h4>
                <v-progress-circular
                  rotate="184"
                  size="70"
                  value="24"
                  width="7"
                  color="secondary"
                >{{ value }}</v-progress-circular>
              </div>
              <div class="text-center mx-5">
                <h4>Bugs codes</h4>
                <v-progress-circular
                  rotate="184"
                  size="70"
                  value="30"
                  width="7"
                  color="warning"
                >{{ value }}</v-progress-circular>
              </div>
              <div class="text-center mx-5">
                <h4>Security holes</h4>
                <v-progress-circular
                  rotate="184"
                  size="70"
                  value="60"
                  width="7"
                  color="error"
                >{{ value }}</v-progress-circular>
              </div>
            </v-row>
          </v-col> -->

          <v-col cols="12">
            <v-row justify="center" class="pa-0 ma-0">
              <v-col cols="12">
                <v-card class="mx-auto text-center" color="colorTertiary">
                  <v-card-text>
                    <v-sheet color="rgba(0, 0, 0, .12)">
                      <v-sparkline
                        :value="values"
                        :gradient="['#f72047', '#ffd200', '#62cb5c']"
                        height="100"
                        padding="24"
                        stroke-linecap="round"
                        smooth
                      >
                        <template v-slot:label="item">{{ item.value }}</template>
                      </v-sparkline>
                    </v-sheet>
                  </v-card-text>
                  <v-card-text>
                    <div class="display-1 font-weight-thin">Reports</div>
                  </v-card-text>
                  <v-divider></v-divider>
                  <v-card-actions class="justify-center">
                    <v-btn block text>Go to Dashboard</v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
          </v-col>

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
    // @TODO: users stats
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