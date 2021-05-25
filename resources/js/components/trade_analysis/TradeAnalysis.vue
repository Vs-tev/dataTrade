<template>
    <div class="content-container pt-0 ">
        <div class="mb-3 col-12 dashboard_container_content p-0">
            <div class="d-flex justify-content-between align-items-center border-bottom px-4 py-3">
                <div class="font-500 h4 text-capitalize font-weight-normal m-0 ">
                    Portfolio Performance 
                </div>
              
                <multiselect class="w-25" @input="getActivePortfolio()" v-model="selectedPortfolio" :preselect-first="true" :options="portfolios" :searchable="false" 
                        :close-on-select="true" :allow-empty="false"  :show-labels="false" label="name" track-by="id">
                </multiselect>
                
            </div>
            <div class="no-gutters row justify-content-between align-items-start" v-if="!spinner">
                <div class="col-sm-6 col-xl-2 px-4 py-3">
                    <div class="text-left">
                        <div class="">
                            <div class="text-capitalize text-muted font-lg">Start Capital</div>
                            <div class="h2 font-weight-bold text-dark text-uppercase">{{portfolio.start_equity}} {{portfolio.currency}}</div>
                            <div class="text-muted font-500">
                                Opening Date
                                <div class="d-inline text-primary pr-1">
                                    <span class="pl-1">{{portfolio.action_date}}</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 px-4 py-3">
                    <div class="text-left">
                        <div class="">
                            <div class="text-capitalize text-muted font-lg">Balance</div>
                            <div class="h2 font-weight-bold text-dark">{{portfolio.current_balance}} {{portfolio.currency}}</div>
                            <div class="text-muted font-500">
                                <div class="d-inline text-primary pr-1">
                                    <span class="pl-1" :class="{'red' : portfolio.return_capital_investment < 0}">{{portfolio.return_capital_investment}}%</span>
                                </div>
                                Rate of Return
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="col-sm-6 col-xl-2 px-4 py-3">
                    <div class="text-left">
                        <div class="">
                            <div class="text-capitalize text-muted font-lg">Total Net Profit</div>
                            <div class="h2 font-weight-bold " :class="portfolio.netProfit < 0 ? 'red' : 'text-dark' ">{{portfolio.netProfit}} EUR</div>
                            <div class="text-muted font-500">
                            <div class="d-inline text-primary pr-1">
                                <span class="pl-1" :class="{'red' : portfolio.trade_profit < 0}">{{portfolio.trade_profit}} Eur</span>
                            </div>
                            Trade Profit
                        </div>
                        </div>
                    </div>
                
                </div>
                <div class="col-sm-6 col-xl-2 px-4 py-3">
                    <div class="text-left">
                        <div class="">
                            <div class="text-capitalize text-muted font-lg">Gained Pips</div>
                            <div class="h2 font-weight-bold" :class="portfolio.gained_pisp < 0 ? 'red' : 'text-dark' ">{{portfolio.gained_pisp}}</div>
                            
                        </div>
                    </div>  
                </div>
            </div>
            <div v-else>
                <ul class="list-unstyled">
                <li class="text-center py-4">
                    <div class="spinner-border text-primary"></div>
                </li>
            </ul> 
            </div>
           
        </div>

        <div class="row mx-0 p-0 mt-3">
            <!-- chart -->
            <div class="col-md-9 pl-0">
                <div class="col-12 p-3 dashboard_container_content h-100">
                    <area-chart v-if="portfolio" :portfolio="portfolio"></area-chart>
                </div>
            </div>

            <!-- win rate-->
            <div class="col-md-3 pr-0"> 
                <div class="dashboard_container_content p-0 h-100">
                    <div class="w-100 pt-5">
                        <donut-chart :data="winrate" class="m-auto"></donut-chart>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between ">
                                <div class="h3 text-dark">
                                  {{losingrate}}%
                                </div>
                                <div class="text-muted font-lg">
                                    Losing Rate
                                </div>
                            </div>
                            <div class="progress h-12">
                                <div class="progress-bar bg-danger h-12" role="progressbar" :aria-valuenow="losingrate"
                                    aria-valuemin="0" aria-valuemax="100" :style="{'width' : losingrate+'%'}">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- Performance data -->
        
        <!-- Trades Monitoring-->
        <trades-monitoring :winrate="winrate" :selectedPortfolio="selectedPortfolio.id"></trades-monitoring>

        
           
    </div>  
</template>
<script>
import DonutChart from "./DonutChart.vue";
import AreaChart from "./AreaChart.vue";
import Multiselect from "vue-multiselect";
import TradesMonitoring from "./TradesMonitoring.vue";

export default {
  name: "TradeAnalysis",
  components: {
    AreaChart,
    DonutChart,
    Multiselect,
    TradesMonitoring,
  },

  props: ["portfolios"],
  data() {
    return {
      selectedPortfolio: this.$props.portfolios[0],
      portfolio: "",
      spinner: true,
    };
  },
  mounted() {
    this.getActivePortfolio();
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
    losingrate() {
      return (
        (this.portfolio.losing_trades / this.portfolio.total_trades || 0) * 100
      ).toFixed(2);
    },
  },

  methods: {
    getActivePortfolio() {
      axios
        .get("/tradeAnalysis/portfolioData/" + this.selectedPortfolio.id)
        .then((res) => {
          // console.log(res.data);
          this.portfolio = res.data[0];
          this.spinner = false;
        })
        .catch((error) => {});
    },
  },
};
</script>


