<template>
  <v-container fluid class="mb-4">
    <v-card outlined class="py-2">
      <div v-for="(item , i) in data" :key="i">
        <v-row>
          <v-col cols="12" md="12">
            <v-text-field
              v-model="firstname"
              :rules="nameRules"
              :counter="10"
              label="First name"
              required
            ></v-text-field>
          </v-col>
          <v-btn dark color="pink " @click="saveSetting">Save</v-btn>
        </v-row>
      </div>
    </v-card>
  </v-container>
</template>

<script>
export default {
  props: ["data", "group"],
  methods: {
    saveSetting() {
        console.log(this)
    },
  },
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
