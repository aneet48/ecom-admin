<template>
  <div>
    <BreadCrumb />
     <PageHeader title="Users">
      <v-btn class="ma-2 action-btn" color="teal accent-4" dark to="/users/create">
        <v-icon class="app-bar-icon">mdi-plus</v-icon>Add New
      </v-btn>
    </PageHeader>
    <v-container>
      <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader>

      <v-simple-table v-if="!loader">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Name</th>
              <th class="text-left">University</th>
              <th class="text-left">Email</th>
              <th class="text-left"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item , i) in posts" :key="i">
              <td>{{ item.first_name }}</td>
              <td>{{ item.university ?item.university.name:'' }}</td>
              <td>{{ item.email }}</td>

              <td class="text-right">
                <v-row class="d-none d-sm-block">
                  <v-btn fab dark x-small color="teal accent-4" @click="edituser(item)">
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
                      <v-list-item @click="edituser(item)">
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



    <div class="text-center" v-if="currentPage && TotalPages">
      <v-pagination v-model="currentPage" :length="TotalPages" :total-visible="totalVisible"></v-pagination>
    </div>

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
      modal_title: "Add New user",
      currentPage: 1,
      TotalPages: 0,
      totalVisible: 15,
      m_name: "",
      m_type: "add",
      valid: false,
      nameRules: [v => !!v || "Name is required"],
      stateRules: [v => !!v || "State is required"],
      snackbar: false,
      snackbarText: "",
      multiLine: true,
      errors: [],
      overlay: false,
      editItem: {},
      snackbarColor: "info",
      m_active: false,
      states: [],
      isStatesLoading: true,
      search: "",
      clubs: [
        { id: 1, name: "chelsea", test: "1" },
        { id: 2, name: "mu", test: "1" },
        { id: 3, name: "arsenal", test: "1" }
      ],
      m_state: { id: null, name: null }
    };
  },
  components: {
    BreadCrumb,
    PageHeader
  },
  mounted() {
    this.loader = true;
    this.fetchusers();
    this.fetchStates();
  },
  watch: {
    currentPage: function(val) {
      //do something when the data changes.
      if (val) {
        this.loader = true;
        this.fetchusers();
      }
    }
  },
  methods: {
    addNew() {
      this.modal_title = "Add New user";
      this.m_type = "add";
      this.dialog = true;
    },

    edituser(item) {
          this.$router.push({ path: `users/edit/${item.id}`, params: {item:item} });
    //   //   this.isStatesLoading = true;
    //   this.modal_title = "Edit user";
    //   this.editItem = item;
    //   console.log(item.state_id);
    //   let state_id = item.state_id;
    //   let state = this.states.find(item => item.id == state_id);
    //   this.m_state = { id: state.id, name: state.name };
    //   this.m_name = item.name;
    //   this.m_active = item.active;
    //   this.m_type = "edit";
    //   this.dialog = true;
    },

    deleteItem(item) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff3860",
        // cancelButtonColor: "#fff",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value && item) {
          this.overlay = true;
          axios
            .post(`api/user/delete/${item.id}`)
            .then(res => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchusers();
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
        this.m_type == "edit" ? `api/user/${this.editItem.id}` : "api/user";
      axios({
        method: "post",
        url: api_url,
        data: {
          name: this.m_name,
          active: this.m_active,
          state_id: this.m_state.id
        }
      })
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
            this.fetchusers();
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
      this.isStatesLoading = false;

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

    fetchusers() {
      axios
        .get("/api/users?page=" + this.currentPage)
        .then(res => {
          this.overlay = false;
          this.loader = false;
          this.posts = res.data.data;
          this.TotalPages = res.data.last_page;
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },
    fetchStates() {
      axios
        .get("/api/states/true")
        .then(res => {
          this.states = res.data;
          this.isStatesLoading = false;
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
