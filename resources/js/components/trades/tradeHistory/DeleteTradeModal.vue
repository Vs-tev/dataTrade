<template>
    <div>
         <div class="modal" id="modal_delete_trade">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete
                        <span>{{trade.symbol}} &#8226; <span class="dark font-500">{{trade.time_frame}}</span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="material-icons ml-auto close-btn icon-sm">close</span>
                    </button>
                </div>
                <input type="hidden" v-model="trade.id" class="form-control">
                <div class="modal-body" >
                    <p>Are you sure want to delete this trade?</p>
                     <div class="p-0 m-0">
                         <ul class="list-unstyled">
                             <li class="p-2"><div class="d-flex"><span class="mr-3">Symbol:</span><span class="dark font-500">{{trade.symbol}}</span> </div></li>
                             <li class="p-2"><div class="d-flex"><span class="mr-3">Type:</span><span class="dark font-500">{{trade.type_side}}</span> </div></li>
                             <li class="p-2"><div class="d-flex"><span class="mr-3">Profit:</span><span class="dark font-500">{{trade.pl_currency}} {{trade.portfolio ? trade.portfolio.currency : ''}} | {{trade.pl_pips}} pips</span> </div></li>
                         </ul>
                     </div>
                </div>
              
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="destroyTrade" type="button" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</template>
<script>
export default {
  name: "DeleteTradeModal",

  props: ["trade"],

  methods: {
    destroyTrade: function () {
      this.$emit("destroyTrade", this.trade);
    },
  },
};
</script>