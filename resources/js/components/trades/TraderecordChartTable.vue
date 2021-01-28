<template>
    <div>
        <donut-chart></donut-chart>
        <div>
            <hr>
            <br>
            <apexchart type="area" ref="realtimeChart" :options="options" :series="series"></apexchart>
            <br>
            <br>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Symbol</th>
                        <th>Side</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>aud/cad</td>
                        <td>Sell</td>
                        <td>-80Eur</td>
                    </tr>
                    <tr>
                        <td>aud/cad</td>
                        <td>Sell</td>
                        <td>-40Eur</td>
                    </tr>
                    <tr>
                        <td>aud/cad</td>
                        <td>Sell</td>
                        <td>30Eur</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" @click="portfolodata">Get</button>
        <p>{{this.series[0].data}}</p>
    </div>

</template>
<script>
import VueApexCharts from "vue-apexcharts";
//Vue.use(VueApexCharts);

Vue.component("apexchart", VueApexCharts);

import DonutChart from "../../DonutChart/DonutChart.vue";
export default {
  components: {
    DonutChart,
  },
  data: function () {
    return {
      running_total: "",
      series: [
        {
          name: "Equity",
          data: [],
        },
      ],
      options: {
        chart: {
          height: 220,
          type: "area",
          sparkline: {
            enabled: true,
          },
          events: {
            dataPointSelection: (event, chartContext, config) => {
              this.portfolodata();
            },
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "smooth",
        },
        fill: {
          opacity: 0.6,
        },

        colors: ["#DCE6EC"],
        title: {
          text: "",
          offsetX: 0,
          style: {
            fontSize: "20px",
          },
        },
        subtitle: {
          text: "",
          offsetX: 0,
          style: {
            fontSize: "14px",
          },
        },
        noData: {
          text: "Loading...",
        },
      },
    };
  },

  mounted() {
    this.portfolodata();
    this.runningtotal();
    this.$root.$on("portfolio_balance", () => {
      this.runningtotal();
    });
  },

  methods: {
    portfolodata() {
      this.$root.$on("portfolio_balance", (data) => {
        // this.options.subtitle.text = data.name;
        this.options = {
          ...this.options,
          ...{
            title: {
              text: data.current_balance + "" + data.currency,
            },
            subtitle: {
              text: data.name,
            },
          },
        };
        this.$refs.realtimeChart.updateOptions(this.options, false, true);
      });
    },

    runningtotal: function runningtotal() {
      axios
        .get("/dashboardPages/traderecord/sparkline")
        .then((res) => {
          this.series[0].data = res.data.map((item) =>
            parseFloat(item.running_total)
          );
          this.updateSeriesLine();
        })
        .catch((error) => {});
    },
    updateSeriesLine() {
      this.$refs.realtimeChart.updateSeries([
        {
          data: this.series[0].data,
        },
      ]);
    },
  },
};
</script>
