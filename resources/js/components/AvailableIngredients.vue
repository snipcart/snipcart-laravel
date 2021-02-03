<template>
  <v-container fluid fill-height>
    <v-container
      v-for="category in categories"
      :key="category"
      color="primary"
      fluid
    >
      <v-row class="mb-1"
        ><h3 class="font-weight-bold"> {{ category | titleize }}</h3></v-row
      >
      <v-row class="mb-4"><v-divider></v-divider></v-row>
      <v-row class="custom-grid" no-gutters>
        <v-col
          justify="space-around"
          v-for="ingredient in ingredientsByCategory[category]"
          :key="ingredient.id"
        >
          <v-checkbox
            color="primary"
            :label="ingredient.name"
            @change="toggle(ingredient.id)"
            cols="4"
            :value="ingredient.id"
            v-model="selectedIngredients"
          ></v-checkbox>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>
<style scoped>
.custom-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, 184px);
  grid-gap: 1% 1%;
  margin: 0 0 0 2%;
  align-items: center;
  justify-items: flex-start;
  width: 100%;
}
</style>
<script>
export default {
  data() {
    return {
      recipeName: "",
      selectedIngredients: [],
    };
  },
  props: {
    ingredients: Array,
  },
  computed: {
    categories() {
      return Object.keys(
        this.ingredients.reduce((dict, x) => {
          dict[x.category] = true;
          return dict;
        }, {})
      );
    },
    ingredientsByCategory() {
      return this.ingredients.reduce((dict, x) => {
        if (!dict[x.category]) {
          dict[x.category] = [];
        }
        dict[x.category].push(x);
        return dict;
      }, {});
    },
  },
  methods: {
    ingredientIsSelected(id) {
      return this.selectedIngredients.find((i) => i === id);
    },
    select(id) {
      console.warn(`Selecting ${id}`);
      this.$emit("selected", id);
    },
    unselect(id) {
      console.warn(`Unselecting ${id}`);
      this.$emit("removed", id);
    },
    toggle(id) {
      //TODO refactor if condition loop in separate method
      if (this.ingredientIsSelected) {
        this.select(id);
      } else {
        this.unselect(id);
      }
    },

    // main TODO s
    // Refactor components
    // Implement pictures
    // Improve styling
  },
};
</script>
