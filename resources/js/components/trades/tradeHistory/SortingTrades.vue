<template>
  <section class="dashboard_container_content p-0">  
    <div class="border-bottom px-4 py-3">
      <h4 class="font-weight-normal m-0">Trade History</h4>
      <p class="lighter font-500 mb-0">All recorded trades in one place</p>
    </div>
      <div class="d-md-flex flex-wrap mb-3 px-2 pt-3">
          <div class="form-group col-12 col-lg-3 ">
              <label>Portfolio:</label>
              <multiselect v-model="selectedPortfolio" @input="change_portfolio" :options="portfolios" :searchable="false" 
                      :close-on-select="true" class="font-sm" :allow-empty="false"  :show-labels="false" label="name" track-by="id">
              </multiselect>

          </div>
            <div class="form-group col-12 col-lg-2 mt-3 mt-lg-0">
            <label>Sort by frame</label>
              <multiselect v-model="selected_frame" @input="sort_by_time_frame" :options="time_frame" :multiple="true"
                  :close-on-select="false" :preserve-search="false" :show-labels="false"
                    :searchable="false"
                  :preselect-first="false">
                  <template slot="selection" slot-scope="{ values, isOpen  }"><span
                          class="multiselect__single"
                          v-if="values.length &amp;&amp; !isOpen">{{ values.length }} time frames
                          </span>
                  </template>
              </multiselect>
          </div>
          <div class="form-group col-12 col-lg-2 mt-3 mt-lg-0">
              <label>Show:</label>
                <multiselect  v-model="sort_pl" @input="sort_by_profit" :options="sort_by" :searchable="false"
                      :close-on-select="true" :show-labels="false" :allow-empty="false"
                      placeholder="All">
              </multiselect>
          </div>

          <div class="form-group col mt-3 mt-lg-0">
              <label for="date">Trade Date:</label>
              <div class="d-flex">
                  <div>
                      <date-pick 
                      v-model="start_date" 
                      @input="searchDateRange"
                      :pickTime="true" 
                      :format="'YYYY-MM-DD HH:mm'"
                      :inputAttributes="{readonly: false}">
                      <template v-slot:default="{toggle, inputValue}">
                          <div class="toggle-calendar start_date">
                              <button class="flex-grow-1" @click="toggle">
                              {{ inputValue || "Start date" }}
                          </button>
                          <span v-if="inputValue" @click="on_clear_start_date" class="material-icons font-sm border rounded-circle">close</span>
                          </div>
                      </template>
                  </date-pick>
                  </div>
                  <span class="input-group-text between_date icon-sm material-icons px-0 mx-0">more_horiz</span>
                  <div>
                      <date-pick 
                      v-model="exit_date"
                      @input="searchDateRange"
                      :pickTime="true" 
                      :format="'YYYY-MM-DD HH:mm'"
                      :inputAttributes="{readonly: false}">
                        <template v-slot:default="{toggle, inputValue}">
                          <div class="toggle-calendar end_date">
                              <button class="flex-grow-1" @click="toggle">
                              {{ inputValue || "End date" }}
                          </button>
                          <span v-if="inputValue" @click="on_clear_exit_date" class="material-icons font-sm border rounded-circle">close</span>
                          </div>
                      </template>
                      </date-pick>
                  </div>
              </div>
          </div>

      </div>
      <div class="d-flex col-12 px-4 pb-4">
          <div class="custom-control custom-checkbox">
              <input type="checkbox" v-model="except_trade" @change="toggle_excepted_trade" class="custom-control-input" id="exept_trades" name="example1">
              <label class="custom-control-label" for="exept_trades">Show Except trades</label>
          </div>
      </div>
  </section>
</template>
<script>
import DatePick from "vue-date-pick";
import Multiselect from "vue-multiselect";
export default {
  name: "SortingTrades",
  components: { DatePick, Multiselect },
  props: ["portfolios"],
  data() {
    return {
      time_frame: [
        "1 min",
        "5 min",
        "15 min",
        "30 min",
        "1 hour",
        "2 hours",
        "4 hours",
        "1 day",
        "1 week",
        "1 month",
      ],
      sort_by: ["All", "Winners", "Losers"],
      selected_frame: [],
      start_date: "",
      exit_date: "",
      sort_pl: "All",
      except_trade: "",
      selectedPortfolio: this.$props.portfolios,
    };
  },

  mounted() {
    this.setSelectedPortfolio();
  },

  computed: {
    today() {
      var today = new Date();
      var date =
        today.getFullYear() +
        "-" +
        ("0" + (today.getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + (today.getDate() + 1)).slice(-2);

      return date;
    },
  },

  methods: {
    setSelectedPortfolio() {
      this.selectedPortfolio = this.$props.portfolios[0];
    },

    change_portfolio: function () {
      this.$emit("change_portfolio", this.selectedPortfolio.id);
    },
    sort_by_time_frame: function () {
      this.$emit("sort_by_time_frame", this.selected_frame);
    },
    sort_by_profit: function () {
      this.$emit("sort_by_profit", this.sort_pl);
    },

    searchDateRange: function () {
      this.$emit("searchDateRange", [this.start_date, this.exit_date]);
    },

    on_clear_start_date() {
      this.start_date = "";
      this.searchDateRange();
    },

    on_clear_exit_date() {
      this.exit_date = "";
      this.searchDateRange();
    },

    toggle_excepted_trade() {
      this.$emit("toggle_excepted_trade", this.except_trade);
    },
  },
};
</script>
<style>
.multiselect__tags {
  font-size: var(--font-normal) !important;
  min-height: 30px;
  padding: 4px 40px 0 8px;
}
.multiselect__select {
  height: 32px;
  right: 1px;
  top: 0px;
}
.multiselect,
.multiselect__input,
.multiselect__single {
  font-size: var(--font-normal);
}
.multiselect__placeholder {
  margin-bottom: 6px;
}
</style>
<style scoped>
.toggle-calendar {
  width: 190px;
  text-align: left;
  height: calc(1.4em + 0.75rem + 2px);
  padding: 0.4rem 0.25rem;
  font-size: var(--font-normal);
  font-weight: 400;
  line-height: 1.2;
  color: var(--primary-color);
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.2rem;
  display: flex;
  justify-content: space-between;
}
.toggle-calendar button {
  background: none;
  border: 0;
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
.start_date:first-of-type {
  border-right: none;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
.end_date {
  border-left: none;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
.between_date {
  border-radius: 0;
}
@media screen and (max-width: 1734px) {
  .toggle-calendar {
    width: 180px;
  }
}
@media screen and (max-width: 1683px) {
  .toggle-calendar {
    width: 160px;
  }
}
@media screen and (max-width: 1190px) {
  .toggle-calendar {
    width: 140px;
  }
}
@media screen and (max-width: 947px) {
  .toggle-calendar {
    width: 140px;
  }
}
</style>