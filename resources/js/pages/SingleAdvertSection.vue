<template>
  <v-card class="mx-auto my-12">
    <v-img height="250" :src="posts[title].link" v-if="posts[title]"></v-img>

    <v-card-title>{{title}}</v-card-title>

    <v-btn color="deep-purple lighten-2" text>
      <v-file-input
        accept="image/*"
        :placeholder="imagePlaceholder"
        prepend-icon="mdi-image"
        label="Image"
        v-model="image"
        ref="inputFile"
        @change="uploadImage"
      ></v-file-input>
    </v-btn>
    <v-col>
      <v-text-field
        v-model="openlink"
        type="url"
        hint="On clicking the image user will go to this link"
        label="Open Link"
      ></v-text-field>
  
    <v-btn color="deep-purple dark" @click="saveAdvert(title)"> Save </v-btn>
      </v-col>
  </v-card>
</template>

<script>
export default {
  name: "SingleAdvertSection",
  props: ["title"],
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
      openlink: "",
    };
  },
  mounted() {
    // this.loader = true;
    this.fetchContacts();
  },
  methods: {
    uploadImage(fieldName, fileList) {
      console.log(fieldName, fileList);
      var file = fieldName;
      //   var file = document.querySelector("input[type=file]").files[0];
      if (!file) return;
      // this.$refs.inputFile.reset();

      var reader = new FileReader();
      reader.onload = function (e) {
        this.m_image = e.target.result;
        console.log("test", e.target.result);
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

    fetchContacts() {
      axios
        .get("/api/adverts")
        .then((res) => {
          // console.log(res.data)
          this.overlay = false;
          this.loader = false;
          this.posts = res.data;
          this.openlink = res.data[this.title]?res.data[this.title].openlink:''
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
          openlink: this.openlink,
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
            this.fetchContacts();
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
</style>