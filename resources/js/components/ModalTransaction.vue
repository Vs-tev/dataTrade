<template>
    <div class="modal" id="transactions" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transaction "Test Portfolio"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="material-icons icon-sm ml-auto close-btn">close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="font-lg dark mb-3 text-muted">Make Transaction:</p>
                    <div class="d-lg-flex align-items-center">
                        <input type="hidden" id="id" v-model="item.id" class="form-control">
                        <div class="form-group mb-4 mr-0 mr-md-3">
                            <label class="mr-0 mr-ml-1">Amount:</label>
                            <input type="text" name="amount_transaction" v-model="item.amount_transaction"
                                class="form-control" placeholder="For withdrawal type '-' " id="amount_transaction"
                                @keyup="item.errors.clear('amount_transaction')">
                            <p class="error-output " v-if="item.errors.has('amount_transaction')"
                                v-text="item.errors.get('amount_transaction')"></p>
                        </div>
                        <div class="form-group mb-4 pr-0 pt-3 pt-lg-0">
                            <label class="mr-0 mr-md-1">Date:</label>
                            <input type="date" id="transaction_date" v-model="item.transaction_date"
                                name="transaction_date" class="form-control"
                                @change="item.errors.clear('transaction_date')">
                            <p class="error-output" v-if="item.errors.has('transaction_date')"
                                v-text="item.errors.get('transaction_date')"></p>
                        </div>

                        <div class="form-group ml-0 ml-lg-3 pt-3 pt-lg-0">
                            <button type="button" @click="storeTransaction" class="btn btn-primary">Save
                                transaction</button>
                        </div>
                    </div>
                    <p class="font-lg dark mt-5 mb-3 text-muted">Transaction History:</p>
                    <div class="transactions_deteils">
                        <div class="form-group w-50 mb-2">
                            <input type="text" class="form-control search-input" name="text"
                                placeholder="Search Transaction">
                            <span class="material-icons search-i icon-sm">search</span>
                        </div>

                        <table class="table table-sm table-hover">
                            <thead class="">
                                <tr>
                                    <th class="pl-2">Action date <span class="unicode-arrow">&#8645;</span></th>
                                    <th class="pl-2">Transaction <span class="unicode-arrow">&#8645;</span></th>
                                    <th class="pl-2">Action <span class="unicode-arrow"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!transaction.length">
                                    <td colspan="3" class="text-center">
                                        <span class="text-muted">There is no transaction</span> 
                                    </td>
                                </tr>
                                <tr v-for="row in transaction.data" :key="row.id">
                                    <td class="pl-2">{{row.action_date}}</td>
                                    <td class="pl-2" :class=" {'red' : row.amount < 0}">{{row.amount}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button @click="delete_transaction(row.id)" class="btn btn-link"> <img
                                                    src="/storage/icons/trash-sm.svg" alt=""></button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <p>Page: {{transaction.current_page}}</p>
                            <p>Total transactions: {{transaction.total}}</p>
                        </div>
                        
                        <pagination :pagination="transaction" :pages="links" v-on:setPage="setPage($event)"></pagination>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Pagination from "./Pagination";

export default {
  components: { Pagination },
  name: "ModalTransaction",
  props: ["item", "transaction", "transact", "links"],
  //props: ["transaction"],

  methods: {
    storeTransaction: function () {
      this.$emit("storeTransaction", this.item);
    },
    delete_transaction: function delete_transaction(id) {
      this.$emit("delete_transaction", id);
    },
    setPage: function setPage(page) {
      this.$emit("setPage", page);
    },
  },
};
</script>