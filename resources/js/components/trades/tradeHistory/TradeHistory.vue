<template>

    <div class="content-container">
        <sorting-trades :portfolios="portfolios" v-on:change_portfolio="change_portfolio($event)"
            v-on:sort_by_profit="sort_by_profit($event)" v-on:searchDateRange="searchDateRange($event)">
        </sorting-trades>
        <section class="dashboard_container_content">


            <div class="d-sm-flex my-3">
                <div class="form-group align-items-center mr-auto">
                    <input @keyup="get_trades" v-model="search_symbol" type="text" class="form-control search-input"
                        name="text" placeholder="Search symbol">
                    <span class="material-icons font-sm icon-sm search-i">search</span>
                </div>
                <div class="d-flex align-items-center pl-1 pr-4 mt-3 mt-sm-0">
                    <label class="lighter pr-1">Display</label>
                    <div>
                        <select @change="get_trades" v-model="show_per_page" class="form-control sort_by_profit">
                            <option value="10" selected="selected">10</option>
                            <option value="20">25</option>
                            <option value="50">50</option>
                            <option value="100">50</option>
                        </select>
                    </div>
                </div>
                <div class="form-group pr-4 mt-3 mt-sm-0">
                    <div class="dropdown ">
                        <button type="button" class="btn btn-secondary" data-toggle="dropdown">
                            <span class="material-icons cyan mr-1">
                                view_agenda
                            </span>
                            View
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <h5 class="dropdown-header indigo">CHOOSE VIEW</h5>
                            <a class="dropdown-item" id="choose-table-view" href="#"><span
                                    class="material-icons lighter icon-sm">
                                    toc
                                </span>Table</a>
                            <a class="dropdown-item" id="choose-largerow-view" href="#"><span
                                    class="material-icons lighter icon-sm">
                                    calendar_view_day
                                </span>Large Row</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown mt-3 mt-sm-0">
                    <button type="button" class="btn btn-primary float-md-right" data-toggle="dropdown">
                        <span class="material-icons white mr-1">description</span>Export
                    </button>
                    <div class="dropdown-menu dropdown-menu-left">
                        <h5 class="dropdown-header indigo">OPTIONS</h5>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">PDF</a>
                        <a class="dropdown-item" href="#">Email</a>
                    </div>
                </div>
            </div>
            <div class="col px-0 px-md-3">
                <div class="row p-0 justify-content-start" id="table-view" style="display:none">
                    <table class="table table-sm table-hover">
                        <thead class="">
                            <tr>
                                <th class="" @click="sort('symbol')">Symbol <span class="unicode-arrow">&#8645;</span>
                                </th>
                                <th>
                                    <div class="d-none d-md-block" @click="sort('quantity')">Quantity <span
                                            class="unicode-arrow">&#8645;</span></div>
                                </th>
                                <th>
                                    <div class="d-none d-md-block">Type side<span class="unicode-arrow">&#8645;</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="d-none d-md-block">Fees</div>
                                </th>
                                <th>
                                    <div class="d-none d-md-block" @click="sort('entry_price')">Entry price <span
                                            class="unicode-arrow">&#8645;</span></div>
                                </th>
                                <th>
                                    <div class="d-none d-md-block" @click="sort('exit_price')">Exit price <span
                                            class="unicode-arrow">&#8645;</span></div>
                                </th>
                                <th>
                                    <div class="d-none d-md-block" @click="sort('stop_loss_price')">Sl price <span
                                            class="unicode-arrow">&#8645;</span></div>
                                </th>
                                <th>
                                    <div class="d-none d-md-block" @click="sort('entry_date')">Entry date <span
                                            class="unicode-arrow">&#8645;</span></div>
                                </th>
                                <th>
                                    <div class="d-none d-md-block" @click="sort('exit_date')">Exit date <span
                                            class="unicode-arrow">&#8645;</span></div>
                                </th>
                                <th class="" @click="sort('pl_currency')">Profit <span
                                        class="unicode-arrow">&#8645;</span></th>
                                <th class="">Actions <span class="unicode-arrow"></span></th>
                            </tr>
                        </thead>
                        <tbody v-if="loading">
                            <tr>
                                <td colspan="10" class="text-center p-5">
                                    <div class="spinner-border lighter"></div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr v-for="trade in trades" :key="trade.id">
                                <td class="font-500">{{trade.symbol}} &#8226; <span
                                        class="dark font-500">{{trade.time_frame}}</span></td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.quantity}}</div>
                                </td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.type_side}}</div>
                                </td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.fees}} {{trade.portfolio.currency}}</div>
                                </td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.entry_price}}</div>
                                </td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.exit_price}}</div>
                                </td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.stop_loss_price}}</div>
                                </td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.entry_date}}</div>
                                </td>
                                <td>
                                    <div class="d-none d-md-block">{{trade.exit_date}}</div>
                                </td>
                                <td class="">
                                    <span :class="trade.pl_currency < 0 ?'red' : 'primary' ">{{trade.pl_currency}}
                                        {{trade.portfolio.currency}} |</span>
                                    <span :class="trade.pl_pips < 0 ? 'red': 'primary' "
                                        v-html="trade.pl_pips + ' pips' "></span>
                                </td>
                                <td class="">
                                    <div class="d-flex">
                                        <button class="btn mr-3"><span
                                                class="material-icons close-trade-deteils">visibility</span></button>
                                        <button type="button" @click="deleteTrade(trade)" class="btn"
                                            data-target="#modal_delete_trade" data-toggle="modal"><span
                                                class="material-icons">delete</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="!loading">
                    <div class="row p-0 my-4 shadow border rounded" v-for="trade in trades" :key="trade.id" id="large-row-view" style="display">
                        <div class="d-flex align-items-center w-100">
                            <div class="p-3 ">
                                <img :src="'/storage/trades/'+ trade.trade_img" alt="" style="height: 210px; width: 230px">
                            </div>
                            <div class="py-3 pl-0">
                                <div class="">
                                    <h4 class="font-weight-bold m-0">{{trade.symbol}}, <span class="font-lg">{{trade.time_frame}} / {{trade.type_side}} &#8226;
                                            {{trade.quantity}}</span></h4>
                                    <p class="font-weight-bolder lighter pb-1"> {{trade.pl_currency}} {{trade.portfolio ? trade.portfolio.currency : ''}} / {{trade.pl_pips}} pips / -0.98 % </p>
                                    <div class="pb-3 d-flex">
                                        <p class="font-weight-bold m-0 width-50px">Used Strategy: </p>
                                        <span class="badge badge-light ml-1 text-muted">{{trade.strategy ? trade.strategy.name : ''}}</span>
                                    </div>
                                    <div class="pb-3 d-flex">
                                        <p class="font-weight-bold m-0 width-50px">Entry rules: </p>
                                        <div v-if="trade.used_entry_rules">
                                            <span class="badge badge-light text-muted ml-1 mb-1 mb-xl-0" v-for="(rule, index) in trade.used_entry_rules" :key="index">{{rule.entry_rule.name}}</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="">
                                    <p class="m-0 font-weight-bold ">Trade note:</p>
                                    <div class="trade-note-div">
                                        <p class="m-0 .text-wrap" v-html="trade.trade_notes"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-trade ml-auto">
                                <div class="timeline p-3">
                                    <div class="timeline-item pt-0 pb-4">
                                        <div class="timeline-label font-weight-bolder">
                                            <p class="font-weight-normal text-muted m-0">Entry date:</p>
                                            {{trade.entry_date}}
                                        </div>
                                        <div class="timeline-badge">
                                            <span class="material-icons primary">trip_origin</span>
                                        </div>
                                        <div class="font-weight-mormal text-muted text-nowrap timeline-content pl-2">
                                            <span class="font-weight-bolder text-nowrap">Entry price: {{trade.entry_price}} </span>

                                        </div>
                                    </div>

                                    <div class="timeline-item py-2">
                                        <div class="timeline-label font-weight-bolder text-dark-75">
                                            <p class="font-weight-normal text-muted m-0">Duration:</p>
                                        {{duration(trade.entry_date, trade.exit_date)}}
                                        </div>
                                        <div class="timeline-badge">
                                            <span class="material-icons primary">trip_origin</span>
                                        </div>
                                        <div class="timeline-content pl-2 text-muted">
                                            <span class="font-weight-bolder text-nowrap">SL price: {{trade.stop_loss_price}} </span>

                                        </div>
                                    </div>

                                    <div class="timeline-item pb-0 pt-4">
                                        <div class="timeline-label font-weight-bolder">
                                            <p class="font-weight-normal text-muted m-0">Exit date:</p>
                                            {{trade.exit_date}}
                                        </div>
                                        <div class="timeline-badge">
                                            <span class="material-icons primary ">trip_origin</span>
                                        </div>
                                        <div class="timeline-content text-muted pl-2">
                                            <span class="font-weight-bolder text-nowrap">Exit price: {{trade.exit_price}}</span>
                                            <span class="font-weight-bolder text-nowrap">Exit reason: SL Hit </span>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <!-- Pagination -->
            <div class="d-flex align-items-center">
                <div class="">
                    <span>Found trades: <span class="font-500">{{response.total}}</span></span>
                </div>
                <pagination class="m-auto" :pagination="response" :pages="pagination" v-on:setPage="setPage($event)">
                </pagination>
            </div>
        </section>
        <deteils-trade></deteils-trade>
        <delete-trade-modal :trade="deleteTradeValue"
            v-on:destroyTrade="destroyTrade($event)"></delete-trade-modal>
    </div>

</template>
<script>
import SortingTrades from "./SortingTrades.vue";
import DeteilsTrade from "./DeteilsTrade.vue";
import Pagination from "../../Pagination.vue";
import DeleteTradeModal from "./DeleteTradeModal.vue";

export default {
  components: {
    SortingTrades,
    DeteilsTrade,
    Pagination,
    DeleteTradeModal,
  },
  name: "TradeHistory",
  props: ["portfolios"],

  data() {
    return {
      loading: true,
      response: [],
      trades: [],
      portfolio_id: this.portfolios[0].id,
      sort_pl: "all",
      start_date: "",
      end_date: "",
      search_symbol: "",
      show_per_page: "10",
      column_name: "",
      order: "ASC",
      pagination: {
        data: [],
      },
      deleteTradeValue: [],
    };
  },
  mounted() {
    this.get_trades();
    this.duration();
  },

  methods: {
    checkResponseStatus(error) {
      if (error.response.status === 419 || error.response.status == 401) {
        window.location.href = "/login";
      } else {
        this.form.errors.record(error.response.data.errors);
      }
    },

    get_trades() {
      axios
        .get("/dashboardPages/tradehistory/g", {
          params: {
            p_id: this.portfolio_id,
            sort_pl: this.sort_pl,
            start_date: this.start_date,
            end_date: this.end_date,
            display: this.show_per_page,
            search_symbol: this.search_symbol,
            column: [this.column_name, this.order],
          },
        })
        .then((res) => {
          this.trades = res.data.data;
          this.response = res.data;
          this.pagination.data = res.data.links;
          this.loading = false;
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
    change_portfolio(portfolio_id) {
      this.portfolio_id = portfolio_id;
      this.get_trades();
    },

    sort_by_profit(sort_pl) {
      this.sort_pl = sort_pl;
      this.get_trades();
    },

    searchDateRange(dateRange) {
      this.start_date = dateRange[0];
      this.end_date = dateRange[1];
      this.get_trades();
    },

    setPage: function setPage(page) {
      if (page !== null) {
        axios
          .get(page, {
            params: {
              p_id: this.portfolio_id,
              sort_pl: this.sort_pl,
              start_date: this.start_date,
              end_date: this.end_date,
              display: this.show_per_page,
            },
          })
          .then((res) => {
            this.trades = res.data.data;
            this.pagination.data = res.data.links;
          });
      }
    },

    sort(name) {
      this.column_name = name;
      //this.sort = "asc";
      if (this.order == "ASC") {
        this.order = "DESC";
      } else {
        this.order = "ASC";
      }
      //console.log(this.order);
      this.get_trades();
    },

    deleteTrade: function deleteTrade(trade) {
      this.deleteTradeValue = trade;
      //this.tradePortfolioData = trade.portfolio;
    },

    destroyTrade: function destroyTrade(trade) {
      axios
        .post("/dashboardPages/tradehistory/d/" + trade.id)
        .then((res) => {
          $("#modal_delete_trade").modal("hide");
          this.get_trades();
          this.$root.$emit("portfolio_balance"); //here we update navbar data to show current balance status
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    duration(entry_date, exit_date) {
      var entry = new Date(entry_date);
      var exit = new Date(exit_date);
      this.Difference_in_ms = exit.getTime() - entry.getTime();
      var days = this.Difference_in_ms / 86400000;
      var to_hour = this.Difference_in_ms - Math.trunc(days) * 86400000;
      var hour = to_hour / 3600000;
      var to_minute = to_hour - Math.trunc(hour) * 3600000;
      var minute = to_minute / 60000;
      return (
        Math.trunc(days) +
        "d/" +
        Math.trunc(hour) +
        "h/" +
        Math.trunc(minute) +
        "m"
      );
    },
  },
};
</script>
