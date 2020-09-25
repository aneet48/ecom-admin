<template>
  <div>
    <BreadCrumb />
    <v-row>
      <v-col cols="12" sm="12">
        <v-row>
          <v-col cols="12" sm="4" v-for="data in blockData" :key="data.id">
            <InfoBlock :data="data"/>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="4">
            <apexchart width="90%" type="bar" :options="useroptions" :series="userseries"></apexchart>
          </v-col>
          <v-col cols="12" sm="1">
          </v-col>
          <v-col cols="12" sm="4">
            <apexchart width="90%" type="bar" :options="productoptions" :series="productseries"></apexchart>
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
import VueApexCharts from 'vue-apexcharts'


export default {
  components: {
    Sidebar,
    BreadCrumb,
    ComingSoon,
    InfoBlock,
    apexchart: VueApexCharts
  },
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
    blockData: [
      {
        id: 1,
        title: "Total Colleges",
        amount:400,
        subtitle:'200 with users',
        bgFirstColor:'#365db2',
        bgSecondColor:'#3ab6cb',
      },
      {
        id: 2,
        title: "Total Students",
        amount:400,
        subtitle:'100 new today',
        bgFirstColor:'#c6d65f',
        bgSecondColor:'#54b249',
      },
      {
        id: 3,
        title: "Total Products",
        amount:400,
        subtitle:'10 new today',
        bgFirstColor:'#f56527',
        bgSecondColor:'#fdba35',
      },
    ],
    useroptions: {
        chart: {
          id: 'vuechart-example'
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        title: {
          text: 'Users Added'
        },
        xaxis: {
          categories: ['yesterday' , 'last 7 days', 'last month','last 3 months','last 6 months','last year']
        }
      },
      userseries: [{
        name: 'users',
        data: [30, 40, 45, 30, 50, 60]
      }],
    productoptions: {
        chart: {
          id: 'vuechart-example'
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        title: {
          text: 'Products Added'
        },
        colors:['#F44336'],
        xaxis: {
          categories: ['yesterday' , 'last 7 days', 'last month','last 3 months','last 6 months','last year']
        }
      },
      productseries: [{
        name: 'Products',
        data: [30, 40, 45, 30, 50, 60]
      }]
  }),
  methods: {
            renderChart() {
                new Chart(document.getElementById('canvas').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: JSON.parse(this.labels),
                        datasets: [{
                            label: '# of Laravel apps made by Jack Russels',
                            data: JSON.parse(this.dataProp),
                            backgroundColor: [
                                '#2ecc71',
                                '#e74c3c',
                                '#8e44ad',
                                '#d35400',
                                '#16a085'
                            ]
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            fontSize: 22,
                            text: 'Example'
                        }
                    }
                });
            }
        },
        mounted() {
            this.renderChart();
        }
};
</script>

<style  scoped>
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
