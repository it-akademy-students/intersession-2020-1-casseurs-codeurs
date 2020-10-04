<template>
  <v-data-table
    :headers="headers"
    :items="results"
    :single-expand="singleExpand"
    :expanded.sync="expanded"
    :sort-by="['status', 'errorsFound']"
    :sort-desc="[true, true]"
    item-key="name"
    show-expand
    class="elevation-1 colorPrimaryUltraLight"
  >
    <template v-slot:item.status="{ item }">
      <v-chip small :color="getColor(item.status)" class="caption my-2">{{
        item.status
      }}</v-chip>
    </template>

    <template v-slot:expanded-item="{ headers, item }">
      <td :colspan="headers.length" class="pa-0">
        <v-data-table
          :headers="headersExpanded"
          :items="item.files"
          hide-default-footer
          class="colorGrey"
        >
          <template v-slot:item.path="{ item }">
            <v-chip color="transparent" class="caption my-2">
              <a :href="`${item.path}`" download>
                <v-icon color="secondary">mdi-file-download</v-icon>
              </a>
            </v-chip>
          </template>
        </v-data-table>
      </td>
    </template>
  </v-data-table>
</template>

<script>
export default {
  name: "ResultTable",
  data() {
    return {
      expanded: [],
      singleExpand: true,
      results: [],
    };
  },
  beforeMount() {
    this.getUserRepository();
  },
  computed: {
    headers() {
      return [
        {
          text: this.$tc("ResultTable.headers.name", 1),
          align: "start",
          sortable: false,
          value: "name",
          class: "colorGreyDark colorSecondary--text",
        },
        {
          text: this.$tc("ResultTable.headers.errorsFound", 1),
          value: "errorsFound",
          class: "colorGreyDark colorSecondary--text",
        },
        {
          text: this.$tc("ResultTable.headers.securityFalls", 1),
          value: "securityFails",
          class: "colorGreyDark colorSecondary--text",
        },
        {
          text: this.$tc("ResultTable.headers.scannedFiles", 1),
          value: "scannedFiles",
          class: "colorGreyDark colorSecondary--text",
        },
        {
          text: this.$tc("ResultTable.headers.numberOfScans", 1),
          value: "numberOfScans",
          class: "colorGreyDark colorSecondary--text",
        },
        {
          text: this.$tc("ResultTable.headers.totalScannedFiles", 1),
          value: "totalScannedFiles",
          class: "colorGreyDark colorSecondary--text",
        },
        {
          text: this.$tc("ResultTable.headers.status", 1),
          value: "status",
          class: "colorGreyDark colorSecondary--text",
        },
        {
          text: "",
          value: "data-table-expand",
          class: "colorGreyDark colorSecondary--text",
        },
      ];
    },
    headersExpanded() {
      return [
        {
          text: this.$tc("ResultTable.headersExpanded.fileName", 1),
          value: "fileName",
          class: "colorGreyDark colorTertiaryLight--text",
        },
        {
          text: this.$tc("ResultTable.headersExpanded.download", 1),
          value: "path",
          class: "colorGreyDark colorTertiaryLight--text",
        },
      ];
    },
  },
  methods: {
    getColor(status) {
      if (status === "danger") return "colorDanger";
      else if (status === "warning") return "colorWarning";
      else return "colorSecondaryLight";
    },
    getUserRepository() {
      let url = `/users/${this.$auth.user().id}/repository`;

      let header = {
        headers: {
          Authorization: `bearer ${this.$auth.token()}`,
        },
      };
      axios
        .get(url, header)
        .then((res) => {
          return (this.results = res.data.data);
        })
        .catch((err) => {
          console.log({ err });
        });
    },
  },
};
</script>

<style scoped lang="scss">
.result {
  &--clean {
    border-left: 4px solid #9ade96;
  }
  &--warning {
    border-left: 4px solid orange;
  }
  &--danger {
    border-left: 4px solid tomato;
  }
}
.v-chip {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 10ch;
}
</style>