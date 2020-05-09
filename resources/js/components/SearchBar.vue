<template>
  <!-- <v-col cols="12" :lg="3" :md="4" :sm="4"> -->
  <v-text-field
    class="page-searchbar"
    hide-details
    placeholder="Type your search here.."
    append-icon="search"
    single-line
    v-model="search"
  ></v-text-field>
  <!-- </v-col> -->
</template>

<script>
export default {
  data() {
    return {
      search: "",
      timeout: ""
    };
  },
  watch: {
    search(val) {
      clearTimeout(this.timeout);

      var self = this;
      this.timeout = setTimeout(function() {
        self.handleSearch(val);
      }, 1000);
    }
  },
  methods: {
    handleSearch(val) {
      this.$emit("handleSearch", val);
    }
  }
};
</script>

<style>
</style>
