<template>
<div class="mx-0 p-0 mt-5">
    <!-- Tabs -->
    <div class="col-12 pt-3 d-flex justify-content-center dashboard_container_content p-0">
        <ul class="nav nav-tabs justify-content-center border-0" role="tablist"> 
            <li class="nav-item"><button class="nav-link bg-transparent text-dark font-500 active font-lg mx-4 px-2 pb-3" @click="setSide('all')" role="tab" data-toggle="tab" aria-selected="true">ALL</button></li>
            <li class="nav-item"><button class="nav-link bg-transparent text-dark font-500 font-lg mx-4 px-2 pb-3" @click="setSide('buy')" role="tab" data-toggle="tab" aria-selected="true">BUY</button></li>
            <li class="nav-item"><button class="nav-link bg-transparent text-dark font-500 font-lg mx-4 px-2 pb-3" @click="setSide('sell')" role="tab" data-toggle="tab" aria-selected="true">SELL</button></li>
        </ul>
        <div class="">
            <button type="button" class="btn btn-link font-lg pt-2 text-muted border-0 font-500 dropdown-toggle" data-toggle="dropdown">Period 
                <span class="lighter px-2 underline">{{period_text}} </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item" @click="setPeriod('all_time', 'All Time')">All Time</button>
                <button class="dropdown-item" @click="setPeriod('day', 'Today')">Today</button>
                <button class="dropdown-item" @click="setPeriod('week' , '7 Days')">7 Days</button>
                <button class="dropdown-item" @click="setPeriod('month', '30 Days')">30 Days</button>
            </div>
        </div>
    </div> 
    <div class="row align-items-center">
        <!-- Trades Monitoring -->
        <div class="col-md-4">
            <div class="col-12 dashboard_container_content p-0" >
                <div class="font-500 h4 d-flex align-items-center text-capitalize font-weight-normal m-0 border-bottom p-4">
                    <div class="font-500 h4 text-capitalize font-weight-normal m-0 text-nowrap">
                        Trades Monitoring
                    </div>
                    <span class="text-white rounded-pill ml-2 font-500 py-1 px-2 font-normal bg-lighter">{{period_text}}</span>
                    
                </div>
                <ul class="list-group list-group-flush px-1">
                     <li class="list-group-item py-1">
                        <div class="d-block d-lg-flex justify-content-start align-items-center py-2">
                             <div class="w-50">
                                <sparkline-donut-chart :winrate="winrate"></sparkline-donut-chart>
                            </div>
                            <div class="ml-3">
                                <div class="font-lg font-weight-normal lighter">
                                    Profit
                                </div>
                                <div class="h2 font-weight-bold primary-color text-nowrap" v-if="response.current_balance">
                                    <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}:</span>
                                    <span :class="response.current_balance < 0 ? 'red': '' ">{{response.current_balance}}</span> 
                                </div>
                                <div class="h2" v-else>
                                    0.00 
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Total Recorded Trades
                                </div>
                              
                            </div>
                            <div class="font-lg font-500 text-dark">
                                {{response.total_trades}} <span class="text-muted font-500 font-sm">Trades</span>
                            </div>
                        </div>
                    </li>
                        <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Winners
                                </div>
                               
                            </div>
                            <div class="font-lg font-500 text-success">
                                {{response.winning_trades}} <span class="text-muted font-500 font-sm">Trades</span>
                            </div>
                        </div>
                    </li>
                        <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Losers
                                </div>
                               
                            </div>
                            <div class="font-lg font-500 text-danger">
                                {{response.losing_trades}} 
                                <span class="text-muted font-500 font-sm">Trades</span>
                            </div>
                        </div>
                    </li>
                   
                </ul>
            </div>
           
        </div>

        <!-- Profit -->
        <div class="col-md-4">
            <div class="col-12 dashboard_container_content p-0">
                <div class="font-500 h4 d-flex align-items-center text-capitalize font-weight-normal m-0 border-bottom p-4">
                    Profit
                    <span class="text-white rounded-pill ml-2 font-500 py-1 px-2 font-normal bg-lighter">{{period_text}}</span>
                </div>
                <ul class="list-group list-group-flush px-1">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Gross Profit
                                </div>
                        
                            </div>
                            <div class="font-lg font-500 text-dark" >
                                {{response_profit_data.gross_profit}} <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}</span>
                            </div>
                        </div>
                    </li>
                        <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Gross Loss
                                </div>
                        
                            </div>
                            <div class="font-lg font-500 text-danger">
                                {{response_profit_data.gross_loss}} <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}</span>
                            </div>
                        </div>
                    </li>
                        <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Profit Factor
                                </div>
                        
                            </div>
                            <div class="font-lg font-500 text-dark">
                            {{response_profit_data.profit_factor}}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                            <div class="text-capitalize primary-color font-lg">
                            <div class="primary-color font-500 font-lg">
                                Trade Profit Average
                            </div>
                            <div class="text-muted font-normal ">
                                    
                            </div>
                            </div>
                            <div class="font-lg font-500 text-nowrap text-truncate" :class="response_profit_data.av_trade_profit < 0 ? 'red': '' ">
                                {{response_profit_data.av_trade_profit}} <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}</span>
                                <span class="text-muted font-normal">({{response_profit_data.avg_return}}%)</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                            <div class="text-capitalize primary-color font-lg">
                            <div class="primary-color font-500 font-lg">
                                    Winning Average
                            </div>
                    
                            </div>
                            <div class="font-lg font-500">
                                {{response_profit_data.avg_winning_trade}} <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}</span>
                                  <span class="text-muted font-normal">({{response_profit_data.avg_winning_return}}%)</span>  
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                            <div class="text-capitalize primary-color font-lg">
                            <div class="primary-color font-500 font-lg">
                                    Losing Average
                            </div>
                    
                            </div>
                            <div class="font-lg font-500 text-danger">
                                {{response_profit_data.avg_losing_trade}} <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}</span>   
                                <span class="text-muted font-normal">({{response_profit_data.avg_losing_return}}%)</span>
                            </div>
                        </div>
                    </li>
                     <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Biggest Win
                                </div>
                               
                                
                            </div>
                            <div class="font-lg font-500" v-if="response_profit_data.biggest_win !== null">
                                    {{response_profit_data.biggest_win}} <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}</span>
                            </div>
                            <div class="font-lg font-500" v-else>No Trades</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Biggest Loss
                                </div>
                            
                            </div>
                            <div class="font-lg font-500 text-danger" v-if="response_profit_data.biggest_loss !== null">
                               {{response_profit_data.biggest_loss}} <span v-if="response_profit_data.portfolio">{{response_profit_data.portfolio.currency}}</span>
                            </div>
                             <div class="font-lg font-500" v-else>No Trades</div>
                        </div>
                    </li>        
                </ul>
            </div>
        </div>
        
        <!--Trade Duration -->
        <div class="col-md-4">
            <div class="col-12 dashboard_container_content p-0">
                <div class="font-500 h4 d-flex align-items-center text-capitalize font-weight-normal m-0 border-bottom p-4 text-nowrap">
                    Trade Duration 
                    <span class="text-white rounded-pill ml-2 font-500 py-1 px-2 font-normal bg-lighter">{{period_text}}</span>
                </div>
                <ul class="list-group list-group-flush px-1">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Trades Duration Average
                                </div>
                                
                            </div>
                            <div class="font-lg font-500 text-dark">
                                {{response.duration_avg}}
                            </div>
                        </div>
                    </li>
                        <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg ">
                                    Winning Trades Duration Avg.
                                </div>
                                
                            </div>
                            <div class="font-lg font-500">
                                {{response.winning_duration_avg}}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                            <div class="primary-color font-500 font-lg">
                                Losing Trades Duration Avg.
                            </div>
                            <div class="font-lg font-500">
                                {{response.losing_duration_avg}}
                            </div>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>

    <!--Miscelaneous-->
    <div class="row mb-5">
        <div class="col-12 my-3">
            <h3 class="text-muted" ref="miscelaneous">Miscelaneous</h3>     
        </div>

        <div class="col-md-5">
             <div class="dashboard_container_content" v-if="!miscelaneous_response">
                <skeletion-box :minWidth="100" :height="'1.5em'" class="rounded-sm my-2"></skeletion-box>
                <skeletion-box :minWidth="100" :height="'1.5em'" class="rounded-sm my-2"></skeletion-box>
                <skeletion-box :minWidth="100" :height="'1.5em'" class="rounded-sm my-2"></skeletion-box>
                <skeletion-box :minWidth="100" :height="'1.5em'" class="rounded-sm my-2"></skeletion-box>
            </div>
            <div class="col-12 dashboard_container_content p-0 p-0" v-else>
                <ul class="list-group list-group-flush px-1">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Best winning streak
                                </div>
                            </div>
                            <div class="font-lg font-500">
                                    {{miscelaneous_response.winning_streak}} <span class="text-muted font-500 font-sm">Trades</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Worst Losing Streak
                                </div>
                            </div>
                            <div class="font-lg font-500">
                                    {{miscelaneous_response.losing_streak}} <span class="text-muted font-500 font-sm">Trades</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                     Risk Rewar Ratio Avg.
                                </div>
                            </div>
                            <div class="font-lg font-500" v-if="miscelaneous_response.trade_performance_avg_ratio">
                                {{miscelaneous_response.trade_performance_avg_ratio}}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Expected Trade Return
                                </div>
                            </div>
                            <div class="font-lg font-500">
                               {{response_profit_data.avg_return}}%
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center p-0">
                            <div class="text-capitalize primary-color font-lg">
                                <div class="primary-color font-500 font-lg">
                                    Standart deviation
                                </div>
                            </div>
                            <div class="font-lg font-500">
                                {{miscelaneous_response.standart_deviation}}%
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-12 dashboard_container_content pt-3 pb-1">
                <bar-chart-symbols v-if="timeFrameFrequence" :color="'#3ac47d'" :title="'Trades by Time Frame'" :barChartdata="timeFrameFrequence"  :height="280"></bar-chart-symbols>
                <skeletion-bar-chart v-if="!timeFrameFrequence"></skeletion-bar-chart>
            </div>
        </div>

        <div class="col-md-7">
           
            <div class="col-12 dashboard_container_content pt-3 pb-1" >
                <bar-chart-symbols v-if="barChartdata" :color="'#49a3ff'" :title="'Most Traded Symbols'" :barChartdata="barChartdata" :height="360"></bar-chart-symbols>
                 <skeletion-bar-chart v-if="!barChartdata"></skeletion-bar-chart>
            </div>
            <div class="d-md-flex">
                <div class="col-md-4 px-0 pr-md-3">

                    <div class="dashboard_container_content" v-if="!usedFeatures">
                        <skeletion-box class="rounded-sm my-2"></skeletion-box>
                        <skeletion-box class="rounded-sm my-2"></skeletion-box>
                    </div>
                    <div class="col-12 dashboard_container_content p-3" v-if="usedFeatures">
                         <div class="h5 text-muted font-weight-light"> Trades used <a href="/dashboardPages/strategy">Strategy</a></div>
                        <div class="d-flex justify-content-between items-content-center pt-3">
                            <div class="h2 m-0 font-weight-light ">{{usedFeatures.withStrategy}} <span class="h5 text-muted" v-html="usedFeatures.withStrategy > 1 ? ' Trades': ' Trade' "></span></div>
                            <div class="my-auto"><a href="/trading_setups_analysis">Deteils</a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 px-0 px-md-2">
                    <div class="dashboard_container_content" v-if="!usedFeatures">
                        <skeletion-box class="rounded-sm my-2"></skeletion-box>
                        <skeletion-box class="rounded-sm my-2"></skeletion-box>
                    </div>
                    <div class="col-12 dashboard_container_content p-3" v-if="usedFeatures">
                    <div class="h5 text-muted font-weight-light"> Trades with <a href="/dashboardPages/tradingrules">Entry Rules</a></div>
                        <div class="d-flex justify-content-between items-content-center pt-3">
                            <div class="h2 m-0 font-weight-light ">{{usedFeatures.entryRules}}<span class="h5 text-muted" v-html="usedFeatures.entryRules > 1 ? ' Trades': ' Trade' "></span></div>
                            <div class="my-auto"><a href="trading_setups_analysis">Deteils</a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 px-0 pl-md-3">
                    <div class="dashboard_container_content" v-if="!usedFeatures">
                        <skeletion-box class="rounded-sm my-2"></skeletion-box>
                        <skeletion-box class="rounded-sm my-2"></skeletion-box>
                    </div>
                    <div class="col-12 dashboard_container_content p-3" v-if="usedFeatures">
                     <div class="h5 text-muted font-weight-light"> Trades with <a href="/dashboardPages/tradingrules">Exit Reason Rule</a></div>
                        <div class="d-flex justify-content-between items-content-center pt-3">
                            <div class="h2 m-0 font-weight-light ">{{usedFeatures.withExitReason}}<span class="h5 text-muted" v-html="usedFeatures.withExitReason > 1 ? ' Trades': ' Trade' "></span></div>
                            <div class="my-auto"><a href="trading_setups_analysis">Deteils</a> </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
           
</div>
</template>
<script>
import SkeletionBarChart from "../Skeletion/SkeletionBarChart.vue";
import SkeletionBox from "../Skeletion/SkeletionBox.vue";
import BarChartSymbols from "./BarChartSymbols.vue";
import SparklineDonutChart from "./SparklineDonutChart.vue";
export default {
  components: {
    SparklineDonutChart,
    BarChartSymbols,
    SkeletionBox,
    SkeletionBarChart,
  },
  name: "TradeMonitoring",
  props: ["selectedPortfolio"],

  data() {
    return {
      side: "all",
      period: "all_time",
      period_text: "All Time",
      response: [],
      response_profit_data: [],

      miscelaneous_response: null,
      barChartdata: null,
      timeFrameFrequence: null,
      usedFeatures: null,

      queriedMiscelaneous_response: false,
      queriedBarChartdata: false,
      queriedTimeFrameFrequence: false,
      queriedUsedFeatures: false,
    };
  },
  computed: {
    winrate() {
      return [this.response.winrate];
    },
  },

  watch: {
    selectedPortfolio: function (newPortfolio, oldPortfolio) {
      if (newPortfolio) {
        this.setPeriod(this.period, this.period_text);
        this.queriedMiscelaneous_response = false;
        this.miscelaneous();

        this.queriedBarChartdata = false;
        this.mostTradedSymbols();

        this.queriedTimeFrameFrequence = false;
        this.timeFrameTrades();

        this.queriedUsedFeatures = false;
        this.tradesUsedFeatures();
      }
    },
  },

  mounted() {
    this.setPeriod(this.period, this.period_text);
    this.$nextTick(function () {
      window.addEventListener("scroll", this.onScroll);
      this.onScroll(); // needed for initial loading on page
    });
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.onScroll);
  },

  methods: {
    onScroll() {
      var miscelaneousHeading = this.$refs["miscelaneous"];
      if (miscelaneousHeading) {
        var marginTop = miscelaneousHeading.getBoundingClientRect().top;
        var innerHeight = window.innerHeight;

        if (marginTop - innerHeight < -50) {
          this.mostTradedSymbols();
          this.timeFrameTrades();
          this.tradesUsedFeatures();
          this.miscelaneous();
        }
      }
    },

    setPeriod(period, text) {
      if (period || text) {
        this.period = period;
        this.period_text = text;
      }
      this.getTradeMonitoringData();
      this.getProfitData();
    },

    setSide(type) {
      this.side = type;
      this.setPeriod(this.period, this.period_text);
    },

    getTradeMonitoringData() {
      axios
        .get(
          "/tradeAnalysis/TradesMonitoring/" +
            this.$props.selectedPortfolio +
            "/" +
            this.period +
            "/" +
            this.side
        )
        .then((res) => {
          this.response = res.data[0];
        })
        .catch((error) => {});
    },

    getProfitData() {
      axios
        .get(
          "/tradeAnalysis/Profit/" +
            this.$props.selectedPortfolio +
            "/" +
            this.period +
            "/" +
            this.side
        )
        .then((res) => {
          this.response_profit_data = res.data[0];
        })
        .catch((error) => {});
    },

    miscelaneous() {
      if (!this.queriedMiscelaneous_response) {
        this.queriedMiscelaneous_response = true;
        axios
          .get(
            "/tradeAnalysis/Miscelaneous/" +
              this.$props.selectedPortfolio +
              "/" +
              this.side
          )
          .then((res) => {
            this.miscelaneous_response = res.data[0];
          })
          .catch((error) => {});
      }
    },

    mostTradedSymbols() {
      if (!this.queriedBarChartdata) {
        this.queriedBarChartdata = true;
        axios
          .get(
            "/tradeAnalysis/MostTradedSymbols/" + this.$props.selectedPortfolio
          )
          .then((res) => {
            this.barChartdata = res.data;
          })
          .catch((error) => {});
      }
    },

    timeFrameTrades() {
      if (!this.queriedTimeFrameFrequence) {
        this.queriedTimeFrameFrequence = true;
        axios
          .get(
            "/tradeAnalysis/timeFrameFrequence/" + this.$props.selectedPortfolio
          )
          .then((res) => {
            this.timeFrameFrequence = res.data;
          })
          .catch((error) => {});
      }
    },

    tradesUsedFeatures() {
      if (!this.queriedUsedFeatures) {
        this.queriedUsedFeatures = true;
        axios
          .get(
            "/tradeAnalysis/tradesUsedFeatures/" + this.$props.selectedPortfolio
          )
          .then((res) => {
            this.usedFeatures = res.data[0];
          })
          .catch((error) => {});
      }
    },
  },
};
</script>