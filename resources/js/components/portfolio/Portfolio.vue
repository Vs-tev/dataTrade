<template>
    <div class="row justify-content-between">
        <div class="col-sm-12 pb-3 px-3">
            <div class="dashboard_container_content border d-flex align-items-center">
                <img src="/storage/icons/create.svg" alt="">
                <span v-on:click="create" data-target="#modal-form" data-toggle="modal"
                    class="font-lg ml-2 font-500 pointer">
                    Create Recording Portfolio
                </span>
            </div>
        </div>
        <main class="col-sm-12 pb-3 px-3 new-item">
            <div>
                <div class="dashboard_container_content border pt-0" :class="{'inactive_portfolio': item.is_active == 0 }"
                    v-for="item in items" :key="item.id">
                    <div class="container-portfolio-action-buttons d-flex justify-content-between align-items-center border-bottom py-3 mb-2">
                     <div class="custom-control custom-switch switch_portfolio">
                        <input @click="toogleActive(item, $event)" type="checkbox"
                            class="custom-control-input activate_portfolio" :id="item.id"
                            :checked="item.is_active == true ? 'checked': '' " :value="item.id">
                        <label class="custom-control-label" :for="item.id"
                            v-text="item.is_active == 0 ? 'Inactive' : 'Active' "></label>
                    </div>
                    <div class=" d-flex  justify-content-between">
                          <button type="button" @click="getId(item.id)" class="btn btn-primary mr-2" data-toggle="modal"
                                        data-target="#transactions"><img src="/storage/icons/wallet.svg" alt=""></button>
                          <button type="button" @click="getValues(item.id, item.name, item.currency)"
                                        class="btn btn-secondary mr-2" data-toggle="modal"
                                        data-target="#modal-form"><img src="/storage/icons/edit.svg" alt=""></button>
                          <button type="button" class="btn btn-secondary delete-item" @click="DeletePortfolio(item)" data-target="#modal-form" data-toggle="modal">
                                  <img src="/storage/icons/trash.svg" alt="">
                                </button>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between" >
                      <div class="w-100">
                        <div class="portfolio_container w-100 mb-3 pb-3 pt-2 justify-content-between border-bottom">
                            <div class="d-flex">
                                <div class="sparkline">
                                    <p class="font-sm m-auto">LineChart</p>
                                </div>
                                <div class="d-flex flex-column justify-content-around portfolio_name ml-3">
                                    <h3 class="font-weight-bold">{{item.name}}</h3>
                                    <div class="d-flex flex-wrap flex-sm-nowrap">
                                        <p class="mr-3 mb-0 d-flex">
                                            Start date: &nbsp;<span class="dark font-500">{{item.started_at}}</span>
                                        </p>
                                        <p class="mr-3 mt-1 mt-sm-0 mb-0">
                                            Currency: &nbsp;<span class="dark font-500 text-uppercase">{{item.currency}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <div
                            class="portfolio_info row col-lg-12 justify-content-between">
                            <div class="d-flex align-items-center mb-3 mb-lg-0">
                                 <img src="/storage/icons/cash.svg" alt="">
                                <div class="ml-2">
                                    <p class="p-0 m-0">Start capital</p>
                                    <h5 class="text-uppercase">{{item.start_equity}} {{item.currency}}</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                                 <img src="/storage/icons/cash.svg" alt="">
                                <div class="ml-2">
                                    <p class="p-0 m-0">Balance</p>
                                    <h5 class="indigo" :class="{'red' : item.current_balance < 0}" >{{item.current_balance}} {{item.currency}}</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                                <img src="/storage/icons/trend-up.svg" alt="">
                                <div class="ml-2">
                                    <p class="p-0 m-0">Win Rate</p>
                                    <h5 class="">61.70 %</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                                <img src="/storage/icons/archive.svg" alt="">
                                <div class="ml-2">
                                    <p class="p-0 m-0">Recorded Trades</p>
                                    <h5 class="">&#35; 81</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3 mr-3 mb-lg-0">
                                <img src="/storage/icons/area-line.svg" alt="">
                                <div class="ml-2">
                                    <p class="p-0 m-0">Return</p>
                                    <h5 :class="{'red' : item.current_balance < item.start_equity }">{{(((item.current_balance - item.start_equity)/item.start_equity)*100).toFixed(2) }}%</h5>
                                </div>
                            </div>
                        </div>
                      </div>
                      
                    </div>
                </div>

            </div>
        </main>
        <modal :item="form" v-on:edit="edit($event)" v-on:store="store($event)" v-on:destroy="destroy($event)"></modal>
        <modal-transaction :transaction="transactions" :links="pagination" :item="form" v-on:setPage="setPage($event)" v-on:storeTransaction="storeTransaction($event)" v-on:delete_transaction="delete_transaction($event)"></modal-transaction>
    </div>
</template>
<script>
import Modal from "./Modal";
import ModalTransaction from "./ModalTransaction";

export default {
  name: "Portfolio",
  components: {
    Modal,
    ModalTransaction,
  },
  data() {
    return {
      items: [],
      transactions: [],
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
    this.fetchitems();
  },

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
          this.fetchitems();
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

    fetchitems() {
      axios
        .get("/dashboardPages/portfolio/g")
        .then((res) => {
          this.items = res.data;
          //this.loading = false;
        })
        .catch((error) => {});
    },

    create: function create() {
      this.form.reset();
      this.form.title = "Create Portfolio";
      this.form.modal = "create";
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
          this.fetchitems();
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
          this.fetchitems();
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
          this.fetchitems();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    /* Transaction controller */
    getId: function getId(value) {
      {
        this.form.id = value;
        axios
          .get("/dashboardPages/portfolio/getTransactions/" + value)
          .then((res) => {
            this.transactions = res.data;
            this.pagination.data = res.data.links;
            $("#transactions").appendTo("body");
          })
          .catch((error) => {
            this.checkResponseStatus(error);
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
          this.fetchitems();
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
          this.fetchitems();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
  },
};
</script>