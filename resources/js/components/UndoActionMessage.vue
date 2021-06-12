<template>
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
</template>
<script>
export default {
  props: ["undo_id"],
  name: "UndoActionMessage",
  data() {
    return {
      undo_delete: false,
      message: "",
    };
  },
  methods: {
    undo: function () {
      this.$emit("undo", this.undo_id);
    },

    deleted(message) {
      $(".undo-message-box").show();
      $(".undo-message-box").addClass("slideDown");
      this.undo_delete = true;
      this.message = message;
    },

    undoMessage(message) {
      this.undo_delete = false;
      this.message = message;
    },

    close() {
      $(".undo-message-box").removeClass("slideDown");
      setTimeout(function () {
        $(".undo-message-box").hide();
      }, 400);
    },
  },
};
</script>
<style>
.undo-message-box {
  position: fixed;
  top: -70px;
  z-index: 99;
  transition: all 0.3s ease-in-out;
}
.slideDown {
  top: 20px;
  transition: all 0.3s ease-in-out;
}
</style>