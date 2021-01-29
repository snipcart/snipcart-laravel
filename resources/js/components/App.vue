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
        <v-row align="center" justify="center">
          <h1>This little being is hungry</h1>
        </v-row>
        <v-row align="center" justify="center">
          <img class="circle" src="/img/baby.gif" alt="Hungry being" />
        </v-row>
        <v-row class="my-8" align="center" justify="center">
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
        <v-row id="test" justify="center" class="max-width">
          <v-stepper class="elevation-0 stepper" v-model="e2" flat vertical>
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
                :ingredients="available"
              />
              <v-btn color="primary" @click="e2 = 2"> Continue </v-btn>
            </v-stepper-content>
            <v-stepper-content step="2">
              <SelectedIngredients
                :ingredients="selected"
                :recipeName="recipeName"
                @removed="remove"
              />
              <v-btn color="primary" @click="e2 = 1" text>
                Change ingredients
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
import RecipeCustomiser from "./RecipeCustomiser";
import SelectedIngredients from "./SelectedIngredients";

import { mutateItem } from "../utils";

export default {
  components: {
    AvailableIngredients,
    RecipeCustomiser,
    SelectedIngredients,
  },
  data() {
    return {
      allIngredients: [],
      e2: 1,
      recipeName: "",
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
    // TODO change mutateItem method so that selected ingredients are not removed from allIngredients
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
// TODO fix naming bug
</script>
<style>
.apps {
  font-family: "Dosis", sans-serif;
}

.circle {
  border-radius: 100%;
}

.stepper {
  width: 70%;
}

@media (max-width: 630px) {
  .stepper {
    width: 100%;
  }
}
</style>
