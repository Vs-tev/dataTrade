<template>
    <div class="col-12 col-xl-6 mb-3 mb-xl-0">
      <div class="form-group">
          <label for="symbol">Entry Rules<span class="material-icons icon-sm tooltip" 
              data-toggle="tooltip" data-placement="top"
              title="You can choose up to 3 entry rules per trade">info</span></label>
          <select class="entryrule" id="" data-max="3" multiple="multiple">
              <option v-for="entryrule in entryRules" :key="entryrule.id" :value="entryrule.id" v-html="entryrule.name"></option>
            
          </select>

      </div>
  </div>

</template>
<script>
import jQuery from "jquery";
window.jQuery = window.$ = jQuery;
require("./../easySelect/easySelect");
export default {
  name: "Selectentryrule",
  props: ["entryRules"],

  updated() {
    $("select.entryrule").easySelect({
      buttons: false,
      search: true,
      placeholderColor: "#6c757d",
      selectColor: "#495057",
      showEachItem: true,
      width: "100%",
      dropdownMaxHeight: "255px",
    });
  },
};
</script>
