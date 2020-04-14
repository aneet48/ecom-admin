<template>
    <v-list class="p-0 m-0 sidebar-nav">
        <v-list-item class="logo-bar">
            <v-list-item-content>
                <span class="logo-title">LOGO</span>
            </v-list-item-content>
        </v-list-item>
        <div v-for="item in menus" :key="item.id">
            <v-subheader class="subheader" v-if="item.type == 'subheader'">{{
                item.title
            }}</v-subheader>
            <v-list-item
                v-if="item.type != 'subheader'"
                link
                :to="item.link"
            >
                <v-list-item-action class="mr-3">
                    <v-icon size="18">mdi-{{item.icon}}</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </div>
    </v-list>
</template>

<script>
import menus from "../utils/sidebar_menu";
export default {
    data() {
        return {
            menus
        };
    },
    mounted: () => {
    }
};
</script>

<style>
.sidebar-nav .logo-bar {
    background: #000000;
}
.logo-title {
    color: #ffffff;
    font-weight: bold;
}
.sidebar-nav .subheader {
    font-size: 12px;
    color: #727c8f;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}
.sidebar-nav
    .theme--light.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled),
.theme--light.v-icon {
    color: #727c8f !important;
}
.sidebar-nav .v-list-item:hover,
.sidebar-nav .v-list-item--active {
    background-color: #0d0d0d;
    color: #fff !important;
    transition: all 0.5s;
}
.sidebar-nav .v-list-item--active .theme--light.v-icon {
    color: #fff !important;
}
.sidebar-nav a:hover {
    text-decoration: none;
}
</style>
