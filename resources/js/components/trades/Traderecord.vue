<template>
     <form action="">
        <section class="dashboard_container_content px-2 px-md-4">
            <div class="d-md-flex">
                <div class="col-12 col-md-6 p-0">
                    <div class="row mx-0 mb-0 mb-xl-5 p-0 align-items-center justify-content-between">
                        <div class="d-flex col-12 col-xl-4 mb-3 mb-xl-0">
                              <div class="btn-group btn-group-toggle buy-sell-div col-12 p-0 mt-0" data-toggle="buttons"
                                id="type">
                                <button class="btn btn-type-buy buy btn-sm col-6 active" type="button">
                                    <input class="buy" type="radio" name="type_side" id="type_buy" value="buy"
                                        autocomplete="on" checked="">BUY
                                </button>
                                <button class="btn btn-type-sell sell col-6 btn-sm" type="button">
                                    <input class="sell" type="radio" name="type_side" id="type_sell" value="sell"
                                        autocomplete="off">SELL
                                </button>
                            </div>
                        </div>
                         <span>{{form.type_side}}</span>
                         
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" v-model="form.quantity" type="text" class="form-control" name="text" placeholder="10000">
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="symbol">Symbol <span>*</span></label>
                                <select v-model="form.symbol" class="form-control">
                                    <option>AUD/CAD</option>
                                    <option>EUR/CAD</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 mb-0 mb-xl-5 p-0 align-items-center justify-content-between">
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="Entry pirce">Entry price <span>*</span></label>
                            <input v-model="form.entry_price" type="text" class="form-control" name="text" placeholder="10000">
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="Exit price">Exit price <span>*</span></label>
                            <input type="text" v-model="form.exit_price" class="form-control" name="text" placeholder="10000">
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="Stop loss">Stop Loss <span>*</span></label>
                            <input type="text" v-model="form.stop_loss_price" class="form-control" name="text" placeholder="10000">
                        </div>
                    </div>
                    <div class="row m-0 p-0 mb-0 mb-xl-3 align-items-center justify-content-between">
                        <selectentryrule :entryRules="entryRules"></selectentryrule>
                         
                        <selectexitreason :exitReasons="exitReasons"></selectexitreason>
                    </div>
                  

                </div>
                <div class="col-12 col-md-6 px-0">
                    <div class="row m-0 p-0 mb-0 mb-xl-5 align-items-center justify-content-between">
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="Entry date">Entry date <span>*</span></label>
                                <input id="entry_date" v-model="form.entry_date" type="date" class="form-control" name="entry_date">
                                <p class="error-output">Entry date must be greater then 12.05.2020 </p>    
                            </div>
                        </div>
                        <div class="col-12 col-xl-2 mb-auto text-center">
                            <span class="font-sm text-muted p-0 m-0 ">Duration: 
                                <span class="font-sm text-muted p-0 m-0">&nbsp; 2.2 Days</span>
                            </span>
                        </div>
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="Exit date">Exit date <span>*</span></label>
                                <input id="exit_date" v-model="form.exit_date" type="date" class="form-control" name="exit_date">
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 mb-0 mb-xl-5 align-items-center justify-content-between">

                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="Profit currency">Profit currency<span>*</span></label>
                                <input id="pl_currency" v-model="form.pl_currency" type="text" class="form-control" name="Currency">
                            </div>
                        </div>
                        <div class="col-12 col-xl-2 text-center">
                            <span class="font-sm text-muted p-0 m-0 ">Return: 
                                <span class="font-sm text-muted p-0 m-0">&nbsp; 1.80%</span>
                            </span>
                        </div>
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="Profit Pips">Profit Pips <span>*</span></label>
                                <input id="pips" v-model="form.pl_pips" type="text" class="form-control" name="Pips">
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 mb-0 mb-xl-0 align-items-center justify-content-start">
                        <selectstrategy :strategies="strategies" v-if="!loading"></selectstrategy>
                         <div class="col-12 col-xl-6 mb-3 mb-xl-0" v-if="loading">
                              <div class="spinner-border lighter"></div>
                        </div>
                         <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                            <label for="Fees">Fees</label>
                            <input id="quantity" type="text" class="form-control" name="text" placeholder="10000">
                        </div>
                        <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                            <label for="Time frame">Time frame</label>
                            <select class="form-control" name="time_frame">
                                <option selected="" value="1 min">1 min</option>
                                <option value="5 min">5 min</option>
                                <option value="15 min">15 min</option>
                                <option value="30 min">30 min</option>
                                <option value="1 hour">1 hour</option>
                                <option value="2 hours">2 hours</option>
                                <option value="4 hours">4 hours</option>
                                <option value="1 day">1 day</option>
                                <option value="1 week">1 week</option>
                                <option value="1 month">1 month</option>
                            </select>
                        </div>
                    </div>    
                </div>
            </div>
        </section>
        
         <section class="dashboard_container_content chart-container">
            <div class="row justify-content-around">
                <div class="drop_img my-3 p-0 mx-0 col-5">
                    <div class="input-file-container js">
                        <input class="d-none "  name="img" id="img" type="file"
                            accept="image/x-png,image/gif,image/jpeg">
                        <label tabindex="0" for="img" class="input-file-trigger text-center"> <span
                                class="material-icons icon-xl indigo ">cloud_upload</span>
                            <h4 class="lighter font-500">Click here to upload image</h4>
                        </label>
                    </div>
                   <!--  <div class="img-content-container">
                        <div class="remove-img"><img src="/storage/icons/remove.svg" alt=""></div>
                        <img class="url-img create" >
                        <img class="url-img falsemode" alt="">
                        <img class="url-img truemode" alt="">
                    </div> -->
                </div>
                <div class="col-5 my-3 p-0 mx-0">
                    <label for="Trade notes">Trade notes</label>
                     <texteditor :item="form" class=""></texteditor>
                </div>
            </div>  
              <div class="d-flex justify-content-center my-3">
                <button type="button" id="tests" class="btn btn-secondary font-lg font-500 mr-3">Clear</button>
                <button type="button" class="btn bt btn-primary font-lg font-500 mr-0" @click="recordTrade">Record Trade</button>
            </div>
        </section>
       
        </form>
</template>
<script>
import Selectentryrule from "./Selectentryrule.vue";
import Selectexitreason from "./Selectexitreason.vue";
import Selectstrategy from "./Selectstrategy.vue";
import Texteditor from "../Texteditor.vue";
export default {
  name: "Traderecord",
  components: {
    Selectstrategy,
    Selectentryrule,
    Selectexitreason,
    Texteditor,
  },

  data() {
    return {
      strategies: [],
      entryRules: [],
      exitReasons: [],
      loading: true,
      buy: "buy",
      sell: "sell",
      form: new Form({
        symbol: "",
        type_side: "",
        quantity: "",
        entry_price: "",
        exit_price: "",
        stop_loss_price: "",
        time_frame: "",
        entry_date: "",
        exit_date: "",
        pl_currency: "",
        pl_pips: "",
        trade_notes: "",
        trade_img: "",
        exit_reason_id: "",
        entry_rule_id: "",
        strategy_id: "",
        height: "170",
        placeholder: "Write down you thougts about this trade",
      }),
    };
  },
  mounted() {
    this.getEntryRules();
    this.getStrategies();
    this.getExitReason();
  },

  methods: {
    getStrategies() {
      axios
        .get("/strategy/g")
        .then((response) => {
          this.strategies = response.data;
          this.loading = false;
        })
        .catch((error) => {});
    },
    getEntryRules() {
      axios
        .get("/entry_rules/g")
        .then((response) => {
          this.entryRules = response.data;
          this.loading = false;
        })
        .catch((error) => {});
    },
    getExitReason() {
      axios
        .get("/exit_reasons/g")
        .then((response) => {
          this.exitReasons = response.data;
          this.loading = false;
        })
        .catch((error) => {});
    },

    recordTrade() {
      const data = new FormData();
    },

    /* getSymbols() {
      axios
        .get(
          "https://eodhistoricaldata.com/api/eod/EUR.FOREX?api_token=OeAFFmMliFG5orCUuwAKQ8l4WWFQ67YX&order=d&fmt=json",
          {
            transformRequest: [
              (data, headers) => {
                delete headers.common["X-Requested-With"];
                delete headers.common["Access-Control-Allow-Origin"];
                return data;
              },
            ],
          }
        )
        .then((response) => {
          this.symbols = response.data;
        })
        .catch((error) => {});
    }, */
  },
};
</script>
