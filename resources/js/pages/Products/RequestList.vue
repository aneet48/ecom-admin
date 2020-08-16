<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Product Requests List">
      
    </PageHeader>
    <v-container fluid>
      <v-row>
        <v-col cols="12" :lg="9" :md="8" :sm="8" class="text-right">
          <!-- <v-dialog v-model="filterdialog" max-width="500px">
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
          </v-dialog>-->
          <!-- <v-btn class="filterBtn" depressed color="primary" @click="filterdialog = !filterdialog"> <v-icon class="filterIcon" dark small>shuffle</v-icon> Filter</v-btn> -->
        </v-col>
        <v-col cols="12" :lg="3" :md="4" :sm="4">
          <SearchBar @handleSearch="handleSearch" />
        </v-col>
      </v-row>
    </v-container>
   
    <v-container fluid>
      <!-- <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader> -->

      <v-simple-table v-if="!loader">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">User</th>
              <th class="text-left">Title</th>              
              <th class="text-left">Category</th>             
              <th class="text-left">Description</th>
              <th class="text-left">Type</th>
              <th class="text-left">Time Period</th>
              <th class="text-left">University</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item , i) in posts" :key="i">
              <td>{{item.user?item.user.first_name+' '+item.user.last_name:''}}</td>
              <td>
                <div class="product">
                  <div class="product__detail">
                    <span class="product__name">{{item.title}}</span>
                  </div>
                </div>
              </td>
              <td>{{item.category?item.category.name:''}}</td>
              <td>{{item.description}}</td>
              <td>
                <v-chip class="ma-2 chip" color="teal accent-4">{{item.type}}</v-chip>
              </td>
              <td>
                <v-chip class="ma-2 chip" color="teal accent-4">{{item.type}}</v-chip>
              </td>
              <td>
              {{item.time_period ?item.time_period.charAt(0).toUpperCase() + item.time_period.slice(1):''}}
              </td>
            
              <td class="text-right">
                <div class="d-none d-sm-block">
                 
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
// import SearchBar from "../../components/SearchBar";
import ProductImages from "./partials/ProductImages";

export default {
  data() {
    return {
      pmModal: false,
      p_images: [],
      p_image: [],
      p_item: "",
      select: [],
      posts: [],
      loader: true,
      dialog: false,
      filterdialog: false,
      currentPage: 1,
      TotalPages: 0,
      totalVisible: 15,
      m_name: "",
      m_type: "add",
      valid: false,
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
      categories: [],
      p_categories: null,
      m_uni: null,
      //   p_categories: { id: null, name: null },
      p_title: "",
      p_desc: "",
      p_price: "",
      p_type: "",
      p_status: "",
      p_category_id: "",
      iscatLoading: false,
      searchCat: "",
      imageRules: [
        value =>
          !value ||
          value.size < 2000000 ||
          "Image size should be less than 2 MB!"
      ],
      timeout: "",
      universities: [],
      isuniLoading: false,
      searchUni: "",
      sellers: [],
      p_seller: null,
      issellerLoading: false,
      searchSeller: ""
    };
  },
  components: {
    BreadCrumb,
    PageHeader,
    ProductImages
    // SearchBar
  },
  mounted() {
    this.loader = true;
    this.fetchProductRequests();
  },
  watch: {
    searchSeller: function(val) {
      clearTimeout(this.timeout);

      var self = this;
      this.timeout = setTimeout(function() {
        self.issellerLoading = true;
        self.fetchseller(val);
      }, 1000);
    },
    searchUni: function(val) {
      clearTimeout(this.timeout);

      var self = this;
      this.timeout = setTimeout(function() {
        self.isuniLoading = true;
        self.fetchuni(val);
      }, 1000);
    },
    searchCat: function(val) {
      clearTimeout(this.timeout);

      var self = this;
      this.timeout = setTimeout(function() {
        self.iscitiesLoading = true;
        self.fetchcat(val);

        console.log("searching:", val);
      }, 1000);
    },
    currentPage: function(val) {
      //do something when the data changes.
      if (val) {
        this.loader = true;
        this.fetchProductRequests();
      }
    }
  },
  methods: {
    handleSearch(val) {
      this.overlay = true;
      axios
        .get("/api/product-request?s=" + val)
        .then(res => {
          this.overlay = false;
          this.posts = res.data.data;
          this.TotalPages = res.data.last_page;
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },

    
    modalToggle() {
      this.pmModal = !this.pmModal;
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
            .post(`api/product-request/delete/${item.id}`)
            .then(res => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchProductRequests();
              }
            })
            .catch(err => {
              this.unknownError();
              console.log(err);
            });
        }
      });
    },    
    fetchProductRequests() {
      axios
        .get("/api/product-request?page=" + this.currentPage)
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

.flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
