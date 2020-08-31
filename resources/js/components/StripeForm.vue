<template>
    <v-dialog
        content-class="modalStripe"
        v-model="dialog"
        dark
        @click:outside="closeModal"
    >
        <div class="stripe-form">
            <form method="post" id="payment-form">
                <div class="email">
                    <label for="email">
                        Email
                    </label>
                    <input type="email" class="StripeElement" />
                </div>
                <div class="form-row">
                    <label for="card-number">
                        Credit card
                    </label>
                    <div id="card-number">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-number-errors" role="alert"></div>
                </div>
                <div class="form-card-row">
                    <div>
                        <div id="card-date">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-date-errors" role="alert"></div>
                    </div>
                    <div>
                        <div id="card-cvc">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-cvc-errors" role="alert"></div>
                    </div>
                </div>

                <button class="my-5 btn btn--violet button">
                    Submit Payment
                </button>
            </form>
        </div>
    </v-dialog>
</template>

<script>
import { loadStripe } from "@stripe/stripe-js";
let stripe;
const stripeObj = loadStripe(
    "pk_test_51HKQ6eEDdpH3cWNoddQJ31BBxp3uWCFyFVuj7Ge0ObIwOBj59a4wfqmjPT1NDg09UeYPHeYeDW7JOgFnuiDO7HNu00jDCMt69v"
).then(res => (stripe = res));

export default {
    name: "StripeElement",

    data: () => ({
        isStripeOpen: false,
        dialog: true
    }),
    methods: {
        closeModal: () => {
            this.isStripeOpen = false;
        },
        initializeStripe: event => {
            // Create an instance of Elements.
            console.log(stripe);
            const elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            const style = {
                base: {
                    color: "#32325d",
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#aab7c4"
                    }
                },
                invalid: {
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };

            // Create an instance of the card Element.
            const cardNumber = elements.create("cardNumber", {
                style: style,
                showIcon: true
            });

            // Add an instance of the card Element into the `card-element` <div>.
            cardNumber.mount("#card-number");

            // // Handle real-time validation errors from the card Element.
            cardNumber.on("change", function(event) {
                const displayError = document.getElementById(
                    "card-number-errors"
                );
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = "";
                }
            });

            const cardExpiry = elements.create("cardExpiry", {
                style: style,
            });

            // Add an instance of the card Element into the `card-element` <div>.
            cardExpiry.mount("#card-date");

            // // Handle real-time validation errors from the card Element.
            cardExpiry.on("change", function(event) {
                const displayError = document.getElementById("card-date-errors");
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = "";
                }
            });

            const cardCvc = elements.create("cardCvc", {
                style: style,
            });
            cardCvc.mount("#card-cvc");

            // // Handle real-time validation errors from the card Element.
            cardCvc.on("change", function(event) {
                const displayError = document.getElementById("card-cvc-errors");
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = "";
                }
            });

            // // Handle form submission.
            const form = document.getElementById("payment-form");
            form.addEventListener("submit", function(event) {
                event.preventDefault();

                stripe.createToken(cardNumber).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById(
                            "card-number-errors"
                        );
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                const form = document.getElementById("payment-form");
                const hiddenInput = document.createElement("input");
                hiddenInput.setAttribute("type", "hidden");
                hiddenInput.setAttribute("name", "stripeToken");
                hiddenInput.setAttribute("value", token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        }
    },
    mounted() {
        setTimeout(() => {
            this.initializeStripe();
        }, 1500);
    }
};
</script>

<style lang="scss">
.StripeElement {
    box-sizing: border-box;

    height: 40px;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
    width: 400px;
    max-width: 70vw;
}

.StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
    border-color: #fa755a;
}

.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}

.stripe-form {
    background: grey;
    padding: 20px;
    width: 500px;
    max-width: 80vw;
    border-radius: 6px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.email {
    display: flex;
    flex-direction: column;
}
.input {
    background: "#aab7c4";
}
#card-number-errors, #card-cvc-erros, #card-cvc-errors {
    color: #ea4141;
}
#card-date, #card-cvc {
    width: 100px;
}
 #card-cvc {
     margin-left: 20px;
 }
 .form-card-row {
     display: flex;
     flex-direction: row;
     margin-top: 20px;
 }
</style>
