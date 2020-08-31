<template>
  <v-container id="dropdown-languages" style="max-width: 15ch;" class="ma-0 pa-0">
    <v-row align-content="center" justify="center" style="max-width: 15ch;" class="ma-0 pa-0">
      <v-col cols="12" class="ma-0 py-0">
        <v-row justify="end" class="ma-0 pa-0">
          <v-overflow-btn
            v-model="$i18n.locale"
            :items="langs"
            item-color="secondary--text"
            append-icon="mdi-translate"
            target="#dropdown-languages"
            style="max-width: 5ch; max-height: 5ch;"
            depressed
            dense
            background-color="primary"
            class="my-2 lang-switcher"
          >
            <template v-slot:append>
              <v-hover>
                <v-icon
                  slot-scope="{ hover }"
                  :color="`${ hover ? 'colorTertiary' : 'colorSecondary ' }`"
                >mdi-translate</v-icon>
              </v-hover>
            </template>
          </v-overflow-btn>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "LangSwitcher",
  data: () => ({
    langs: ["en", "fr"],
  }),
};
</script>