<template>
    <div class="content-container">
        <section class="dashboard_container_content col-12  col-xl-10 p-0 pb-4">
            <div class="d-flex align-items-center justify-content-between border-bottom p-4">
                <h4 class="font-weight-500 m-0">Strategies</h4>
            </div>
        
            <div class="d-flex justify-content-start align-items-center pt-3 px-4">
                <button type="button" class="btn btn-secondary border-0 lighter font-500" data-toggle="modal" data-target="#modal-strategy"
                @click="createStrategy">
                    Add New
                </button>
            </div>
            
        </section>
        <div v-if="loading" class="col-12  col-xl-10 d-flex justify-content-center align-content-center">
            <div class="spinner-border lighter"></div>
        </div>
        <div class="row strategies_container">
            <div class="col-12 col-xl-10 mt-3 strategy-container-from-here" v-for="strategy in strategies" :key="strategy.id">
                
                <div class="p-0">
                    <div class="border-bottom p-4 d-flex justify-content-between align-items-center">
                        <h4 class="font-500 m-0">{{strategy.name}}</h4>
                        <button type="button" class="btn btn-link text-muted border-0" data-toggle="dropdown"><span>&#8226;&#8226;&#8226;</span> </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <h5 class="dropdown-header indigo">OPTIONS</h5>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-strategy" @click="editStrategy(strategy.id, strategy.name, strategy.description, strategy.img_strategy)">Edit</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-strategy"  @click="deleteStrategy(strategy)">Delete</a>
                            <a class="dropdown-item" href="#">Deteiled analysis</a>
                        </div>
                    </div>
                    <div class="strategy_img_container border-bottom">
                        <img :src="'/storage/strategies/'+ strategy.img_strategy" alt="">  
                    </div>
                    <div class="">
                      <div class="border-bottom py-3 px-4">
                         <span class="lighter font-500">Description:</span>
                      </div>
                        <div class="d-flex align-items-top strategy_description_div p-1 p-md-4">
                            <p class="text-break" v-html="strategy.description"></p>
                         </div>
                    </div>
                    <div class="d-flex justify-content-around border-top p-3">
                        <div class="d-flex align-items-center">
                            <img src="/storage/icons/list.svg" alt="" >
                            <div class="ml-2">
                                <p class="p-0 m-0">Trades</p>
                                <h5 class="">&#35; 81</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <img src="/storage/icons/area-line.svg" alt="">
                            <div class="ml-2">
                                <p class="p-0 m-0">Success</p>
                                <h5 class="">45,85 %</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <img src="/storage/icons/area-line.svg" alt="">
                            <div class="ml-2">
                                <p class="p-0 m-0">Used</p>
                                <h5 class="">54.40 %</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal :item="form" v-on:storeStrategy="storeStrategy($event)" v-on:updateStrategy="updateStrategy($event)" v-on:destroyStrategy="destroyStrategy($event)" v-on:onFileSelected="onFileSelected($event)"></modal>
    </div>
</template>
<script>
//import Editor from "@tinymce/tinymce-vue";
import Modal from "./Modal";

export default {
  name: "Strategies",
  components: {
    //editor: Editor,
    Modal,
  },

  data() {
    return {
      strategies: [],
      items: [],
      togglediv: false,
      loading: true,
      form: new Form({
        id: "",
        name: "",
        url: null,
        description: "",
        img_strategy: "",
        img_error: "",
        title: "",
        modal: "",
        img_mode: false,
        height: "261",
        placeholder:
          "Well written description will help you to improve your strategy and help you to make better trading decisions",
      }),
    };
  },

  mounted: function mounted() {
    this.getStrategies();
  },

  methods: {
    checkResponseStatus(error) {
      if (error.response.status === 419 || error.response.status == 401) {
        window.location.href = "/login";
      } else {
        this.form.errors.record(error.response.data.errors);
      }
    },

    getStrategies() {
      axios
        .get("/dashboardPages/strategy/g")
        .then((response) => {
          this.strategies = response.data;
          this.loading = false;
        })
        .catch((error) => {});
    },

    createStrategy() {
      this.form.reset();
      this.form.title = "Create Strategy";
      this.form.modal = "create";

      //console.log(tinyMCE.init({ selector: ".my_editor" }));
    },

    storeStrategy(value) {
      if (value.img_strategy && value.img_strategy.type == "") {
        this.form.img_error = "Undefine file type";
      } else {
        const data = new FormData();
        data.append("img_strategy", value.img_strategy);
        data.append("name", value.name);
        data.append("description", value.description);
        axios
          .post("/dashboardPages/strategy/p", data)
          .then((res) => {
            this.getStrategies();
            $("#modal-strategy").modal("hide");
            this.form.reset();
          })
          .catch((error) => {
            this.checkResponseStatus(error);
          });
      }
    },

    editStrategy: function editStrategy(id, name, description, img_strategy) {
      this.form.modal = "edit";
      this.form.title = "Edit";
      this.form.errors.clear();
      this.form.id = id;
      this.form.name = name;
      this.form.url = img_strategy;
      this.form.img_strategy = img_strategy;
      this.form.description = description;
      this.form.img_mode = false;
    },

    updateStrategy: function updateStrategy(value) {
      if (value.img_strategy && value.img_strategy.type == "") {
        this.form.img_error = "Undefine file type";
      } else {
        const data = new FormData();
        data.append("img_strategy", value.img_strategy);
        data.append("name", value.name);
        data.append("description", value.description);
        axios
          .post("/dashboardPages/strategy/u/" + value.id, data)
          .then((res) => {
            $("#modal-strategy").modal("hide");
            this.getStrategies();
            this.form.reset();
          })
          .catch((error) => {
            this.checkResponseStatus(error);
          });
      }
    },

    deleteStrategy: function deleteStrategy(value) {
      this.form.title = "Delete Rule";
      this.form.modal = "delete";
      this.form.name = value.name;
      this.form.id = value.id;
      tinymce.activeEditor.destroy();
    },

    destroyStrategy: function destroyStrategy(value) {
      axios
        .post("/dashboardPages/strategy/d/" + value.id)
        .then((res) => {
          $("#modal-strategy").modal("hide");
          this.getStrategies();
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
  },
};
</script>

