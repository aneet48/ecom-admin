<template>
  <v-app id="dashboard">
   <div v-if="this.$router.currentRoute.name != 'Login Redirect'">
        <v-navigation-drawer v-model="drawer" app class="drawer">
      <Sidebar />
    </v-navigation-drawer>

    <v-app-bar app color="white" light dense elevation="1">
      <div class="d-flex justify-space-between app-bar">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />

        <div class="d-flex justify-flex-end">
          <v-icon class="app-bar-icon">mdi-bell</v-icon>
          <v-icon class="app-bar-icon" link @click="logout">mdi-logout</v-icon>
        </div>
      </div>
    </v-app-bar>
   </div>

    <v-content class="dashboard-content-wrapper">
      <router-view />
    </v-content>
    <!-- <v-footer color="indigo" app>
            <span class="white--text">&copy; 2019</span>
    </v-footer>-->
  </v-app>
</template>

<script>
import Sidebar from "./components/Sidebar";
import store from "./store";

export default {
  components: {
    Sidebar
  },
  props: {
    source: String
  },
  data: () => ({
    drawer: null
  }),
  methods: {
    logout() {
      this.$store.dispatch("logout");
    }
  }
};
</script>

<style scoped>
.app-bar {
  width: 100%;
}
.app-bar-icon {
  border-left: 1px solid #f5efef;
  padding-left: 18px;
  padding-right: 18px;
  font-size: 18px;
}
#dashboard {
  background-color: #f8f8f8;
  font-family: Nunito, sans-serif;
}
.drawer {
  background: #2e323a;
}
</style>

<style >
.theme--light.v-data-table thead th {
  color: black !important;
}
.theme--light.v-data-table thead tr th {
  font-size: 16px;
}
.gray-dot {
  background: #bebbbb;
  height: 10px;
  width: 10px;
  border-radius: 50%;
}
.green-dot {
  background: green;
  height: 10px;
  width: 10px;
  border-radius: 50%;
}
.dashboard-content-wrapper .v-content__wrap{
  padding: 0 1rem 1rem;
}
</style>
