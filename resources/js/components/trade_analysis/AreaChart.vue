<template>
<div>
   <apexchart ref="realtimeChart" type="area" height="450" :options="options" :series="series"></apexchart>


</div>
</template>
<script>
export default {
  props: ["portfolio"],

  name: "AreaChart",
  data() {
    return {
      port: "",
      series: [
        {
          name: "Equity",
          data: [],
        },
      ],
      options: {
        chart: { background: "#fff" },
        type: "area",
        stacked: false,

        height: 350,
        zoom: {
          type: "x",
          enabled: true,
          autoScaleYaxis: true,
        },
        toolbar: {
          autoSelected: "zoom",
        },

        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "straight",
        },
        title: {
          text: "Portfolio Grow",
          align: "left",
          offsetY: 0,
          style: {
            fontSize: "20px",
            fontWeight: "400",
            colors: "#343a40",
          },
        },
        subtitle: {
          text: "",
          align: "left",
          margin: 15,
          offsetX: 0,
          style: {
            fontSize: "16px",
            fontWeight: "400",
            color: "#6c757d",
          },
        },
        markers: {
          size: 4,
        },
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            inverseColors: false,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 90, 100],
          },
        },
        grid: {
          row: {
            colors: ["#fff"], // takes an array which will be repeated on columns
            opacity: 0.5,
          },
        },
        yaxis: {
          show: true,
          showAlways: true,
          labels: {
            style: {
              colors: [],
              fontSize: "14px",
              fontFamily: "Helvetica, Arial, sans-serif",
              fontWeight: 400,
            },
          },
        },
        xaxis: {
          type: "datetime",
          categories: this.$props.portfolio.running_total
            .map((arr) => arr.action_date)
            .reverse(),
        },
      },
    };
  },

  watch: {
    portfolio: function (newProtfolio, oldVal) {
      this.series[0].data = newProtfolio.running_total
        .map((item) => parseFloat(item.running_total))
        .reverse();
      if (newProtfolio) {
        this.portfolio_data();
      }
    },
  },

  mounted() {
    this.portfolio_data();
  },

  methods: {
    portfolio_data() {
      this.series[0].data = this.$props.portfolio.running_total.map((item) =>
        parseFloat(item.running_total)
      );

      this.updateSeriesLine(this.$props.portfolio.currency);
    },

    updateSeriesLine(currency) {
      this.options = {
        ...this.options,
        ...{
          xaxis: {
            type: "datetime",
            categories: this.$props.portfolio.running_total
              .map((arr) => arr.action_date)
              .reverse(),
          },
          subtitle: {
            text: this.$props.portfolio.name,
            align: "left",
          },

          tooltip: {
            x: {
              format: "dd / MMM / yy",
            },
            y: {
              formatter: function (val) {
                return val.toFixed(2) + " " + currency;
              },
            },
          },
        },
      };
      this.$refs.realtimeChart.updateOptions(this.options, false, true);
      this.$refs.realtimeChart.updateSeries([
        {
          data: this.series[0].data.reverse(),
        },
      ]);
    },
  },
};
</script>
