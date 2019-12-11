<template>
    <v-app>
        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row class="max-width"
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="6"
                        md="5"
                    >
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
.max-width {
    max-width: 1024px;
    margin: auto;
}
</style>