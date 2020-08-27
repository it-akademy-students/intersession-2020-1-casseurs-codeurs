<template>
  <v-container>
    <v-row>
      <v-col xs="12">
        <v-row justify="center" align-content="center">
          <h2 class="my-5 pa-4 text-center">Hello {{ user.username }}, glad to see you again!</h2>
          <h3 class="mb-5 pa-4 text-center">What would you like to do today?</h3>
          <button
            class="my-5 btn btn--violet"
            style="min-width:35ch;"
          >Consult the analysis history</button>
          <button
            class="my-5 btn btn--violet"
            style="min-width:35ch;"
          >Migration tools php5 > php7</button>
          <p class="my-5 pa-4 text-center">
            The SWAPP application has already enabled you to detect
            <span class="colorTertiaryLight--text text-h6">{{ user.stats }}</span> bugs and security vulnerabilities in your code!
          </p>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "Logged",
  data: () => ({
    user: {
      username: "Isa",
      email: "i@i.dev",
      password: "********",
      job: "Développeuse",
      stats: "1200",
    },
  }),
  // computed: {
  //   currentUser() {
  //     return this.$store.state.auth.user;
  //   }
  // },
  // mounted() {
  //   if (!this.currentUser) {
  //     this.$router.push('/login');
  //   }
  // }
};
</script>