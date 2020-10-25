<template>
  <div>
    <v-row justify="center">
      <v-row justify="center" class="pa-0 ma-0">
        <v-col cols="12">
          <v-card
            class="mx-auto text-center"
            color="colorTertiary"
            @click="initDashboard"
          >
            <v-card-text>
              <v-sheet color="rgba(0, 0, 0, .12)">
                <v-sparkline
                  :value="values"
                  :gradient="['#f72047', '#ffd200', '#62cb5c']"
                  height="100"
                  padding="24"
                  stroke-linecap="round"
                  smooth
                  elevation="1"
                  :auto-draw="!!values.length"
                ></v-sparkline>
              </v-sheet>
            </v-card-text>
            <v-card-text>
              <div class="display-1 font-weight-thin">
                {{ $tc("dashboard.btn.title", 1) }}
              </div>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions class="justify-center">
              <v-btn block text>{{ $tc("dashboard.btn.action", 1) }}</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      <!-- dialog -->
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
              <v-icon color="secondary">mdi-close</v-icon>
            </v-btn>

            <v-toolbar-title class="secondary--text">{{
              $tc("dashboard.title", 1)
            }}</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>

          <v-card-text>
            <v-container fluid class="mb-5">
              <v-row justify="space-around" align="baseline">
                <!-- total repo -->
                <v-col cols="6" md="3">
                  <v-card
                    color="colorSecondaryLight"
                    class="mx-auto"
                    min-height="200px"
                  >
                    <v-card-text>
                      <v-row justify="space-between">
                        <div class="colorPrimaryLight--text font-weight-black">
                          {{ $tc("dashboard.card.totalRepository", 1) }}
                        </div>
                        <v-icon color="colorPrimaryLight" size="25"
                          >mdi-source-repository</v-icon
                        >
                      </v-row>
                      <p
                        class="display-1 text--primary colorPrimaryLight--text font-weight-black mt-4"
                      >
                        {{ totalRepository }}
                      </p>
                    </v-card-text>
                  </v-card>
                </v-col>
                <!-- bugs -->
                <v-col cols="6" md="3">
                  <v-card color="warning" class="mx-auto" min-height="200px">
                    <v-card-text>
                      <v-row justify="space-between">
                        <div class="colorPrimaryLight--text font-weight-black">
                          {{ $tc("dashboard.card.totalErrorsFound", 1) }}
                        </div>
                        <v-icon color="colorPrimaryLight" size="25"
                          >mdi-bug</v-icon
                        >
                      </v-row>
                      <p
                        class="display-1 text--primary colorPrimaryLight--text font-weight-black mt-4"
                      >
                        {{ totalErrorsFound }}
                      </p>
                    </v-card-text>
                  </v-card>
                </v-col>
                <!-- security holes -->
                <v-col cols="6" md="3">
                  <v-card color="error" class="mx-auto" min-height="200px">
                    <v-card-text>
                      <v-row justify="space-between">
                        <div class="colorPrimaryLight--text font-weight-black">
                          {{ $tc("dashboard.card.totalSecurityFails", 1) }}
                        </div>
                        <v-icon color="colorPrimaryLight" size="25"
                          >mdi-security</v-icon
                        >
                      </v-row>
                      <p
                        class="display-1 text--primary colorPrimaryLight--text font-weight-black mt-4 mx-4"
                      >
                        {{ totalSecurityFails }}
                      </p>
                    </v-card-text>
                  </v-card>
                </v-col>
                <!-- last repo -->
                <v-col cols="6" md="3">
                  <v-card
                    color="colorTertiaryLight"
                    class="mx-auto"
                    min-height="200px"
                  >
                    <v-card-text>
                      <v-row justify="space-between">
                        <div class="colorPrimaryLight--text font-weight-black">
                          {{ $tc("dashboard.card.scannedFiles", 1) }}
                        </div>
                        <v-icon color="colorPrimaryLight" size="25"
                          >mdi-file-code</v-icon
                        >
                      </v-row>
                      <p
                        class="display-1 text--primary colorPrimaryLight--text font-weight-black mt-4"
                      >
                        {{ scannedFiles }}
                      </p>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row>
                <!-- bar chart -->
                <v-col cols="12" md="6" v-if="this.barChartData.length > 0">
                  <v-card
                    color="colorPrimaryUltraLight"
                    class="mx-auto"
                    min-height="200px"
                  >
                    <bart-chart
                      :title="`${$tc('dashboard.card.lastRepository', 1)}: ${
                        this.lastRepository
                      }`"
                      xKey="name"
                      yKey="amount"
                      :data="barChartData"
                    />
                  </v-card>
                </v-col>

                <!-- gauge chart -->
                <v-col cols="12" md="6" v-if="this.GaugeChartData.length > 0">
                  <v-card
                    color="colorPrimaryUltraLight"
                    class="mx-auto"
                    min-height="200px"
                  >
                    <gauge-chart
                      :title="`${$tc('dashboard.card.lastRepository', 1)}: ${
                        this.lastRepository
                      }`"
                      :data="GaugeChartData"
                    />
                  </v-card>
                </v-col>
              </v-row>
            </v-container>

            <v-divider class="secondary"></v-divider>

            <v-container fluid class="mt-5">
              <v-row justify="center" align="center" class="my-5">
                <!-- result list -->
                <v-col cols="12">
                  <result-table />
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <div style="flex: 1 1 auto"></div>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>

<script>
import ResultTable from "@/js/components/ResultTable";
import BartChart from "@/js/components/BartChart";
import GaugeChart from "@/js/components/GaugeChart";
export default {
  name: "Dashboard",
  components: {
    ResultTable,
    BartChart,
    GaugeChart,
  },
  data: () => ({
    dialog: false,
    values: [423, 446, 675, 510, 590, 610, 760],
    lastRepository: "",
    numberOfScans: "",
    scannedFiles: "",
    totalErrorsFound: "",
    totalRepository: "",
    totalSecurityFails: "",
    barChartData: [],
    GaugeChartData: "",
  }),
  beforeMount() {
    this.getUserRepository();
  },
  methods: {
    initDashboard() {
      this.getUsersAnalizes();
      this.getUserRepository();
      this.dialog = true;
    },
    getUsersAnalizes() {
      let url = `/users/${this.$auth.user().id}/analyzes`;

      let header = {
        headers: {
          Authorization: `bearer ${this.$auth.token()}`,
        },
      };
      axios
        .get(url, header)
        .then((res) => {
          this.totalSecurityFails = res.data.data.totalSecurityFails;
          this.totalErrorsFound = res.data.data.totalErrorsFound;
          this.numberOfScans = res.data.data.numberOfScans;
          this.totalRepository = res.data.data.totalRepository;
          this.scannedFiles = res.data.data.scannedFiles;
          this.lastRepository = res.data.data.lastRepository;
        })
        .catch((err) => {
          console.log({ err });
        });
    },
    getUserRepository() {
      let url = `/users/${this.$auth.user().id}/repository`;
      let header = {
        headers: {
          Authorization: `bearer ${this.$auth.token()}`,
        },
      };
      axios
        .get(url, header)
        .then((res) => {
          const last_repo = [...res.data.data].pop();
          this.GaugeChartData = last_repo.status;
          delete last_repo.name;
          delete last_repo.status;
          for (let i in last_repo) {
            this.barChartData.push({
              name: this.$tc(`BarChart.${i}`, 1),
              amount: last_repo[i],
            });
          }
          return this.barChartData, this.GaugeChartData;
        })
        .catch((err) => {
          console.log({ err });
        });
    },
  },
};
</script>
