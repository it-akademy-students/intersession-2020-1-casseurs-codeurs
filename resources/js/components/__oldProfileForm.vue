 <template>
  <v-row justify="center">
    <v-card flat color="colorPrimaryUltraLight">
      <v-card-title class="text-center">
        <span class="headline">Les informations de votre compte</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field :label="`${user.username}*`"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field :label="`${user.email}*`" required></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field :label="`${user.password}*`" type="password" required></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-autocomplete
                :items="['Frontend', 'Backend', 'Admin sys', 'cyber sécu', 'Chef de projet', 'Autre']"
                :label="`${user.job}`"
                multiple
              ></v-autocomplete>
            </v-col>
          </v-row>
        </v-container>
        <small>*indicates required field</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
        <v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-row>
</template>

<script>
export default {
  name: "ProfileForm",
  data: () => ({
    user: {
      username: "Isa",
      email: "i@i.dev",
      password: "********",
      job: "Développeuse",
    },
  }),
};
</script>

<style lang="scss">
</style>