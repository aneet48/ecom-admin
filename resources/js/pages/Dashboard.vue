<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app>
            <Sidebar />
        </v-navigation-drawer>

        <v-app-bar app color="white" light dense>
            <div class="d-flex justify-space-between app-bar">
                <v-app-bar-nav-icon @click.stop="drawer = !drawer" />

                <div class="d-flex justify-flex-end">
                    <v-icon class="app-bar-icon">mdi-bell</v-icon>
                    <v-icon class="app-bar-icon">mdi-logout</v-icon>
                </div>
            </div>
        </v-app-bar>

        <v-content>
            <router-view />
        </v-content>
        <!-- <v-footer color="indigo" app>
            <span class="white--text">&copy; 2019</span>
        </v-footer> -->
    </v-app>
</template>

<script>
import Sidebar from "../components/Sidebar";
export default {
    components: {
        Sidebar
    },
    props: {
        source: String
    },
    data: () => ({
        drawer: null
    })
};
</script>

<style  scoped>
.app-bar{
    width: 100%;
}
.app-bar-icon{
  border-left: 1px solid #f5efef;
    padding-left: 18px;
    padding-right: 18px;
    font-size: 18px;
}
</style>
