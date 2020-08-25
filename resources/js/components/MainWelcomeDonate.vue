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
                        <h3 class="display-1">Je scanne mon repo</h3>
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
                              />
                              <label for="repository" class="form__label">Entrez l'url de votre repo</label>
                            </v-col>
                            <v-col cols="12" lg="2">
                              <button class="btn btn--green">Envoyer</button>
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
                            >Participez vous aussi au maintiens de ce projet !</h3>
                          </v-col>
                          <v-col cols="12" lg="2">
                            <button class="btn btn--green">Je soutiens !</button>
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
    welcome: "Bienvenue sur SWAPP !",
    donate: "Soutenez le projet",
    donateText:
      "SWAPP est un projet open source permettant d’automatiser la détection de failles de sécurité et/ou de bug dans le code.",
    lorem:
      "Lorem ipsum dolor sit amet, mel at clita quando. Te sit oratio vituperatoribus, nam ad ipsum posidonium mediocritatem, explicari dissentiunt cu mea. Repudiare disputationi vim in, mollis iriure nec cu, alienum argumentum ius ad. Pri eu justo aeque torquatos.",
  }),
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