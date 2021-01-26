<template>
  <v-app class="app">
    <v-app-bar flat dense><v-btn icon class="snipcart-checkout"><v-icon>mdi-cart</v-icon></v-btn></v-app-bar>
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row class="max-width py-6" align="center" justify="center">
          <h1>This little being is hungry</h1>
        </v-row>
        <v-row class="max-width py-6" align="center" justify="center">
          <img class="circle" src="/img/baby.gif" alt="Hungry being" />
        </v-row>
        <v-row class="max-width py-6" align="center" justify="center">
          <h1>Make him a recipe</h1>
        </v-row>
        <v-row class="max-width" align="center" justify="center">
          <v-stepper v-model="e3">
            <v-stepper-header>
              <v-stepper-step :complete="e3 > 1" step="1">
                Select your ingredients
              </v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step :complete="e3 > 2" step="2">
                Name your recipe
              </v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step :complete="e3 > 3" step="3">
                Add it to your cart
              </v-stepper-step>
            </v-stepper-header>
            <v-stepper-items>
            <v-stepper-content step="1">
                <AvailableIngredients
                v-if="available.length"
                @named="setRecipeName"
                @selected="select"
                :ingredients="available"
              />
              <v-btn color="primary" @click="e3 = 2"> Continue </v-btn>
              <v-btn text> Cancel </v-btn>
            </v-stepper-content>
            <v-stepper-content step="2">
              <v-btn color="primary" @click="e3 = 3"> Continue </v-btn>

              <v-btn text> Cancel </v-btn>
            </v-stepper-content>
            <!-- TODO Remove @removed -->
            <v-stepper-content step="3">
                <SelectedIngredients
                v-if="selected.length"
                :ingredients="selected"
                :recipeName="recipeName"
                @removed="remove"
              />
            </v-stepper-content>
            </v-stepper-items>
          </v-stepper>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import axios from "axios";

import AvailableIngredients from "./AvailableIngredients";
import SelectedIngredients from "./SelectedIngredients";

import { mutateItem } from "../utils";

export default {
  components: {
    AvailableIngredients,
    SelectedIngredients,
  },
  data() {
    return {
      allIngredients: [],
      e3: 1,
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
</script>
<style>
.app {
  font-family: "Dosis", sans-serif;
}
.circle {
  border-radius: 100%;
}
</style>
