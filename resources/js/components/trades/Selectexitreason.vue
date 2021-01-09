<template>
    <div class="col-12 col-xl-6 mb-3 mb-xl-0">
        <label for="Exit Reason">Exit reason</label>
        <select class="exitreason" id="eee" data-max="1" multiple="multiple">
            <option v-for="exitreason in exitReasons" :key="exitreason.id" :value="exitreason.id" v-html="exitreason.name">
            </option>
        </select>
    </div>

</template>
<script>
import jQuery from "jquery";
window.jQuery = window.$ = jQuery;
require("./../easySelect/easySelect");
export default {
  name: "Selectexitreason",
  props: ["exitReasons"],

  updated() {
    $("select.exitreason").easySelect({
      buttons: false,
      search: true,
      placeholderColor: "#6c757d",
      selectColor: "#495057",
      showEachItem: true,
      placeholder: "Select used strategy",
      width: "100%",
      dropdownMaxHeight: "255px",
    });
  },
};
</script>
