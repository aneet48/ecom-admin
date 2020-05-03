<template>
  <div>
    <v-overlay value="true">
      <v-progress-circular indeterminate color="teal"></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$store
      .dispatch("login")
      .then(() => {
        this.$router.push({name:'Dashboard'})
      })
      .catch(err => {
        console.log(err);
      });
  }
};
</script>

<style>
</style>
