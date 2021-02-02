<template>
  <v-app class="apps">
    <v-app-bar app flat dense fixed clipped-right>
      <v-spacer></v-spacer>
      <v-btn icon class="snipcart-customer-signin"
        ><v-icon color="primary">mdi-account</v-icon></v-btn
      >
      <v-btn icon class="snipcart-checkout"
        ><v-icon color="primary">mdi-cart</v-icon></v-btn
      ></v-app-bar
    >
    <v-main>
      <v-container fluid class="d-flex flex-column justify-center align-center">
        <v-row class="mt-16 mb-8" align="center" justify="center">
          <h1>This little being is hungry</h1>
        </v-row>
        <v-row class="my-8" align="center" justify="center">
          <img class="circle" src="/img/baby.gif" alt="Hungry being" />
        </v-row>
        <v-row class="mt-8 mb-16" align="center" justify="center">
          <v-btn
            block
            color="primary"
            @click="$vuetify.goTo('#test')"
            class="font-weight-bold"
            depressed
            shaped
            x-large
            >Make him a recipe</v-btn
          >
        </v-row>
        <v-row>
          <v-spacer class="my-16 py-16"></v-spacer>
        </v-row>
        <v-row id="test" justify="center" class="max-width">
          <v-stepper class="elevation-0 stepper" v-model="e2" flat>
            <v-stepper-header>
              <v-stepper-step :complete="e2 > 1" step="1">
                Select your ingredients
              </v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step :complete="e2 > 2" step="2">
                Complete final details
              </v-stepper-step>
            </v-stepper-header>
            <v-stepper-content step="1">
              <AvailableIngredients
                @selected="select"
                :ingredients="allIngredients"
              />
              <v-btn color="primary" @click="e2 = 2"> Continue </v-btn>
            </v-stepper-content>
            <v-stepper-content step="2">
              <v-container fill-height fill-width fluid>
                <v-row class="d-flex flex-column">
                    <RecipeCustomizer
                      :ingredients="selected"
                      @named="setRecipeName"
                      @sized="setSize"
                      @removed="remove"
                    />
                </v-row>
              </v-container>
              <v-btn color="primary" @click="e2 = 1" text>
                Change ingredients
              </v-btn>
              <v-btn color="primary" @click="buy">
                <v-icon>mdi-cart-plus</v-icon> Add to cart
              </v-btn>
            </v-stepper-content>
            <v-stepper-items> </v-stepper-items>
          </v-stepper>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import axios from "axios";

import AvailableIngredients from "./AvailableIngredients";
import RecipeCustomizer from "./RecipeCustomizer";

import { mutateItem } from "../utils";

export default {
  components: {
    AvailableIngredients,
    RecipeCustomizer,
  },
  data() {
    return {
      allIngredients: [],
      e2: 1,
      recipeName: "",
      size: "small",
    };
  },
  async created() {
    const response = await axios.get("/api/ingredients");
    this.allIngredients = response.data;
  },
  computed: {
    selected() {
      return this.allIngredients.filter((x) => !!x.selected);
    },
    available() {
      return this.allIngredients.filter((x) => !x.selected);
    },
    categories() {
      return Object.keys(
        this.allIngredients.reduce((x, opts) => {
          opts[x.category] = true;
          return opts;
        }, {})
      );
    },
  },
  methods: {
    async buy() {
      const payload = {
        name: this.recipeName,
        size: this.size,
        items: this.selected.map((x) => ({
          id: x.id,
          quantity: x.quantity,
        })),
      };
      const response = await axios.post("/api/recipes", payload);
      const host = window.location.protocol + "//" + window.location.host;
      Snipcart.api.cart.items.add({
        ...response.data,
        image: "img/Logo.svg",
        url: host + response.data.url,
      });
    },
    select(id) {
      const items = this.allIngredients;
      mutateItem(
        items,
        (x) => x.id === id,
        (x) => ({
          ...x,
          selected: true,
          // reset
          quantity: 5,
        })
      );
    },
    setRecipeName(name) {
      this.recipeName = name;
    },
    setSize(size) {
      this.size = size;
    },
    remove(id) {
      const items = this.allIngredients;
      mutateItem(
        items,
        (x) => x.id === id,
        (x) => ({
          ...x,
          selected: false,
        })
      );
    },
    quantity(data) {
      mutateItemId(this.allIngredients, data.id, (x) => ({
        ...x,
        quantity: data.qnt,
      }));
    },
  },
};
</script>
<style>
.apps {
  font-family: "Dosis", sans-serif;
}

.circle {
  border-radius: 100%;
}

.product {
  height: auto;
  width: 300px;
}

.stepper {
  width: 56%;
}

@media (max-width: 630px) {
  .stepper {
    width: 88%;
  }
}
</style>
