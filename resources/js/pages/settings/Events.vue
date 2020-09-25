<template>
  <div class="formWrap">
    <div class="form-container">
       <v-row>
      <v-col cols="12">
        <h2>Enter the Event Price</h2>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" md="12">
        <v-text-field v-model="event_price" :rules="nameRules" label="Event Price" required></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <v-btn dark color="pink " @click="saveSetting">Save</v-btn>
      </v-col>
    </v-row>
    </div>
    <v-snackbar v-model="snackbar" :color="snackbarColor" :timeout="5000">
      {{snackbarText}}
      <v-btn dark text @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </div>
</template>

<script>
import MetaSetting from "../../components/MetaSetting";

export default {
  data() {
    return {
      nameRules: [(v) => !!v || "Number is required"],
      event_price: 0,
      snackbar: false,
      snackbarText: "",
      snackbarColor: "info",
      meta_key: "event_price",
      group: "events",
    };
  },
  mounted() {
    this.loader = true;
    this.getEventPrice();
  },
  methods: {
    getEventPrice() {
      axios
        .get(`/api/setting/search/${this.meta_key}/${this.group}`)
        .then((res) => {
          if (res && res.data && res.data.meta_value) {
            this.event_price = res.data.meta_value;
          }
          console.log(res);
        })
        .catch((err) => {
          //   this.unknownError();
          console.log(err);
        });
    },
    saveSetting() {
      axios({
        method: "post",
        url: "api/setting/store",
        data: {
          meta_key: "event_price",
          meta_value: this.event_price,
          group: "events",
        },
      })
        .then((res) => {
          let data = res.data;
          if (data.error && data.msg) {
            this.errors = data.msg;
          } else {
            this.overlay = true;
            this.snackbarColor = "success";

            this.snackbarText = data.msg;
            this.snackbar = true;
          }
        })
        .catch((err) => {
          this.unknownError();

          console.log(err);
        });
    },
  },
  components: {
    MetaSetting,
  },
};
</script>

<style scoped>
  .formWrap{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    align-items:center;
    height:100%
  }
  .form-container{
    background: #fff;
    padding: 2rem;
    border-radius: 20px;
  }
  .form-container button{
    width:100%
  }
</style>
