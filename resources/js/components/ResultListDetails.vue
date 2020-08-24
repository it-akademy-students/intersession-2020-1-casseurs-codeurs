<template>
  <v-container fluid class="my-5">
    <v-layout row class="mb-3 ml-0">
      <v-tooltip top>
        <template v-slot:activator="{ on }">
          <v-btn small text class="colorSecondary--text" @click="sortBy('directory')" v-on="on">
            <v-icon left small>folder</v-icon>
            <span class="caption text-lowercase">Trier par répertoire</span>
          </v-btn>
        </template>
        <span>Affiche les répertoires par ordre alphabétique</span>
      </v-tooltip>
      <v-tooltip top>
        <template v-slot:activator="{ on }">
          <v-btn
            small
            text
            class="ml-3 colorSecondary--text"
            @click="sortBy('criticity')"
            v-on="on"
          >
            <v-icon left small>error</v-icon>
            <span class="caption text-lowercase">Trier par criticité</span>
          </v-btn>
        </template>
        <span>Affiche les répertoires contenant des erreurs critiques en premier</span>
      </v-tooltip>
    </v-layout>

    <v-expansion-panels>
      <v-expansion-panel v-for="result in results" :key="result.directory">
        <v-expansion-panel-header color="colorPrimaryUltraLight">
          <div>{{ result.directory }}</div>
          <div class="text-right pr-5">
            <v-chip small :class="`${result.status} caption my-2`">{{ result.status }}</v-chip>
          </div>
        </v-expansion-panel-header>
        <v-expansion-panel-content color="colorPrimaryUltraLight">
          <v-layout row class="mb-3 ml-0">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn
                  small
                  text
                  color="colorPrimaryUltraLight"
                  class="colorTertiary--text"
                  @click="sortBy('file')"
                  v-on="on"
                >
                  <v-icon left small>folder</v-icon>
                  <span class="caption text-lowercase">Trier par répertoire</span>
                </v-btn>
              </template>
              <span>Affiche les répertoires par ordre alphabétique</span>
            </v-tooltip>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn
                  small
                  text
                  color="colorPrimaryUltraLight"
                  class="ml-3 colorTertiary--text"
                  @click="sortBy('criticity')"
                  v-on="on"
                >
                  <v-icon left small>error</v-icon>
                  <span class="caption text-lowercase">Trier par criticité</span>
                </v-btn>
              </template>
              <span>Affiche les répertoires contenant des erreurs critiques en premier</span>
            </v-tooltip>
          </v-layout>
          <v-card
            class="pa-3 grey--text"
            color="colorPrimaryUltraLight"
            v-for="res in result.files"
            :key="res.file"
            flat
          >
            <v-card-text>
              <v-layout row wrap :class="`pa-3 ml-0 result result--${res.status}`">
                <v-flex xs12 md6>
                  <div class="caption grey--text">Repo name</div>
                  <div>{{ result.directory }}</div>
                </v-flex>
                <v-flex xs6 sm4 md2>
                  <div class="caption grey--text">file name</div>
                  <div>{{ res.file }}</div>
                </v-flex>
                <v-flex xs6 sm4 md2>
                  <div class="caption grey--text">problem</div>
                  <div>{{ res.problem }}</div>
                </v-flex>
                <v-flex xs2 sm4 md2>
                  <div class="text-right pr-5">
                    <v-chip small :class="`${res.status} caption my-2`">{{ res.status }}</v-chip>
                  </div>
                </v-flex>
              </v-layout>
              <v-divider></v-divider>
            </v-card-text>
          </v-card>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </v-container>
</template>

<script>
export default {
  name: "ResultListDetails",
  data: () => ({
    results: [
      {
        directory: "repo1",
        files: [
          {
            file: "my file1",
            problem: "delectus aut autem",
            status: "warning",
            criticity: 1,
          },
          {
            file: "my file2",
            problem: "delectus aut autem",
            status: "clean",
            criticity: 2,
          },
          {
            file: "my file3",
            problem: "delectus aut autem",
            status: "clean",
            criticity: 2,
          },
        ],
        status: "warning",
        criticity: 1,
      },
      {
        directory: "repo2",
        files: [
          {
            file: "my file1",
            problem: "delectus aut autem",
            status: "danger",
            criticity: 0,
          },
          {
            file: "my file2",
            problem: "delectus aut autem",
            status: "danger",
            criticity: 0,
          },
          {
            file: "my file3",
            problem: "delectus aut autem",
            status: "clean",
            criticity: 2,
          },
        ],
        status: "danger",
        criticity: 0,
      },
      {
        directory: "repo3",
        files: [
          {
            file: "my file1",
            problem: "delectus aut autem",
            status: "clean",
            criticity: 2,
          },
          {
            file: "my file2",
            problem: "delectus aut autem",
            status: "clean",
            criticity: 2,
          },
          {
            file: "my file3",
            problem: "delectus aut autem",
            status: "clean",
            criticity: 2,
          },
        ],
        status: "clean",
        criticity: 2,
      },
    ],
  }),
  methods: {
    sortBy(prop) {
      this.results.sort((a, b) => (a[prop] < b[prop] ? -1 : 1));
    },
  },
};
</script>
<style scoped lang="scss">
.result {
  &--clean {
    border-left: 4px solid #9ade96;
  }
  &--warning {
    border-left: 4px solid orange;
  }
  &--danger {
    border-left: 4px solid tomato;
  }
}
.v-chip {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 10ch;
  &.clean {
    background-color: #9ade96;
  }
  &.warning {
    background-color: orange;
  }
  &.danger {
    background-color: tomato;
  }
}
</style>
