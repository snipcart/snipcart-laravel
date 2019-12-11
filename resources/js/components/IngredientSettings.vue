<template>
    <v-list-item>
        <v-list-item-content>
        <v-list-item-title>{{ingredient.name}}</v-list-item-title>
        <v-list-item-subtitle v-if="ingredient.description">
            <v-slider v-model="quantity"
                :min="0" :max="10" :step="0.01"
                @change="$emit('quantity', {id: ingredient.id, qnt: $event})">
            </v-slider>
        </v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action @click="$emit('removed', ingredient.id)">
        <v-icon>mdi-minus-circle</v-icon>
        </v-list-item-action>
    </v-list-item>
</template>
<script>
export default {
    props: {
        ingredient: Object,
    },
    data() {
        return {
            quantity: 5,
        };
    },
}
</script>