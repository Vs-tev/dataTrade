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
                <div class="list-editable-items p-0 col-12 col-md-8 mr-auto">
                    <input type="hidden" id="id" v-model="item.id" class="form-control">
                        <ul class="list-unstyled">
                            <li class="editable-item">
                                <label class=""></label>
                                <p class="font-500 font-lg mb-0">Make Transaction:</p>
                            </li>
                            <li class="editable-item">
                                <label class="label-item pr-4">Amount:({{currency}})</label>
                                <div class="w-100 mb-4">
                                    <input
                                        type="text"
                                        name="amount_transaction"
                                        v-model="item.amount_transaction"
                                        class="form-control-big"
                                        placeholder="For withdrawal type '-' "
                                        id="amount_transaction"
                                        @keyup="item.errors.clear('amount_transaction')">
                                        <p
                                            class="error-output "
                                            v-if="item.errors.has('amount_transaction')"
                                            v-text="item.errors.get('amount_transaction')"></p>
                                    </div>
                                </li>
                                <li class="editable-item">
                                    <label class="label-item pr-4">Date:</label>
                                    <div class="w-100 mb-2">
                                        <date-pick
                                            v-model="item.transaction_date"
                                            :pickTime="true"
                                            :isDateDisabled="isFutureDate"
                                            :format="'YYYY-MM-DD'"
                                            :inputAttributes="{readonly: true}"
                                            @input="item.errors.clear('transaction_date')"
                                            :class="{'is-invalid': item.errors.has('transaction_date')}">
                                            <template v-slot:default="{toggle, inputValue}">
                                                <div class="toggle-calendar transaction_date">
                                                    <button class="flex-grow-1" @click="toggle">
                                                        {{ inputValue || "Transaction date" }}
                                                    </button>
                                                    <span
                                                        v-if="inputValue"
                                                        @click="on_clear_start_date"
                                                        class="material-icons font-sm border rounded-circle">close</span>
                                                </div>
                                            </template>
                                        </date-pick>
                                        <p
                                            class="error-output"
                                            v-if="item.errors.has('transaction_date')"
                                            v-text="item.errors.get('transaction_date')"></p>
                                    </div>
                                </li>
                                <li class="editable-item pb-3 pt-4">
                                    <label class="label-item pr-4"></label>
                                    <button type="button" @click="storeTransaction" class="btn btn-primary">Save transaction</button>
                                </li>
                            </ul>
                        </div>

                        <table class="table table-sm table-hover">
                            <thead class="">
                                <tr>
                                    <th class="pl-2">Action date
                                        <span class="unicode-arrow">&#8645;</span>
                                    </th>
                                    <th class="pl-2">Transaction
                                        <span class="unicode-arrow">&#8645;</span>
                                    </th>
                                    <th class="pl-2">Action
                                        <span class="unicode-arrow"></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="transaction.data == '' ">
                                    <td colspan="3" class="text-center">
                                        <span class="text-muted">There is no transaction</span>
                                    </td>
                                </tr>
                                <tr v-for="row in transaction.data" :key="row.id">
                                    <td class="pl-2">{{row.action_date}}</td>
                                    <td class="pl-2" :class=" {'red' : row.amount < 0}">{{row.amount}}
                                        {{currency}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button @click="delete_transaction(row.id)" class="btn">
                                                <span class="material-icons">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <p>Page:
                                {{transaction.current_page}}</p>
                            <p>Total transactions:
                                {{transaction.total}}</p>
                        </div>
                        <pagination
                            :pagination="transaction"
                            :pages="links"
                            v-on:setPage="setPage($event)"></pagination>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import Pagination from "../Pagination";
import DatePick from "vue-date-pick";

export default {
  components: { Pagination, DatePick },
  name: "ModalTransaction",
  props: ["item", "transaction", "links", "currency"],

  methods: {
    isFutureDate(date) {
      const currentDate = new Date();
      return date > currentDate;
    },

    on_clear_start_date() {
      this.item.transaction_date = "";
    },

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
<style src="vue-date-pick/dist/vueDatePick.css"></style>
<style scoped>
.label-item {
  min-width: 80px;
}
.toggle-calendar {
  width: 100%;
  height: calc(1.6em + 1.4rem + 2px);
  padding-right: 0.5rem;
  font-size: var(--font-normal);
  font-weight: 400;
  line-height: 1.6;
  color: var(--primary-color);
  background-color: var(--light);
  background-clip: padding-box;
  border: none;
  border-radius: 0.3rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.toggle-calendar button {
  background: none;
  border: 0;
  height: calc(1.6em + 1.4rem + 2px);
  padding: 0.4rem 0.5rem;
  text-align: left;
  white-space: nowrap;
  overflow: hidden;
}
.toggle-calendar span {
  padding: 3px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}
</style>