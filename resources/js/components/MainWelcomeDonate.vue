<template>
  <v-container fluid class="container">
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
                        <h3 class="display-1">Scan your repository</h3>
                      </div>
                    </v-col>
                    <!-- form -->
                    <v-col cols="12">
                      <form action="#" class="form">
                        <v-container>
                          <v-col>
                            <v-row align-content="space-between" justify="space-around">
                              <v-col cols="12" lg="8">
                                <input
                                  id="repository"
                                  type="email"
                                  class="form__input form__input--green"
                                  placeholder="dev@swapp.com"
                                  v-model="email"
                                />
                                <label for="repository" class="form__label">Enter your email</label>
                              </v-col>
                              <v-col cols="12" lg="4">
                                <input
                                  id="repository"
                                  type="text"
                                  class="form__input form__input--green"
                                  placeholder="master"
                                  v-model="branch"
                                />
                                <label for="repository" class="form__label">Branch to scan</label>
                              </v-col>
                            </v-row>
                            <v-row align-content="space-between" justify="space-around">
                              <v-col cols="12" lg="8">
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
                                >Enter the URL of your repo</label>
                              </v-col>
                              <v-col cols="12" lg="4">
                                <button class="btn btn--green" @click="handleClick">Submit</button>
                              </v-col>
                            </v-row>
                          </v-col>
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
                          <h4>Success</h4>
                          <p>We will sent your result by email</p>
                        </v-dialog>
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
                <!-- <span class="subheading my-5">{{ lorem }}</span> -->
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
                            <button class="btn btn--green">I support!</button>
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
    email: "",
    branch: "",
    loading: false,
    fetching: false
  }),
  methods: {
    handleClick: function() {
      this.loading = true;
      console.log("click");
      const splittedUrl = this.repository.split("/");
      const username = splittedUrl[splittedUrl.length - 2];
      const repo = splittedUrl[splittedUrl.length - 1];
      const email = this.email;
      const branch = this.branch;
      const url = `github/${username}/${repo}`;
      console.log({ url });
      this.$http.get(url).then(response => {
        this.loading = false;
        this.fetching = true;
        setTimeout(() => {
          this.fetching = false;
        }, 3000);
      });
    }
  }
};
</script>

<style lang="scss">
.divider-x {
  width: 100%;
  height: 0.5rem;
  box-sizing: border-box;
  // background-color: #967dff;
  background-color: #62cb5c;
  transform: scale(1.02);
}
.email-input {
  width: 83%;
}
.form {
  position: relative;
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
  -webkit-animation: rotation 1s infinite linear;
  position: absolute;
}
h4, p {
  text-align: center;
}
@-webkit-keyframes rotation {
  from {
    -webkit-transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(359deg);
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