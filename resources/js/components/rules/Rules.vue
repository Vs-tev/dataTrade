<template>
    <div>
        <ul class="nav nav-tabs mt-4 mx-4 mb-2" role="tablist"> 
            <li class="nav-item"><a href="#entry_rule" @click="setView('entry_rules')" class="nav-link active font-normal" role="tab" data-toggle="tab" aria-selected="true">Entry Rules</a></li>
            <li class="nav-item"><a href="" @click="setView('exit_reasons')" class="nav-link font-normal" role="tab" data-toggle="tab" aria-selected="true">Exit Reason</a></li>
        </ul>
        <div class="tab-content">
            <div id="entry_rule" class="tab-pane active" role="tabpanel">
                <div class="d-block d-md-flex justify-content-start align-items-center py-3 px-4">
                  <button type="button" @click="create" class="btn btn-secondary border-0 lighter font-500"  v-text="buttonText">
                  </button>
                </div>
                <div class="col rule-table-div px-2 px-sm-4">
                    <table class="table table-rules table-hover">
                        <thead class="border-bottom-white">
                            <tr>
                                <th class="font-500 font-md pl-1">{{this.thTitle}}</th>
                                <th class="lighter font-md font-500 d-none d-md-flex"># USED</th>
                                <th class="lighter font-md font-500 " v-if="typeRule == 'entry_rules'">
                                    <div class="d-none d-md-block">SUCCESS</div>
                                </th>
                                <th class="lighter font-md font-500">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom" v-for="rule in rules" :key="rule.id">
                                <td>
                                  <div class="pl-1">
                                      <span class="m-0 p-0 font-normal font-weight-bold">{{rule.name}}</span>
                                      <p class="m-0 p-0 lighter font-md font-500">Created: <span>{{rule.created_at}}</span></p>
                                  </div>
                                </td>
                                <td class="d-none d-md-block">
                                  <div>
                                    <span class="m-0 p-0 font-normal font-weight-bold">{{rule.used_rules_count}} Trades</span>
                                    <p class="m-0 p-0 lighter font-md font-500" v-if="typeRule == 'entry_rules' "><span>{{rule.rules_in_winn_trades}} Winners</span></p>
                                  </div>
                                </td>
                                <td v-if="typeRule == 'entry_rules'">
                                    <span
                                        class="d-none d-md-inline badge badge-light font-sm font-500 text-muted" 
                                        v-html="rule.used_rules_count ? ((rule.rules_in_winn_trades / rule.used_rules_count)*100).toFixed(2) + '%' : '0.00%' ">
                                        </span>
                                </td>
                                <td>
                                    <div class="d-flex align-content-center">
                                        <button type="button"
                                        class="btn" data-toggle="modal" @click="getItem(rule)"
                                        data-target="#modal-rule"><span
                                        class="material-icons">mode_edit</span></button>

                                        <button type="button" class="btn" @click="deleteRule(rule)" 
                                        data-toggle="modal" data-target="#modal-rule"><span
                                        class="material-icons">delete</span></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <modal :item="form" v-on:storeRule="storeRule($event)" v-on:updateRule="updateRule($event)" v-on:destroyRule="destroyRule($event)"></modal>
            <modal-upgrade-plan :text="upgrade_plan_modal"></modal-upgrade-plan>
        </div>
    </div>
    
</template>
<script>
import ModalUpgradePlan from "../ModalUpgradePlan.vue";
import Modal from "./Modal";
export default {
  //props: ["form"],
  name: "Rules",
  components: {
    Modal,
    ModalUpgradePlan,
  },
  data() {
    return {
      upgrade_plan_modal: [
        {
          text: "Use the full power of dataTrade",
          subtext: "Upgrade your plan, and create up to 20 trading rules",
        },
      ],
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
        .get("/dashboardPages/tradingrules/" + this.typeRule + "/g")
        .then((response) => {
          this.rules = response.data;
          //this.loading = false;
        })
        .catch((error) => {});
    },
    create: function create() {
      axios
        .get("/dashboardPages/tradingrules/" + this.typeRule)
        .then((res) => {
          this.form.reset();
          this.form.modal = "create";
          if (this.typeRule == "entry_rules") {
            this.form.title = "Create Entry Rule";
          } else if (this.typeRule == "exit_reasons") {
            this.form.title = "Create Exit Reason";
          }
          $("#modal-rule").modal("show");
        })
        .catch((error) => {
          if (error.response.status === 402) {
            $("#modal-upgrade-plan").modal("show");
          }
        });
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
          "/dashboardPages/tradingrules/" + this.typeRule + "/u/" + item_id,
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