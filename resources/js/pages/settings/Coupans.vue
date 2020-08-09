<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Coupan Codes">
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
              <th class="text-left">Code</th>
              <th class="text-left">No of user can use</th>
              <th class="text-left">Expiry Date</th>
              <th class="text-left">Amount</th>
              <th class="text-left"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item , i) in posts" :key="i">
              <td>{{ item.code }}</td>
              <td>{{ item.users_can_use }}</td>
              <td>{{ item.expiry_date }}</td>
              <td>{{ item.amount }}</td>
              <td class="text-right">
                <v-row class="d-none d-sm-block">
                  <v-btn fab dark x-small color="teal accent-4" @click="editCoupan(item)">
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
                      <v-list-item @click="editCoupan(item)">
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
                  <v-text-field label="Code*" required v-model="m_code" :rules="codeRules" oninput="if(Number(this.m_code) > Number(this.m_code_max)) this.value = this.m_code_max;"></v-text-field>
                </v-col>            
                <v-col cols="12">
                  <v-text-field label="Amount*"   type="number" required v-model="m_amount" :rules="amountRules"></v-text-field>
                </v-col>
                 <v-col cols="12">
                <v-text-field label="Users Limit*"   type="number" required v-model="m_users_can_use" :rules="usersRules"></v-text-field>
                </v-col>
                 <v-col cols="12">
                      <v-date-picker v-model="m_expiry_date" ></v-date-picker>
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
      modal_title: "Add New Coupan",
      currentPage: 1,
      TotalPages: 0,
      totalVisible: 15,
      m_code: "",
      m_expiry_date: "",
      m_amount: "",
      m_users_can_use: "",
      m_type: "add",
      valid: false,
      codeRules: [v => !!v || "Code is required",
      v => v.length < 7 || "Code must be 6 characters long"
      ],      
      amountRules: [v => !!v || "Amount is required",
      v => v < 101 || "Amount not exceed from 100%"
      ],
      expirydateRules: [v => !!v || "Expiry Date is required"],
      usersRules: [v => !!v || "Uesr limit is required"],
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
      m_code_max:6
    };
  },
  components: {
    BreadCrumb,
    PageHeader
  },
  mounted() {
    this.loader = true;
    this.fetchCoupans();
  },
  watch: {
    currentPage: function(val) {
      //do something when the data changes.
      if (val) {
        this.loader = true;
        this.fetchCoupans();
      }
    }
  },
  methods: {
    addNew() {
      this.modal_title = "Add New Coupan";
      this.m_type = "add";
      this.m_code = '';
      this.m_expiry_date = '';
      this.m_amount = '';
      this.m_users_can_use = '';
      this.dialog = true;
    },

    editCoupan(item) {
      //   this.isStatesLoading = true;
     
      this.modal_title = "Edit Coupan";
      this.editItem = item;
      console.log(item);
      this.m_code = item.code;
      this.m_amount = item.amount;
      this.m_expiry_date = item.expiry_date;
      this.m_users_can_use = item.users_can_use;
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
            .post(`api/coupan/delete/${item.id}`)
            .then(res => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchCoupans();
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
        this.m_type == "edit" ? `api/coupan/${this.editItem.id}` : "api/coupan";
      axios({
        method: "post",
        url: api_url,
        data: {
          code:this.m_code,
          expiry_date:this.m_expiry_date,
          users_can_use:this.m_users_can_use,
          amount:this.m_amount,
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
            this.fetchCoupans();
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

    fetchCoupans() {
      axios
        .get("/api/coupans?page=" + this.currentPage)
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
