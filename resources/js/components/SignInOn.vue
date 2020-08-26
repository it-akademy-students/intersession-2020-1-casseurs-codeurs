<template>
  <v-container fluid>
    <v-row align-content="center" justify="space-around" no-gutters>
      <v-col cols="12">
        <v-row justify="center">
          <h2
            class="my-5 pa-4 text-center"
          >Connectez-vous ou Créez votre compte pour bénéficier de toutes les fonctionnalités de l’application SWAPP.</h2>
        </v-row>
      </v-col>
      <v-col cols="12">
        <v-row justify="center">
          <button class="my-5 btn btn--violet" style="min-width:20ch;">Se connecter</button>
        </v-row>
      </v-col>
      <v-col cols="12">
        <v-row justify="center">
          <button class="my-5 btn btn--violet" style="min-width:20ch;">Créer un compte</button>
        </v-row>
      </v-col>
      <v-col cols="12">
        <h3 class="mt-5 pa-4">Pourquoi créer un compte ?</h3>
      </v-col>
      <v-col cols="12">
        <p
          class="mb-5 pa-4"
        >Les fonctionalités de base de l’application sont disponibles gratuitement sans inscription. Toutefois les utilisateurs connectés bénéficient de fonctionnalités supplémentaires : rapport par e-mail, possibilité d'upgrade de version de php, historique des rapports.</p>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "SignInOn",
};
</script>