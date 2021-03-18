<template>
    <div class="modal" id="modal-symbol">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h4 class="font-500 my-auto">Symbol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn icon-sm">close</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="form-group align-items-center p-2 border-bottom">
                    <input type="text" @keyup="getSymbols(type)" v-model="search_symbol" name="text" placeholder="Search symbol" class="form-control font-lg font-weight-500 text-uppercase search-input input-focus-none border-0">
                        <span class="material-icons font-sm icon-sm search-i">search</span>
                    </div>

                    <div class="px-0">
                        <ul class="nav nav-tabs border-0 mb-2 px-4" role="tablist">
                            <li class="nav-item" @click="getSymbols('forex')">
                                <a href="#forex" class="nav-link active font-lg" role="tab" data-toggle="tab" aria-selected="true">Forex</a>
                            </li>
                            <li class="nav-item" @click="getSymbols('stock')">
                                <a href="#forex" class="nav-link font-lg" role="tab" data-toggle="tab" aria-selected="true">Stock</a>
                            </li>
                            <li class="nav-item" @click="getSymbols('crypto')">
                                <a href="#forex" class="nav-link font-lg" role="tab" data-toggle="tab" aria-selected="true">Crypto</a>
                            </li>
                            <li class="nav-item" @click="getSymbols('cfd')">
                                <a href="#forex" class="nav-link font-lg" role="tab" data-toggle="tab" aria-selected="true">CFD</a>
                            </li>
                             <li class="nav-item" @click="getSymbols('all')">
                                <a href="#forex" class="nav-link font-lg" role="tab" data-toggle="tab" aria-selected="true">All</a>
                            </li>

                        </ul>
                        <div class="tab-content scroll_modal_content pt-3">
                            <div id="forex" class="tab-pane active" role="tabpanel">
                               <ul class="list-group list-group-flush" >
                                    <li class="list-group-item list-group-item-action p-0" v-for="symbol in symbols" :key="symbol.id">
                                        <div class="d-flex justify-content-between p-3" @click="setSymbol(symbol.symbol)">
                                            <div class="font-lg font-500">{{symbol.symbol}}</div>
                                            <div class="lighter">{{symbol.type}}</div>
                                        </div>
                                    </li>
                                   <li v-if="symbols == '' " class="d-flex align-items-center justify-content-center h-100"><h4 class="font-500 text-muted">No Symbol Found</h4></li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <h6 class="m-auto text-muted">Not found what you're looking for?</h6>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  name: "ModalSymbol",

  data() {
    return {
      type: "forex",
      search_symbol: "",
      symbols: [],
    };
  },

  mounted() {
    this.getSymbols("forex");
  },

  methods: {
    getSymbols(typeSymbol) {
      this.type = typeSymbol;
      axios
        .get("/symbols", {
          params: {
            type: this.type,
            search_symbol: this.search_symbol,
          },
        })
        .then((res) => {
          this.symbols = res.data;
        });
    },

    setSymbol: function setSymbol(symbol) {
      this.$emit("setSymbol", symbol);
      $("#modal-symbol").modal("hide");
    },
  },
};
</script>