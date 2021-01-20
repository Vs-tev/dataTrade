<template>
     <div class="downbar">
        <div class="down-left d-flex justify-content-start" >
            <ul class="list-unstyled" v-if="spinner">
                <li class="font-500 font-lg dark"><span>{{portfolio.name}}:</span></li>
                <li class="font-lg"><span>{{portfolio.current_balance}}</span>
                <span>{{portfolio.currency}}/</span>
                </li>
                <li class="font-lg"><span class="font-500">Return: </span>
                <span :class="{'red' : rci < 0}">{{rci}}%</span>
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
      return (
        ((this.portfolio.current_balance - this.portfolio.start_equity) /
          this.portfolio.start_equity || 0) * 100
      ).toFixed(2);
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