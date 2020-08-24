<template>
  <v-container>
    <v-row>
      <v-col xs="12">
        <v-row justify="center" align-content="center">
          <h2 class="my-5 pa-4 text-center">Bonjour {{ user.username }}, heureux de vous revoir !</h2>
          <h3 class="mb-5 pa-4 text-center">Que souhaitez-vous faire aujourd'hui ?</h3>
          <button
            class="my-5 btn btn--violet"
            style="min-width:35ch;"
          >Consulter l'historique d'analyses</button>
          <button
            class="my-5 btn btn--violet"
            style="min-width:35ch;"
          >Outils de migration php5 > php7</button>
          <p class="my-5 pa-4 text-center">
            L'application SWAPP vous a déjà permis de détecter
            <span class="colorTertiaryLight--text text-h6">{{ user.stats }}</span> bugs et failles de sécurité dans votre code !
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
};
</script>