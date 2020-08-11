<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Feedback">
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
              <th class="text-left">Name</th>
              <th class="text-left">Rating</th>
              <th class="text-left">Text</th>
              <th class="text-left">Image</th>
              <th class="text-left"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item , i) in posts" :key="i">
              <td>{{ item.name }}</td>
              <td>{{ item.rating }}</td>
              <td>{{ item.text }}</td>
                <td>           <v-img :src="item.link" aspect-ratio="2"></v-img></td>
              <td class="text-right">
                <v-row class="d-none d-sm-block">
                  <v-btn fab dark x-small color="teal accent-4" @click="editFeedback(item)">
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
                      <v-list-item @click="editFeedback(item)">
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
                  <v-text-field label="Name*" required v-model="m_name" :rules="nameRules"></v-text-field>
                </v-col>            
                <v-col cols="12">
                  <v-text-field label="Rating*"   type="number" required v-model="m_rating" :rules="ratingRules"></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea label="Text*" required v-model="m_text" :rules="textRules"></v-textarea>
                </v-col>
                <v-col cols="12">
                  <v-file-input
                     
                      accept="image/*"
                      :placeholder="imagePlaceholder"
                      prepend-icon="mdi-image"
                      label="Image"
                      v-model="image"
                      ref="file"
                      
                      @change="uploadImage"
                       ></v-file-input>
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
      modal_title: "Add New Feedback",
      currentPage: 1,
      TotalPages: 0,
      totalVisible: 15,
      m_name: "",
      m_rating: "",
      m_text: "",
      m_image: "",
      image:[],
      m_type: "add",
      valid: false,
      nameRules: [v => !!v || "Name is required"],
      ratingRules: [v => !!v || "Rating is required" ,
           v => v <= 6 || 'Rating should be in 1 to 5',
      ],
      textRules: [v => !!v || "Text is required"],
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
      imageRules: [
        value =>
          !value ||
          value.size < 2000000 ||
          "Image size should be less than 2 MB!"
      ],
      imagePlaceholder:'Add Image'
    };
  },
  components: {
    BreadCrumb,
    PageHeader
  },
  mounted() {
    this.loader = true;
    this.fetchFeedback();
  },
  watch: {
    currentPage: function(val) {
      //do something when the data changes.
      if (val) {
        this.loader = true;
        this.fetchFeedback();
      }
    }
  },
  methods: {
    addNew() {
      this.modal_title = "Add New Feedback";
      this.m_type = "add";
      this.m_image = "";
      this.image=[];
      this.dialog = true;
      this.imagePlaceholder= 'Add Image';
    },

    editFeedback(item) {
      //   this.isStatesLoading = true;
     
      this.modal_title = "Edit Feedback";
      this.editItem = item;
      this.m_name = item.name;
      this.m_rating = item.rating;
      this.m_image = "";
      this.image=[];
      this.m_text = item.text;
      this.m_type = "edit";
      this.dialog = true;
      this.imagePlaceholder= 'Select Image (Only if you want to change)'
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
            .post(`api/feedback/delete/${item.id}`)
            .then(res => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchFeedback();
              }
            })
            .catch(err => {
              this.unknownError();
              console.log(err);
            });
        }
      });
    },

     uploadImage(){
      var file = document
        .querySelector('input[type=file]')
        .files[0];
      var reader = new FileReader();
      reader.onload = function(e) {
       
       this.m_image = e.target.result 
      }.bind(this);
      reader.onerror = function(error) {
        alert(error);
      };
      reader.readAsDataURL(file);      
    },

    saveDialog() {

      this.errors = [];
      let is_valid = this.$refs.form.validate();
      if (!is_valid) return;
     // console.log(!this.img);

      if (this.m_type == 'add' && !this.m_image) return;
     

      let api_url =
        this.m_type == "edit" ? `api/feedback/${this.editItem.id}` : "api/feedback";
      axios({
        method: "post",
        url: api_url,
        data: {
          name:this.m_name,
          rating:this.m_rating,
          text:this.m_text,
          image:this.m_image,
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
            this.fetchFeedback();
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

    fetchFeedback() {
      axios
        .get("/api/feedback?page=" + this.currentPage)
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
