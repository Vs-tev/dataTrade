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
                <div class="col-12 p-3 dashboard_container_content p-0 h-100">
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
        <div class="mx-0 p-0 mt-5">
            <!-- Tabs -->
            <div class="col-12 pt-3 dashboard_container_content p-0">
                <ul class="nav nav-tabs justify-content-center border-0" role="tablist"> 
                    <li class="nav-item text-dark"><a href="#all" class="nav-link active font-lg mx-4 px-2 pb-3" role="tab" data-toggle="tab" aria-selected="true">ALL</a></li>
                    <li class="nav-item"><a href="#buy" class="nav-link font-lg mx-4 px-2 pb-3" role="tab" data-toggle="tab" aria-selected="true">BUY</a></li>
                    <li class="nav-item"><a href="#sell" class="nav-link font-lg mx-4 px-2 pb-3" role="tab" data-toggle="tab" aria-selected="true">SELL</a></li>
                </ul>
            </div> 
            <div class="row mt-3 mb-5">

                <!-- Trades -->
                <div class="col-md-6">
                    <div class="col-12 dashboard_container_content p-0">
                        <div class="d-flex justify-content-between align-items-center  font-500 h4 text-capitalize font-weight-normal m-0 border-bottom px-4 py-3">
                            <h4 class="p-0 m-0">
                                Trades
                            </h4>
                            <div class="">
                                <button type="button" class="btn btn-link text-muted border-0 dropdown-toggle" data-toggle="dropdown">Period </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">All ime</a>
                                    <a class="dropdown-item" href="#">1 Day</a>
                                    <a class="dropdown-item" href="#">7 Days</a>
                                    <a class="dropdown-item" href="#">30 Days</a>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush px-1">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Total Recorded Trades
                                        </div>
                                        <div class="text-muted font-normal">
                                            last 7 days: 4 trades
                                        </div>
                                    </div>
                                    <div class="h3 font-500 text-dark">
                                        148 <span class="text-muted font-500 font-sm">Trades</span>
                                    </div>
                                </div>
                            </li>
                             <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Winners
                                        </div>
                                        <div class="text-muted font-normal">
                                            last 7 days: 2 winners
                                        </div>
                                    </div>
                                    <div class="h3 font-500 text-success">
                                        148 <span class="text-muted font-500 font-sm">Trades</span>
                                    </div>
                                </div>
                            </li>
                             <li class="list-group-item border-bottom">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Losers
                                        </div>
                                        <div class="text-muted font-normal">
                                            last 7 days: 2 Losers
                                        </div>
                                    </div>
                                    <div class="h3 font-500 text-danger">
                                        33 <span class="text-muted font-500 font-sm">Trades</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item  py-1">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize text-dark font-lg">
                                        <div class="primary-color font-weight-bold font-xl">
                                            Win Rate
                                        </div>
                                       
                                    </div>
                                    <div class="w-15">
                                        <apexchart type="radialBar" class="text-right" height="75" :options="sparklinechart" :series="[25]"></apexchart>
                                    </div>
                                </div>
                            </li>
                            
                           
                        </ul>
                    </div>
                </div>

                <!-- Profit -->
                <div class="col-md-6">
                     <div class="col-12 dashboard_container_content p-0">
                        <div class="d-flex justify-content-between align-items-center  font-500 h4 text-capitalize font-weight-normal m-0 border-bottom px-4 py-3">
                            <h4 class="p-0 m-0">
                                Profit
                            </h4>
                            <div class="">
                                <button type="button" class="btn btn-link text-muted border-0 dropdown-toggle" data-toggle="dropdown">Period </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">All ime</a>
                                    <a class="dropdown-item" href="#">1 Day</a>
                                    <a class="dropdown-item" href="#">7 Days</a>
                                    <a class="dropdown-item" href="#">30 Days</a>
                                </div>
                            </div>
                        </div>
                       <ul class="list-group list-group-flush px-1">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Gross Profit
                                        </div>
                                        <div class="text-muted font-normal">
                                            last 7 days: 4 trades
                                        </div>
                                    </div>
                                    <div class="h4 font-500 text-dark">
                                        1248.21 EUR
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
                                    <div class="h4 font-500 text-danger">
                                       688.47 EUR
                                    </div>
                                </div>
                            </li>
                             <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                                    <div class="primary-color font-500 font-lg">
                                        Profit Factor
                                    </div>
                                    <div class="h4 font-500 text-dark">
                                        2.56
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                                    <div class="primary-color font-500 font-lg">
                                         Average Trade Profit
                                    </div>
                                    <div class="h4 font-500">
                                       52.75 EUR
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                                    <div class="primary-color font-500 font-lg">
                                         Winning Average
                                    </div>
                                    <div class="h4 font-500">
                                         212.38 EUR <span class="text-muted font-normal">(2.09 %) (2.6 Pips)</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                                    <div class="primary-color font-500 font-lg">
                                         Losing Average
                                    </div>
                                    <div class="h4 font-500 text-danger">
                                         -84.13 EUR <span class="font-normal">(-0.82 %) (-0.3 Pips)</span>
                                    </div>
                                </div>
                            </li>
                          
                           
                        </ul>
                    </div>
                </div>

                <!--Trade Duration -->
                <div class="col-md-6 mt-3">
                    <div class="col-12 dashboard_container_content p-0">
                        <div class="font-500 h4 text-capitalize font-weight-normal m-0 border-bottom px-4 py-3">
                            <h4 class="p-0 m-0">
                                Trade Duration
                            </h4>
                            
                        </div>
                       <ul class="list-group list-group-flush px-1">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Duration Average
                                        </div>
                                        
                                    </div>
                                   <div class="font-lg font-500 text-muted">
                                        1 day / 3h / 15 min
                                    </div>
                                </div>
                            </li>
                             <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Winning Duration Average
                                        </div>
                                       
                                    </div>
                                    <div class="font-lg font-500 text-muted">
                                        1 day / 3h / 15 min
                                    </div>
                                </div>
                            </li>
                             <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0 text-capitalize primary-color font-500 font-lg">
                                    <div class="primary-color font-500 font-lg">
                                        Losing Duration Average
                                    </div>
                                    <div class="font-lg font-500 text-muted">
                                        1 day / 3h / 15 min
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--Miscelaneous-->
                <div class="col-md-6 mt-3">
                    <div class="col-12 dashboard_container_content p-0 p-0">
                        <div class="font-500 h4 text-capitalize font-weight-normal m-0 border-bottom px-4 py-3">
                            <h4 class="p-0 m-0">
                                Miscelaneous 
                            </h4>
                        </div>
                        <ul class="list-group list-group-flush px-1">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Biggest Win
                                        </div>
                                        <div class="text-muted font-normal">
                                            last 7 days: 2 Losers
                                        </div>
                                        
                                    </div>
                                    <div class="font-lg font-500">
                                            260 EUR
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Biggest Los
                                        </div>
                                    
                                    </div>
                                    <div class="font-lg font-500 text-danger">
                                        -180 EUR
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Best winning streak
                                        </div>
                                    </div>
                                    <div class="font-lg font-500">
                                            4 <span class="text-muted font-500 font-sm">Trades</span>
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
                                            8 <span class="text-muted font-500 font-sm">Trades</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center p-0">
                                    <div class="text-capitalize primary-color font-lg">
                                        <div class="primary-color font-500 font-lg">
                                            Av. Risk Rewar Ratio
                                        </div>
                                    </div>
                                    <div class="font-lg font-500">
                                        3.25
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
                                        1.52%
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
                                        1.89%
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
           
        </div>
           
    </div>  
</template>
<script>
import DonutChart from "./DonutChart.vue";
import AreaChart from "./AreaChart.vue";
import Multiselect from "vue-multiselect";

export default {
  name: "TradeAnalysis",
  components: {
    AreaChart,
    DonutChart,
    Multiselect,
  },

  props: ["portfolios"],
  data() {
    return {
      selectedPortfolio: this.$props.portfolios[0],
      portfolio: "",
      spinner: true,
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
              size: "70%",
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
              strokeWidth: "75%",
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
                show: false,
              },
              value: {
                offsetY: 4,
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
                return "#f80303e3";
              } else {
                if (value <= 49) {
                  return "#6575cdfa";
                } else {
                  return "#0160be";
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
      },
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


