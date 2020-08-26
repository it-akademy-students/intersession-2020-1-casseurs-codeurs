<template>
  <v-container fluid class="px-5 mt-5">
    <v-card class="px-3" color="colorPrimaryLight">
      <v-row align-content="space-between" justify="space-around">
        <v-col cols="12">
          <h2 class="display-1 my-5 pa-2">Voici les résultats :</h2>
        </v-col>
        <!-- <v-col cols="12">
          <result-list />
        </v-col>-->
        <!-- <v-col cols="12">
          <result-list-details />
        </v-col>-->
        <v-col cols="12">
          <result-table />
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
import ResultList from "@/js/components/ResultList";
import ResultListDetails from "@/js/components/ResultListDetails";
import ResultTable from "@/js/components/ResultTable";

export default {
  name: "ResultSection",
  components: {
    ResultList,
    ResultListDetails,
    ResultTable,
  },
};
</script>
