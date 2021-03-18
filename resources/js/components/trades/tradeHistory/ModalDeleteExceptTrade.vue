<template>
    <div>
         <div class="modal" id="modal_delete_trade">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="trade.modal_type == 'delete'">Delete
                        <span class="lighter font-normal pl-1">{{trade.data.symbol}} &#8226; <span class="font-500">{{trade.data.time_frame}}</span></span>
                    </h5>
                     <h5 class="modal-title" v-if="trade.modal_type == 'except_trade'">Exept trade 
                      <span class="lighter font-normal pl-1">{{trade.data.symbol}} &#8226; <span class="font-500">{{trade.data.time_frame}}</span></span>   
                    </h5>
                     <h5 class="modal-title" v-if="trade.modal_type == 'include_trade'">Include trade
                      <span class="lighter font-normal pl-1">{{trade.data.symbol}} &#8226; <span class="font-500">{{trade.data.time_frame}}</span></span>   
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="material-icons ml-auto close-btn icon-sm">close</span>
                    </button>
                </div>
                <input type="hidden" v-model="trade.id" class="form-control">
                <div class="modal-body" v-if="trade.modal_type == 'delete'">
                    <p>Are you sure want to delete this trade?</p>
                     <div class="p-0 m-0">
                         <ul class="list-unstyled">
                             <li class="p-2"><div class="d-flex"><span class="mr-3">Symbol:</span><span class="dark font-500">{{trade.data.symbol}}</span> </div></li>
                             <li class="p-2"><div class="d-flex"><span class="mr-3">Type:</span><span class="dark font-500">{{trade.data.type_side}}</span> </div></li>
                             <li class="p-2"><div class="d-flex"><span class="mr-3">Profit:</span><span class="dark font-500">{{trade.data.pl_currency}} {{trade.data.portfolio ? trade.data.portfolio.currency : ''}} | {{trade.data.pl_pips}} pips</span> </div></li>
                         </ul>
                     </div>
                </div>
                  <div class="modal-body" v-if="trade.modal_type == 'except_trade'">
                    <p>If this trade is an exception to your trading plan, 
                        for example an unexpectedly large profit or a loss of unforeseen circumstances, 
                        you can mark this trade as an exception and it will not be calculated in the overall 
                        performance of the portfolio. You can change this at any time.</p>
                        <br>
                         <p>Are you sure want to except this trade?</p>
                </div>
                 <div class="modal-body" v-if="trade.modal_type == 'include_trade'">
                     <p>This action will include back the trade and it will be calculated in the overall 
                        performance of the portfolio.</p>
                     <p>Are you sure want to include this trade?</p>
                </div>

              
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="destroyTrade" type="button" class="btn btn-danger" v-if="trade.modal_type == 'delete'">Delete</button>
                    <button type="button" @click="confirm_except_trade" class="btn btn-primary" data-dismiss="modal" v-if="trade.modal_type !== 'delete'">Confirm</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</template>
<script>
export default {
  name: "ModalDeleteExceptTrade",

  props: ["trade"],

  methods: {
    destroyTrade: function () {
      this.$emit("destroyTrade", this.trade.data.id);
    },

    confirm_except_trade: function () {
      this.$emit("confirm_except_trade", this.trade.data.id);
    },
  },
};
</script>