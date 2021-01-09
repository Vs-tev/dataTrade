<template>
    <div class="col-12 col-xl-6 mb-3 mb-xl-0">
        <label for="quantity">Strategy</label>
        <select class="strategy" id="eee" data-max="1" multiple="multiple">
            <option v-for="strategy in strategies" :key="strategy.id" :value="strategy.id" v-html="strategy.name">
            </option>
        </select>
    </div>

</template>
<script>
import jQuery from "jquery";
window.jQuery = window.$ = jQuery;
require("./../easySelect/easySelect");
export default {
  name: "Selectstrategy",
  props: ["strategies"],

  updated() {
    $("select.strategy").easySelect({
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
