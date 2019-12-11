<template>
    <v-card
    class="mx-auto"
    max-width="300"
    tile
  >
    <v-list three-line>
      <v-subheader>Available Ingredients</v-subheader>
      <v-list-group v-for="category in categories" :key="category" color="primary">
        <template v-slot:activator>
            <v-list-item-title>{{category}}</v-list-item-title>
        </template>
        <v-list-item v-for="ingredient in ingredientsByCategory[category]"
          :key="ingredient.id"
          @click="select(ingredient.id)"
        >
          <v-list-item-content>
            <v-list-item-title>{{ingredient.name}}</v-list-item-title>
            <v-list-item-subtitle v-if="ingredient.description">
                {{ingredient.description}}
            </v-list-item-subtitle>
          </v-list-item-content>
          <v-list-item-action>
            <v-icon>mdi-plus-circle</v-icon>
          </v-list-item-action>
        </v-list-item>
      </v-list-group>
    </v-list>
  </v-card>
</template>
<script>
export default {
    props: {
        ingredients: Array,
    },
    computed: {
        categories() {
            return Object.keys(this.ingredients.reduce(
                (dict, x)  => {
                    dict[x.category] = true;
                    return dict;
                },
                {},
            ));
        },
        ingredientsByCategory() {
            return this.ingredients.reduce(
                (dict, x)  => {
                    if(!dict[x.category]) {
                        dict[x.category] = [];
                    }
                    dict[x.category].push(x);
                    return dict;
                },
                {},
            );
        }
    },
    methods: {
        select(id) {
            console.warn(`Selecting ${id} from availables`)
            this.$emit('selected', id);
        }
    }
}
</script>