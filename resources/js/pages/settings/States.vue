<template>
  <div>
    <BreadCrumb />
    <PageHeader title="States">
      <v-btn class="ma-2 action-btn" color="teal accent-4" dark @click="addNew">
        <v-icon class="app-bar-icon">mdi-plus</v-icon>Add New
      </v-btn>
    </PageHeader>
    <v-container>
      <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader>

      <v-simple-table v-if="!loader">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">#</th>
              <th class="text-left">Code</th>
              <th class="text-left">Name</th>
              <th class="text-left">Active</th>
              <th class="text-left"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item , i) in posts" :key="item.code">
              <td>{{i+1}}</td>
              <td>{{ item.code }}</td>
              <td>{{ item.name }}</td>
              <td>
                <div class="green-dot" v-if="item.active"></div>
                <div class="gray-dot" v-if="!item.active"></div>
              </td>
              <td class="text-right">
                <v-row class="d-none d-sm-block">
                  <v-btn fab dark x-small color="teal accent-4" @click="editState(item)">
                    <v-icon dark small>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn fab dark x-small color="pink" @click="deleteItem(item)">
                    <v-icon dark small>mdi-trash-can</v-icon>
                  </v-btn>
                </v-row>

                <v-row class="d-sm-none">
                  <v-menu>
                    <template v-slot:activator="{ on }">
                      <v-btn dark icon v-on="on">
                        <v-icon light>mdi-dots-vertical</v-icon>
                      </v-btn>
                    </template>

                    <v-list>
                      <v-list-item @click="editState(item)">
                        <v-list-item-title>Edit</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="deleteItem(item)">
                        <v-list-item-title>Delete</v-list-item-title>
                      </v-list-item>
                    </v-list>
                  </v-menu>
                </v-row>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-container>

    <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-card>
            <v-card-title>
              <span class="headline">{{modal_title}}</span>
            </v-card-title>
            <v-card-text>
              <v-row>
                <v-col cols="12">
                  <v-text-field label="Code*" required v-model="m_code" :rules="codeRules"></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field label="Name*" required v-model="m_name" :rules="nameRules"></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-checkbox v-model="m_active" label="Activate"></v-checkbox>
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
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn light color="white " @click="closeDialog">Close</v-btn>
              <v-btn dark color="pink " @click="saveDialog">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
    </v-row>

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
  data() {
    return {
      posts: [],
      loader: true,
      dialog: false,
      modal_title: "Add New State",
      m_code: "",
      m_name: "",
      m_type: "add",
      valid: false,
      codeRules: [v => !!v || "Code is required"],
      nameRules: [v => !!v || "Name is required"],
      snackbar: false,
      snackbarText: "",
      multiLine: true,
      errors: [],
      overlay: false,
      editItem: {},
      snackbarColor: "info",
      m_active: false
    };
  },
  components: {
    BreadCrumb,
    PageHeader
  },
  mounted() {
    this.loader = true;
    this.fetchStates();
  },
  methods: {
    addNew() {
      this.modal_title = "Add New State";
      this.m_type = "add";
      this.dialog = true;
    },

    editState(item) {
      this.modal_title = "Edit State";
      this.editItem = item;
      this.m_code = item.code;
      this.m_name = item.name;
      this.m_active = item.active;
      this.m_type = "edit";
      this.dialog = true;
    },

    deleteItem(item) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff3860",
        // cancelButtonColor: "#fff",
        confirmButtonText: "Yes, delete it!",
      }).then(result => {
        if (result.value && item) {
          this.overlay = true;
          axios
            .post(`api/state/delete/${item.id}`)
            .then(res => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchStates();
              }
            })
            .catch(err => {
              this.unknownError();
              console.log(err);
            });
        }
      });
    },

    saveDialog() {
      this.errors = [];
      let is_valid = this.$refs.form.validate();
      if (!is_valid) return;

      let api_url =
        this.m_type == "edit" ? `api/state/${this.editItem.id}` : "api/state";
      axios({
        method: "post",
        url: api_url,
        data: {
          code: this.m_code,
          name: this.m_name,
          active: this.m_active
        }
      })
        // .post("api/state")
        .then(res => {
          let data = res.data;
          if (data.error && data.msg) {
            this.errors = data.msg;
          } else {
            this.overlay = true;
            this.snackbarColor = "success";

            this.snackbarText = data.msg;
            this.snackbar = true;
            this.closeDialog();
            this.fetchStates();
          }
        })
        .catch(err => {
          this.unknownError();

          console.log(err);
        });
    },

    closeDialog() {
      this.resetValidation();
      this.resetForm();
      this.dialog = false;
      this.m_active = false;
      this.editItem = {};
      this.errors = [];
    },

    resetForm() {
      this.$refs.form.reset();
    },

    resetValidation() {
      this.$refs.form.resetValidation();
    },

    fetchStates() {
      axios
        .get("/api/states/true")
        .then(res => {
          this.overlay = false;
          this.loader = false;
          this.posts = res.data;
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
    }
  }
};
</script>

<style>
.action-btn:hover {
  text-decoration: none;
}
.error-text
  .theme--light.v-list-item:not(.v-list-item--active):not(.v-list-item--disabled) {
  color: red !important;
}
</style>
