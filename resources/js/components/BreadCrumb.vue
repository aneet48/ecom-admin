<template>
  <v-container fluid class="admin-breadcrumb">
    <v-breadcrumbs :items="items"></v-breadcrumbs>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {
          text: "Admin",
          disabled: false,
          href: "/"
        }
      ]
    };
  },
  mounted: function() {
    let breadcrumb = this.items;
    breadcrumb.push({
      text: this.$route.name,
      disabled: false,
      href: this.$route.currentRoute
    });
  }
};
</script>

<style>
.admin-breadcrumb .v-breadcrumbs li .v-breadcrumbs__item {
  color: #7a7a7a;
  font-size: 22px;
}
.admin-breadcrumb .v-breadcrumbs li:last-child .v-breadcrumbs__item {
  font-weight: 700;
  color: #242424;
}
</style>
