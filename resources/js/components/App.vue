<template>
    <v-app class="test">
        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
            <v-row class="max-width py-6"
                    align="center"
                    justify="center"
                >
                    <h1> This little being is hungry </h1>
                </v-row>
            <v-row class="max-width py-6"
                    align="center"
                    justify="center"
                >
                    <img class="circle" src="/img/baby.gif" alt="Hungry being" />
                </v-row>
            <v-row class="max-width py-6"
                    align="center"
                    justify="center"
                >
                    <h1> Make him a recipe </h1>
                </v-row>
            <v-row class="max-width"
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="6"
                        md="5"
                    >
                        <p v-if="!selected.length" align="center">
                            Select some ingredients to start building your own oatmeal recipe.
                        </p>
                        <SelectedIngredients
                            v-if="selected.length"
                            :ingredients="selected"
                            @removed="remove" />
                    </v-col>
                    <v-col
                        cols="12"
                        sm="6"
                        md="5"
                    >
                        <AvailableIngredients
                            v-if="available.length"
                            @selected="select"
                            :ingredients="available" />
                    </v-col>
                </v-row>
                <v-row class="max-width"
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="6"
                        md="5"
                    >
                        <p v-if="!selected.length" align="center">
                            Select some ingredients to start building your own oatmeal recipe.
                        </p>
                        <SelectedIngredients
                            v-if="selected.length"
                            :ingredients="selected"
                            @removed="remove" />
                    </v-col>
                    <v-col
                        cols="12"
                        sm="6"
                        md="5"
                    >
                        <AvailableIngredients
                            v-if="available.length"
                            @selected="select"
                            :ingredients="available" />
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>
<script>
import axios from 'axios';

import AvailableIngredients from './AvailableIngredients';
import SelectedIngredients from './SelectedIngredients';

import { mutateItem } from '../utils';

export default {
    components: {
        AvailableIngredients,
        SelectedIngredients,
    },
    data() {
        return {
            allIngredients: [],
        };
    },
    async created() {
        const response = await axios.get('/api/ingredients');
        this.allIngredients = response.data;
    },
    computed: {
        selected() {
            return this.allIngredients.filter(
                x => !!x.selected
            );
        },
        available() {
            return this.allIngredients.filter(
                x => !x.selected
            );
        },
        categories() {
            return Object.keys(this.allIngredients.reduce(
                (x, opts)  => {
                    opts[x.category] = true;
                    return opts;
                },
                {},
            ));
        },
    },
    methods:{
        select(id) {
            const items = this.allIngredients;
            mutateItem(items,
                (x) => x.id === id,
                (x) => ({
                    ...x,
                    selected: true,
                    // reset
                    quantity: 5,
                }));
        },
        remove(id) {
            const items = this.allIngredients;
            mutateItem(items,
                (x) => x.id === id,
                (x) => ({
                    ...x,
                    selected: false,
                }));
        },
        quantity(data) {
            mutateItemId(this.allIngredients, data.id, x => ({
                    ...x,
                    quantity: data.qnt,
                }));
        }
    },
};
</script>
<style>
.test {
    font-family: 'Dosis', sans-serif;
}
.circle {
    border-radius: 100%;
}
</style>
