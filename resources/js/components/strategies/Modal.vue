<template>
    <div class="modal" id="modal-strategy">
        <div class="modal-dialog" v-bind:class="[item.modal == 'delete' ? ' ' : 'modal-xl' ]">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{item.title}}
                        <span v-if="item.modal == 'title'">{{item.name}}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="material-icons ml-auto close-btn icon-sm">close</span>
                    </button>
                </div>
                <input type="hidden" v-model="item.id" class="form-control">

                <div class="modal-body" v-if="item.modal !== 'delete' ">
                    <div class="form-group pb-3">
                        <label for="quantity">Strategy name</label>
                        <input v-model="item.name" id="name" type="text" class="form-control" name="text"
                            @keyup="item.errors.clear('name')" placeholder="Min 2 charachters">
                        <p class="error-output" v-if="item.errors.has('name')" v-text="item.errors.get('name')"></p>
                    </div>
                    <div class="drop_img my-3">
                        <div class="img_list text-center">
                            <div class="input-file-container js" v-if="!item.url || item.url == 'noimage.jpg'">
                                <input class="d-none" @change="onFileSelected" name="img" id="img" type="file"
                                    accept="image/x-png,image/gif,image/jpeg">
                                <label tabindex="0" for="img" class="input-file-trigger"> <span
                                        class="material-icons icon-xl indigo">cloud_upload</span>
                                    <h4 class="lighter font-500">Click here to upload image</h4>
                                </label>
                            </div>
                            <div class="img-content-container" v-if="item.url && item.url !== 'noimage.jpg'">
                                <div class="remove-img" @click="removeSelectedImg"><img src="/storage/icons/remove.svg"
                                        alt=""></div>
                                <img class="url-img create" v-if="item.modal == 'create'" :src="item.url">
                                <img class="url-img falsemode" v-if="!item.img_mode && item.modal == 'edit' "
                                    :src="!item.img_mode ? '/storage/strategies/'+ item.url : ' '" alt="">
                                <img class="url-img truemode" v-if="item.img_mode && item.modal == 'edit' "
                                    :src="item.url" alt="">
                            </div>
                        </div>
      
                        <p class="error-output" v-if="this.item.img_error" v-text="this.item.img_error"></p>
                        <p class="error-output" v-if="item.errors.has('img_strategy')"
                            v-text="item.errors.get('img_strategy')"></p>
                    </div>
                    <div class="form-group pt-3">
                        <label for="textarea">Strategy description</label>

                        <texteditor :item="item"></texteditor>
                        
                        <p class="error-output" v-if="item.errors.has('description')"
                            v-text="item.errors.get('description')"></p>
                    </div>
                </div>
                <div class="modal-body" v-if="item.modal == 'delete' ">
                    <p>Are you sure want to delete <span class="font-weight-bold">"{{item.name}}"?</span> </p>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" v-if="item.modal == 'create' "
                        class="btn btn-primary font-weight-500 mt-2 mt-md-0" @click="storeStrategy">Create
                        Strategy</button>
                    <button type="button" v-if="item.modal == 'edit' "
                        class="btn btn-primary font-weight-500 mt-2 mt-md-0" @click="updateStrategy">Save
                        Changes</button>
                    <button type="button" @click="destroyStrategy" class="btn btn-danger"
                        v-if="item.modal == 'delete'">Delete</button>
                </div>

            </form>
        </div>
    </div>
</template>
<script>
import Texteditor from "../Texteditor";

export default {
  name: "Modal",
  props: ["item"],
  components: {
    Texteditor,
  },

  methods: {
    destroyStrategy: function () {
      this.$emit("destroyStrategy", this.item);
    },

    onFileSelected: function () {
      this.$emit("onFileSelected", this.item.img_strategy);
    },

    onFileSelected() {
      this.item.img_strategy = event.target.files[0];
      this.item.url = URL.createObjectURL(this.item.img_strategy);
      this.item.img_mode = true;
    },
    removeSelectedImg() {
      this.item.url = null;
      this.item.img_strategy = "";
      this.item.img_error = "";
      this.item.errors.clear("img_strategy");
      this.item.img_mode = true;
    },

    storeStrategy: function () {
      this.$emit("storeStrategy", this.item);
    },
    updateStrategy: function () {
      this.$emit("updateStrategy", this.item);
    },
  },
};
</script>
