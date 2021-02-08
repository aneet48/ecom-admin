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
        <v-btn class="ma-2 action-btn" color="teal accent-4" dark>
          <JsonCSV
            class="ma-2 action-btn"
            color="teal accent-4"
            dark
            :data="all_products"
          >
            Export
            <v-icon dark>mdi-cloud-download</v-icon>
          </JsonCSV>
        </v-btn>
        <v-col cols="12" :lg="3" :md="4" :sm="4">
          <SearchBar @handleSearch="handleSearch" />
        </v-col>
      </v-row>
    </v-container>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-card>
          <v-card-title>
            <span class="headline">Add Product</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <!-- <v-col cols="12" sm="6" md="12">
                <v-file-input multiple label="Product Image"></v-file-input>
                </v-col>-->
                <v-col cols="12" sm="6" md="12">
                  <v-text-field
                    label="Product Name"
                    required
                    v-model="p_title"
                    :rules="requiredRules"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="12">
                  <v-textarea
                    label="Product description"
                    required
                    v-model="p_desc"
                    :rules="requiredRules"
                    rows="3"
                  ></v-textarea>
                </v-col>
                <!-- <v-col cols="12" sm="6" md="6">
                <v-text-field label="Sku"></v-text-field>
                </v-col>-->
                <v-col cols="12" sm="6" md="6">
                  <v-text-field
                    label="Price (₹)"
                    :rules="requiredRules"
                    v-model="p_price"
                    type="number"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="6">
                  <v-select
                    v-model="p_type"
                    :items="['buy', 'rental']"
                    label="Buy or Rent"
                    required
                    :rules="requiredRules"
                  ></v-select>
                </v-col>

                <v-col cols="12" sm="12" md="12">
                  <v-autocomplete
                    label="Categories"
                    :items="categories"
                    item-text="name"
                    item-value="id"
                    return-object
                    v-model="p_categories"
                    :loading="iscatLoading"
                    :rules="requiredRules"
                    :search-input.sync="searchCat"
                  ></v-autocomplete>
                </v-col>
                <v-col cols="12" md="12">
                  <v-autocomplete
                    label="College"
                    :items="universities"
                    item-text="name"
                    item-value="id"
                    return-object
                    v-model="m_uni"
                    :loading="isuniLoading"
                    :rules="requiredRules"
                    :search-input.sync="searchUni"
                  ></v-autocomplete>
                </v-col>

                <v-col cols="12" md="12">
                  <v-autocomplete
                    label="Seller"
                    :items="sellers"
                    item-text="email"
                    item-value="id"
                    return-object
                    v-model="p_seller"
                    :loading="issellerLoading"
                    :rules="requiredRules"
                    :search-input.sync="searchSeller"
                  ></v-autocomplete>
                </v-col>

                <v-col cols="12" sm="12" md="12">
                  <v-checkbox v-model="p_status" label="Active"></v-checkbox>
                  <!-- <v-switch v-model="status" class="ma-2" label="Inactive"></v-switch> -->
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn light color="white " @click="closeDialog">Close</v-btn>
            <v-btn dark color="pink " @click="saveDialog">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>
    <v-container fluid>
      <!-- <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader> -->

      <v-simple-table v-if="!loader">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Product</th>
              <th class="text-left">Title</th>
              <th class="text-left">Category</th>
              <th class="text-left">Price</th>
              <th class="text-left">Status</th>
              <th class="text-left">Type</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, i) in posts" :key="i">
              <td>
                <div class="product">
                  <div class="product__detail">
                    <span class="product__name">{{ item.title }}</span>
                  </div>
                </div>
              </td>
              <td>{{ item.category ? item.category.name : "" }}</td>
              <td>{{ item.description }}</td>
              <td>₹{{ item.price }}</td>
              <td>
                <v-chip class="ma-2 chip" color="teal accent-4">{{
                  item.type
                }}</v-chip>
              </td>
              <td>
                <div v-if="item.active">
                  <v-chip class="ma-2 chip" color="teal accent-4"
                    >Active</v-chip
                  >
                </div>
                <div v-if="!item.active">
                  <v-chip class="ma-2 chip" color="grey accent-4"
                    >Inactive</v-chip
                  >
                </div>
              </td>
              <td class="text-right">
                <div class="d-none d-sm-block">
                  <v-btn
                    fab
                    dark
                    x-small
                    color="blue"
                    @click="editImages(item)"
                  >
                    <v-icon dark small>mdi-image</v-icon>
                  </v-btn>
                  <v-btn
                    fab
                    dark
                    x-small
                    color="teal accent-4"
                    @click="editProduct(item)"
                  >
                    <v-icon dark small>mdi-pencil</v-icon>
                  </v-btn>
                  <v-btn
                    fab
                    dark
                    x-small
                    color="pink"
                    @click="deleteItem(item)"
                  >
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
                      <v-list-item @click="editProduct(item)">
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

    <div class="text-center" v-if="currentPage && TotalPages">
      <v-pagination
        v-model="currentPage"
        :length="TotalPages"
        :total-visible="totalVisible"
      ></v-pagination>
    </div>

    <v-snackbar
      v-model="snackbar"
      :color="snackbarColor"
      :timeout="5000"
      :multi-line="multiLine"
    >
      {{ snackbarText }}
      <v-btn dark text @click="snackbar = false">Close</v-btn>
    </v-snackbar>

    <v-overlay :value="overlay">
      <v-progress-circular indeterminate color="teal"></v-progress-circular>
    </v-overlay>
    <v-dialog
      v-model="pmModal"
      width="800"
      :modalToggle="modalToggle"
      persistent
    >
      <v-card>
        <v-card-title class="headline grey lighten-2" primary-title
          >Product Images</v-card-title
        >

        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-row>
              <v-col cols="8" sm="12" md="8">
                <v-file-input
                  :rules="imageRules"
                  accept="image/*, video/*"
                  placeholder="Add Image/Video"
                  prepend-icon="mdi-image"
                  label="Image"
                  v-model="p_image"
                  ref="file"
                ></v-file-input>
              </v-col>
              <v-col cols="4" sm="12" md="4">
                <v-btn dark color="pink " @click="saveImage">Save</v-btn>
              </v-col>
            </v-row>

            <v-row v-if="p_item && p_item.images.length">
              <v-col
                cols="4"
                sm="6"
                md="4"
                text-center
                v-for="(item, i) in p_item.images"
                :key="i"
              >
                <v-img
                  :src="item.thumbnail_link"
                  height="150px"
                  v-if="item.type == 'image'"
                ></v-img>

                <video
                  height="150px"
                  width="100%"
                  controls
                  v-if="item.type == 'video'"
                >
                  <source :src="item.link" />
                </video>
                <v-btn
                  color="red"
                  dark
                  small
                  @click="deleteImage(item)"
                  width="100%"
                  >Delete</v-btn
                >
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="pmModal = !pmModal">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import BreadCrumb from "../../components/BreadCrumb";
import PageHeader from "../../components/PageHeader";
// import SearchBar from "../../components/SearchBar";
import ProductImages from "./partials/ProductImages";
import JsonCSV from "vue-json-csv";

export default {
  data() {
    return {
      all_products:[],
      pmModal: false,
      p_images: [],
      p_image: [],
      p_item: "",
      select: [],
      posts: [],
      loader: true,
      dialog: false,
      filterdialog: false,
      modal_title: "Add New Product",
      currentPage: 1,
      TotalPages: 0,
      totalVisible: 15,
      m_name: "",
      m_type: "add",
      valid: false,
      requiredRules: [v => !!v || "this is required"],
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
    ProductImages,
    JsonCSV
    // SearchBar
  },
  mounted() {
    this.loader = true;
    this.fetchProducts();
    this.fetchStates();
    this.fetchAllproducts()
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
        this.fetchProducts();
      }
    }
  },
  methods: {
    fetchAllproducts() {
      axios
        .get("/api/all-products")
        .then((res) => {
          this.all_products = res.data.data;
        })
        .catch((err) => {
          this.unknownError();
          console.log(err);
        });
    },
    handleSearch(val) {
      this.overlay = true;
      axios
        .get("/api/products/true?s=" + val)
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
    fetchseller(val) {
      axios
        .get("/api/user/search/" + val)
        .then(res => {
          this.sellers = res.data.data;
          this.issellerLoading = false;
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },
    deleteImage(item) {
      console.log(item);
      this.overlay = true;
      axios
        .post("/api/product-media/delete/" + item.id)
        .then(res => {
          //   this.overlay = false;

          this.fetchImages();
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },
    fetchImages() {
      if (!this.p_item.id) return;
      axios
        .get("/api/product-media/" + this.p_item.id)
        .then(res => {
          this.overlay = false;
          this.p_item.images = res.data;
          //   this.iscatLoading = false;
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },
    modalToggle() {
      this.pmModal = !this.pmModal;
    },
    fetchcat(val) {
      if (val) {
        axios
          .get("/api/product-categories-search/" + val)
          .then(res => {
            this.categories = res.data.data;
            this.iscatLoading = false;
          })
          .catch(err => {
            this.unknownError();
            console.log(err);
          });
      }
    },
    addNew() {
      this.modal_title = "Add New Product";
      this.m_type = "add";
      this.dialog = true;
    },

    saveImage() {
      console.log(this.p_image);
      let formData = new FormData();
      let file = this.p_image;

      // files
      formData.append("image", file, file.name);
      formData.append("product", this.p_item.id);

      axios({
        method: "post",
        url: "/api/product-media",
        data: formData,
        headers: {
          "Content-Type": "multipart/form-data"
        }
      })
        .then(res => {
          let data = res.data;
          if (data.error && data.msg) {
            this.errors = data.msg;
          } else {
            this.p_image = [];
            this.fetchImages();
            console.log(data);
            // this.overlay = true;
            // this.snackbarColor = "success";

            // this.snackbarText = data.msg;
            // this.snackbar = true;
            // this.closeDialog();
            // this.fetchProducts();
          }
        })
        .catch(err => {
          this.unknownError();
          console.log(err);
        });
    },

    editImages(item) {
      console.log(item);
      this.pmModal = true;
      this.p_item = item;
    },

    editProduct(item) {
      //   this.isStatesLoading = true;
      this.modal_title = "Edit Product";
      this.editItem = item;
      let category = item.category;
      this.m_type = "edit";
      this.p_categories = { id: category.id, name: category.name };
      this.categories = [this.p_categories];
      this.m_uni = { id: item.university.id, name: item.university.name };
      this.universities = [this.m_uni];
      this.p_seller = { id: item.seller.id, email: item.seller.email };
      this.sellers = [this.p_seller];
      this.p_title = item.title;
      this.p_desc = item.description;
      this.p_type = item.type;
      this.p_price = item.price;
      this.p_status = item.status;
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
            .post(`api/product/delete/${item.id}`)
            .then(res => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchProducts();
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
      console.log(is_valid);
      if (!is_valid) return;

      let api_url =
        this.m_type == "edit"
          ? `api/product/${this.editItem.id}`
          : "api/product";
      console.log(this.m_type);
      console.log(api_url);
      const userInfo = localStorage.getItem("user");
      const userData = JSON.parse(userInfo);
      axios({
        method: "post",
        url: api_url,
        data: {
          title: this.p_title,
          description: this.p_desc,
          price: this.p_price,
          category_id: this.p_categories.id,
          university_id: this.m_uni.id,
          seller_id: this.p_seller.id,
          type: this.p_type,
          active: this.p_status
          //   seller_id: userData.id
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
            this.fetchProducts();
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

    fetchProducts() {
      axios
        .get("/api/products/true?page=" + this.currentPage)
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

.flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
