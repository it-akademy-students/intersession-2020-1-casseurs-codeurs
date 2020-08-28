<template>
  <v-container justify-center>
    <v-layout align-center justify-space-around column fill-height>
      <v-flex xs12>
        <h2
          class="my-5 pa-4"
        >Connectez-vous afin de bénéficier de toutes les fonctionnalités de l’application SWAPP</h2>
      </v-flex>
      <v-flex xs12>
        <form action="#" class="form">
          <v-container grid-list-md>
            <v-layout align-space-between justify-space-around row wrap fill-height>
              <v-flex xs12>
                <input
                  id="username"
                  type="text"
                  class="form__input form__input--violet"
                  placeholder="Nom d'utilisateur"
                  required
                />
                <label for="username" class="form__label">Entrez votre nom d'utilisateur</label>
              </v-flex>
              <v-flex xs12>
                <input
                  id="password"
                  type="text"
                  class="form__input form__input--violet"
                  placeholder="Mot de passe"
                  required
                />
                <label for="password" class="form__label">Entrez votre mot de passe</label>
              </v-flex>
              <v-flex xs12 class="mb-5">
                <div>
                  <a href="#" class="btn-text btn-text--form--violet">Mot de passe oublié ?</a>
                </div>
              </v-flex>
              <v-flex xs12>
                <button class="btn btn--violet">Envoyer</button>
              </v-flex>
            </v-layout>
          </v-container>
        </form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: "LoginForm",
};
</script>


<style scoped lang="scss">
/*
see resources/sass/components/_forms.scss
*/
</style>