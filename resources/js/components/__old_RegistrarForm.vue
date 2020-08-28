<template>
  <v-container justify-center>
    <v-layout align-center justify-space-around column fill-height>
      <v-flex xs12>
        <h2
          class="my-5 pa-4"
        >Inscrivez-vous afin de bénéficier de toutes les fonctionnalités de l’application SWAPP</h2>
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
                  id="email"
                  type="text"
                  class="form__input form__input--violet"
                  placeholder="adresse@exemple.com"
                  required
                />
                <label for="email" class="form__label">Entrez votre adresse email</label>
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
                <v-select :items="items" label="Votre Job" solo class="form__select form__select--violet"></v-select>
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
  name: "OldRegistrarForm",
  data: () => ({
      items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
    }),
};
</script>


<style lang="scss">
/*
see also resources/sass/components/_forms.scss
*/
.theme--dark.v-list,
.theme--dark.v-text-field--solo > .v-input__control > .v-input__slot {
    
    background-color: #B8B8BF !important;
    border: 1px solid #967dff;

    &:focus {
        border: 1px solid #ab97ff;
    }
}
.mdi-menu-down::before,
.mdi-menu-down::after {
    color: #fbfbfb;
}
</style>