<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Notice
                        <small>admin</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                <!-- BEGIN WELLS PORTLET-->
                    <div>
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Notices</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Compose All</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">History</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1" style="width:50%;">
                                        <form role="form" id="noticeAll" @submit.prevent="addNotice()">
                                            <!-- <div :class="{'form-group': true, 'form-group has-error': errors.has('receiver') }">
                                                <label class="control-label">Receiver
                                                    <span class="required"> * </span>
                                                </label><br>
                                                <select class="form-control" name="receiver" v-model="notice.receiver" v-validate="'required|alpha'" >
                                                    <option value="">Select...</option>
                                                    <option value="all">All</option>
                                                    <option value="teacher">Teacher</option>
                                                    <option value="student">Student</option>
                                                </select>
                                                <i class="fa fa-exclamation-triangle required" v-show="errors.has('receiver')" ></i>
                                                <span v-show="errors.has('receiver')" class="required">{{ errors.first('receiver') }}</span>
                                            </div> -->
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('subject') }">
                                                <label class="control-label">Subject
                                                    <span class="required"> * </span>
                                                </label><br>
                                                <input type="text" name="subject" v-model="notice.subject" v-validate="'required'" class="form-control">
                                                <i class="fa fa-exclamation-triangle required" v-show="errors.has('subject')" ></i>
                                                <span v-show="errors.has('subject')" class="required">{{ errors.first('subject') }}</span>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('content') }">
                                                <label class="control-label">Content
                                                    <span class="required"> * </span>
                                                </label>
                                                <textarea name="content" form="noticeAll" v-model="notice.content" v-validate="'required'" class="form-control" rows="3"></textarea>
                                                <i class="fa fa-exclamation-triangle required" v-show="errors.has('content')" ></i>
                                                <span v-show="errors.has('content')" class="required">{{ errors.first('content') }}</span>
                                            </div>
                                            <div class="margiv-top-10" align="right">
                                                <input type="submit" value="Send" class="btn green">
                                                <input type="reset" value="Reset" id="reset" class="btn default">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" border="1">
                                            <thead>
                                                <tr>
                                                    <th> sl </th>
                                                    <th> Subject </th>
                                                    <th> Date </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX" v-for="notice in notices" :key="notice.notice_id">
                                                    
                                                    <td> {{notice.notice_id}}</td>
                                                    <td> {{notice.subject}} </td>
                                                    <td> {{notice.date}} </td>
                                                    <td>
                                                        <a class="btn green btn-outline" @click="editNotice(notice)" data-toggle="modal" href="#basic" > Edit </a>
                                                        <a  class="btn red btn-outline" @click.prevent="deleteNotice(notice.notice_id)">Delete</a>
                                                    </td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END WELLS PORTLET-->
                    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Teacher details</h4>
                                </div>
                                <div class="modal-body">  
                                    <form  id="form_sample_1" class="form-horizontal" > 
                                        <div class="form-body">
                                            <!-- <div :class="{'form-group': true, 'form-group has-error': errors.has('receiver') }">
                                                <label class="control-label col-md-3" >Receiver
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="receiver" v-model="notice.receiver" v-validate="'required|alpha_dash'" class="form-control" disabled>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('receiver')" ></i>
                                                    <span v-show="errors.has('receiver')" class="required">{{ errors.first('receiver') }}</span>
                                                </div>
                                            </div> -->
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('subject') }">
                                                <label class="control-label col-md-3">Subject
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="subject" v-model="notice.subject" v-validate="'required'" class="form-control">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('subject')" ></i>
                                                    <span v-show="errors.has('subject')" class="required">{{ errors.first('subject') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('content') }">
                                                <label class="control-label col-md-3">Content
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <textarea name="content" form="noticeAll" v-model="notice.content" v-validate="'required'" class="form-control" rows="3"></textarea>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('content')" ></i>
                                                    <span v-show="errors.has('content')" class="required">{{ errors.first('content') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button @click.prevent="updateNotice(notice.notice_id)" class="btn green">Update</button>
                                    <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</template>
<style>
</style>

<script>
import { Validator } from 'vee-validate';

    export default {
        mounted() {
            console.log('Component mounted.')
            const plugin1 = document.createElement("script");

            plugin1.setAttribute(
            "src",
            "assets/pages/scripts/table-datatables-managed.min.js"
            );
                
            plugin1.async = true;
            document.body.appendChild(plugin1);
        },
        data() {
            return {
                notices:[],
                notice: {
                    notice_id: '',
                    subject: '',
                    content: '',
                    date: '',
                    teacher_id: $('#user_id').val()
                }
            }
        },
        created(){
            this.teacher_id = $('#user_id').val();
            console.log(this.teacher_id);
            this.viewNotices(this.teacher_id);
        },
        methods:{
            viewNotices(id){
                fetch(`api/notices.showAllTeacher/${id}`)
                .then(res => res.json())
                .then(res => {
                    this.notices = res.data;
                })
                .catch(err => console.log(err));
            },
            addNotice(){
                this.validateBeforeSubmit();
                fetch('api/notices',{
                    method: 'post',
                    body: JSON.stringify(this.notice),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal('Success!', "Notice added successfully.", 'success');
                    this.clearForm();
                    this.viewNotices(this.teacher_id);
                })
                .catch(err => console.log(err))
            },
            updateNotice(id){
                console.log(id);
                this.validateBeforeSubmit();
                fetch(`api/notices/${id}`,{
                    method: 'put',
                    body: JSON.stringify(this.notice),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(data => {
                    alert('Notice updated');
                    this.clearForm();
                    this.viewNotices(this.teacher_id);
                })
                .catch(err => console.log(err))
            },
            deleteNotice(id){
                console.log(id);
                if(confirm("Are you sure!")){
                    fetch(`api/notices/${id}`,{
                    method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Notice removed');
                        this.viewNotices(this.teacher_id);
                    })
                    .catch(err => console.log(err))
                }
            },
            editNotice(n){
                this.notice.notice_id = n.notice_id;
                this.notice.receiver = n.receiver;
                this.notice.subject = n.subject;
                this.notice.content = n.content;
            },
            clearForm(){
                this.notice.receiver = '';
                this.notice.subject = '';
                this.notice.content = '';
                this.$validator.reset();
            }, 
            validateBeforeSubmit(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        // eslint-disable-next-line
                        //alert('Form Submitted!');
                        console.log("hello")
                        return true;
                    }
                    else{
                        return false;
                    }
                });
            }
        }
    }
</script>
