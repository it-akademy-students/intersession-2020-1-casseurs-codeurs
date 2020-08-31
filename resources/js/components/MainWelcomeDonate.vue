<template>
  <v-container fluid class="container">
    <v-row no-gutters>
      <v-col cols="12">
        <v-row align-content="center" no-gutters>
          <!-- welcome section -->
          <v-container fluid class="px-5 mb-1">
            <v-row align-content="space-between" justify="space-around" no-gutters>
              <v-col cols="12">
                <h1 class="display-2 mb-5">{{ $tc("mainWelcomeDonate.welcome", 1) }}</h1>
                <span class="text-h6 mt-5">{{ $tc("mainWelcomeDonate.welcomeText", 1) }}</span>
                <v-container fluid class="pa-0 mt-5">
                  <v-row align-content="center" no-gutters>
                    <v-col cols="12">
                      <div class="my-3">
                        <h3 class="display-1">{{ $tc("mainWelcomeDonate.welcomeAction", 1) }}</h3>
                      </div>
                    </v-col>
                    <!-- form -->
                    <v-col cols="12">
                      <form class="form">
                        <v-container class="ma-0 pa-0" fluid>
                          <v-row align-content="space-between" justify="space-around">
                            <v-col cols="12" lg="9">
                              <input
                                id="repository"
                                type="url"
                                pattern="https://github.com/.+"
                                title="The URL must start with https://github.com/"
                                class="form__input form__input--green"
                                placeholder="https://github.com/example"
                                v-model="repository"
                              />
                              <label
                                for="repository"
                                class="form__label"
                              >{{ $tc("mainWelcomeDonate.welcomeForm.labelUrl", 1) }}</label>
                            </v-col>
                            <v-col cols="12" lg="3">
                              <input
                                id="branch"
                                type="text"
                                class="form__input form__input--green"
                                placeholder="master"
                                v-model="branch"
                              />
                              <label
                                for="branch"
                                class="form__label"
                              >{{ $tc("mainWelcomeDonate.welcomeForm.labelBranch", 1) }}</label>
                            </v-col>
                            <v-col cols="12" lg="9">
                              <input
                                id="mail"
                                type="email"
                                class="form__input form__input--green"
                                placeholder="dev@swapp.com"
                                v-model="email"
                              />
                              <label
                                for="mail"
                                class="form__label"
                              >{{ $tc("mainWelcomeDonate.welcomeForm.labelEmail", 1) }}</label>
                            </v-col>
                            <v-col cols="12" lg="3">
                              <v-row justify="end" justify-lg="center" class="ma-0 pa-0">
                                <button
                                  class="btn btn--green"
                                  @click="handleClick"
                                >{{ $tc("mainWelcomeDonate.welcomeBtn", 1) }}</button>
                              </v-row>
                            </v-col>
                          </v-row>
                        </v-container>
                        <v-dialog content-class="modal" v-show="loading" v-model="loading" dark>
                          <v-img
                            class="mx-1 loader"
                            src="../../img/swapp_image_logo.svg"
                            max-height="100"
                            max-width="100"
                            contain
                            alt="logo"
                          ></v-img>
                          <v-skeleton-loader class="mx-auto" max-width="300" type="card"></v-skeleton-loader>
                        </v-dialog>
                        <v-dialog content-class="modal" v-show="fetching" v-model="fetching" dark>
                          <h4>{{ $tc("mainWelcomeDonate.welcomeModale.success", 1) }}</h4>
                          <p>{{ $tc("mainWelcomeDonate.welcomeModale.successMsg", 1) }}</p>
                        </v-dialog>
                      </form>
                      <span
                        class="subheading mb-5"
                      >{{ $tc("mainWelcomeDonate.welcomeAsterisk", 1) }}</span>
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
          <v-container fluid class="px-5 mt-0 hidden-md-and-down">
            <v-row align-content="space-between" justify="space-around" no-gutters>
              <v-col cols="12">
                <h2 class="display-2 mb-1 mt-2">{{ $tc("mainWelcomeDonate.donate", 1) }}</h2>
                <v-container fluid class="pa-0 mt-1">
                  <v-row align-content="center" no-gutters>
                    <v-col cols="12">
                      <v-container fluid>
                        <v-row align="baseline" class="mr-5">
                          <v-col cols="12" lg="10">
                            <h3 class="title">{{ $tc("mainWelcomeDonate.donateAction", 1) }}</h3>
                          </v-col>
                          <v-col cols="12" lg="2">
                            <button
                              class="btn btn--green"
                              role="link"
                              @click="handleClick"
                            >{{ $tc("mainWelcomeDonate.donateBtn", 1) }}</button>
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
    repository: "",
    error: false,
    loading: false,
    email: "",
    branch: "",
    fetching: false
  }),
  methods: {
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
    },
    handleGithubUrl: function () {
      this.loading = true;
      console.log("click");
      const splittedUrl = this.repository.split("/");
      const username = splittedUrl[splittedUrl.length - 2];
      const repo = splittedUrl[splittedUrl.length - 1];
      const email = this.email;
      const branch = this.branch;
      const url = `github/${username}/${repo}/${branch}`;
      console.log({ url });
      this.$http.get(url).then((response) => {
        this.loading = false;
        this.fetching = true;
        setTimeout(() => {
          this.fetching = false;
        }, 3000);
      });
    },
  },
};
</script>

<style lang="scss">
.divider-x {
  width: 100%;
  height: 0.5rem;
  box-sizing: border-box;
  background-color: #62cb5c;
  transform: scale(1.02);
}
.modal {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 200px;
  height: 150px;
  position: relative;
}

.loader {
  animation: rotation 1s infinite linear;
  position: absolute;
}

@keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(359deg);
  }
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