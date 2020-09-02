<template>
  <v-card class="mx-auto mt-5" color="colorTertiary">
    <v-card-title>
      <div class="layout row ma-0 justify-space-between pb-1">
        <div class="subheading">{{ title }}</div>
        <div class="icon">
          <v-icon color="colorSecondary">mdi-code-tags-check</v-icon>
        </div>
      </div>
    </v-card-title>
    <v-card-text>
      <div class="justify-center row layout ma-0">
        <v-progress-circular
          :size="150"
          :width="15"
          :rotate="-90"
          :value="value"
          color="colorSecondary"
        >{{ value }}</v-progress-circular>
      </div>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "CircleStats",
  props: {
    title: "hello",
    subTitle: "test",
    caption: "retest",
    value: 30,
  },
};
</script>

