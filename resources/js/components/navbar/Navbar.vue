<template>
     <div class="downbar">
        <div class="down-left d-flex justify-content-start" >
            <ul class="list-unstyled" v-if="spinner">
                <li class="font-500 dark"><span>{{portfolio.name}}: </span>
                <span class="font-500 light-md">{{portfolio.current_balance}} {{portfolio.currency}}
                  <span class="">( <span class="font-dark">Net Profit: </span><span :class="{'red' : netProfit < 0}">{{netProfit}} {{portfolio.currency}}</span>)</span>
                </span>
                </li>

                <li class="border-left mx-2 p-1"></li>
                <li class=""><span class="font-500">Return: </span>
                <span class=" font-500 light-md" :class="{'red' : rci < 0}">{{rci}}%</span>
                </li>
                <li class="border-left mx-2 p-1"></li>
                <li class=""><span class="font-500">Trade Profit:</span>
                <span class=" font-500 light-md" :class="{'red' : trade_profit < 0}">{{trade_profit}}</span>
                </li>
            </ul> 
             <ul class="list-unstyled" v-if="!spinner">
                <li>
                <div class="spinner-grow indigo spinner-grow-sm"></div>
                <div class="spinner-grow indigo spinner-grow-sm"></div>
                <div class="spinner-grow indigo spinner-grow-sm"></div>
                </li>
            </ul> 
             
        </div>
    </div>
</template>
<script>
export default {
  name: "Navbar",
  data() {
    return {
      portfolio: "",
      spinner: false,
    };
  },
  created() {
    //this come from TradeRecord.vue
    this.$root.$on("portfolio_balance", () => {
      this.getActivePortfolio();
    });
  },
  mounted() {
    this.getActivePortfolio();
  },
  computed: {
    rci: function () {
      const rci = (
        ((this.portfolio.current_balance - this.portfolio.start_equity) /
          this.portfolio.start_equity || 0) * 100
      ).toFixed(2);
      if (rci > 0) {
        return "+" + rci;
      } else {
        return rci;
      }
    },

    trade_profit: function () {
      if (this.portfolio.trade_profit > 0) {
        return "+" + this.portfolio.trade_profit;
      } else {
        return this.portfolio.trade_profit;
      }
    },

    netProfit: function () {
      var netprofit = (
        this.portfolio.current_balance - this.portfolio.start_equity
      ).toFixed(2);
      if (netprofit > 0) {
        return "+" + netprofit;
      } else {
        return netprofit;
      }
    },
  },
  methods: {
    getActivePortfolio() {
      axios
        .get("/dashboardPages/portfolioIsActive/g")
        .then((res) => {
          this.portfolio = res.data[0];
          this.spinner = true;
        })
        .catch((error) => {});
    },
  },
};
</script>