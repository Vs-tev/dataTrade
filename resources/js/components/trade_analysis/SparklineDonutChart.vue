<template>
    <apexchart type="radialBar" class="text-right" height="120" :options="sparklinechart" :series="[winrate]"></apexchart>
</template>
<script>
export default {
  name: "SparklineDonutChart",
  props: ["winrate"],

  data() {
    return {
      sparklinechart: {
        chart: {
          type: "radialBar",
          toolbar: {
            show: false,
          },
          sparkline: {
            enabled: true,
          },
        },
        plotOptions: {
          radialBar: {
            hollow: {
              margin: 0,
              size: "80%",
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
              strokeWidth: "79%",
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
                show: true,
                offsetY: -4,
                color: "#b7c0d5",
                fontSize: "12px",
              },
              value: {
                offsetY: 2,
                fontSize: "14px",
                fontWeight: "600",
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