<template>
  <div class="w-100 d-flex justify-content-center" v-if="display">
    <div class="undo-message-box bg-dark rounded shadow p-3">
        <div class="d-flex justify-content-between align-items-center" v-if="undo_delete">
            <div class="light font-500 mr-4">{{message}}</div>
            <button type="button" @click="undo" class="btn cyan font-500 mr-4 border-0">Undo</button>
            <button type="button" class="close" @click="close">
                <span class="material-icons light icon-sm">close</span>
            </button>
        </div>
        <div class="d-flex justify-content-between align-items-center" v-else>
            <div class="light font-500 mr-4">{{message}}</div>
            <button type="button" class="close" @click="close">
                <span class="material-icons light icon-sm" >close</span>
            </button>
        </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "UndoActionMessage",
  data() {
    return {
      display: false,
      undo_delete: false,
      message: "",
      item: "",
    };
  },
  methods: {
    undo: function () {
      this.$emit("undo", this.item);
    },

    deleted(message, item_id) {
      this.display = true;
      this.item = item_id;
      setTimeout(function () {
        $(".undo-message-box").addClass("slideDown");
      }, 200);
      this.undo_delete = true;
      this.message = message;
    },

    undoMessage(message) {
      this.display = true;
      setTimeout(function () {
        $(".undo-message-box").addClass("slideDown");
      }, 400);
      this.undo_delete = false;
      this.message = message;
      setTimeout(function () {
        $(".undo-message-box").removeClass("slideDown");
      }, 4000);
      setTimeout(() => (this.display = false), 4200);
    },

    close() {
      $(".undo-message-box").removeClass("slideDown");
      setTimeout(() => (this.display = false), 1000);
    },
  },
};
</script>
<style>
.undo-message-box {
  position: fixed;
  top: -90px;
  z-index: 99;
  transition: all 0.3s ease-in-out;
}
.slideDown {
  top: 20px;
  transition: all 0.3s ease-in-out 0.3s;
}
</style>