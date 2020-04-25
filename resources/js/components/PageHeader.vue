<template>
  <v-container fluid class="mb-4">
    <v-card outlined class="py-2">
      <v-toolbar flat>
        <v-toolbar-title class="heading">{{title}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <div>
          <slot></slot>
        </div>
      </v-toolbar>
    </v-card>
  </v-container>
</template>

<script>
export default {
  props: ["title"]
};
</script>

<style scoped>
.heading {
  color: #363636;
  font-weight: 600;
  line-height: 1.125;
  font-size: 30px;
}
</style>
