<template>
  <v-dialog
    v-model="dialog"
    max-width="600px"
    v-if="showContact"
    adaptative
    @click:outside="closeModal"
  >
    <v-card color="colorPrimaryUltraLight" class="pa-3 card">
      <v-icon class="top-right" @click="closeModal">mdi-close</v-icon>
      <v-card-title>
        <v-card-text
          class="headline text-center colorSecondary--text"
        >{{ $tc("contactForm.title", 1) }}</v-card-text>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                :label="$tc('contactForm.form.labelLastName', 1)"
                required
                color="secondary"
                v-model="lastname"
                :rules="['Required']"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                :label="$tc('contactForm.form.labelFirstName', 1)"
                color="secondary"
                v-model="firstname"
                :rules="['Required']"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field
                :label="$tc('contactForm.form.labelEmail', 1)"
                required
                color="secondary"
                v-model="email"
                :rules="['Required']"
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea
                color="secondary"
                :label="$tc('contactForm.form.labelMsg', 1)"
                v-model="message"
                :rules="['Required']"
              ></v-textarea>
            </v-col>
          </v-row>
        </v-container>
        <small>{{ $tc("contactForm.form.required", 2) }}</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="warning"
          text
          @click="closeModal"
        >{{ $tc("contactForm.form.actions.cancel", 1) }}</v-btn>
        <v-btn
          color="success"
          text
          @click.prevent="submitForm"
        >{{ $tc("contactForm.form.actions.send", 1) }}</v-btn>
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
    /**
     * Represents a book.
     * @constructor
     */
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
      this.axios.post("contact", postData).then((res) => {
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
