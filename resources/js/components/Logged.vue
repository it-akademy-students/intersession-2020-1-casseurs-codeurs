<template>
  <v-container class="pa-0 ma-0" id="user-logged">
    <v-row align-content="center" justify="space-around" no-gutters class="pa-0 ma-auto">
      <v-col xs="12">
        <v-row justify="center" align-content="center" class="pa-0 ma-0">
          <v-col cols="12">
            <v-row justify="center">
              <h2
                class="text-center"
              >{{ $tc("logged.title.hello", 1) }} {{ this.$auth.user().name | capitalize }} {{ $tc("logged.title.welcome", 1) }}</h2>
            </v-row>
          </v-col>
          <v-col cols="12">
            <v-row justify="center">
              <p class="text-center">{{ $tc("logged.stats.text", 1) }}</p>
            </v-row>
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
    values: [423, 446, 675, 510, 590, 610, 760],
  }),
};
</script>
