<template>
  <v-card  v-if="data" dark>
    <v-list-item three-line :style="`background-image: linear-gradient(-143deg, ${data.bgFirstColor},  ${data.bgSecondColor});`">
      <v-list-item-content >
        <div class="headline mb-4"><h4>{{data.title}}</h4></div>
        <v-list-item-title class="headline mb-1"><h2>{{data.amount}}</h2></v-list-item-title>
        <v-list-item-subtitle>{{data.subtitle}}</v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
  </v-card>
</template>

<script>
export default {
  props: ["data"],
};
</script>

<style>
</style>