<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Products List">
    <v-btn class="ma-2 action-btn" color="teal accent-4" dark @click="addNew">
        <v-icon class="app-bar-icon">mdi-plus</v-icon>Add New
    </v-btn>
    </PageHeader>
    <v-container fluid>
      <v-row>
        <v-col cols="12" :lg="9" :md="8" :sm="8" class="text-right">
        <v-dialog v-model="filterdialog" max-width="500px">
          <v-card class="padding20">
            <v-combobox
              v-model="select"
              :items="items"
              label="Categoires"
              multiple
              clearable
              chips
            >
              <template v-slot:selection="data">
                <v-chip
                  :key="JSON.stringify(data.item)"
                  v-bind="data.attrs"
                  :input-value="data.selected"
                  :disabled="data.disabled"
                  @click:close="data.parent.selectItem(data.item)"
                >
                  <v-avatar
                    class="accent white--text"
                    left
                    v-text="data.item.slice(0, 1).toUpperCase()"
                  ></v-avatar>
                  {{ data.item }}
                </v-chip>
              </template>
            </v-combobox>
            <v-combobox
              v-model="select"
              :items="items"
              label="Subcategoires"
              multiple
              clearable
              chips
            >
              <template v-slot:selection="data">
                <v-chip
                  :key="JSON.stringify(data.item)"
                  v-bind="data.attrs"
                  :input-value="data.selected"
                  :disabled="data.disabled"
                  @click:close="data.parent.selectItem(data.item)"
                >
                  <v-avatar
                    class="accent white--text"
                    left
                    v-text="data.item.slice(0, 1).toUpperCase()"
                  ></v-avatar>
                  {{ data.item }}
                </v-chip>
              </template>
            </v-combobox>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn depressed color="primary" @click="filterdialog = false">Filter</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
          <v-btn depressed color="primary" @click="filterdialog = !filterdialog"> <v-icon class="filterIcon" dark small>shuffle</v-icon> Filter</v-btn>
        </v-col>
        <v-col cols="12" :lg="3" :md="4" :sm="4">
          <v-text-field
            class="page-searchbar"
            hide-details
            placeholder="Type your search here.."
            append-icon="search"
            single-line
          ></v-text-field>
        </v-col>
      </v-row>
    </v-container>
    <v-container fluid>
      <!-- <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader> -->

      <v-simple-table v-if="!loader">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Product</th>
              <th class="text-left">SKU</th>
              <th class="text-left">Amount</th>
              <th class="text-left">Status</th>
              <th class="text-left">Categories</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item , i) in posts" :key="i">
              <td>
                <div class="product">
                  <img class="product__thumbnail" src="https://source.unsplash.com/collection/190727/320x240" alt="">
                  <div class="product__detail">
                    <span class="product__name">
                      This is a  Large Product Name for style testing
                    </span>
                  </div>
                </div>
              </td>
              <td>{{ item.state.name }}</td>
              <td>₹2000</td>
              <td><v-chip class="ma-2 chip" color="teal accent-4">In Processing</v-chip></td>
              <td>{{ item.state.name }},  {{ item.state.name }}, {{ item.state.name }}</td>
              <td class="text-right">
                <div class="d-none d-sm-block">
                  <v-btn fab dark x-small color="teal accent-4" @click="editCity(item)">
                    <v-icon dark small>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn fab dark x-small color="pink" @click="deleteItem(item)">
                    <v-icon dark small>mdi-trash-can</v-icon>
                  </v-btn>
                </div>

                <div class="d-sm-none">
                  <v-menu>
                    <template v-slot:activator="{ on }">
                      <v-btn dark icon v-on="on">
                        <v-icon light>mdi-dots-vertical</v-icon>
                      </v-btn>
                    </template>

                    <v-list>
                      <v-list-item @click="editCity(item)">
                        <v-list-item-title>Edit</v-list-item-title>
                      </v-list-item>
                      <v-list-item @click="deleteItem(item)">
                        <v-list-item-title>Delete</v-list-item-title>
                      </v-list-item>
                    </v-list>
                  </v-menu>
                </div>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </v-container>

    <!-- <v-row justify="center">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-card>
            <v-card-title>
              <span class="headline">{{modal_title}}</span>
            </v-card-title>
            <v-card-text>
              <v-row>
                <v-col cols="12">
                  <v-text-field label="Name*" required v-model="m_name" :rules="nameRules"></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-autocomplete
                    label="State"
                    :items="states"
                    item-text="name"
                    item-value="id"
                    return-object
                    v-model="m_state"
                    :loading="isStatesLoading"
                  ></v-autocomplete>
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
    </v-row> -->

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
    select: [],
    items: [
        'Programming',
        'Design',
        'Vue',
        'Vuetify',
      ],
      posts: [],
      loader: true,
      dialog: false,
      filterdialog: false,
      modal_title: "Add New City",
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
    this.fetchCities();
    this.fetchStates();
  },
  watch: {
    currentPage: function(val) {
      //do something when the data changes.
      if (val) {
        this.loader = true;
        this.fetchCities();
      }
    }
  },
  methods: {
    addNew() {
      this.modal_title = "Add New City";
      this.m_type = "add";
      this.dialog = true;
    },

    editCity(item) {
      //   this.isStatesLoading = true;
      this.modal_title = "Edit City";
      this.editItem = item;
      console.log(item.state_id);
      let state_id = item.state_id;
      let state = this.states.find(item => item.id == state_id);
      this.m_state = { id: state.id, name: state.name };
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
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value && item) {
          this.overlay = true;
          axios
            .post(`api/city/delete/${item.id}`)
            .then(res => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchCities();
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
        this.m_type == "edit" ? `api/city/${this.editItem.id}` : "api/city";
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
            this.fetchCities();
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

    fetchCities() {
      axios
        .get("/api/cities/true?page=" + this.currentPage)
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

.flex{
  display: flex;
  justify-content: space-between;
  align-items: center;
}


</style>
