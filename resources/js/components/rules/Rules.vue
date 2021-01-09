<template>
    <div>
        <ul class="nav nav-tabs mt-4 mx-4 mb-2" role="tablist"> 
            <li class="nav-item"><a href="#entry_rule" @click="setView('entry_rules')" class="nav-link active font-normal" role="tab" data-toggle="tab" aria-selected="true">Entry Rules</a></li>
            <li class="nav-item"><a href="" @click="setView('exit_reasons')" class="nav-link font-normal" role="tab" data-toggle="tab" aria-selected="true">Exit Reason</a></li>
        </ul>
        <div class="tab-content">
            <div id="entry_rule" class="tab-pane active" role="tabpanel">
                <div class="d-block d-md-flex justify-content-between align-items-center pt-4 pb-3 px-4">
                    <div class="form-group px-0 col-12 col-md-3">
                        <input type="text" class="form-control search-input" name="text" placeholder="Search rule">
                        <span class="material-icons font-sm icon-sm search-i">search</span>
                    </div>
                    <button type="button" @click="addNewRule" class="btn btn-primary font-weight-500 mt-2 mt-md-0" data-target="#modal-rule"
                        data-toggle="modal" v-text="buttonText"></button>
                </div>
                <div class="col rule-table-div px-2 px-sm-4">
                    <table class="table table-rules">
                        <thead>
                            <tr>
                                <th class="font-500 font-md">{{this.thTitle}}</th>
                                <th class="lighter font-md font-500 d-none d-md-flex"># TRADES</th>
                                <th class="lighter font-md font-500 ">
                                    <div class="d-none d-md-block">SUCCESS</div>
                                </th>
                                <th class="lighter font-md font-500">ACTION</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr v-for="rule in rules" :key="rule.id">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar-letter m-0 h3" :class="{'bg-cyan white' : typeRule == 'exit_reasons'}">{{rule.name.charAt(0)}}</span>
                                        <div class="">
                                            <span class="m-0 p-0 font-normal font-weight-bold">{{rule.name}}</span>
                                            <p class="m-0 p-0 lighter font-md font-500">Created: <span>{{rule.created_at}}</span></p>
                                        </div>
                                    </div>

                                </td>
                                <td class="d-none d-md-block">12 Trades
                                    <p class="m-0 p-0 lighter font-md font-500">Last: 6 days ago</p>
                                </td>
                                <td class="">
                                    <span
                                        class="d-none d-md-inline badge badge-light font-sm font-500 text-muted">28%</span>
                                </td>
                                <td>
                                    <div class="d-flex align-content-center">
                                        <button type="button"
                                        class="btn btn-secondary mr-2" data-toggle="modal" @click="getItem(rule)"
                                        data-target="#modal-rule"><img src="/storage/icons/edit-sm.svg" alt=""></button>

                                        <button type="button" class="btn btn-link" @click="deleteRule(rule)" 
                                        data-toggle="modal" data-target="#modal-rule"><img src="/storage/icons/trash-sm.svg" alt=""></button>
                                   
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
          
            <modal :item="form" v-on:storeRule="storeRule($event)" v-on:updateRule="updateRule($event)" v-on:destroyRule="destroyRule($event)"></modal>
        </div>
    </div>
</template>
<script>
import Modal from "./Modal";
export default {
  name: "Rules",
  components: {
    Modal,
  },
  data() {
    return {
      typeRule: "entry_rules",
      thTitle: "",
      buttonText: "",
      rules: [],
      form: new Form({
        id: "",
        name: "",
        title: "",
        modal: "",
      }),
    };
  },

  mounted: function mounted() {
    this.getRules();
  },

  methods: {
    setView: function setView(view) {
      this.typeRule = view;
      this.getRules();
    },

    getRules() {
      if (this.typeRule == "entry_rules") {
        this.thTitle = "ENTRY RULES";
        this.buttonText = "Add Entry Rule";
      } else if (this.typeRule == "exit_reasons") {
        this.thTitle = "EXIT REASONS";
        this.buttonText = "Add Exit Reason";
      }
      axios
        .get("/" + this.typeRule + "/g")
        .then((response) => {
          this.rules = response.data;
          //this.loading = false;
        })
        .catch((error) => {});
    },

    addNewRule: function addNewRule() {
      this.form.reset();
      this.form.modal = "create";
      if (this.typeRule == "entry_rules") {
        this.form.title = "Create Entry Rule";
      } else if (this.typeRule == "exit_reasons") {
        this.form.title = "Create Exit Reason";
      }
    },

    storeRule: function storeRule(value) {
      let data = new FormData();
      data.append("name", value.name);
      axios
        .post("/dashboardPages/tradingrules/" + this.typeRule + "/p", data)
        .then((res) => {
          $("#modal-rule").modal("hide");
          this.getRules();
        })
        .catch((error) => {
          this.form.errors.record(error.response.data.errors);
        });
    },

    getItem: function getItem(rule) {
      this.form.errors.clear();
      this.form.modal = "edit";
      if (this.typeRule == "entry_rules") {
        this.form.title = "Edit Entry Rule";
      } else if (this.typeRule == "exit_reasons") {
        this.form.title = "Edit Exit Reason";
      }
      this.form.id = rule.id;
      this.form.name = rule.name;
    },

    updateRule: function updateRule(value) {
      var item_id = value.id;
      var item_name = value.name;
      let data = new FormData();
      data.append("name", item_name);

      axios
        .post(
          "/dashboardPages/tradingrules/" + this.typeRule + "/d/" + item_id,
          data
        )
        .then((res) => {
          $("#modal-rule").modal("hide");
          this.getRules();
        })
        .catch((error) => {
          this.form.errors.record(error.response.data.errors);
        });
    },

    deleteRule: function deleteRule(value) {
      this.form.title = "Delete Rule";
      this.form.modal = "delete";
      this.form.name = value.name;
      this.form.id = value.id;
    },

    destroyRule: function destroy(value) {
      axios
        .post(
          "/dashboardPages/tradingrules/" + this.typeRule + "/d/" + value.id
        )
        .then((res) => {
          $("#modal-rule").modal("hide");
          this.getRules();
        })
        .catch((error) => {
          this.form.errors.record(error.response.data.errors);
        });
    },
  },
};
</script>