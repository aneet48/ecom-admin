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
              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                required
                :disabled="emailDisabled"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field v-model="phonenumber" :rules="nameRules" label="Phone Number" required></v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" md="6">
              <v-autocomplete
                label="University"
                :items="universities"
                item-text="name"
                item-value="id"
                return-object
                v-model="m_uni"
                :loading="isuniLoading"
                :rules="uniRules"
                :search-input.sync="searchUni"
              ></v-autocomplete>
            </v-col>
            <!-- <v-col cols="12" md="4">
              <v-select v-model="select" :items="items" label="College" required></v-select>
            </v-col>-->
            <v-col cols="12" md="6">
              <v-text-field v-model="m_branch" :rules="nameRules" label="Branch"></v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" md="6">
              <v-text-field v-model="m_city" :rules="nameRules" label="City" disabled></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field v-model="m_state" :rules="nameRules" label="State" disabled></v-text-field>
            </v-col>
          </v-row>
          <v-list v-if="errors.length" dense class="error-text">
            <v-subheader>Please look at these errors:</v-subheader>
            <v-list-item-group>
              <v-list-item v-for="(item, i) in errors" :key="i">
                <v-list-item-content>
                  <v-list-item-title v-html="item"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
          </v-list>
          <v-row>
            <v-col cols="12" md="4">
              <v-btn color="error" class="mr-4" @click="submit">Submit</v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-card>
    </v-container>

    <v-snackbar v-model="snackbar" :color="snackbarColor" :timeout="5000" :multi-line="multiLine">
      {{snackbarText}}
      <v-btn dark text @click="snackbar = false">Close</v-btn>
    </v-snackbar>

    <v-overlay :value="overlay">
      <v-progress-circular indeterminate color="teal"></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
import BreadCrumb from "../../components/BreadCrumb";
import PageHeader from "../../components/PageHeader";

export default {
  data: () => ({
    emailDisabled: false,
    valid: false,
    firstname: "",
    lastname: "",
    phonenumber: "",
    select: "",
    password: "",
    nameRules: [
      v => !!v || "Required"
      //   v => v.length <= 10 || " must be less than 10 characters"
    ],
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+/.test(v) || "E-mail must be valid"
    ],
    universities: [],
    m_uni: { name: "", id: "" },
    isuniLoading: false,
    uniRules: [
      v => !!v || "Required"
      //   v => v.length <= 10 || " must be less than 10 characters"
    ],
    searchUni: "",
    timeout: null,
    snackbar: false,
    snackbarText: "",
    overlay: true,
    snackbarColor: "info",
    items: [],
    multiLine: true,
    m_city: "",
    m_state: "",
    errors: [],
    form_type: "",
    user_id: "",
    m_branch: ""
  }),

  mounted() {
    this.form_type =
      this.$router.currentRoute.name == "Edit User" ? "edit" : "create";
    if (this.form_type == "edit") {
      let id = this.$router.currentRoute.params.id;
      this.user_id = id;
      this.fetchUser(id);
    } else {
      this.overlay = false;
    }
  },

  watch: {
    m_uni: function(val) {
      if (val && val.city) {
        this.m_city = val.city.name;
        this.m_state = val.city.state.name;
      }
    },
    searchUni: function(val) {
      clearTimeout(this.timeout);

      var self = this;
      this.timeout = setTimeout(function() {
        self.isuniLoading = true;
        self.fetchuni(val);
      }, 1000);
    }
  },
  methods: {
    submit() {
      let isValid = this.$refs.form.validate();
      if (!isValid) return;
      this.overlay = true;
      let url = this.form_type == "edit" ? `update/${this.user_id}` : "sign-up";
      axios
        .post(`api/user/${url}`, {
          first_name: this.firstname,
          last_name: this.lastname,
          phone_number: this.phonenumber,
          email: this.email,
          password: this.password,
          university_id: this.m_uni.id,
          branch: this.m_branch
          // university_id:this.university_id
        })
        .then(res => {
          let data = res.data;
          this.overlay = false;

          if (data.error && data.msg) {
            this.errors = data.msg;
          } else {
            this.snackbarColor = "success";

            this.snackbarText = data.msg;
            this.snackbar = true;
            this.$router.push({ name: "Users" });
          }
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },
    fetchuni(val) {
      axios
        .get("/api/universities/search/" + val)
        .then(res => {
          this.universities = res.data.data;
          this.isuniLoading = false;
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },
    unknownError() {
      this.overlay = false;
      this.snackbarText =
        "Oops!! There was some error. Please try again later or report ";
      this.snackbar = true;
      this.snackbarColor = "red";
    },
    fetchUser(id) {
      axios
        .get("/api/user/" + id)
        .then(res => {
          let data = res.data;
          this.firstname = data.first_name;
          this.lastname = data.last_name;
          this.phonenumber = data.phone_number;
          this.email = data.email;
          this.emailDisabled = true;
          (this.m_uni = { name: data.university.name, id: data.university.id }),
            (this.universities = [this.m_uni]);
          this.m_city = data.university.city.name;
          this.m_state = data.university.city.state.name;
          this.m_branch = data.branch;
          this.overlay = false;
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
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
