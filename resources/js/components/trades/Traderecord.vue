<template>

    <form action="">
        <section class="dashboard_container_content px-2 px-md-4">
            <div class="d-md-flex">
                <div class="col-12 col-md-6 p-0">
                    <div class="row mx-0 mb-0 mb-xl-5 p-0 align-items-center justify-content-between">
                        <div class="d-flex col-12 col-xl-4 mb-3 mb-xl-0">
                            <div class="btn-group btn-group-toggle buy-sell-div col-12 p-0 mt-0" data-toggle="buttons"
                                id="type">
                                <button class="btn btn-type-buy buy btn-sm col-6 active" type="button" @click="buy">
                                    <input class="buy" type="radio" name="type_side" id="type_buy" checked>BUY
                                </button>
                                <button class="btn btn-type-sell sell col-6 btn-sm" type="button" @click="sell">
                                    <input class="sell" type="radio" name="type_side" id="type_sell">SELL
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" v-model="form.quantity" type="text" class="form-control" name="quantity"
                                placeholder="10000" :class="{'is-invalid': form.errors.has('quantity')}" @input="form.errors.clear('quantity')">
                            <p class="error-output" v-if="form.errors.has('quantity')" v-text="form.errors.get('quantity')"></p>
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="symbol">Symbol <span>*</span></label>
                                <select v-model="form.symbol" class="form-control">
                                    <option value="AUD/CAD" selected>AUD/CAD</option>
                                    <option value="EUR/CAD">EUR/CAD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0 mb-0 mb-xl-5 p-0 align-items-center justify-content-between">
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="Entry pirce">Entry price <span>*</span></label>
                            <input v-model="form.entry_price" type="text" class="form-control" 
                                placeholder="1.0000" :class="{'is-invalid': form.errors.has('entry_price')}" @input="form.errors.clear('entry_price')">
                            <p class="error-output" v-if="form.errors.has('entry_price')" v-text="form.errors.get('entry_price')"></p>    
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="Exit price">Exit price <span>*</span></label>
                            <input type="text" v-model="form.exit_price" class="form-control" name="text"
                                 placeholder="1.0000" :class="{'is-invalid': form.errors.has('exit_price')}" @input="form.errors.clear('exit_price')">
                            <p class="error-output" v-if="form.errors.has('exit_price')" v-text="form.errors.get('exit_price')"></p>
                        </div>
                        <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                            <label for="Stop loss">Stop loss price <span>*</span></label>
                            <input type="text" v-model="form.stop_loss_price" class="form-control" name="text"
                                placeholder="1.0000" :class="{'is-invalid': form.errors.has('stop_loss_price')}" @input="form.errors.clear('stop_loss_price')">
                            <p class="error-output" v-if="form.errors.has('stop_loss_price')" v-text="form.errors.get('stop_loss_price')"></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 px-0">
                    <div class="row m-0 p-0 mb-0 mb-xl-5 align-items-center justify-content-between">
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="Entry date">Entry date <span>*</span></label>
                                <date-pick 
                                  v-model="form.entry_date"
                                  :pickTime="true"
                                  :isDateDisabled="isFutureDate"
                                  :format="'YYYY-MM-DD HH:mm'"
                                  :inputAttributes="{readonly: true}"
                                  @input="form.errors.clear('entry_date')"
                                  :class="{'is-invalid': form.errors.has('entry_date')}"
                                  ></date-pick>
                              <p class="error-output" v-if="form.errors.has('entry_date')" v-text="form.errors.get('entry_date')"></p>
                            </div>
                        </div>
                        <div class="col-12 col-xl-2 mt-0 mt-xl-3 p-0 text-center date-error">
                        
                          <span class="font-sm text-muted" v-if="duration">{{duration}}</span>
                            
                        </div>
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="Exit date">Exit date <span>*</span></label>
                                 <date-pick 
                                  v-model="form.exit_date"
                                  :pickTime="true"
                                  :isDateDisabled="isFutureDate"
                                  :inputAttributes="{readonly: true}"
                                  :format="'YYYY-MM-DD HH:mm'"
                                  @input="form.errors.clear('exit_date')"
                                  :class="{'is-invalid': form.errors.has('exit_date')}"
                                  ></date-pick>
                              <p class="error-output" v-if="form.errors.has('exit_date')" v-text="form.errors.get('exit_date')"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 mb-0 mb-xl-5 align-items-center justify-content-between">

                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="input-group">
                                <label for="Profit currency">Profit currency<span>*</span></label>
                                <label for="fees" class="ml-auto">Fees</label>
                                <input id="pl_currency" @keyup="calculateProfit" @input="form.errors.clear('pl_currency')" v-model="form.pl_currency" type="text"
                                    placeholder="0.00" class="form-control w-75" :class="{'is-invalid': form.errors.has('pl_currency')}">
                                <input type="text" @keyup="calculateProfit" @input="form.errors.clear('fees')" v-model="form.fees"
                                   placeholder="0.00" class="form-control w-25" name="fees" id="fees" :class="{'is-invalid': form.errors.has('fees')}">
                            </div>
                             <p class="error-output" v-if="form.errors.has('pl_currency')" v-text="form.errors.get('pl_currency')"></p>
                        </div>
                        <div class="col-12 col-xl-2 text-center">
                            <span class="font-sm text-muted p-0 m-0 ">Return:
                                <span class="font-sm text-muted p-0 m-0">&nbsp; {{form.pl}}</span>
                            </span>
                        </div>
                        <div class="col-12 col-xl-5 mb-3 mb-xl-0">
                            <div class="form-group">
                                <label for="Profit Pips">Profit Pips <span>*</span></label>
                                <input id="pips" v-model="form.pl_pips" type="text" class="form-control" name="pips"
                                placeholder="0.00" :class="{'is-invalid': form.errors.has('pl_pips')}" @input="form.errors.clear('pl_pips')">
                                <p class="error-output" v-if="form.errors.has('pl_pips')" v-text="form.errors.get('pl_pips')"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
            <div class="row m-0 p-0 mb-0 mb-xl-3 align-items-center justify-content-between">
                <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                    <label class="typo__label">Entry rules (max 3)</label>
                    <multiselect v-model="form.entry_rule_id" :options="entryRules" :multiple="true"
                        :close-on-select="false" :clear-on-select="false" :preserve-search="false" :max="3"
                        placeholder="Select entrty rules" label="name" track-by="id" :preselect-first="true">
                        <template slot="selection" slot-scope="{ values, isOpen  }"><span class="multiselect__single"
                                v-if="values.length &amp;&amp; !isOpen">{{ values.length }} rules
                                selected</span></template>
                    </multiselect>
                </div>
                <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                    <label class="typo__label">Exit reason</label>
                    <multiselect v-model="form.exit_reason_id" :options="exitReasons" :searchable="false"
                        :close-on-select="true" :show-labels="false" track-by="id" label="name"
                        placeholder="Exit Reason"></multiselect>
                </div>
                <div class="col-12 col-xl-4 mb-3 mb-xl-0">
                    <label class="typo__label">Used strategy</label>
                    <multiselect v-model="form.strategy_id" :options="strategies" :searchable="false"
                        :close-on-select="true" :show-labels="false" track-by="id" label="name" placeholder="Strategy">
                    </multiselect>
                </div>
            </div>
            <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                <label for="Time frame">Time frame</label>
                <select v-model="form.time_frame" class="form-control" name="time_frame">
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
import Texteditor from "../Texteditor.vue";
import Multiselect from "vue-multiselect";

import DatePick from "vue-date-pick";

export default {
  name: "Traderecord",
  components: {
    Texteditor,
    Multiselect,
    DatePick,
  },
  data() {
    return {
      Difference_in_ms: "",
      entryRules: [],
      exitReasons: [],
      strategies: [],
      loading: true,
      form: new Form({
        symbol: "AUD/CAD",
        type_side: "buy",
        quantity: "",
        entry_price: "",
        exit_price: "",
        stop_loss_price: "",
        time_frame: "1 min",
        entry_date: "",
        exit_date: "",
        pl_currency: "",
        fees: "",
        pl: "",
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

  computed: {
    duration: function () {
      var entry = new Date(this.form.entry_date);
      var exit = new Date(this.form.exit_date);

      if (this.form.entry_date && this.form.exit_date) {
        if (this.form.entry_date <= this.form.exit_date) {
          this.Difference_in_ms = exit.getTime() - entry.getTime();
          var days = this.Difference_in_ms / 86400000;
          var to_hour = this.Difference_in_ms - Math.trunc(days) * 86400000;
          var hour = to_hour / 3600000;
          var to_minute = to_hour - Math.trunc(hour) * 3600000;
          var minute = to_minute / 60000;
          return (
            Math.trunc(days) +
            "d - " +
            Math.trunc(hour) +
            "h - " +
            Math.trunc(minute) +
            "m"
          );
        } else {
          return "Date is incorrect";
        }
      }
    },
  },
  methods: {
    checkResponseStatus(error) {
      if (error.response.status === 419 || error.response.status == 401) {
        window.location.href = "/login";
      } else {
        this.form.errors.record(error.response.data.errors);
      }
    },

    isFutureDate(date) {
      const currentDate = new Date();
      return date > currentDate;
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

    calculateProfit() {
      return [(this.form.pl = this.form.pl_currency - this.form.fees)];
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
      data.append("pl_currency", this.form.pl);
      data.append("fees", this.form.fees);
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
<style src="vue-date-pick/dist/vueDatePick.css"></style>
