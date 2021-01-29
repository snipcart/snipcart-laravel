<template>
  <v-card class="max-width" tile>
    <!-- TODO remove removed logic -->
    <v-list three-line>
      <v-list-item>
        <v-text-field
          label="Name your recipe"
          v-model="recipeName"
        >
        </v-text-field>
      </v-list-item>
      <v-list-item>
        <v-select
          :items="['small', 'medium', 'large']"
          label="Select your size"
          v-model="size"
        >
        </v-select>
      </v-list-item>
      <v-list-item @click="buy">
        <v-list-item-action>
          <v-icon>mdi-cart-plus</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Add to cart</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>
<script>
import axios from "axios";

import IngredientSettings from "./IngredientSettings";

// TODO clear state
export default {
  components: {
    IngredientSettings,
  },
  data() {
    return {
      recipeName: "",
      size: "small",
    };
  },
  props: {
    ingredients: Array,
  },
  asyncComputed: {
    async price() {
      const payload = {
        size: this.size,
        items: this.ingredients.map((x) => ({
          id: x.id,
          quantity: x.quantity,
        })),
      };
      const response = await axios.post("/api/recipes/preview", payload);
      return response.data.price;
    },
  },
  methods: {
    async buy() {
      const payload = {
        name: this.recipeName,
        size: this.size,
        items: this.ingredients.map((x) => ({
          id: x.id,
          quantity: x.quantity,
        })),
      };
      const response = await axios.post("/api/recipes", payload);
      const host = window.location.protocol + "//" + window.location.host;
      Snipcart.api.cart.items.add({
        ...response.data,
        // reset state
        url: host + response.data.url,
      });
    },
  },
};
</script>
