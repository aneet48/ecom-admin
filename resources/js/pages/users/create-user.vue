<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Add User Form">
      <v-btn class="ma-2 action-btn" color="teal accent-4" dark to="/users">
        <v-icon class="app-bar-icon">mdi-arrow-left</v-icon>Back
      </v-btn>
    </PageHeader>
  </div>
</template>

<script>
import BreadCrumb from "../../components/BreadCrumb";
import PageHeader from "../../components/PageHeader";

export default {
  components: {
    BreadCrumb,
    PageHeader
  }
};
</script>

<style>
</style>
