<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Advertisements"> </PageHeader>
    <v-container>
      <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader>
    </v-container>

    <SingleAdvertSection title="homepage1"></SingleAdvertSection>
    <SingleAdvertSection title="homepage2"></SingleAdvertSection>
    <SingleAdvertSection title="homepage3"></SingleAdvertSection>
    <SingleAdvertSection title="homepage4"></SingleAdvertSection>

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
  </div>
</template>

<script>
import BreadCrumb from "../components/BreadCrumb";
import PageHeader from "../components/PageHeader";
import SingleAdvertSection from "./SingleAdvertSection";

export default {
  data() {
    return {
      posts: [],
      loader: true,
      currentPage: 1,
      TotalPages: 0,
      totalVisible: 15,

      snackbar: false,
      snackbarText: "",
      multiLine: true,
      errors: [],
      overlay: false,
      snackbarColor: "info",
      m_image: "",
      image: [],
      imageRules: [
        (value) =>
          !value ||
          value.size < 2000000 ||
          "Image size should be less than 2 MB!",
      ],
      imagePlaceholder: "Add Image",
    };
  },
  components: {
    BreadCrumb,
    PageHeader,
    SingleAdvertSection,
  },
  mounted() {
    this.loader = true;
    this.fetchContacts();
  },
  watch: {
    currentPage: function (val) {
      //do something when the data changes.
      if (val) {
        this.loader = true;
        this.fetchContacts();
      }
    },
  },
  methods: {
    uploadImage() {
      var file = document.querySelector("input[type=file]").files[0];
      if (!file) return;
      // this.$refs.inputFile.reset();

      var reader = new FileReader();
      reader.onload = function (e) {
        this.m_image = e.target.result;
        // let api_url = "api/adverts";
        // axios({
        //   method: "post",
        //   url: api_url,
        //   data: {
        //     place: "header_image",
        //     image: this.m_image,
        //   },
        // })
        //   .then((res) => {
        //     let data = res.data;
        //     if (data.error && data.msg) {
        //       this.errors = data.msg;
        //     } else {
        //       this.overlay = false;
        //       this.snackbarColor = "success";

        //       this.snackbarText = data.msg;
        //       this.snackbar = true;
        //       // this.closeDialog();
        //       // this.fetchFeedback();
        //     }
        //   })
        //   .catch((err) => {
        //     this.unknownError();

        //     console.log(err);
        //   });
      }.bind(this);
      reader.onerror = function (error) {
        alert(error);
      };
      reader.readAsDataURL(file);
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
      }).then((result) => {
        if (result.value && item) {
          this.overlay = true;
          axios
            .post(`api/adverts/delete/${item.id}`)
            .then((res) => {
              let data = res.data;
              if (data.error && data.msg) {
                this.errors = data.msg;
              } else {
                this.$swal("Deleted!", data.msg, "success");
                this.overlay = true;
                this.fetchContacts();
              }
            })
            .catch((err) => {
              this.unknownError();
              console.log(err);
            });
        }
      });
    },

    fetchContacts() {
      axios
        .get("/api/adverts")
        .then((res) => {
          // console.log(res.data)
          this.overlay = false;
          this.loader = false;
          this.posts = res.data;
          this.TotalPages = res.data.last_page;
        })
        .catch((err) => {
          this.unknownError();
          console.log(err);
        });
    },

    saveAdvert(place) {
      this.$refs.inputFile.reset();

      let api_url = "api/adverts";
      axios({
        method: "post",
        url: api_url,
        data: {
          place: place,
          image: this.m_image,
        },
      })
        .then((res) => {
          let data = res.data;
          if (data.error && data.msg) {
            this.errors = data.msg;
          } else {
            this.overlay = false;
            this.snackbarColor = "success";

            this.snackbarText = data.msg;
            this.snackbar = true;
            // this.closeDialog();
            // this.fetchFeedback();
          }
        })
        .catch((err) => {
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
  },
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
