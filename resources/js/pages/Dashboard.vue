<template>
  <div>
    <BreadCrumb />
    <v-row>
      <v-col cols="12" sm="12">
        <v-row>
          <v-col cols="12" sm="4" v-for="data in blockData" :key="data.id">
            <InfoBlock :data="data" />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" md="4">
            <v-menu
              v-model="menu2"
              :close-on-content-click="false"
              :nudge-right="40"
              transition="scale-transition"
              offset-y
              min-width="auto"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="date"
                  label="Select Date"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                v-model="date"
                @input="menu2 = false"
              ></v-date-picker>
            </v-menu>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="8">
            <v-card class="text-center" outlined>
              <div class="headline mb-4">
                <h4>New students today per university</h4>
              </div>
              <v-simple-table v-if="new_students_uni.length" height="300px">
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">University</th>
                      <th class="text-left">New Students</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in new_students_uni" :key="item.id">
                      <td>{{ item.name }}</td>
                      <td>{{ item.students_count }}</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
              <v-simple-table v-if="!new_students_uni.length" height="300px">
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">University</th>
                      <th class="text-left">New Students</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr >
                      <td>No students added this day</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" v-if="useroptions && userseries">
            <v-card class="text-center" outlined>
              <apexchart
                width="90%"
                type="bar"
                :options="useroptions"
                :series="userseries"
              ></apexchart>
            </v-card>
          </v-col>
          <!-- <v-col cols="12" sm="1"> </v-col> -->
          <v-col cols="12" sm="6">
            <v-card class="text-center" outlined>
              <apexchart
                width="90%"
                type="bar"
                :options="productoptions"
                :series="productseries"
              ></apexchart>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" v-if="eventsoptions && eventsseries">
            <v-card class="text-center" outlined>
              <apexchart
                width="90%"
                type="bar"
                :options="eventsoptions"
                :series="eventsseries"
              ></apexchart>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import Sidebar from "../components/Sidebar";
import BreadCrumb from "../components/BreadCrumb";
import ComingSoon from "../components/ComingSoon";
import InfoBlock from "../components/InfoBlock";
// import {Chart} from 'vue-chartjs';
import VueApexCharts from "vue-apexcharts";

export default {
  components: {
    Sidebar,
    BreadCrumb,
    ComingSoon,
    InfoBlock,
    apexchart: VueApexCharts,
  },
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
    blockData: [],
    new_students_uni: [],
    useroptions: null,
    userseries: null,
    productoptions: null,
    productseries: null,
    eventsoptions: null,
    eventsseries: null,
    date: new Date().toISOString().substr(0, 10),
    menu2: false,
  }),
  watch: {
    date(val) {
      console.log(val);
      this.fetchNewsstudentsByUni(val);
      this.fetchUserVisitChart(val);
      this.fetchProductCount(val);
      this.fetchEventsCount(val);
    },
  },
  methods: {
    fetchBlockData() {
      axios.get("/get-block-data").then(({ data }) => {
        this.blockData = data;
      });
    },
    fetchNewsstudentsByUni(date = "") {
      axios.get("/get-students_new_uni?date=" + date).then(({ data }) => {
        this.new_students_uni = data.data;
      });
    },
    fetchUserVisitChart(date = "") {
      axios.get("/get-features_chart?date=" + date).then(({ data }) => {
        let options = {
          chart: {
            id: "vuechart-example",
          },
          plotOptions: {
            bar: {
              horizontal: false,
            },
          },
          title: {
            text: "Feature Used Today Per student",
          },
          xaxis: {
            categories: data.feature,
          },
        };
        let series = [
          {
            name: "Products",
            data: data.total,
          },
        ];
        this.userseries = series;

        this.useroptions = options;
      });
    },
    fetchProductCount(date = "") {
      axios.get("/get-products_today?date=" + date).then(({ data }) => {
        let options = {
          chart: {
            id: "vuechart-example2",
          },
          plotOptions: {
            bar: {
              horizontal: false,
            },
          },
          title: {
            text: "Products added today",
          },
          colors: ["#F44336"],
          xaxis: {
            categories: data.category,
          },
        };
        let series = [
          {
            name: "Students",
            data: data.total,
          },
        ];
        this.productseries = series;

        this.productoptions = options;
      });
    },
    fetchEventsCount(date = "") {
      axios.get("/get-events_today?date=" + date).then(({ data }) => {
        let options = {
          chart: {
            id: "vuechart-example3",
          },
          plotOptions: {
            bar: {
              horizontal: false,
            },
          },
          title: {
            text: "Events added today",
          },
          colors: ["#F44336"],
          xaxis: {
            categories: data.category,
          },
        };
        let series = [
          {
            name: "Events",
            data: data.total,
          },
        ];
        this.eventsseries = series;

        this.eventsoptions = options;
      });
    },
  },
  mounted() {
    this.fetchBlockData();
    this.fetchNewsstudentsByUni();
  },
  beforeMount() {
    this.fetchUserVisitChart();
    this.fetchProductCount();
    this.fetchEventsCount();
  },
};
</script>

<style scoped>
.app-bar {
  width: 100%;
}
.app-bar-icon {
  border-left: 1px solid #f5efef;
  padding-left: 18px;
  padding-right: 18px;
  font-size: 18px;
}
#dashboard {
  background-color: #f8f8f8;
  font-family: Nunito, sans-serif;
}
.drawer {
  background: #2e323a;
}
</style>
