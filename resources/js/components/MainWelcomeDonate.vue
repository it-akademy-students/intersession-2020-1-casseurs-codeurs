<template>
  <v-container fluid class="container">
    <v-row no-gutters>
      <v-col cols="12">
        <v-row align-content="center" no-gutters>
          <!-- welcome section -->
          <v-container fluid class="px-5 mb-1 mt-0 pt-0">
            <v-row
              align-content="space-between"
              justify="space-around"
              no-gutters
              class="mt-0 pt-0"
            >
              <v-col cols="12">
                <h1
                  :class="{
                    'display-1 mb-3': $vuetify.breakpoint.smAndDown,
                    'display-2 mb-5': $vuetify.breakpoint.mdAndUp,
                  }"
                >
                  {{ $tc("mainWelcomeDonate.welcome", 1) }}
                </h1>
                <span class="text-lg-h6 mt-5">{{
                  $tc("mainWelcomeDonate.welcomeText", 1)
                }}</span>
                <v-container fluid class="pa-0 mt-0">
                  <v-row align-content="center" no-gutters class="mt-0 pt-0">
                    <v-col cols="12">
                      <div class="my-3">
                        <h2 class="display-1">
                          {{ $tc("mainWelcomeDonate.welcomeAction", 1) }}
                        </h2>
                      </div>
                    </v-col>
                    <!-- form -->
                    <v-col cols="12">
                      <form class="form">
                        <v-container class="ma-0 pa-0" fluid>
                          <v-row
                            align-content="space-between"
                            justify="space-around"
                          >
                            <v-col cols="12" lg="9" class="pb-0 input">
                              <div class="errorAlertRepo" v-show="errorRepo">
                                {{ $tc("repoError.repo", 1) }}
                              </div>
                              <input
                                id="repository"
                                type="url"
                                pattern="https://github.com/.+"
                                title="The URL must start with https://github.com/"
                                class="form__input form__input--green"
                                placeholder="https://github.com/example"
                                v-model="repository"
                                v-on:keyup="cancelErrorRepo"
                                @focus="cancelErrorRepo"
                              />
                              <label for="repository" class="form__label">{{
                                $tc("mainWelcomeDonate.welcomeForm.labelUrl", 1)
                              }}</label>
                            </v-col>
                            <v-col cols="12" lg="3" class="pb-0">
                              <input
                                id="branch"
                                type="text"
                                class="form__input form__input--green"
                                placeholder="master"
                                v-model="branch"
                              />
                              <label for="branch" class="form__label">{{
                                $tc(
                                  "mainWelcomeDonate.welcomeForm.labelBranch",
                                  1
                                )
                              }}</label>
                            </v-col>
                            <v-col
                              cols="12"
                              class="ma-0 pa-0"
                              v-if="$auth.check()"
                            >
                              <v-radio-group
                                row
                                class="ma-0 pa-0"
                                v-model="radioGroup"
                              >
                                <v-row
                                  justify="space-around"
                                  align-content="center"
                                  align="baseline"
                                  class="ma-0"
                                >
                                  <v-col cols="12" md="4">
                                    <v-radio
                                      :label="
                                        $tc(
                                          'mainWelcomeDonate.welcomeForm.labelOption1',
                                          1
                                        )
                                      "
                                      value="1"
                                      name="migration"
                                      color="secondary"
                                      class="my-md-1"
                                    ></v-radio>
                                  </v-col>
                                  <v-col cols="12" md="4">
                                    <v-radio
                                      :label="
                                        $tc(
                                          'mainWelcomeDonate.welcomeForm.labelOption2',
                                          1
                                        )
                                      "
                                      value="2"
                                      name="migration"
                                      color="secondary"
                                      class="my-md-1"
                                    ></v-radio>
                                  </v-col>
                                  <v-col cols="12" md="4">
                                    <v-radio
                                      :label="
                                        $tc(
                                          'mainWelcomeDonate.welcomeForm.labelOption0',
                                          1
                                        )
                                      "
                                      value="0"
                                      name="migration"
                                      color="secondary"
                                      class="my-md-1"
                                    ></v-radio>
                                  </v-col>
                                </v-row>
                              </v-radio-group>
                            </v-col>
                            <v-col cols="12" lg="9" class="pt-0 input">
                              <div class="errorAlertEmail" v-show="errorEmail">
                                {{ $tc("repoError.email", 1) }}
                              </div>
                              <input
                                id="mail"
                                pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                required
                                class="form__input form__input--green"
                                placeholder="dev@swapp.com"
                                v-model="email"
                                v-on:keyup="cancelErrorEmail"
                                @focus="cancelErrorEmail"
                              />
                              <label for="mail" class="form__label">{{
                                $tc(
                                  "mainWelcomeDonate.welcomeForm.labelEmail",
                                  1
                                )
                              }}</label>
                            </v-col>
                            <v-col cols="12" lg="3" class="pt-0">
                              <v-row
                                justify="end"
                                justify-lg="center"
                                class="ma-0 pa-0"
                              >
                                <button
                                  class="btn btn--green"
                                  @click.prevent="handleGithubUrl"
                                >
                                  {{ $tc("mainWelcomeDonate.welcomeBtn", 1) }}
                                </button>
                              </v-row>
                            </v-col>
                          </v-row>
                        </v-container>
                        <v-dialog
                          content-class="modal"
                          v-show="loading"
                          v-model="loading"
                          dark
                        >
                          <v-img
                            class="mx-1 loader"
                            src="../../img/swapp_image_logo.svg"
                            max-height="100"
                            max-width="100"
                            contain
                            alt="logo"
                          ></v-img>
                          <v-skeleton-loader
                            class="mx-auto"
                            max-width="300"
                            type="card"
                          ></v-skeleton-loader>
                        </v-dialog>
                        <v-dialog
                          content-class="success-modal"
                          v-show="fetching"
                          v-model="fetching"
                          dark
                        >
                          <h4 class="message-success">
                            {{
                              this.userFeedBackScanned
                                ? $tc(
                                    "mainWelcomeDonate.welcomeModale.success",
                                    1
                                  )
                                : $tc(
                                    "mainWelcomeDonate.welcomeModale.error",
                                    1
                                  )
                            }}
                          </h4>
                          <p class="message">
                            {{
                              this.userFeedBackScanned
                                ? $tc(
                                    "mainWelcomeDonate.welcomeModale.successMsg",
                                    1
                                  )
                                : $tc(
                                    "mainWelcomeDonate.welcomeModale.errorMsg",
                                    1
                                  )
                            }}
                          </p>
                        </v-dialog>
                      </form>
                      <span class="subheading mb-5 pt-2">{{
                        $tc("mainWelcomeDonate.welcomeAsterisk", 1)
                      }}</span>
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
            <v-row
              align-content="space-between"
              justify="space-around"
              no-gutters
            >
              <v-col cols="12">
                <v-container fluid class="pa-0 mt-1">
                  <v-row align-content="center" no-gutters>
                    <v-col cols="12">
                      <v-container fluid>
                        <v-row align="baseline" class="mr-5">
                          <v-col cols="12" lg="10">
                            <h2 class="mb-1 mt-2">
                              {{ $tc("mainWelcomeDonate.donateAction", 1) }}
                            </h2>
                          </v-col>
                          <v-col cols="12" lg="2">
                            <button
                              class="btn btn--green"
                              role="link"
                              @click="showStripeForm"
                            >
                              {{ $tc("mainWelcomeDonate.donateBtn", 1) }}
                            </button>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-col>
                    <stripe-element
                      v-if="isStripeOpen"
                      v-model="isStripeOpen"
                      :method="hideStripeForm"
                    />
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
import StripeElement from "./StripeForm";
export default {
  name: "MainWelcome",
  components: {
    StripeElement,
  },
  data: () => ({
    repository: "",
    error: false,
    loading: false,
    email: "",
    branch: "",
    fetching: false,
    isStripeOpen: false,
    errorEmail: false,
    errorRepo: false,
    radioGroup: "0",
    userFeedBackScanned: true,
  }),
  methods: {
    handleGithubUrl: function () {
      let reg = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

      if (
        !this.repository.startsWith("https://github.com/") ||
        !reg.test(this.email)
      ) {
        if (!reg.test(this.email)) {
          this.errorEmail = true;
        }
        if (!this.repository.startsWith("https://github.com/")) {
          this.errorRepo = true;
        }
      } else {
        this.loading = true;
        const splittedUrl = this.repository.split("/");
        const username = splittedUrl[splittedUrl.length - 2];
        const repo = splittedUrl[splittedUrl.length - 1];
        const email = this.email;
        const migration = this.radioGroup;
        const branch = this.branch;
        let url = `github/${username}/${repo}/${email}/${migration}/${branch}`;
        url = url.replace("//", "/");
        this.axios
          .get(url)
          .then((response) => {
            this.loading = false;
            this.fetching = true;
            if (response.data.code == 200) {
              this.userFeedBackScanned = true;
            } else {
              this.userFeedBackScanned = false;
            }
            setTimeout(() => {
              this.fetching = false;
            }, 4000);
          })
          .catch((err) => {
            console.log({ err });
          });
      }
    },
    showStripeForm: function () {
      this.isStripeOpen = true;
    },
    hideStripeForm: function () {
      this.isStripeOpen = false;
    },
    cancelErrorRepo: function () {
      this.errorRepo = false;
    },
    cancelErrorEmail: function () {
      this.errorEmail = false;
    },
  },
};
</script>

<style lang="scss">
@import "https://cdn.jsdelivr.net/npm/animate.css@3.5.1";
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

.success-modal {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 400px;
  height: 200px;
  position: relative;
  padding: 40px;
  background: #3a3a3f;
}

.message-success {
  font-size: 22px;
  font-weight: bold;
  color: #62cb5c;
  text-align: center;
}

.message {
  text-align: center;
}

.loader {
  animation: rotation 1s infinite linear;
  position: absolute;
}

.errorAlertRepo {
  color: red;
  position: absolute;
  bottom: 10px;
  right: 15px;
  font-weight: bold;
}

.errorAlertEmail {
  color: red;
  position: absolute;
  top: 50px;
  right: 15px;
  font-weight: bold;
}

.input {
  position: relative;
}

@keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(359deg);
  }
}

.v-radio > label {
  color: #62cb5c !important;
}

.v-radio > label {
  color: #62cb5c !important;
}
</style>
