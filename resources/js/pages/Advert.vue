<template>
  <div>
    <BreadCrumb />
    <PageHeader title="Advertisements"> </PageHeader>
    <v-container>
      <v-skeleton-loader type="table" v-if="loader"></v-skeleton-loader>
    </v-container>

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
    };
  },
  components: {
    BreadCrumb,
    PageHeader,
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
          this.overlay = false;
          this.loader = false;
          this.posts = res.data.data;
          this.TotalPages = res.data.last_page;
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
