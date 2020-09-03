<template>
  <v-dialog content-class="modalStripe" v-model="dialog" dark @click:outside="method">
    <div class="stripe-form">
      <form method="POST" id="payment-form">
        <div class="email top-form">
          <label for="email">Email</label>
          <div>
            <input
              type="email"
              class="StripeElement"
              id="email"
              name="email"
              v-on:keyup="cancelErrorEmail"
            />
          </div>
          <div class="errorAlertEmail" v-show="errorEmail">Valid email is required</div>
        </div>
        <div class="form-row top-form">
          <label for="card-number">Name on card</label>
          <div>
            <input type="text" class="StripeElement" id="name_on_card" name="name_on_card" />
          </div>
          <div class="top-form">
            <label for="card-number">Credit card</label>
            <div id="card-number">
              <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-number-errors" role="alert"></div>
          </div>
        </div>
        <div class="form-card-row">
          <div>
            <label for="card-date">Expiration date</label>
            <div id="card-date">
              <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-date-errors" role="alert"></div>
          </div>
          <div>
            <label for="card-cvc">Cvc</label>
            <div id="card-cvc">
              <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-cvc-errors" role="alert"></div>
          </div>
        </div>
        <div id="amount">
          <label for="amount">Amount</label>
          <div>
            <select v-model="amount" class="StripeElement" id="input-amount">
              <option
                v-bind:key="option.value"
                v-for="option in options"
                v-bind:value="option.value"
              >{{ option.text }} €</option>
            </select>
          </div>
        </div>
        <button @click="validePayment" class="my-5 btn btn--violet button">Submit Payment</button>
      </form>
    </div>
    <v-dialog content-class="success-modal" v-show="stripeResponse" v-model="stripeResponse" dark>
      <h4 class="message-success">{{ $tc( "mainWelcomeDonate.welcomeModale.success", 1 ) }}</h4>
      <p class="message">{{ $tc( "mainWelcomeDonate.welcomeModale.successMsg", 1 ) }}</p>
    </v-dialog>
  </v-dialog>
</template>

<script>
import { loadStripe } from "@stripe/stripe-js";
let stripe;
const stripeObj = loadStripe(
  "pk_test_51HKQ6eEDdpH3cWNoddQJ31BBxp3uWCFyFVuj7Ge0ObIwOBj59a4wfqmjPT1NDg09UeYPHeYeDW7JOgFnuiDO7HNu00jDCMt69v"
).then(res => (stripe = res));
const axios = require("axios").default;

export default {
  name: "StripeElement",
  props: {
    method: { type: Function }
  },
  data: () => ({
    dialog: true,
    stripeResponse: false,
    email: "",
    amount: "1",
    options: [
      { text: "1", value: "1" },
      { text: "2", value: "2" },
      { text: "3", value: "3" },
      { text: "4", value: "4" },
      { text: "5", value: "5" },
      { text: "6", value: "6" },
      { text: "7", value: "7" },
      { text: "8", value: "8" },
      { text: "9", value: "9" },
      { text: "10", value: "10" },
      { text: "11", value: "11" },
      { text: "12", value: "12" },
      { text: "13", value: "13" },
      { text: "14", value: "14" },
      { text: "15", value: "15" }
    ],
    errorEmail: false
  }),
  methods: {
    initializeStripe: function(event) {
      // Create an instance of Elements.
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
        const displayError = document.getElementById("card-number-errors");
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = "";
        }
      });

      const cardExpiry = elements.create("cardExpiry", {
        style: style
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
        style: style
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
        const options = {
          name: document.getElementById("name_on_card").value
        };
        stripe.createToken(cardNumber, options).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById("card-number-errors");
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
        // form.submit();
        this.token = token;
      }
    },
    validePayment() {
      const formEmail = document.getElementById("email").value;
      setTimeout(() => {
        this.stripeResponse = true;
      }, 500);
      
      setTimeout(() => {
        this.stripeResponse = false;
        this.method()
      }, 5000);
      axios
        .post("/donate", {
          email: formEmail,
          amount: amount,
          tokenId: this.token.id
        })
        .then(res => console.log({ res }))
        .catch(err => console.log({ err }));
    },
    checkEmail() {
      let reg = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

      if (!reg.test(document.getElementById("email").value)) {
        this.errorEmail = true;
      } else {
        this.errorEmail = false;
      }
    },
    cancelErrorEmail: () => {
      this.errorEmail = false;
    }
  },
  mounted() {
    setTimeout(() => {
      this.initializeStripe();
    }, 400);
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
  color: #32325d;
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
  position: relative;
}
.input {
  background: "#aab7c4";
}
#card-number-errors,
#card-date-errors,
#card-cvc-errors {
  color: red;
}
#card-date,
#card-cvc,
#amount {
  width: 100px;
}
// #card-cvc,
// #amount {
//     margin-left: 20px;
// }
#input-amount {
  width: 100px;
}
.form-card-row {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-top: 20px;
}
.cvc {
  margin-left: 20px;
}
.top-form,
#amount {
  margin-top: 15px;
}
.errorAlertEmail {
  color: red;
  position: absolute;
  bottom: 25px;
  right: 15px;
  font-weight: bold;
  top: 0px;
  right: 10%;
}
.success-modal {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 400px;
  height: 200px;
  position: absolute;
  padding: 40px;
  background: black;
}
</style>
