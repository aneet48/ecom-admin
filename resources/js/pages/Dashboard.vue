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
                      <td>{{ item.new_students_count }}</td>
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
  }),
  methods: {
    fetchBlockData() {
      axios.get("/get-block-data").then(({ data }) => {
        this.blockData = data;
      });
    },
    fetchNewsstudentsByUni() {
      axios.get("/get-students_new_uni").then(({ data }) => {
        this.new_students_uni = data.data;
      });
    },
    fetchUserVisitChart() {
      axios.get("/get-features_chart").then(({ data }) => {
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
    fetchProductCount() {
      axios.get("/get-products_today").then(({ data }) => {
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
    fetchEventsCount() {
      axios.get("/get-events_today").then(({ data }) => {
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
