<template>
    <apexchart ref="realtimeChart" type="bar" :height="height" :options="chartOptions" :series="series"></apexchart>
</template>
<script>
export default {
  name: "BarChartSymbol",
  props: ["height", "barChartdata", "title", "color"],

  data() {
    return {
      series: [
        {
          name: "Trades",
          data: [],
        },
      ],
      chartOptions: {
        chart: {
          height: 300,
          stacked: true,
          type: "bar",
        },
        colors: this.$props.color ? this.$props.color : "",
        plotOptions: {
          bar: {
            borderRadius: 5,
            columnWidth: "35%",
            dataLabels: {
              position: "top", // top, center, bottom
            },
          },
        },

        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + " Trades";
          },
          offsetY: -20,
          style: {
            fontSize: "12px",
            colors: ["#304758"],
          },
        },
        noData: {
          text: "No Recorded Trades",
          align: "center",
          verticalAlign: "middle",
          offsetX: 0,
          offsetY: 0,
          style: {
            color: "#b7c0d5",
            fontSize: "20px",
            fontFamily: undefined,
          },
        },
        xaxis: {
          categories: this.$props.barChartdata
            ? this.$props.barChartdata.map((i) => i.category)
            : "",
          position: "top",
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
          crosshairs: {
            fill: {
              type: "gradient",
              gradient: {
                colorFrom: "#D8E3F0",
                colorTo: "#BED1E6",
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              },
            },
          },
          tooltip: {
            enabled: true,
          },
        },
        yaxis: {
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + " Trades";
            },
          },
        },
        title: {
          text: this.$props.title ? this.$props.title : "",
          floating: false,
          align: "left",
          margin: 15,
          offsetY: 0,
          style: {
            fontSize: "18px",
            fontWeight: "400",
            colors: "#343a40",
          },
        },
      },
    };
  },

  watch: {
    barChartdata: function (newProtfolio, oldVal) {
      if (newProtfolio) {
        this.getData();
      }
    },
  },

  mounted() {
    this.getData();
  },

  methods: {
    getData() {
      if (this.$props.barChartdata) {
        this.series[0].data = this.$props.barChartdata.map((item) =>
          parseFloat(item.trades)
        );
        this.updateSeriesBar();
      }
    },

    updateSeriesBar() {
      this.options = {
        ...this.options,
        ...{
          xaxis: {
            categories: this.$props.barChartdata
              ? this.$props.barChartdata.map((i) => i.category)
              : "",
          },
        },
      };

      this.$refs.realtimeChart.updateOptions(this.options, false, true);
      this.$refs.realtimeChart.updateSeries([
        {
          data: this.$props.barChartdata.map((item) => parseFloat(item.trades)),
        },
      ]);
    },
  },
};
</script>
