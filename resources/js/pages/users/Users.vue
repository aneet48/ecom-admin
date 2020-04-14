<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Users">
      <v-btn class="ma-2 action-btn" color="teal accent-4" dark to="/users/create">
        <v-icon class="app-bar-icon">mdi-plus</v-icon>Add New
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
  },

};
</script>

<style>
.action-btn:hover{
    text-decoration: none;
}
</style>
