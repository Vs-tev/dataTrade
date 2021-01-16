<template>

     <form action="">
        <section class="dashboard_container_content px-2 px-md-4">
            <div class="d-md-flex">
                <div class="col-12 col-md-6 p-0">
                    <div class="row mx-0 mb-0 mb-xl-5 p-0 align-items-center justify-content-between">
                        <div class="d-flex col-12 col-xl-4 mb-3 mb-xl-0">
                              <div class="btn-group btn-group-toggle buy-sell-div col-12 p-0 mt-0" data-toggle="buttons"
                                id="type">
                                <button class="btn btn-type-buy buy btn-sm col-6 active"  type="button" @click="buy">
                                    <input class="buy" type="radio" name="type_side" id="type_buy" checked>BUY
                                </button>
                                <button class="btn btn-type-sell sell col-6 btn-sm"  type="button" @click="sell">
                                    <input class="sell" type="radio" name="type_side" id="type_sell">SELL
                                </button>
                            </div>
                        </div>
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
                            <div class="input-group">
                                <label for="Profit currency">Profit currency<span>*</span></label>
                                <label for="fee" class="ml-auto">Fees</label>
                                <input id="pl_currency" v-model="form.pl_currency" type="text" class="form-control w-75" name="Currency">
                                <input type="text" class="form-control w-25" name="fee" id="fee">
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
                   
                        
                </div>

            </div>
               <div class="row m-0 p-0 mb-0 mb-xl-3 align-items-center justify-content-between">
                      <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                         <label class="typo__label">Entry rules (max 3)</label>
                         <multiselect 
                         v-model="form.entry_rule_id" 
                         :options="entryRules" 
                         :multiple="true" 
                         :close-on-select="false" 
                         :clear-on-select="false" 
                         :preserve-search="false" 
                         placeholder="Select entrty rules" 
                         label="name" 
                         track-by="id"
                        :preselect-first="true">
                          <template slot="selection" slot-scope="{ values, isOpen  }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} rules selected</span></template>
                        </multiselect>
                      </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                           <label class="typo__label">Exit reason</label>
                            <multiselect 
                            v-model="form.exit_reason_id" 
                            :options="exitReasons" 
                            :searchable="false" 
                            :close-on-select="true" 
                            :show-labels="false" 
                            track-by="id"
                            label="name"
                            placeholder="Exit Reason"></multiselect>
                        </div>
                         <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label class="typo__label">Used strategy</label>
                            <multiselect 
                            v-model="form.strategy_id" 
                            :options="strategies" 
                            :searchable="false" 
                            :close-on-select="true" 
                            :show-labels="false" 
                            track-by="id"
                            label="name"
                            placeholder="Strategy"></multiselect>
                        </div>
                    </div>
                    <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                            <label for="Time frame">Time frame</label>
                            <select v-model="form.time_frame" class="form-control" name="time_frame">
                                <option selected="" value="1 min">1 min</option>
                                <option value="5 min">5 min</option>
                                <option value="15 min">15 min</option>
                                <option value="1 hour">1 hour</option>
                                <option value="2 hours">2 hours</option>
                                <option value="4 hours">4 hours</option>
                                <option value="1 day">1 day</option>
                                <option value="1 week">1 week</option>
                                <option value="1 month">1 month</option>
                            </select>
                        </div>
                        <span>{{form.entry_rule_id.map(item=>({
                            id: item.id
                          }.id))}}</span>
        </section>
        
         <section class="dashboard_container_content chart-container">
            <div class="row justify-content-around">
                <div class="trade_img text-center my-3 p-0 mx-0 col-lg-5">
                    <div class="input-file-container js" v-if="!form.trade_img">
                        <input class="d-none" @change="onFileSelected" id="img" name="img" type="file"
                            accept="image/x-png,image/gif,image/jpeg">
                        <label tabindex="0" for="img" class="input-file-trigger text-center"> <span
                                class="material-icons icon-xl indigo ">cloud_upload</span>
                            <h4 class="lighter font-500">Click here to upload image</h4>
                        </label>
                    </div>
                    <div class="img-content-container" v-if="form.trade_img">
                        <div class="remove-img" @click="removeSelectedImg">
                          <img src="/storage/icons/remove.svg" alt="">
                        </div>
                      <img class="url-img" :src="this.form.thumbnail_img" alt="">
                    </div>
                </div>
                <div class="col-lg-5 my-3 p-0 mx-0">
                     <texteditor :item="form"  class=""></texteditor>
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
import Texteditor from "../Texteditor.vue";
import Multiselect from "vue-multiselect";
export default {
  name: "Traderecord",
  components: {
    Texteditor,
    Multiselect,
  },

  data() {
    return {
      entryRules: [],
      exitReasons: [],
      strategies: [],
      val: "",

      loading: true,
      form: new Form({
        symbol: "",
        type_side: "buy",
        quantity: "",
        entry_price: "",
        exit_price: "",
        stop_loss_price: "",
        time_frame: "1 min",
        entry_date: "",
        exit_date: "",
        pl_currency: "",
        pl_pips: "",
        description: "",
        trade_img: "",
        thumbnail_img: "",
        exit_reason_id: "",
        entry_rule_id: [],
        strategy_id: "",
        height: "196",
        placeholder: "Write you thougts about this trade",
      }),
    };
  },
  mounted() {
    this.getEntryRules();
    this.getStrategies();
    this.getExitReason();
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
    buy() {
      this.form.type_side = "buy";
    },
    sell() {
      this.form.type_side = "sell";
    },
    onFileSelected() {
      this.form.trade_img = event.target.files[0];
      this.form.thumbnail_img = URL.createObjectURL(this.form.trade_img);
    },

    removeSelectedImg() {
      this.form.thumbnail_img = null;
      this.form.trade_img = "";
    },

    selectedStrategy(value) {
      this.strategy_id = value;
    },
    getStrategies() {
      axios
        .get("/strategy/g")
        .then((response) => {
          this.loading = false;
          this.strategies = response.data;
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
      data.append("symbol", this.form.symbol);
      data.append("type_side", this.form.type_side);
      data.append("quantity", this.form.quantity);
      data.append("entry_price", this.form.entry_price);
      data.append("exit_price", this.form.exit_price);
      data.append("stop_loss_price", this.form.stop_loss_price);
      data.append("time_frame", this.form.time_frame);
      data.append("entry_date", this.form.entry_date);
      data.append("exit_date", this.form.exit_date);
      data.append("pl_currency", this.form.pl_currency);
      data.append("pl_pips", this.form.pl_pips);
      data.append("trade_notes", this.form.description);
      data.append("trade_img", this.form.trade_img);
      if (this.form.exit_reason_id) {
        data.append("exit_reason_id", this.form.exit_reason_id.id);
      }
      if (this.form.entry_rule_id) {
        data.append(
          "entry_rule_id",
          this.form.entry_rule_id.map(
            (item) =>
              ({
                id: item.id,
              }.id)
          )
        );
      }
      if (this.form.strategy_id) {
        data.append("strategy_id", this.form.strategy_id.id);
      }
      axios.post("/dashboardPages/traderecord/p", data).catch((error) => {
        this.checkResponseStatus(error);
      });
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
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


