<template>
  <v-container>
    <v-row align-content="center" justify="space-around" no-gutters>
      <v-col xs="12">
        <v-row justify="center" align-content="center">
          <v-col cols="12">
            <h2
              class="my-5 pa-4 text-center"
            >{{ $tc("logged.title.hello", 1) }} {{ this.$auth.user().name | capitalize }} {{ $tc("logged.title.welcome", 1) }}</h2>
          </v-col>
          <!-- <v-col cols="12">
            <h3 class="mb-5 pa-4 text-center">{{ $tc("logged.title.action", 1) }}</h3>
          </v-col> -->

          <!-- stats -->
          <v-col cols="12">
            <v-row justify="center" align="center">
              <div class="text-center ma-12">
                <v-progress-circular
                  
                  rotate="184"
                  size="85"
                  value="24"
                  width="7"
                  color="light-blue"
                >{{ value }}</v-progress-circular>
              </div>
            </v-row>
          </v-col>


          <v-col cols="12">
            <v-row justify="center">
              <v-card class="mx-auto text-center" color="green" dark>
                <v-card-text>
                  <v-sheet color="rgba(0, 0, 0, .12)">
                    <v-sparkline
                      :value="values"
                      color="rgba(255, 255, 255, .7)"
                      height="100"
                      padding="24"
                      stroke-linecap="round"
                      smooth
                    >
                      <template v-slot:label="item">${{ item.value }}</template>
                    </v-sparkline>
                  </v-sheet>
                </v-card-text>

                <v-card-text>
                  <div class="display-1 font-weight-thin">Sales Last 24h</div>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions class="justify-center">
                  <v-btn block text>Go to Report</v-btn>
                </v-card-actions>
              </v-card>
            </v-row>
          </v-col>
          <v-col cols="12">
            <v-row justify="center"></v-row>
          </v-col>
          <v-col cols="12">
            <p class="my-5 pa-4 text-center">
              {{ $tc("logged.stats.textPart1", 1) }}
              <span
                class="colorTertiaryLight--text text-h6"
              >{{ user.stats }}</span>
              {{ $tc("logged.stats.textPart2", 1) }}
            </p>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "Logged",
  data: () => ({
    // @TODO: users stats
    user: {
      repository: "1200",
      errorsFound: "",
      scannedFiles: "",
      numberOfScans: "",
      files: "",
      created_at: "",
    },
    values: [423, 446, 675, 510, 590, 610, 760],
  }),
};
</script>