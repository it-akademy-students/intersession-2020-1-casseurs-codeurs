<template>
  <v-container fluid class="px-5 mt-5">
    <v-card class="px-3" color="colorPrimaryLight">
      <v-row align-content="space-between" justify="space-around">
        <v-col cols="12">
          <h2 class="display-1 my-5 pa-2">Analysis results:</h2>
        </v-col>
        <v-col cols="12">
          <result-table />
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
import ResultTable from "@/js/components/ResultTable";

export default {
  name: "ResultSection",
  components: {
    ResultTable,
  },
};
</script>
