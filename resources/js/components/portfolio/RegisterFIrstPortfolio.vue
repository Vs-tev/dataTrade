<template>
    <div class="d-flex justify-content-center py-5 px-2 px-md-0">
    <div class="m-auto p-3 pm-0 ">
        <div class="text-center mb-5">
            <h2 class="uppercase font-weight-bolder primary">dataTrade </h2>
        </div>
        <div class="py-4 ">
            <h1 class="font-weight-bold dark text-center">Create Recording Portfolio</h1>
        </div>
        <div class="form-group mb-5">
            <label class="font-lg font-weight-bold dark">Name</label>
            <input type="text" class="form-control auth-input" v-model="value.name"  placeholder="Portfolio name">
             <p class="error-output"
                            v-if="value.errors.has('name')" v-text="value.errors.get('name')"></p>
        </div>
        <div class="form-group mb-5">
            <label class="font-lg font-weight-bold dark" >Start Equity</label>
            <input type="text" class="form-control auth-input" v-model="value.start_equity"  placeholder="Enter start equity">
            <p class="error-output"
                            v-if="value.errors.has('start_equity')" v-text="value.errors.get('start_equity')"></p>
        </div>
            <div class="form-group row mx-0 mb-5">
                <div class="col-6 pl-0">
                    <label class="font-lg font-weight-bold dark">Currency</label>
                    <select class="form-control auth-input auth-input-w-50" v-model="value.currency">
                        <option value="EUR" selected>EUR</option>
                        <option value="USD">USD</option>
                        <option value="CHF">CHF</option>
                        <option value="AUD">AUD</option>
                        <option value="CAD">CAD</option>
                    </select>
                </div>
                 <div class="form-group col-6 pr-1">
                    <label class="font-lg font-weight-bold dark">Start Date</label>
                    <date-pick 
                        v-model="value.started_at"
                        :pickTime="false"
                        :isDateDisabled="isFutureDate"
                        :format="'YYYY-MM-DD'"
                        :inputAttributes="{readonly: true}"
                        @input="value.errors.clear('started_at')"
                        :class="{'is-invalid': value.errors.has('started_at')}">
                        <template v-slot:default="{toggle, inputValue}">
                               <div class="toggle-calendar">
                                   <button class="flex-grow-1" @click="toggle">
                                    {{ inputValue || "Select date" }}
                                </button>
                                <span v-if="inputValue" @click="value.started_at = '' " class="material-icons font-sm border rounded-circle">close</span>
                               </div>
                            </template>
                        </date-pick>
                    <p class="error-output" v-if="value.errors.has('started_at')" v-text="value.errors.get('started_at')"></p>
                </div>
            </div>
           

        <div class="form-group mb-5">
            <div class="d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-primary w-100 auth-btn" @click="create_portfolio(value)">
                    Ready to go
                </button>
            </div>
        </div>
         
    </div>
</div>
</template>
<script>
import DatePick from "vue-date-pick";
export default {
  name: "RegisterFIrstPortfolio",

  components: {
    DatePick,
  },
  data() {
    return {
      value: new Form({
        name: "",
        start_equity: "",
        currency: "EUR",
        started_at: "",
      }),
    };
  },

  methods: {
    checkResponseStatus(error) {
      if (error.response.status === 419 || error.response.status == 401) {
        window.location.href = "/login";
      } else {
        this.value.errors.record(error.response.data.errors);
      }
    },

    isFutureDate(date) {
      const currentDate = new Date();
      return date > currentDate;
    },

    create_portfolio: function store(value) {
      let data = new FormData();
      data.append("name", value.name);
      data.append("start_equity", value.start_equity);
      data.append("currency", value.currency);
      data.append("started_at", value.started_at);
      axios
        .post("/dashboardPages/portfolio/store", data)
        .then((res) => {
          //window.location.href = "/dashboardPages/dashboard";
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
  },
};
</script>
<style>
.toggle-calendar button {
  background: none;
  border: 0;
  text-align: left;
  white-space: nowrap;
  overflow: hidden;
}
.toggle-calendar {
  padding-left: 5px;
  border: none;
  background-color: var(--light);
  border-radius: 10px;
  font-size: var(--font-lg);
  height: 60px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  line-height: 1.2;
}
.toggle-calendar span {
  padding: 6px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  margin-right: 5px;
}
</style>