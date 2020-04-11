<template>
    <v-list dense>
         <router-link to="/">
        <v-list-item link>
            <v-list-item-action>
                <v-icon>mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Home</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
         </router-link>
        <router-link to="/page1">
        <v-list-item link>

            <v-list-item-action>
                <v-icon>mdi-contact-mail</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Contact</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        </router-link>
    </v-list>
</template>

<script>
export default {};
</script>

<style></style>
