<template>
    <v-card
    class="mx-auto"
    max-width="300"
    tile
  >
  <!-- TODO remove removed logic -->
    <v-list three-line>
        <v-subheader>Your Recipe Summary</v-subheader>
        <IngredientSettings
            v-for="ingredient in ingredients"
            :key="ingredient.id"
            :ingredient="ingredient"
            @quantity="$emit('quantity', $event)"
            @removed="$emit('removed', $event)">
        </IngredientSettings>
        <v-list-item>
            <v-text-field
                label="Name"
                v-model="name">
            </v-text-field>
        </v-list-item>
        <v-list-item>
            <v-select
                :items="['small', 'medium', 'large']"
                label="Size"
                v-model="size">
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
        <v-subheader>Select Each Ingredients' ratio</v-subheader>
    </v-list>
  </v-card>
</template>
<script>
import axios from 'axios';

import IngredientSettings from './IngredientSettings';

export default {
    components: {
        IngredientSettings
    },
    data() {
        return {
            size: 'small',
            name: '',
        };
    },
    props: {
        ingredients: Array,
    },
    asyncComputed: {
        async price() {
            const payload = {
                size: this.size,
                items: this.ingredients.map(x => ({
                    id: x.id,
                    quantity: x.quantity,
                })),
            };
            const response = await axios.post('/api/recipes/preview', payload);
            return response.data.price;
        },
    },
    methods: {
        async buy() {
            const payload = {
                name: this.name,
                size: this.size,
                items: this.ingredients.map(x => ({
                    id: x.id,
                    quantity: x.quantity,
                })),
            };
            const response = await axios.post('/api/recipes', payload);
            const host = window.location.protocol+'//'+window.location.host;
            Snipcart.api.cart.items.add({
                ...response.data,
                url: host+response.data.url,
            });
        }
    }
}
</script>
