<template>
  <v-container>
    <v-row align-content="center" justify="space-around" no-gutters>
      <v-col xs="12">
        <v-row justify="center" align-content="center">
          <v-col cols="12">
            <h2
              class="my-5 pa-4 text-center"
            >{{ $tc("logged.title.hello", 1)  }} {{ this.$store.getters.getUser.name | capitalize }} {{ $tc("logged.title.welcome", 1)  }} </h2>
          </v-col>
          <v-col cols="12">
            <h3 class="mb-5 pa-4 text-center">{{ $tc("logged.title.action", 1)  }} </h3>
          </v-col>
          <v-col cols="12">
            <v-row justify="center">
              <button
                class="my-5 btn btn--violet"
                style="min-width:35ch;"
              >{{ $tc("logged.btnActions.analysis", 1)  }} </button>
            </v-row>
          </v-col>
          <v-col cols="12">
            <v-row justify="center">
              <button
                class="my-5 btn btn--violet"
                style="min-width:35ch;"
              >{{ $tc("logged.btnActions.migration", 1)  }}</button>
            </v-row>
          </v-col>
          <v-col cols="12">
            <p class="my-5 pa-4 text-center">
              {{ $tc("logged.stats.textPart1", 1)  }}
              <span
                class="colorTertiaryLight--text text-h6"
              >{{ user.stats }}</span> {{ $tc("logged.stats.textPart2", 1)  }}
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
      stats: "1200",
    },
  }),
};
</script>