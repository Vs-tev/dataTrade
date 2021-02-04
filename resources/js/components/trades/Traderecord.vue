<template>
    <form action="">
        <section class="dashboard_container_content p-0 pb-4">
            <div class="border-bottom p-4">
                <h4 class="font-weight-500 m-0">Trade record pandel</h4>
            </div>
            <div class="d-lg-flex flex-block p-4">
                <!-- trade inputs -->
                <div class="new_trade_inputs_300 mx-auto">
                    <div class="btn-group btn-group-toggle buy-sell-div col-12 p-0 mt-0" data-toggle="buttons"
                        id="type">
                        <button class="btn btn-type-buy buy btn-sm col-6 active" type="button" @click="buy">
                            <input class="buy" type="radio" name="type_side" id="type_buy" checked>BUY
                        </button>
                        <button class="btn btn-type-sell sell col-6 btn-sm" type="button" @click="sell">
                            <input class="sell" type="radio" name="type_side" id="type_sell">SELL
                        </button>
                    </div>
                    <!-- symbol/time frame -->
                    <div class="d-flex justify-content-between mt-4 symbol-time_frame">
                        <div class="form-group">
                            <label for="symbol">Symbol <span>*</span></label>
                            <select v-model="form.symbol" class="form-control">
                                <option value="AUD/CAD" selected>AUD/CAD</option>
                                <option value="EUR/CAD">EUR/CAD</option>
                            </select>
                        </div>
                        <div class="">
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
                    </div>
                    <!-- quantity -->
                    <div class="qty-row">
                        <div class="inline ">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" v-model="form.quantity" type="text" class="form-control quantity_input"
                                name="quantity" placeholder="10000" :class="{'is-invalid': form.errors.has('quantity')}"
                                @input="form.errors.clear('quantity')">
                        </div>
                        <p class="error-output error-trade-p trade-error" v-if="form.errors.has('quantity')" v-text="form.errors.get('quantity')"></p>
                    </div>
                    <!-- Price -->
                    <div class="price-row">
                        <div class="inline justify-content-end ">
                            <label>Price</label>
                            <input v-model="form.entry_price" type="text" class="form-control price_input"
                                placeholder="Entry" :class="{'is-invalid': form.errors.has('entry_price')}"
                                @input="form.errors.clear('entry_price')">
                            <input type="text" v-model="form.exit_price" class="form-control price_input" name="text"
                                placeholder="Exit" :class="{'is-invalid': form.errors.has('exit_price')}"
                                @input="form.errors.clear('exit_price')">
                            <input type="text" v-model="form.stop_loss_price" class="form-control price_input"
                                name="text" placeholder="Stop loss"
                                :class="{'is-invalid': form.errors.has('stop_loss_price')}"
                                @input="form.errors.clear('stop_loss_price')">
                        </div>
                        <p class="error-output error-trade-p" v-if="form.errors.has('entry_price') || form.errors.has('exit_price') || form.errors.has('stop_loss_price')" v-text="'Price format is invalid'"></p>
                    </div>
                    
                    <!--Date -->
                    <div class="date-row">
                        <div class="inline justify-content-end">
                            <label>Date</label>
                            <div class="date-inpit-div">
                                <date-pick 
                                    v-model="form.entry_date" 
                                    :pickTime="true" 
                                    :isDateDisabled="isFutureDate"
                                    :format="'YYYY-MM-DD HH:mm'"
                                    :inputAttributes="{readonly: false}"
                                    @input="form.errors.clear('entry_date')"
                                    :class="{'is-invalid': form.errors.has('entry_date')}">
                                </date-pick>
                            </div>
                        </div>
                        <div class="date-inpit-div mt-1">
                            <date-pick v-model="form.exit_date" 
                              :pickTime="true" 
                              :isDateDisabled="isFutureDate"
                              :inputAttributes="{readonly: true}" 
                                :format="'YYYY-MM-DD HH:mm'"
                               
                                @input="form.errors.clear('exit_date')"
                                :class="{'is-invalid': form.errors.has('exit_date')}">
                            </date-pick>
                            <span class="font-sm lighter p-0" v-if="duration && !form.errors.has('entry_date') && !form.errors.has('exit_date')">{{duration}}</span>
                            <p class="error-output w-25 p-0" v-if="form.errors.has('entry_date')"
                                v-text="form.errors.get('entry_date')"></p>
                            <p class="error-output w-25 p-0" v-if="!form.errors.has('entry_date') && form.errors.has('exit_date')"
                                v-text="form.errors.get('exit_date')"></p>    
                        </div>
                    </div>
                    <!-- Profit -->
                    <div class="profit_row">
                        <div class="inline justify-content-end">
                            <label for="pl_currency">Profit</label>
                            <input id="pl_currency" @keyup="calculateProfit" @input="form.errors.clear('pl_currency')"
                                v-model="form.pl_currency" type="text" placeholder="0.00" class="form-control"
                                :class="{'input-error': form.errors.has('pl_currency')}">
                            <input type="text" v-model="trade_return" class="form-control trade_return" tabindex="-1"
                                readonly>
                            <input type="text" @keyup="calculateProfit" @input="form.errors.clear('fees')"
                                v-model="form.fees" placeholder="Fees" class="form-control" name="fees" id="fees"
                                :class="{'is-invalid': form.errors.has('fees')}">
                        </div>
                        <div class="profit-input-div mt-1">
                            <input id="pips" v-model="form.pl_pips" type="text" class="form-control" name="pips"
                                placeholder="Pips" :class="{'is-invalid': form.errors.has('pl_pips')}"
                                @input="form.errors.clear('pl_pips')">  
                        </div>
                         <p class="error-output error-trade-p mt-4 pt-2" v-if="form.errors.has('pl_pips') || form.errors.has('pl_currency')" v-text="'The profit field is required'"></p>
                    </div>

                    <!-- Rules -->
                    <div class="rules-row">
                        <div class="inline justify-content-end">
                           <label>Rules</label>
                            <multiselect v-model="form.entry_rule_id" :options="entryrules" :multiple="true"
                                :close-on-select="false" :clear-on-select="false" :preserve-search="false" :max="3"
                                placeholder="Select entrty rules" id="entry_rules" label="name" track-by="id" :searchable="false"
                                :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, isOpen  }"><span
                                        class="multiselect__single"
                                        v-if="values.length &amp;&amp; !isOpen">{{ values.length }} rules
                                        selected</span>
                                </template>
                            </multiselect>
                        </div>
                        
                        <multiselect v-model="form.exit_reason_id" :options="exit_reason" :searchable="false"
                            :close-on-select="true" :show-labels="false" track-by="id" label="name"
                            placeholder="Exit Reason"></multiselect>

                       
                        <multiselect v-model="form.strategy_id" :options="strategies" :searchable="false"
                            :close-on-select="true" :show-labels="false" track-by="id" label="name"
                            placeholder="Strategy">
                        </multiselect>
                    </div>
                </div>
                <!-- Img/commentar -->
                <div class="flex-grow-1 img-commentar-div ml-md-4">
                    <div class="">
                        <div class="trade_img text-center mb-4">
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
                        <texteditor :item="form" class=""></texteditor>
                    </div>

                </div>
            </div>

            <div class="d-flex justify-content-end p-4">
                <button type="button" id="tests" class="btn btn-secondary mr-3"
                    @click="clearFileds">Clear</button>
                <button type="button" class="btn bt btn-primary mr-0" @click="recordTrade">Record
                    Trade</button>
            </div>
        </section>
    </form>

</template>

<script>
import Texteditor from "../Texteditor.vue";
import Multiselect from "vue-multiselect";
import DatePick from "vue-date-pick";
//import Chart from "../Chart.vue";

export default {
  name: "Traderecord",
  props: ["strategies", "exit_reason", "entryrules"],
  components: {
    Texteditor,
    Multiselect,
    DatePick,

    //Chart,
  },

  data() {
    return {
      portfolio: "",
      Difference_in_ms: "",
      loading: true,
      form: new Form({
        symbol: "AUD/CAD",
        type_side: "buy",
        quantity: "10000",
        entry_price: "1.00000",
        exit_price: "1.00000",
        stop_loss_price: "1.00000",
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
        height: "396",
        placeholder: "Write you thougts about this trade",
      }),
    };
  },
  mounted() {
    this.getPortfolioEquity();
    this.today();
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
            "d/" +
            Math.trunc(hour) +
            "h/" +
            Math.trunc(minute) +
            "m"
          );
        } else {
          return "The date is incorrect";
        }
      }
    },

    trade_return: function () {
      return (
        ((this.form.pl / this.portfolio.current_balance || 0) * 100).toFixed(
          2
        ) + "%"
      );
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

    today() {
      var today = new Date();
      var date =
        today.getFullYear() +
        "-" +
        ("0" + (today.getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + (today.getDate() + 1)).slice(-2);
      var time =
        today.getHours() + ":" + ("0" + (today.getMinutes() + 1)).slice(-2);
      var dateTime = date + " " + time;
      this.form.entry_date = dateTime;
      this.form.exit_date = dateTime;
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

    calculateProfit() {
      return [(this.form.pl = this.form.pl_currency - this.form.fees)];
    },

    getPortfolioEquity() {
      axios
        .get("/dashboardPages/portfolioIsActive/g")
        .then((res) => {
          this.portfolio = res.data;
          //this is send to navbar
          this.$root.$emit("portfolio_balance", res.data[0]); // optional we can put second argumen -> this.$root.$emit("portfolio_balance", data)
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
      axios
        .post("/dashboardPages/traderecord/p", data)
        .then((res) => {
          this.getPortfolioEquity();
          this.clearFileds();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
    clearFileds() {
      this.form.reset();
      this.today();
      this.form.type_side = "buy";
      this.form.symbol = "AUD/CAD";
      this.form.time_frame = "1 min";
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
