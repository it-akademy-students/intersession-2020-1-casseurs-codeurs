<template>
  <v-dialog v-model="dialog" max-width="600px" v-if="showContact" adaptative @click:outside="closeModal">
    <v-card color="colorPrimaryUltraLight" class="pa-3 card">
      <p class="top-right" @click="closeModal">&#215;</p>
      <v-card-title>
        <v-card-text class="headline text-center colorSecondary--text">Any question? Contact us!</v-card-text>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field label="Last name *" required color="secondary" v-model="lastname"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field label="First Name *" color="secondary" v-model="firstname"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field label="Email *" required color="secondary" v-model="email"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea color="secondary" label="Message *" v-model="message"></v-textarea>
            </v-col>
          </v-row>
        </v-container>
        <small>*required field</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="warning" text @click="closeModal">Cancel</v-btn>
        <v-btn color="success" text @click.prevent="submitForm">Submit</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import store from "../stores/store";
export default {
  name: "ContactForm",
  data() {
    return {
      dialog: true,
      message: "",
      email: "",
      firstname: "",
      lastname: "",
      isSubmitSucced: false,
    };
  },
  computed: {
    showContact() {
      return this.$store.getters.isShowContact;
    },
  },
  methods: {
    closeModal: () => {
      store.commit("hideContact");
    },
    updateMessage: (e) => {
      this.$store.commit("updateContact", e.target.value);
    },
    submitForm() {
      const postData = {
        firstname: this.firstname,
        lastname: this.lastname,
        email: this.email,
        message: this.message,
      };
      this.$http.post("contact", postData).then((res) => {
        console.log(res);
        this.isSubmitSucced = true;
      });
    },
  },
};
</script>

<style scoped>
.card {
  position: relative;
}
.top-right {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 22px;
  color: white;
  font-weight: bold;
  cursor: pointer;
  padding: 5px;
}
</style>
