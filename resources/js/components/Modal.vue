<template>
     <div class="modal" id="modal-form">
            <div class="modal-dialog">
                <form  class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{item.title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="material-icons ml-auto close-btn icon-sm" >close</span>
                        </button>
                    </div>

                    <div class="modal-body" v-if="item.modal !== 'delete'">
                        <div class="modal-body">
                        <input type="hidden" id="id" v-model="item.id" class="form-control">

                        <div class="form-group mb-5">
                            <label for="name">Portfolio name</label>
                            <input type="text"  id="name" name="name" class="form-control" v-model="item.name" placeholder="Enter portfolio name">
                                <p class="error-output"
                            v-if="item.errors.has('name')" v-text="item.errors.get('name')"></p>
                        </div>

                         <div class="form-group mb-5"  v-if="item.modal == 'create' ">
                            <label for="start_equity">Equity</label>
                            <input type="text" id="start_equity" v-model="item.start_equity" name="start_equity" class="form-control" placeholder="Enter start equity">
                                <p class="error-output"
                            v-if="item.errors.has('start_equity')" v-text="item.errors.get('start_equity')"></p>
                        </div>
        
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group mb-4 col-6 pl-0">
                            <label for="currency">Currency</label>
                            <select id="currency" class="form-control" v-model="item.currency" name="currency">
                                <option :value="item.currency" v-text="item.currency" selected hidden></option>
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                                <option value="CHF">CHF</option>
                                <option value="AUD">AUD</option>
                                <option value="CAD">CAD</option>
                            </select>
                            <span class="error-output"
                            v-if="item.errors.has('currency')" v-text="item.errors.get('currency')"></span>
                        </div>

                         <div class="form-group mb-4  col-6 pr-0"  v-if="item.modal == 'create' ">
                            <label for="start_equity">Start date</label>
                            <input type="date" id="action_date" v-model="item.action_date" name="action_date" class="form-control">
                                <p class="error-output"
                            v-if="item.errors.has('action_date')" v-text="item.errors.get('action_date')"></p>
                        </div>

                    </div>

                    </div>
                    </div>
                      <div class="modal-body" v-if="item.modal == 'delete'">
                          <p>Are you sure want to delete <span class="font-weight-bold">"{{item.name}}"</span> </p>
                      </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="edit" class="btn btn-primary" v-if="item.modal == 'edit'">Save</button>
                        <button type="button" @click="store" class="btn btn-primary" v-if="item.modal == 'create'">Create</button>
                        <button type="button" @click="destroy" class="btn btn-danger" v-if="item.modal == 'delete'">Delete</button>
                       
                    </div>

                </form>
            </div>
        </div>
</template>
<script>
export default {
  name: "Modal",
  props: ["item"],

  methods: {
    edit: function () {
      this.$emit("edit", this.item);
    },

    store: function () {
      this.$emit("store", this.item);
    },

    destroy: function () {
      this.$emit("destroy", this.item);
    },
  },
};
</script>