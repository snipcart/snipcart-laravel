<template>
    <v-col class="max-width" cols="12" sm="4" md="4">
    <v-list class="max-width" two-line>
        <!-- TODO make multi columns lists -->
      <v-subheader :inset="inset">Select your ingredients</v-subheader>
      <v-divider></v-divider>
      <v-list-group v-for="category in categories" :key="category" color="primary">
        <template v-slot:activator>
            <v-list-item-title class="font-weight-medium">{{category}}</v-list-item-title>
        </template>
        <v-list-item class="max-width" v-for="ingredient in ingredientsByCategory[category]"
          :key="ingredient.id"
          @click="select(ingredient.id)"
        >
          <v-list-item-content>
            <v-list-item-action>
                <v-checkbox color="primary" :label="ingredient.name"></v-checkbox>
            </v-list-item-action>
            <v-list-item-subtitle v-if="ingredient.description">
                {{ingredient.description}}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>
    </v-list>
    </v-col>
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
