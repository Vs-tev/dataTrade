<template>
     <section class="dashboard_container_content p-0">  
          <div class="border-bottom px-4 py-3">
                <h4 class="font-weight-500 m-0">Trade History</h4>
                <p class="lighter font-500 mb-0">All recorded trades in one place</p>
            </div>
            <div class="d-md-flex flex-wrap mb-3 px-2 pt-3">
                <div class="form-group col-12 col-md-3 col-lg-3 ">
                    <label>Portfolio:</label>
                    <select v-model="selectedPortfolio" class="form-control" @change="change_portfolio">
                        <option :value="portfolio.id" v-for="(portfolio, index) in portfolios" :key="index">{{portfolio.name}}</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-3 col-lg-3 mt-3 mt-lg-0">
                    <label>Show:</label>
                    <select v-model="sort_pl" @change="sort_by_profit" class="form-control" name="sort_by_profit">
                        <option value="all" selected="selected">All</option>
                        <option value="winners">Winners</option>
                        <option value="losers">Losers</option>
                    </select>
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
                <button type="button" class="btn btn-secondary">
                    <span class="material-icons text-muted mr-1">clear</span>
                    Reset
                </button>
                <h1></h1>
            </div>
        </section>
</template>
<script>
import DatePick from "vue-date-pick";
export default {
  name: "SortingTrades",
  components: { DatePick },
  props: ["portfolios"],
  data() {
    return {
      start_date: "",
      exit_date: "",

      sort_pl: "all",
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
      this.selectedPortfolio = this.$props.portfolios[0].id;
    },

    change_portfolio: function () {
      this.$emit("change_portfolio", this.selectedPortfolio);
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
  },
};
</script>

<style scoped>
.toggle-calendar[data-v-44cb10b9] {
  width: 190px;
  text-align: left;
  height: calc(1.6em + 0.8rem + 2px);
  padding: 0.4rem 0.45rem;
  font-size: var(--font-normal);
  font-weight: 400;
  line-height: 1.6;
  color: var(--primary-color);
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.2rem;
  display: flex;
  justify-content: space-between;
}
.toggle-calendar[data-v-44cb10b9][data-v-44cb10b9] button {
  background: none;
  border: 0;
  text-align: left;
}
.toggle-calendar[data-v-44cb10b9][data-v-44cb10b9] span {
  padding: 3.5px;
  cursor: pointer;
}
.start_date[data-v-44cb10b9][data-v-44cb10b9]:first-of-type {
  border-right: none;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
.end_date[data-v-44cb10b9][data-v-44cb10b9] {
  border-left: none;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
.between_date[data-v-44cb10b9] {
  border-radius: 0;
}
@media screen and (max-width: 1734px) {
  .toggle-calendar[data-v-44cb10b9][data-v-44cb10b9] {
    width: 180px;
  }
}
@media screen and (max-width: 1683px) {
  .toggle-calendar[data-v-44cb10b9][data-v-44cb10b9] {
    width: 160px;
  }
}
@media screen and (max-width: 1190px) {
  .toggle-calendar[data-v-44cb10b9][data-v-44cb10b9] {
    width: 140px;
  }
}
@media screen and (max-width: 947px) {
  .toggle-calendar[data-v-44cb10b9][data-v-44cb10b9] {
    width: 130px;
  }
}
</style>