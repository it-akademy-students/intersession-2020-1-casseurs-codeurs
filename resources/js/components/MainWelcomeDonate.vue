<template>
  <v-container fluid>
    <v-row no-gutters>
      <v-col cols="12">
        <v-row align-content="center" no-gutters>
          <!-- welcome section -->
          <v-container fluid class="px-5 mb-5">
            <v-row align-content="space-between" justify="space-around" no-gutters>
              <v-col cols="12">
                <h1 class="display-3 mb-5">{{ welcome }}</h1>
                <span class="subheading my-5">{{ lorem }}</span>
                <v-container fluid class="pa-0 mt-5">
                  <v-row align-content="center" no-gutters>
                    <v-col cols="12">
                      <div class="my-3">
                        <h3 class="display-1">I scan my repository</h3>
                      </div>
                    </v-col>
                    <!-- form -->
                    <v-col cols="12">
                      <form action="#" class="form">
                        <v-container>
                          <v-row align-content="space-between" justify="space-around">
                            <v-col cols="12" lg="10">
                              <input
                                id="repository"
                                type="url"
                                pattern="https://github.com/.+"
                                title="The URL must start with https://github.com/"
                                class="form__input form__input--green"
                                placeholder="https://github.com/example"
                                v-model="repository"
                              />
                              <label for="repository" class="form__label">Enter the URL of your repo</label>
                            </v-col>
                            <v-col cols="12" lg="2">
                              <button class="btn btn--green" @click.prevent="handleUrl">Submit</button>
                            </v-col>
                          </v-row>
                        </v-container>
                      </form>
                    </v-col>
                  </v-row>
                </v-container>
              </v-col>
            </v-row>
          </v-container>

          <!-- separator between welcome and donate -->
          <v-container fluid class="ma-0 pa-0">
            <v-row justify="center">
              <v-col cols="12">
                <v-divider class="ma-auto divider-x" inset></v-divider>
              </v-col>
            </v-row>
          </v-container>

          <!-- donate section -->
          <v-container fluid class="px-5 mt-5 hidden-md-and-down">
            <v-row align-content="space-between" justify="space-around" no-gutters>
              <v-col cols="12">
                <h2 class="display-2 my-5">{{ donate }}</h2>
                <span class="subheading my-5">{{ lorem }}</span>
                <v-container fluid class="pa-0 mt-5">
                  <v-row align-content="center" no-gutters>
                    <v-col cols="12">
                      <v-container grid-list-lg>
                        <v-row align-content="center">
                          <v-col cols="12" lg="10">
                            <h3
                              class="title my-5 mr-5"
                            >Participate in the maintenance of this project! Make a donation to allow us to guarantee this service.</h3>
                          </v-col>
                          <v-col cols="12" lg="2">
                            <button
                              class="btn btn--green"
                              role="link"
                              @click="handleClick"
                            >I support!</button>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-col>
                  </v-row>
                </v-container>
              </v-col>
            </v-row>
          </v-container>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>        

<script>
import { loadStripe } from "@stripe/stripe-js";
// Make sure to call `loadStripe` outside of a component’s render to avoid
// recreating the `Stripe` object on every render.
const stripePromise = loadStripe(
  "pk_test_51HKQ6eEDdpH3cWNoddQJ31BBxp3uWCFyFVuj7Ge0ObIwOBj59a4wfqmjPT1NDg09UeYPHeYeDW7JOgFnuiDO7HNu00jDCMt69v"
);
export default {
  name: "MainWelcome",
  data: () => ({
    welcome: "Welcome on SWAPP!",
    donate: "Support the project",
    donateText:
      "SWAPP is an open source project that automates the detection of security vulnerabilities and / or code bugs.",
    lorem:
      "Lorem ipsum dolor sit amet, mel at clita quando. Te sit oratio vituperatoribus, nam ad ipsum posidonium mediocritatem, explicari dissentiunt cu mea. Repudiare disputationi vim in, mollis iriure nec cu, alienum argumentum ius ad. Pri eu justo aeque torquatos.",
    repository: "",
    error: false,
    loading: false
  }),
  methods: {
    handleUrl() {
      const url = this.repository;
      const splitedUrl = url.split("/");
      const repo = splitedUrl[splitedUrl.length - 1];
      const username = splitedUrl[splitedUrl.length - 2];
      const getUrl = `github/${username}/${repo}`;

      this.loading = true;
      this.$http
        .get(getUrl)
        .then(res => {
          console.log(res);
        })
        .catch(error => {
          console.log(error);
          this.errored = true;
        })
        .finally(() => (this.loading = false));
    },
    handleClick: async function (event) {
      console.log("click")
      // Get Stripe.js instance
      const stripe = await stripePromise;

      // Call your backend to create the Checkout Session
      const response = await this.$http.post("create-checkout-session");

      const session = await response.json();

      // When the customer clicks on the button, redirect them to Checkout.
      const result = await stripe.redirectToCheckout({
        sessionId: session.id
      });

      if (result.error) {
        // If `redirectToCheckout` fails due to a browser or network
        // error, display the localized error message to your customer
        // using `result.error.message`.
      }
    }
  }
};
</script>

<style scoped lang="scss">
.divider-x {
  width: 100%;
  height: 0.5rem;
  box-sizing: border-box;
  // background-color: #967dff;
  background-color: #62cb5c;
  transform: scale(1.02);
}
// .v-btn {
//   &:hover {
//   border-color: #967dff;
//   transform: translateY(-3px);
//   box-shadow: 0 1rem 2rem rgba(#000,.2);
//   }
//   &:hover &__content{
//     color: #967dff;
//   }
// }
</style>