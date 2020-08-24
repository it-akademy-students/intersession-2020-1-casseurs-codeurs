<template>
    <v-dialog
        v-model="dialog"
        max-width="600px"
        v-if="showContact"
        adaptative
        persistent
    >
        <!-- <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on">Open Dialog</v-btn>
    </template>-->

        <v-card color="colorPrimaryUltraLight" class="pa-3">
            <v-card-title>
                <v-card-text class="headline text-center colorSecondary--text"
                    >Any question? Contact us!
                </v-card-text>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                label="Last name *"
                                required
                                color="secondary"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                label="First Name *"
                                color="secondary"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                label="Email *"
                                required
                                color="secondary"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                color="secondary"
                                label="Message *"
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <small>*required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="warning" text @click="closeModal">Cancel</v-btn>
                <v-btn color="success" text @click="dialog = false" href="/"
                    >Submit</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import store from "../stores/store";
export default {
    name: "ContactForm",
    data: () => ({
        dialog: true
    }),
    computed: {
        showContact() {
            return this.$store.getters.isShowContact;
        }
    },
    methods: {
        closeModal: () => {
            store.commit("hideContact");
        }
    }
};
</script>
