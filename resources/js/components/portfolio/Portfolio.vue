<template>
    <div class="row justify-content-center p-4"> 
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
                    <div class="d-flex justify-content-between">
                          <button type="button" @click="getId(item.id, item.currency)" class="btn btn-primary mr-2" data-toggle="modal"
                                        data-target="#transactions"><img src="/icons/wallet.svg" alt=""></button>
                          <button type="button" @click="getValues(item.id, item.name, item.currency)"
                                        class="btn btn-secondary mr-2" data-toggle="modal"
                                        data-target="#modal-form"><img src="/icons/edit.svg" alt=""></button>
                          <button type="button" v-if="items.portfolio.length > 1" class="btn btn-secondary delete-item" @click="DeletePortfolio(item)" data-target="#modal-form" data-toggle="modal">
                                  <img src="/icons/trash.svg" alt="">
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
                            text: item.current_balance +' '+ item.currency + ' '+ '('+ ((item.current_balance - item.start_equity)/ item.start_equity * 100).toFixed(2) + '%' + ')' ,
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
                                format: 'dd/MMM/yy'
                              },
                              y: {
                                labels: {
                                  formatter: function(val) {
                                    return val.toFixed(2);
                                  }
                                }
                              }
                              
                            },
                        }" :series="[{name: 'Balance', data : item.running_total.map(arr =>
                 parseFloat(arr.running_total)
                 ).reverse()}]"></apexchart>
               </div>  
                
            </div>
        </main>
        
        <modal :item="form" v-on:edit="edit($event)" v-on:store="store($event)" v-on:destroy="destroy($event)"></modal>
        <modal-transaction :currency="portfolioCurrency" :transaction="transactions" :links="pagination" :item="form" v-on:setPage="setPage($event)" v-on:storeTransaction="storeTransaction($event)" v-on:delete_transaction="delete_transaction($event)"></modal-transaction>
        <modal-upgrade-plan :text="upgrade_plan_modal"></modal-upgrade-plan>
    </div>
</template>
<script>
import Modal from "./Modal";
import ModalTransaction from "./ModalTransaction";
import ModalUpgradePlan from "../ModalUpgradePlan";
import VueApexCharts from "vue-apexcharts";
Vue.component("apexchart", VueApexCharts);
export default {
  name: "Portfolio",
  components: {
    Modal,
    ModalTransaction,
    ModalUpgradePlan,
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
        this.form.errors.record(error.response.data.errors);
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
          //$("#modal-form").modal("show");
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
      let data = new FormData();
      data.append("name", item_name);
      data.append("currency", item_currency);
      axios
        .post("/dashboardPages/portfolio/u/" + item_id, data)
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

    destroy: function destroy(value) {
      axios
        .post("/dashboardPages/portfolio/d/" + value.id)
        .then((res) => {
          $("#modal-form").modal("hide");
          this.fetchportfolio();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
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
    /*  getTransactions: function getTransactions() {
     
    }, */

    storeTransaction: function storeTransaction(value) {
      let data = new FormData();
      data.append("amount_transaction", value.amount_transaction);
      data.append("transaction_date", value.transaction_date);
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