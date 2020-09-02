<template>
  <div>
    <v-row justify="center">
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
              <v-btn block text @click="dialog = true">Go to Dashboard</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      <!-- <v-col cols="12">
        <v-row justify="center">
          <button
            class="my-5 btn btn--violet"
            style="min-width:35ch;"
            @click="dialog = true"
          >{{ $tc("logged.btnActions.analysis", 1) }}</button>
        </v-row>
      </v-col>-->

      <v-dialog
        v-model="dialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
        scrollable
      >
        <v-card tile color="colorPrimaryLight">
          <v-toolbar flat color="primary">
            <v-btn icon @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-toolbar-title>Your dashboard Reports</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>

          <v-card-text>
            <v-container fluid class="mb-5">
              <v-row justify="space-around" align-content="baseline">
                <v-col cols="6" md="3">
                  <v-card color="colorSecondaryLight" class="mx-auto">
                    <v-card-text>
                      <v-row justify="space-between">
                        <div>Number of repo scan</div>
                        <v-icon>mdi-file-code</v-icon>
                      </v-row>
                      <p class="display-1 text--primary">24</p>
                    </v-card-text>
                  </v-card>
                </v-col>
                <v-col cols="6" md="3">
                  <v-card color="warning" class="mx-auto">
                    <v-card-text>
                      <v-row justify="space-between">
                        <div>Bugs founds</div>
                        <v-icon>mdi-bug</v-icon>
                      </v-row>
                      <p class="display-1 text--primary">255</p>
                    </v-card-text>
                  </v-card>
                </v-col>
                <v-col cols="6" md="3">
                  <v-card color="error" class="mx-auto">
                    <v-card-text>
                      <v-row justify="space-between">
                        <div>Security holes founds</div>
                        <v-icon>mdi-security-network</v-icon>
                      </v-row>
                      <p class="display-1 text--primary">66</p>
                    </v-card-text>
                  </v-card>
                </v-col>
                <v-col cols="6" md="3">
                  <v-card color="colorTertiaryLight" class="mx-auto">
                    <v-card-text>
                      <v-row justify="space-between">
                        <div>Last repo scan</div>
                        <v-icon>mdi-source-repository</v-icon>
                      </v-row>

                      <p class="display-1 text--primary">repo name</p>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
            </v-container>

            <v-divider class="secondary"></v-divider>

            <v-container fluid class="mt-5">
              <v-row justify="space-around" align="center" class="mt-5">
                <v-col cols="12">
                  <result-table />
                </v-col>
                <!-- <v-col cols="6">
                  <circle-stats />
                </v-col> -->
              </v-row>
            </v-container>
          </v-card-text>

          <div style="flex: 1 1 auto;"></div>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>

<script>
import StatsGraph from "@/js/components/StatsGraph";
import CircleStats from "@/js/components/CircleStats";
import ResultTable from "@/js/components/ResultTable"

export default {
  name: "Dashboard",
  components: {
    StatsGraph,
    CircleStats,
    ResultTable
  },
  data() {
    return {
      dialog: false,
      values: [423, 446, 675, 510, 590, 610, 760],
    };
  },
};
</script>