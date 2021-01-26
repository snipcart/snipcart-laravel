<template>
    <v-list-item>
        <v-list-item-content>
        <v-list-item-title>{{ingredient.name}}</v-list-item-title>
        </v-list-item-content>
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
