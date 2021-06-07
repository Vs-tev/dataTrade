<template>
    <div>
      <br>
         <donut-chart :data="winrate"></donut-chart>
        <div>
         <apexchart type="area" ref="realtimeChart" :options="options" :series="series"></apexchart>
            <br>
            <div class="table-div-min-height">
            <table class="table table-sm table-hover">
                <thead>
                    <tr class="">
                        <th class="w-30 text-center">Symbol</th>
                        <th class="w-40 text-center">Exit date</th>
                        <th class="w-30 text-center">Profit</th>
                    </tr>
                </thead>
                <tbody v-if="trades.length">
                    <tr v-for="(item, index) in trades" :key="index" class="">
                        <td class="text-muted font-500">
                          <div class="max-width-80 text-truncate d-block ml-2">{{item.symbol}}</div>
                        </td>
                        <td class="font-500 ">{{item.exit_date}}</td>
                        <td class="font-500 text-center" :class="item.pl_currency < 0 ?'red' : 'primary' ">{{item.pl_currency}}</td>
                    </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="3" class="border-0 text-center font-weight-500">No recorded trades</td>
                  </tr>
                </tbody>
            </table>
            <div v-if="loading" class="d-flex justify-content-center align-items-center container_for_small_trades_table">
                <div class="spinner-border lighter"></div>
              </div>
           
            </div>
             <div class="text-right px-4 pb-4 pt-2">
               <a type="button" href="./tradehistory" class="lighter"> See all trades</a>
            </div>
        </div>
    </div>

</template>
<script>
import VueApexCharts from "vue-apexcharts";
Vue.component("apexchart", VueApexCharts);
import DonutChart from "./DonutChart.vue";

export default {
  components: {
    DonutChart,
  },
  data: function () {
    return {
      loading: true,
      loading_portfolio: true,
      portfolio: {
        winning_trades: "",
        total_trades: "",
      },
      running_total: "",
      trades: "",
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
          align: "center",
          margin: 0,
          offsetX: 0,
          style: {
            fontSize: "22px",
            fontWeight: "600",
            colors: "#343a40",
          },
        },
        subtitle: {
          text: "",
          align: "center",
          margin: 20,
          offsetX: 0,
          style: {
            fontSize: "14px",
            fontWeight: "bold",
            color: "#6c757d",
          },
        },
        noData: {
          text: undefined,
          align: "center",
          verticalAlign: "middle",
          offsetX: 0,
          offsetY: 0,
          style: {
            color: undefined,
            fontSize: "14px",
            fontFamily: undefined,
          },
        },
      },
    };
  },

  mounted() {
    this.portfolodata();
    this.$root.$on("portfolio_balance", () => {
      this.runningtotal();
      this.tradeRecordTradesTable();
    });
  },
  computed: {
    winrate() {
      return [
        (
          (this.portfolio.winning_trades / this.portfolio.total_trades || 0) *
          100
        ).toFixed(2),
      ];
    },
  },

  methods: {
    portfolodata() {
      this.$root.$on("portfolio_balance", (data) => {
        this.portfolio.winning_trades = data.winning_trades;
        this.portfolio.total_trades = data.total_trades;
        this.loading_portfolio = false;
        this.options = {
          ...this.options,
          ...{
            title: {
              text: data.current_balance + " " + data.currency,
            },
            subtitle: {
              text: data.name,
            },
            tooltip: {
              x: {
                format: "dd / MMM / yy",
              },
              y: {
                formatter: function (val) {
                  return val.toFixed(2) + " " + data.currency;
                },
              },
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
          data: this.series[0].data.reverse(),
        },
      ]);
    },

    tradeRecordTradesTable() {
      axios.get("/dashboardPages/traderecord/t").then((res) => {
        this.trades = res.data;
        this.loading = false;
      });
    },
  },
};
</script>
<style scoped>
.max-width-80 {
  max-width: 80px;
}
</style>
