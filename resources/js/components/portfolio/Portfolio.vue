<template>
    <div class="row justify-content-center p-4"> 
      <undo-action-message v-on:undo="undo($event)" ref="action"></undo-action-message>
      
      <div class="col-12 col-md-11 col-lg-8 pb-3 p-0">
        <div class="dashboard_container_content border d-flex align-items-center">
            <button type="button" class="btn btn-secondary border-0 lighter font-500"
              v-on:click="create">
                  Add New
              </button>
        </div>
      </div>
      
      <main class="col-12 col-md-11 col-lg-8 p-0 new-item" v-if="items.portfolio">
          <div class="dashboard_container_content portfolio-wrapper border p-0" :class="{'inactive_portfolio': item.is_active == 0 }"
                  v-for="(item, index) in items.portfolio" :key="item.id">
            <div class="container-portfolio-action-buttons d-flex justify-content-between align-items-center p-3 mb-2">
              <div class="custom-control custom-switch switch_portfolio">
                <div v-if="items.portfolio.length > 1">
                <input @click="toogleActive(item, $event)" type="checkbox"
                    class="custom-control-input activate_portfolio" :id="item.id"
                    :checked="item.is_active == true ? 'checked': '' " :value="item.id">
                <label class="custom-control-label" :for="item.id"
                    v-text="item.is_active == 0 ? 'Inactive' : 'Active' "></label>
                </div>
            </div>
            <div class="d-flex justify-content-between buttons-portfolio-options">
              <button type="button" v-if="items.portfolio.length > 1" class="btn mr-2" @click="DeletePortfolio(item)" data-target="#modal-form" data-toggle="modal">
                <span class="material-icons-outlined icon-sm red">delete</span>
              </button>
              
              <button type="button" @click="getId(item.id, item.currency)" class="btn mr-2" data-toggle="modal"
                data-target="#transactions"><span class="material-icons-outlined icon-sm cyan">paid</span>
              </button>
              
              <button type="button" @click="getValues(item.id, item.name, item.currency)"
                  class="btn mr-2 font-weight-bold lighter" data-toggle="modal" data-target="#modal-form">
                  Edit
              </button>

              <button type="button" class="btn mr-2" @click="openClearPortfolioModal(item.id)" data-target="#modal-form" data-toggle="modal">
                <span class="material-icons-outlined icon-sm lighter">clear</span>
              </button>
            </div>
          </div>
            <div class="chart-wrapper">
                    <apexchart type="area" height="270" 
                    :options="{chart:{
                        width:'100%', 
                        type: 'area', 
                        sparkline: {
                          enabled: true,
                        }
                      }, 
                      stroke: {
                        curve: 'smooth',
                      },
                        fill: {
                        opacity: 0.2,
                      },
                      yaxis: {
                          show: false,
                          showAlways: false,
                      },
                      colors: index === 0 ? ['#3490dc']: ['#1bc5bd'],
                      title: {
                        text: item.current_balance +' '+ item.currency + ' '+ '('+ item.return_capital_investment + '%' + ')' ,
                        align: 'center',
                        margin: 0,
                        offsetX: 0,
                        offsetY: 0,
                        style: {
                          fontSize: '24px',
                          fontWeight: '500',
                          colors: '#343a40',
                        },
                      },
                        subtitle: {
                          text: item.name + ' • ' + item.started_at,
                          align: 'center',
                          margin: 10,
                          offsetX: 0,
                          style: {
                            fontSize: '18px',
                            fontWeight: '400',
                            color: '#343a40',
                          },
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: item.running_total.map(arr =>
                            arr.action_date
                            ).reverse()
                        },
                          tooltip: {
                          x: {
                            format: 'dd / MMM / yy'
                          },
                          y: {
                              formatter: function(val) {
                                return val.toFixed(2) + ' ' + item.currency;
                              }
                          }
                          
                        },
                    }" :series="[{name: 'Balance', data : item.running_total.map(arr =>
              parseFloat(arr.running_total)
              ).reverse()}]"></apexchart>
            </div>  
              
          </div>
      </main>
        
      <modal :item="form" 
        v-on:clear="clear($event)" 
        v-on:edit="edit($event)" 
        v-on:store="store($event)" 
        v-on:destroy="destroy($event)">
      </modal>
      <modal-transaction :currency="portfolioCurrency" :transaction="transactions" :links="pagination" :item="form" 
        v-on:setPage="setPage($event)" 
        v-on:storeTransaction="storeTransaction($event)" 
        v-on:delete_transaction="delete_transaction($event)">
      </modal-transaction>
      <modal-upgrade-plan :text="upgrade_plan_modal"></modal-upgrade-plan>

    </div>
</template>
<script>
import Modal from "./Modal";
import ModalTransaction from "./ModalTransaction";
import ModalUpgradePlan from "../ModalUpgradePlan";
import VueApexCharts from "vue-apexcharts";
import UndoActionMessage from "../UndoActionMessage.vue";
Vue.component("apexchart", VueApexCharts);
export default {
  name: "Portfolio",
  components: {
    Modal,
    ModalTransaction,
    ModalUpgradePlan,
    UndoActionMessage,
  },
  data() {
    return {
      upgrade_plan_modal: [
        {
          text: "Keep track on multiple portfolios",
          subtext:
            "Upgrade your plan to create up to 5 portfolios and multiple tests trading setup.",
        },
      ],

      items: {
        portfolio: [],
        series: [
          {
            data: [],
          },
        ],
      },
      transactions: [],
      portfolioCurrency: "",
      pagination: {
        data: [],
      },
      form: new Form({
        id: "",
        name: "",
        start_equity: "",
        currency: "",
        started_at: "",
        title: "",
        modal: "",
        amount_transaction: "",
        transaction_date: "",
      }),
      modal: "create",
      title: "",
      undo_id: "",
    };
  },
  mounted: function mounted() {
    this.fetchportfolio();
  },
  computed: {},

  methods: {
    checkResponseStatus(error) {
      if (error.response.status === 419 || error.response.status == 401) {
        window.location.href = "/login";
      } else {
        if (error.response.status === 403) {
          console.log(error.response.data.message);
        } else {
          this.form.errors.record(error.response.data.errors);
        }
      }
    },

    toogleActive: function (value, event) {
      var data = false;
      if (event.target.checked) {
        data = 1;
      } else {
        data = 0;
      }
      axios
        .post("/dashboardPages/portfolio/toggle_active/" + value.id, {
          active: data,
        })
        .then((res) => {
          this.fetchportfolio();
          this.$root.$emit("portfolio_balance");
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    getValues(item_id, item_name, item_currency) {
      this.form.modal = "edit";
      this.form.title = "Edit";
      this.form.errors.clear();
      this.form.id = item_id;
      this.form.name = item_name;
      this.form.currency = item_currency;
    },

    openClearPortfolioModal(item_id) {
      this.form.modal = "clearPortfolio";
      this.form.title = "Clear Portfolio";
      this.form.errors.clear();
      this.form.id = item_id;
    },

    fetchportfolio() {
      axios
        .get("/dashboardPages/portfolio/g")
        .then((res) => {
          this.items.portfolio = res.data;

          this.$root.$emit("portfolio_balance");
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    create: function create() {
      axios
        .get("/dashboardPages/portfolio/create")
        .then((res) => {
          this.form.reset();
          this.form.title = "Create Portfolio";
          this.form.modal = "create";
          $("#modal-form").modal("show");
        })
        .catch((error) => {
          if (error.response.status === 402) {
            $("#modal-upgrade-plan").modal("show");
          }
        });
    },

    store: function store(value) {
      let data = new FormData();
      data.append("name", value.name);
      data.append("start_equity", value.start_equity);
      data.append("currency", value.currency);
      data.append("started_at", value.started_at);
      axios
        .post("/dashboardPages/portfolio/store", data)
        .then((res) => {
          $("#modal-form").modal("hide");
          this.fetchportfolio();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    edit: function edit(value) {
      var item_id = value.id;
      var item_name = value.name;
      var item_currency = value.currency;
      axios
        .put("/dashboardPages/portfolio/update/" + item_id, {
          id: item_id,
          name: item_name,
          currency: item_currency,
        })
        .then((res) => {
          $("#modal-form").modal("hide");
          this.fetchportfolio();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    clear: function clear(value) {
      var item_id = value.id;
      axios
        .delete("/dashboardPages/portfolio/clear/" + item_id)
        .then((res) => {
          $("#modal-form").modal("hide");
          this.fetchportfolio();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    DeletePortfolio: function DeletePortfolio(value) {
      this.form.reset();
      this.form.title = "Delete Portfolio";
      this.form.modal = "delete";
      this.form.name = value.name;
      this.form.id = value.id;
    },

    destroy: function destroy(portfolio) {
      axios
        .delete("/dashboardPages/portfolio/d/" + portfolio.id)
        .then((res) => {
          $("#modal-form").modal("hide");
          this.fetchportfolio();
          this.$refs.action.deleted("Portfolio has been deleted", portfolio.id);
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    undo: function undo(id) {
      axios
        .get("/dashboardPages/portfolio/restore/" + id)
        .then((res) => {
          this.fetchportfolio();
          this.$refs.action.undoMessage("Portfolio has been restored");
        })
        .catch((error) => {
          console.log(error);
        });
    },

    /* Transaction controller */
    getId: function getId(value, currency) {
      {
        this.form.id = value;
        axios
          .get("/dashboardPages/portfolio/getTransactions/" + value)
          .then((res) => {
            this.transactions = res.data;
            this.portfolioCurrency = currency;

            this.pagination.data = res.data.links;
            $("#transactions").appendTo("body");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },

    setPage: function setPage(page) {
      console.log(page);
      //this.currentPage = page;
      if (page !== null) {
        axios.get(page).then((res) => {
          this.transactions = res.data;
          this.pagination.data = res.data.links;
        });
      }
    },

    storeTransaction: function storeTransaction(value) {
      let data = new FormData();
      data.append("amount", value.amount_transaction);
      data.append("action_date", value.transaction_date);
      data.append("portfolio_id", value.id);
      axios
        .post("/dashboardPages/portfolio/storeTransactions", data)
        .then((res) => {
          this.fetchportfolio();
          this.getId(this.form.id);
          this.form.amount_transaction = "";
          this.form.transaction_date = "";
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    delete_transaction: function delete_transaction(value, value1) {
      console.log(value);
      axios
        .post("/dashboardPages/portfolio/deleteTransactions/" + value)
        .then((res) => {
          //$("#transactions").modal("hide");
          this.getId(this.form.id);
          this.fetchportfolio();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
  },
};
</script>