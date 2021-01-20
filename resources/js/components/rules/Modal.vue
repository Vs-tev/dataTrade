<template>
     <div class="modal" id="modal-rule">
        <div class="modal-dialog">
            <form  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{item.title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="material-icons ml-auto close-btn icon-sm" >close</span>
                    </button>
                </div>
                <input type="hidden" id="id" v-model="item.id" class="form-control">

                <div class="modal-body" v-if="item.modal !== 'delete' ">
                    <div class="form-group mb-5">
                        <label for="name">Rule name</label>
                        <input type="text" id="name" name="name" class="form-control" v-model="item.name"  placeholder="Between 2 and 40 charachters">
                            <p class="error-output"
                        v-if="item.errors.has('name')" v-text="item.errors.get('name')"></p>
                    </div>
                </div>
                <div class="modal-body" v-if="item.modal == 'delete' ">
                          <p>Are you sure want to delete <span class="font-weight-bold">"{{item.name}}"?</span> </p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" v-if="item.modal == 'create'" @click="storeRule" class="btn btn-primary">Create</button>
                    <button type="button" v-if="item.modal == 'edit'" @click="updateRule" class="btn btn-primary">Save</button>
                    <button type="button" @click="destroyRule" class="btn btn-danger" v-if="item.modal == 'delete'">Delete</button>
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
    storeRule: function () {
      this.$emit("storeRule", this.item);
    },

    updateRule: function () {
      this.$emit("updateRule", this.item);
    },

    destroyRule: function () {
      this.$emit("destroyRule", this.item);
    },
  },
};
</script>