<template>
<div id="chartDiv">
    <trading-vue 
            :data="chart" 
            :toolbar="true" title-txt="BTCUSD"
            :width="this.width" :height="this.height"
            :chart-config="config"
            :color-back="colors.back"
            :color-grid="colors.grid"
            :color-text="colors.text"
            :color-title="colors.tvTitle"
            ></trading-vue>
           
        </div>
</template>
<script>
/* api code for fcsapi: IOAH0VCIVJC0A43W */
import { TradingVue, DataCube } from "trading-vue-js";
import Data from ".././chartvue/trading-vue-js/data/data.json";

export default {
  name: "Chart",
  components: { TradingVue },
  data() {
    return {
      api: {
        url:
          "https://financialmodelingprep.com/api/v3/historical-chart/30min/BTCUSD?apikey=009508292e37fd1396f1ad5c33010084",
      },
      colors: {
        back: "#121827",
        grid: "#3e3e3e",
        text: "#35a776",
        cross: "#dd64ef",
        candle_dw: "#e54077",
        wick_dw: "#e54077",
      },
      //chart: new DataCube(Data),
      width: 0,
      height: window.innerHeight,

      chart: new DataCube(),

      overlays: [],
      config: {
        DEFAULT_LEN: 300,
        TB_BORDER: 2,
        CANDLEW: 0.7,
        GRIDX: 200,
        GRIDY: 200,
        VOLSCALE: 0.2,
      },
    };
  },
  mounted() {
    this.widthchart();
    window.addEventListener("resize", this.onResize);
    window.dc = this.chart;
    //this.getSymbol();
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },

  methods: {
    widthchart() {
      var elmnt = document.getElementById("chartDiv");
      this.width = elmnt.offsetWidth;
      window.dc = this.chart;
    },
    onResize() {
      var elmnt = document.getElementById("chartDiv");
      this.width = elmnt.offsetWidth;
      this.height = window.innerHeight;
    },

    getSymbol() {
      axios
        .get(this.api.url, {
          transformRequest: [
            (data, headers) => {
              delete headers.common["X-Requested-With"];
              delete headers.common["Access-Control-Allow-Origin"];
              return data;
            },
          ],
        })
        .then((response) => {
          const keys = ["open", "high", "low", "close", "volume"],
            results = {
              ohlcv: Object.entries(response.data)
                .map(([volume, open]) => [
                  Date.parse(open.date),
                  ...keys.map((k) => open[k]),
                ])
                .sort(function (a, b) {
                  return a[0] - b[0];
                }),
            };
          this.chart = results;
          console.log(results);
        });
    },
  },
};
</script>
