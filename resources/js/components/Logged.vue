<template>
  <v-container>
    <v-row align-content="center" justify="space-around" no-gutters>
      <v-col xs="12">
        <v-row justify="center" align-content="center">
          <v-col cols="12">
            <h2
              class="my-5 pa-4 text-center"
            >Hello {{ this.$store.getters.getUser.name | capitalize }}, welcome on board!</h2>
          </v-col>
          <v-col cols="12">
            <h3 class="mb-5 pa-4 text-center">What would you like to do today?</h3>
          </v-col>
          <v-col cols="12">
            <v-row justify="center">
              <button
                class="my-5 btn btn--violet"
                style="min-width:35ch;"
              >Consult the analysis history</button>
            </v-row>
          </v-col>
          <v-col cols="12">
            <v-row justify="center">
              <button
                class="my-5 btn btn--violet"
                style="min-width:35ch;"
              >Migration tools php5 > php7</button>
            </v-row>
          </v-col>
          <v-col cols="12">
            <p class="my-5 pa-4 text-center">
              The SWAPP application has already enabled you to detect
              <span
                class="colorTertiaryLight--text text-h6"
              >{{ user.stats }}</span> bugs and security vulnerabilities in your code!
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