<template>
  <v-list class="max-width" two-line>
    <v-list-item>
      <!-- TODO: validate we want a keyup event here and not something else -->
      <v-text-field label="Name your recipe" @keyup="setRecipeName" v-model="recipeName">
      </v-text-field>
    </v-list-item>
  </v-list>
</template>
<script>
export default {
  data() {
    return {
      recipeName: "",
    };
  },
  methods: {
    setRecipeName() {
      console.warn(`Setting recipe name to ${this.recipeName}`);
      this.$emit("named", this.recipeName);
    },
  },
};
</script>
