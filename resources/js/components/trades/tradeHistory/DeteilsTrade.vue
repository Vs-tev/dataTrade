<template>
    <div class="modal" id="modal_edit_trade">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="d-flex justify-content-between border-bottom px-4 py-4">
                        <div class="my-auto">
                             <h4 class="font-weight-500 m-0">Edit Trade</h4>
                        </div>
                            <button type="button" class="close my-auto" data-dismiss="modal" aria-label="Close">
                        <span class="material-icons ml-auto close-btn icon-sm">close</span>
                    </button>
                    </div>
                      <div class="modal-body">

                          <div class="container-edit-trade-img-container" >
                              <div class="img_list" v-if="trade.trade_img == 'noimage.jpg' || !trade.trade_img">
                                <div class="input-file-container js">
                                    <input class="d-none" @change="onFileSelected" id="img" name="img" type="file"
                                        accept="image/x-png,image/gif,image/jpeg">
                                    <label tabindex="0" for="img" class="input-file-trigger text-center"> <span
                                            class="material-icons icon-xl indigo ">cloud_upload</span>
                                        <h4 class="lighter font-500">Click here to upload image</h4>
                                        <p class="dark font-sm">Images, up to 3 MB, jpeg, png, gif </p>
                                    </label>
                                </div>
                            </div>
                              <div class="img-buttons" v-if="trade.trade_img && trade.trade_img !== 'noimage.jpg'">
                                <div class="remove-img">
                                    <img src="/storage/icons/remove.svg" @click="removeTradeImg" alt="">
                                </div>
                              </div>
                               <img v-if="trade.trade_img !== 'noimage.jpg'" class="modal-trade-img" :src="!trade.img_mode ? '/storage/trades/' + trade.trade_img : this.new_img " alt="">
                          </div>
                         
                          <div class="list-editable-items p-3 col-12 col-sm-10 col-lg-10 col-xl-9 mx-md-auto">
                              <ul class="list-unstyled">
                                  <li class="editable-item">
                                      <label class=""></label>
                                      <p class="font-500 font-lg mb-0">Edit trade:</p>
                                  </li>
                                   <li class="editable-item">
                                      <label class="label-item">Type side:</label>
                                      <select v-model="trade.type_side" class="form-control bg-light">
                                        <option value="buy">Buy</option>
                                        <option value="sell">Sell</option>
                                    </select>
                                  </li>
                                 <li class="editable-item">
                                      <label class="label-item">Symbol:</label>
                                      <select v-model="trade.symbol" class="form-control bg-light">
                                        <option value="AUD/CAD" selected>AUD/CAD</option>
                                        <option value="EUR/CAD">EUR/CAD</option>
                                    </select>
                                  </li>
                                   <li class="editable-item">
                                      <label class="label-item">Time frame:</label>
                                      <select v-model="trade.time_frame" class="form-control bg-light">
                                        <option value="1 min">1 min</option>
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
                                  </li>
                                    <li class="editable-item">
                                      <label class="label-item">Quantity:</label>
                                      <div class="w-100">
                                          <input type="text" v-model="trade.quantity" class="form-control border-0 bg-light" :class="{'is-invalid': form.errors.has('quantity')}"
                                            @input="form.errors.clear('quantity')">
                                            <p class="error-output" v-if="form.errors.has('quantity')" v-text="form.errors.get('quantity')"></p>
                                      </div>
                                      
                                  </li>
                                   <li class="editable-item">
                                      <label class=""></label>
                                      <p class="font-500 font-lg mb-0">Price:</p>
                                  </li>
                                    <li class="editable-item">
                                      <label class="label-item">Entry:</label>
                                      <div class="price">
                                          <input type= "text" v-model="trade.entry_price" class="form-control  border-0 bg-light mb-2 mb-lg-0" :class="{'is-invalid': form.errors.has('entry_price')}"
                                            @input="form.errors.clear('entry_price')">
                                            <p class="error-output" v-if="form.errors.has('entry_price')" v-text="form.errors.get('entry_price')"></p>

                                      </div>
                                      
                                      <label class="label-item">SL:</label>
                                      <div class="price">
                                        <input type="text"  v-model="trade.stop_loss_price" class="form-control  border-0 bg-light mb-2 mb-lg-0" >
                                            <p class="error-output" v-if="form.errors.has('stop_loss_price')" v-text="form.errors.get('stop_loss_price')"></p>
                                      </div>

                                      <label class="label-item">Exit:</label>
                                      <div class="price">
                                        <input type="text" v-model="trade.exit_price" class="form-control  border-0 bg-light mb-2 mb-lg-0" :class="{'is-invalid': form.errors.has('exit_price')}"
                                            @input="form.errors.clear('exit_price')">
                                            <p class="error-output" v-if="form.errors.has('exit_price')" v-text="form.errors.get('exit_price')"></p>
                                      </div>
                                  </li>
                                  <li class="editable-item py-0">
                                    <label class="label-item pt-0">Ratio:</label>
                                    <span v-if="risk_reward_ratio_computed">{{risk_reward_ratio_computed}}</span>
                                  </li>
                                  <li class="editable-item">
                                      <label class=""></label>
                                      <p class="font-500 font-lg mb-0">Rules:</p>
                                  </li>
                                    <li class="editable-item">
                                      <label class="label-item">Entry rules: </label>
                                      <multiselect 
                                      v-model="trade.entry_rules"
                                      :options="entryrules" 
                                      :multiple="true"
                                      :close-on-select="false" 
                                      :clear-on-select="false" 
                                      :preserve-search="false" 
                                      
                                      :max="3"
                                      :preselect-first="false"
                                      :searchable="false"
                                      label="name" track-by="id" 
                                      placeholder="Select entrty rules" class="select-rule mb-2 mb-lg-0" id="entry_rules" 
                                        >
                                        <template slot="selection" slot-scope="{ values, isOpen  }"><span
                                                class="multiselect__single"
                                                v-if="values.length &amp;&amp; !isOpen">{{ values.length }} rules
                                                selected</span>
                                        </template>
                                    </multiselect>
                                      <label class="label-item">Exit:</label>
                                      <multiselect v-model="trade.exit_reason" :options="exit_reason" :searchable="false"
                                        :close-on-select="true" :show-labels="false" :clear-on-select="true" track-by="id" label="name"
                                        placeholder="Exit Reason">
                                        </multiselect>
                                  </li>
                                     <li class="editable-item">
                                      <label class="label-item">Used strategy:</label>
                                      <multiselect v-model="trade.strategy" :options="strategies" :searchable="false"
                                        :close-on-select="true" :clear-on-select="true"  :show-labels="false" track-by="id" label="name"
                                        placeholder="Select used strategy"></multiselect>
                                  </li>
                                   <li class="editable-item">
                                      <label class=""></label>
                                      <p class="font-500 font-lg mb-0">Trade note:</p>
                                  </li>
                                   <li class="editable-item">
                                      <label class="label-item"></label>
                                      <div class="w-100">
                                        <textarea class="form-control border-0 bg-light" v-model="trade.trade_notes" cols="30" rows="8" :class="{'is-invalid': form.errors.has('trade_notes')}"
                                            @input="form.errors.clear('trade_notes')" placeholder="Write your analysis or thoughts about this trade"></textarea>
                                        <p class="error-output" v-if="form.errors.has('trade_notes')" v-text="form.errors.get('trade_notes')"></p>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" @click="update" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
import Multiselect from "vue-multiselect";
export default {
  name: "DeteilsTrade",
  components: {
    Multiselect,
  },

  props: ["trade", "portfolios", "strategies", "exit_reason", "entryrules"],

  data() {
    return {
      new_img: "",
      form: new Form({
        quantity: "",
        entry_price: "",
        exit_price: "",
        stop_loss_price: "",
        entry_date: "",
        exit_date: "",
        trade_notes: "",
        trade_img: "",
        risk_reward: "",
      }),
    };
  },
  computed: {
    risk_reward_ratio_computed: function () {
      var entry = this.trade.entry_price;
      var exit = this.trade.exit_price;
      var stop = this.trade.stop_loss_price;
      if (entry && exit && stop) {
        var result = ((entry - exit) / (stop - entry) || 0).toFixed(2);
        if (isFinite(result)) {
          this.form.risk_reward = result;
          return result;
        } else {
          this.form.risk_reward = 0;
          return 0;
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

    /* risk_reward_ratio: function () {
      var entry = this.trade.entry_price;
      var exit = this.trade.exit_price;
      var stop = this.trade.stop_loss_price;
      if (entry && exit && stop) {
        var result = ((entry - exit) / (stop - entry) || 0).toFixed(2);
        if (isFinite(result)) {
          this.form.risk_reward = result;
        } else {
          this.form.risk_reward = 0;
        }
      }
    }, */

    update: function () {
      const data = new FormData();
      data.append("symbol", this.trade.symbol);
      data.append("type_side", this.trade.type_side);
      data.append("quantity", this.trade.quantity);
      data.append("entry_price", this.trade.entry_price);
      data.append("exit_price", this.trade.exit_price);
      data.append("stop_loss_price", this.trade.stop_loss_price);
      data.append("time_frame", this.trade.time_frame);
      if (this.trade.trade_notes !== null) {
        data.append("trade_notes", this.trade.trade_notes);
      }
      data.append("risk_reward", this.form.risk_reward);
      if (this.trade.exit_reason) {
        data.append("exit_reason_id", this.trade.exit_reason.id);
      }
      if (this.trade.strategy) {
        data.append("strategy_id", this.trade.strategy.id);
      }
      data.append("trade_img", this.trade.trade_img);
      data.append(
        "entry_rule_id",
        this.trade.entry_rules.map(
          (item) =>
            ({
              id: item.id,
            }.id)
        )
      );
      axios
        .post("/dashboardPages/tradehistory/u/" + this.trade.id, data)
        .then((res) => {
          this.$emit("update");
          $("#modal_edit_trade").modal("hide");
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    onFileSelected() {
      this.trade.img_mode = true;
      this.trade.trade_img = event.target.files[0];
      this.new_img = URL.createObjectURL(this.trade.trade_img);
    },

    removeTradeImg() {
      this.trade.trade_img = "";
      this.new_img = "";
      this.trade.img_mode = true;
    },
  },
};
</script>