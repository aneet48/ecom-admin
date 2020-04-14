<template>
  <v-container>
    <v-row align="center" justify="center">
      <v-col class="text-center">
        <v-card class="text-center" outlined>
          <img :src="image" class="img" />
          <p class="display-1">Coming Soon !</p>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      image: "images/cat_play.svg"
    };
  }
};
</script>

<style scoped>
.img {
  height: 200px;
  margin: 40px 0;
}
</style>
