<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Add New User Form">
      <v-btn class="ma-2 action-btn" color="teal accent-4" dark to="/users">
        <v-icon class="app-bar-icon">mdi-arrow-left</v-icon>Back
      </v-btn>
    </PageHeader>
    <v-container>
      <v-card class="mx-auto px-10 mb-5" outlined>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field v-model="firstname" :rules="nameRules" label="First name" required></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
              <v-text-field v-model="lastname" :rules="nameRules" label="Last name" required></v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" md="6">
              <v-text-field v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field v-model="phonenumber" :rules="nameRules" label="Phone Number" required></v-text-field>
            </v-col>
          </v-row>

          <v-row>
             <v-col cols="12" md="4">
              <v-select v-model="select" :items="items" label="University" required></v-select>
            </v-col>
             <v-col cols="12" md="4">
              <v-select v-model="select" :items="items" label="College" required></v-select>
            </v-col>
             <v-col cols="12" md="4">
              <v-select v-model="select" :items="items" label="Branch" required></v-select>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" md="6">
              <v-text-field v-model="email" :rules="emailRules" label="City" required></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-select v-model="select" :items="items" label="State" required></v-select>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4">
              <v-btn color="error" class="mr-4" @click="submit">Submit</v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-card>
    </v-container>
  </div>
</template>

<script>
import BreadCrumb from "../../components/BreadCrumb";
import PageHeader from "../../components/PageHeader";

export default {
  data: () => ({
    valid: false,
    firstname: "",
    lastname: "",
    phonenumber: "",
    select: "",
    nameRules: [
      v => !!v || "Name is required",
      v => v.length <= 10 || "Name must be less than 10 characters"
    ],
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+/.test(v) || "E-mail must be valid"
    ],
    items: ["Item 1", "Item 2", "Item 3", "Item 4"]
  }),
  methods: {
    submit() {
      console.log(this.$refs.form.validate());
    }
  },
  components: {
    BreadCrumb,
    PageHeader
  }
};
</script>

<style>
</style>
