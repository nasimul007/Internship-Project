<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Profile
                        <small>teacher</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form id="form_sample_1" class="form-horizontal" > 
                                        <div class="form-body">
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('name') }">
                                                <label class="control-label col-md-3">Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <!-- <input type="text" class="form-control" v-model="teacher.name" required>  "-->
                                                    <input name="name" v-model="user.name" v-validate="'required|alpha_spaces'" class="form-control"  type="text" placeholder="">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('name')" ></i>
                                                    <span v-show="errors.has('name')" class="required">{{ errors.first('name') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('teacher_id') }">
                                                <label class="control-label col-md-3">Id
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input name="teacher_id" v-model="user.teacher_id" class="form-control"  type="text" disabled>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('email') }">
                                                <label class="control-label col-md-3">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input name="email" v-model="user.email" v-validate="'required|email|uniqueEmail'" class="form-control"  type="email">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('email')" ></i>
                                                    <span v-show="errors.has('email')" class="required">{{ errors.first('email') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('mobileNo') }">
                                                <label class="control-label col-md-3">MobileNo.
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input name="mobileNo" v-model="user.mobileNo" v-validate="'required|numeric'" class="form-control"  type="text">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('mobileNo')" ></i>
                                                    <span v-show="errors.has('mobileNo')" class="required">{{ errors.first('mobileNo') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group" align="right">
                                                <label class="control-label col-md-3">
                                                </label>
                                                <div class="col-md-6">
                                                    <button @click.prevent="updateUser(user.id)"  class="btn green">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <form class="form-horizontal" id="changePass">
                                        <input type="hidden" name="user_id" id="userId">
                                        <div class="form-group col-md-10 ">
                                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                            <label class="control-label visible-ie8 visible-ie9">Old Password</label>
                                            <div class="input-icon col-md-offset-4 col-md-7" >
                                                <i class="fa fa-lock col-md-2"></i>
                                                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Old Password" name="oldPass" /> 
                                            </div>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                            <label class="control-label visible-ie8 visible-ie9">New Password</label>
                                            <div class="input-icon col-md-offset-4 col-md-7">
                                                <i class="fa fa-lock col-md-2"></i>
                                                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" id="newPass" name="newPass" /> 
                                            </div>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                                            <label class="control-label visible-ie8 visible-ie9">Retype new Password</label>
                                            <div class="input-icon col-md-offset-4 col-md-7">
                                                <i class="fa fa-lock col-md-2"></i>
                                                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Retype new Password" name="newRePass" /> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">
                                            </label>
                                            <div class="col-md-offset-7 col-md-8">
                                                <button type="submit"  class="btn green">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</template>

<script>
import { Validator } from 'vee-validate';
import axios from 'axios';


    export default {
        mounted() {
            console.log('Component mounted.')
            const plugin = document.createElement("script");

            plugin.setAttribute(
            "src",
            "assets/pages/scripts/profile.js"
            );
                
            plugin.async = true;
            document.body.appendChild(plugin);

            const isUniqueEmail = (value) => {
                return axios.post('/validateTeacherEmail', { 
                        email: value
                    }).then((response) => {
                        return { valid: response.data.valid, data: { message: response.data.message} };
                    })
                    .catch(error => {
                        console.log('yoo error', error);
                    });
            };
            Validator.extend('uniqueEmail',{
                validate: isUniqueEmail, getMessage: (field, params, data) => { return data.message; }
            });
        },
        data() {
            return {
                user: {
                    id: '',
                    name: '',
                    teacher_id: $('#user_id').val(),
                    email: '',
                    mobileNo: '',
                    currentPassword: '',
                    newPassword: '',
                    password_confirmation: '',
                }
            }
        },
        created(){
            this.teacher_id = $('#user_id').val();
            this.viewUser(this.teacher_id );
        },
        methods:{
            viewUser(id){
                console.log(id);
                fetch(`api/teachers.profile/${id}`)
                .then(res => res.json())
                .then(res => {
                    this.user.id = res.id;
                    this.user.name = res.name;
                    this.user.teacher_id = res.teacher_id;
                    this.user.email = res.email;
                    this.user.mobileNo = res.mobileNo;
                    this.$validator.reset();
                })
                .catch(err => console.log(err));
            },
            updateUser(id){
                this.validateBeforeSubmit();
                //console.log(this.user);
                fetch(`api/teachers/${id}`,{
                    method: 'put',
                    body: JSON.stringify(this.user),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(data => {
                    swal('Success!', "Profile details updated.", 'success');
                    this.viewUser(this.teacher_id);
                })
                .catch(err => console.log(err))
            },
            validateBeforeSubmit(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        // eslint-disable-next-line
                        //alert('Form Submitted!');
                        return;
                    }
                });
            }
        }
    }
</script>
