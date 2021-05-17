<template>
    <div id="card">
        <div id="chart">
          <apexchart type="radialBar" height="255" :options="chartOptions" :series="data"></apexchart>
        </div>
      </div>
</template>
<script>
import VueApexCharts from "vue-apexcharts";
Vue.component("apexchart", VueApexCharts);

export default {
  props: ["data"],
  data() {
    return {
      series: "",
      chartOptions: {
        chart: {
          type: "radialBar",
          toolbar: {
            show: false,
          },
        },
        plotOptions: {
          radialBar: {
            hollow: {
              margin: 0,
              size: "81%",
              background: "#fff",
              position: "front",
              dropShadow: {
                enabled: true,
                top: 1,
                left: 0,
                blur: 1,
                opacity: 0.2,
              },
            },
            track: {
              background: "#fff",
              strokeWidth: "67%",
              margin: 0, // margin is in pixels
              dropShadow: {
                enabled: true,
                top: 0.51,
                left: 0,
                blur: 0.5,
                opacity: 0.1,
              },
            },
            dataLabels: {
              show: true,
              name: {
                offsetY: -7,
                show: true,
                color: "#b7c0d5",
                fontSize: "16px",
              },
              value: {
                offsetY: 7,
                fontSize: "22px",
                fontWeight: "500",
                colors: "#343a40",
                show: true,
              },
            },
          },
        },
        fill: {
          colors: [
            function ({ value, seriesIndex, w }) {
              if (value <= 30) {
                return " #f8030381";
              } else {
                if (value <= 49) {
                  return "#6575cdad";
                } else {
                  return "#3699ff";
                }
              }
            },
          ],
          opacity: 0.9,
          type: "solid",
        },
        stroke: {
          lineCap: "round",
        },
        labels: ["Win rate"],
      },
    };
  },
};
</script>