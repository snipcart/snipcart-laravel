<template>
  <!-- TODO remove removed logic -->
  <v-container fluid fill-height>
    <v-row lg align="center" justify="center">
      <v-lazy>
        <img class="product" src="img/Logo.svg" />
      </v-lazy>
    </v-row>
    <v-row>
      <v-text-field
        label="Name your recipe"
        @keyup="named"
        v-model="recipeName"
      >
      </v-text-field>
    </v-row>
    <v-row>
      <v-select
        :items="['small', 'medium', 'large']"
        label="Select your size"
        @change="sized"
        v-model="size"
      >
      </v-select>
    </v-row>
    <v-row class="my-4">
      <div>
        Price preview: <span class="font-weight-black"> ${{ price }} </span>.
        What a deal for that little guy!
      </div>
    </v-row>
  </v-container>
</template>
<script>
import axios from "axios";

// TODO clear state
export default {
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
    named() {
      this.$emit("named", this.recipeName);
    },
    sized() {
      this.$emit("sized", this.size);
    },
  },
};
</script>
