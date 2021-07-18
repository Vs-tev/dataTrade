<template>
<div>
    <undo-action-message ref="action"></undo-action-message>
    <div class="dashboard_container_content col-12 col-md-10 mx-auto">
        <ul class="nav nav-tabs mx-1 mx-md-4 mb-2" role="tablist"> 
            <li class="nav-item"><a href="#account" class="nav-link active font-normal" role="tab" data-toggle="tab" aria-selected="true">Account</a></li>
            <li class="nav-item ml-0 ml-md-3"><a href="#change_password" class="nav-link font-normal" role="tab" data-toggle="tab" aria-selected="true">Change Password</a></li>
            <li class="nav-item ml-0 ml-md-3"><a href="#notifications_settings" class="nav-link font-normal mr-0" role="tab" data-toggle="tab" aria-selected="true">Notifications</a></li>
        </ul>
      
        <div class="tab-content">
            <div id="account" class="tab-pane active" role="tabpanel">
                <div class="list-editable-items p-1 p-md-3 col-12 col-sm-10 col-lg-10 col-xl-8 mx-md-auto">

                    <ul class="list-unstyled">
                        <li class="editable-item">
                            <label class="pr-4"></label>
                            <p class="font-500 font-lg">Account:</p>
                        </li>
                        <li class="editable-item pb-4">
                            <label class="label-item pr-4">Email Adress </label>
                            <div class="w-100">
                                <input type="text" v-model="user.email" :class="{'is-invalid': form.errors.has('email')}" class="form-control-big" @input="form.errors.clear('Email')" placeholder="@">
                               <p class="error-output pt-0"
                                v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>
                            </div>
                        </li>
                        <li class="editable-item pb-4">
                            <label class="label-item pr-4">Username</label>
                            <div class="w-100">
                                <input type="text" v-model="user.name" :class="{'is-invalid': form.errors.has('name')}" class="form-control-big" @input="form.errors.clear('name')" placeholder="Username" autocomplete="off">
                            <p class="error-output pt-0"
                                v-if="form.errors.has('name')" v-text="form.errors.get('name')"></p>
                            </div>
                            
                        </li>
                        <li class="editable-item pb-4">
                            <label class="label-item pr-4">Country</label>
                            <select v-model="user.country" class="form-control-big">
                                <option v-for="country in countries"  :key="country.short_code">{{country.name}}</option>
                            </select>
                        </li>
                         <li class="editable-item pb-3 pt-4">
                            <label class="label-item pr-4"></label>
                            <button type="button" @click="updateUser" class="btn btn-primary font-500">Save Changes</button>
                        </li>
                    </ul>
                  
                </div>
            </div>
            <div id="change_password" class="tab-pane" role="tabpanel">
                <div class="list-editable-items p-3 col-12 col-sm-10 col-lg-10 col-xl-8 mx-md-auto">
                    <ul class="list-unstyled">
                        <li class="editable-item">
                            <label class="pr-4"></label>
                            <p class="font-500 font-lg">Change Your Password:</p>
                        </li>
                        <li class="editable-item pb-4">
                            <label class="label-item pr-4">Current Password:</label>
                            <div class="w-100">
                                 <input type="password" v-model="form.current_password" :class="{'is-invalid': form.errors.has('current_password')}" class="form-control-big" @input="form.errors.clear('current_password')"  placeholder="Current password">
                                <p class="error-output pt-0"
                                v-if="form.errors.has('current_password')" v-text="form.errors.get('current_password')"></p>
                            </div>
                        </li>
                        <li class="editable-item pb-4">
                            <label class="label-item pr-4">New Password</label>
                            <div class="w-100">
                                 <input type="password" v-model="form.new_password" class="form-control-big" :class="{'is-invalid': form.errors.has('new_password')}" @input="form.errors.clear('new_password')" placeholder="New password">
                                <p class="error-output pt-0"
                                v-if="form.errors.has('new_password')" v-text="form.errors.get('new_password')"></p>
                            </div>
                        </li>
                        <li class="editable-item pb-4">
                             <label class="label-item pr-4">Confirm Password</label>
                            <div class="w-100">
                                 <input type="password" v-model="form.confirm_password" class="form-control-big" :class="{'is-invalid': form.errors.has('confirm_password')}" @input="form.errors.clear('confirm_password')" placeholder="Confirm password">
                                <p class="error-output pt-0"
                                v-if="form.errors.has('confirm_password')" v-text="form.errors.get('confirm_password')"></p>
                            </div>
                        </li>

                        <li class="editable-item pb-3 pt-4">
                            <label class="label-item pr-4"></label>
                            <button type="button" @click="updatePassword" class="btn btn-primary font-500">Save Changes</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="notifications_settings" class="tab-pane" role="tabpanel">
               <div class="list-editable-items p-3 col-12 col-sm-10 col-lg-10 col-xl-8 mx-md-auto">
                  <ul class="list-unstyled">
                    <li>
                        <label class="pr-4"></label>
                        <p class="font-500 font-lg">Notifications Settings</p>
                    </li>
                    <li class="py-4">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" v-model="notifiable" class="custom-control-input" id="email_notification" name="example1">
                          <label class="custom-control-label" for="email_notification">Email notifications for trades import</label>
                        </div>
                    </li>
                    <li class="pb-3">
                        <label class="pr-4"></label>
                        <button type="button" @click="isNotifiable" class="btn btn-primary font-500">Save Changes</button>
                    </li>
                  </ul>
               </div>
            </div>
        </div>
   
    </div>
     <modal-success :text="text"></modal-success>
</div>
</template>
<script>
import ModalSuccess from "../ModalSuccess.vue";
import UndoActionMessage from "../UndoActionMessage.vue";

export default {
  name: "userSettings",
  props: ["user", "countries"],
  components: { ModalSuccess, UndoActionMessage },
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        country: "",
        current_password: "",
        new_password: "",
        confirm_password: "",
      }),
      notifiable: this.$props.user.is_notifiable,
    };
  },

  methods: {
    checkResponseStatus(error) {
      if (error.response.status === 419 || error.response.status == 401) {
        window.location.href = "/login";
      } else {
        this.form.errors.record(error.response.data.errors);
      }
    },

    updateUser: function updateUser() {
      let data = new FormData();
      data.append("name", this.user.name);
      data.append("email", this.user.email);
      data.append("country", this.user.country);
      axios
        .post("/user_settings/u/", data)
        .then((res) => {
          this.$refs.action.undoMessage("Profile has been updated");
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    updatePassword: function newPassword() {
      let data = new FormData();
      data.append("current_password", this.form.current_password);
      data.append("new_password", this.form.new_password);
      data.append("confirm_password", this.form.confirm_password);
      axios
        .post("/user_settings/password/", data)
        .then((res) => {
          this.$refs.action.undoMessage("Passwort has been updated");
          this.form.current_password = "";
          this.form.new_password = "";
          this.form.confirm_password = "";
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },

    isNotifiable: function isNotifiable() {
      let data = new FormData();
      data.append("is_notifiable", this.notifiable);
      axios
        .post("/user_settings/notifications", data)
        .then((res) => {
          this.$refs.action.undoMessage(
            "Notifications settings has been updated"
          );
        })
        .catch((error) => {
          this.checkResponseStatus(error);
        });
    },
  },
};
</script>