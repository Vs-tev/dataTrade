<template>
     <section class="dashboard_container_content p-0">  
          <div class="border-bottom px-4 py-3">
                <h4 class="font-weight-500 m-0">Trade History</h4>
                <p class="lighter font-500 mb-0">All recorded trades in one place</p>
            </div>
            <div class="d-md-flex mb-3 p-2">

                <div class="form-group col-12 col-md-3 col-lg-3">
                    <label for="portfolio">Portfolio</label>
                    <select class="form-control" id="portfolio" name="portfolio">
                        <option :value="item.id" v-for="item in portfolio" :key="item.id">{{item.name}}</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-3 col-lg-3">
                    <label for="sort_by_profit">Show</label>
                    <select id="sort_by_profit" class="form-control" name="sort_by_profit">
                        <option value="Volvo">All</option>
                        <option value="Opel">Winners</option>
                        <option value="Audi">Losers</option>
                    </select>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-4">
                    <label for="date">Trade date</label>
                    <div class="d-flex">
                        <div>
                             <date-pick 
                            v-model="date" 
                            :pickTime="true" 
                            :format="'YYYY-MM-DD HH:mm'"
                            :inputAttributes="{readonly: false}"
                            >
                            <template v-slot:default="{toggle, inputValue}">
                            <button @click="toggle" class="toggle-calendar start_date">
                                {{ inputValue || ' Start date ' }}
                            </button>
                            </template>
                        </date-pick>
                        </div>
                      
                        <span class="input-group-text between_date icon-sm material-icons px-0 mx-0">more_horiz</span>
                        
                        <div>
                            <date-pick 
                            v-model="date" 
                            :pickTime="true" 
                            :format="'YYYY-MM-DD HH:mm'"
                            :inputAttributes="{readonly: false}"
                            >
                            <template v-slot:default="{toggle, inputValue}">
                            <button @click="toggle" class="toggle-calendar end_date">
                                {{ inputValue || ' End date ' }}
                            </button>
                            </template>
                            </date-pick>
                        </div>
                         
                    </div>
                </div>
                <div class="form-group col-12 col-md-2 col-lg-2 align-self-end mt-3 mt-lg-0 float-lg-right">
                    <div class="dropdown ">
                        <button type="button" class="btn btn-secondary" data-toggle="dropdown">
                            <span class="material-icons cyan mr-1">
                                view_agenda
                            </span>
                            View
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <h5 class="dropdown-header indigo">CHOOSE VIEW</h5>
                            <a class="dropdown-item" id="choose-table-view" href="#"><span class="material-icons lighter icon-sm">
                                    toc
                                </span>Table</a>
                            <a class="dropdown-item" id="choose-largerow-view" href="#"><span class="material-icons lighter icon-sm">
                                    calendar_view_day
                                </span>Large Row</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex col-12 px-4 pb-4">
                <button type="button" class="btn btn-primary mr-3">
                    <span class="material-icons white mr-1">search</span>
                    Search
                </button>
                <button type="button" class="btn btn-secondary">
                    <span class="material-icons text-muted mr-1">clear</span>
                    Reset
                </button>
            </div>
        </section>
</template>
<script>
import DatePick from "vue-date-pick";
export default {
  name: "SortingTrades",
  components: { DatePick },
  data() {
    return {
      portfolio: "",
      date: "",
    };
  },

  mounted() {
    this.fetchportfolio();
  },

  methods: {
    checkResponseStatus(error) {
      if (error.response.status === 419 || error.response.status == 401) {
        window.location.href = "/login";
      } else {
        this.form.errors.record(error.response.data.errors);
      }
    },

    fetchportfolio() {
      axios
        .get("/dashboardPages/portfolio/g")
        .then((res) => {
          this.portfolio = res.data;
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
  },
};
</script>
<style scoped>
.toggle-calendar[data-v-44cb10b9] {
  width: 160px;
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
@media screen and (max-width: 1190px) {
  .toggle-calendar[data-v-44cb10b9] {
    width: 100%;
    padding: 0 10px 0 10px;
  }
}
</style>