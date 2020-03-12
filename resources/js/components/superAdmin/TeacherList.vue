<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Teacher List
                        <small>Super</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
            <div class="col-md-12">
                <div>
                    <!-- BEGIN GENERAL PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-blue-sharp"></i>
                                <span class="caption-subject font-blue-sharp bold uppercase">Teachers</span>
                            </div>
                            <div class="actions">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <a data-toggle="modal" href="#basic" class="btn blue btn-outline" @click.prevent="clearForm()">Add New <i class="fa fa-plus"></i></a>
                                        </td>
                                        <td >
                                            <div class="dropdown show " style="margin-left:5%;">
                                                <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Save or Export
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:60px;">
                                                    <a  class="btn red btn-outline dropdownCustom" @click="exportPdf()">Save as PDF <i class="fa fa-file-pdf-o"></i></a>
                                                    <a  class="btn blue btn-outline dropdownCustom" @click="exportExcel()">Export to Excel <i class="fa fa-file-excel-o"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" border="1">
                                <thead>
                                    <tr>
                                        <th> sl </th>
                                        <th> Name </th>
                                        <th> ID </th>
                                        <th> Go to </th>
                                        <th> Email </th>
                                        <th> mobileNo </th>
                                        <th> Access </th>
                                        <th> Options </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX" v-for="teacher in teachers" :key="teacher.id">
                                        
                                        <td> {{teacher.id}}</td>
                                        <td> {{teacher.name}} </td>
                                        <td> {{teacher.teacher_id}} </td>
                                        <td> <a class="btn purple btn-outline dropdownCustom" data-toggle="modal" href="#login" @click="superLoginLoad(teacher.teacher_id, teacher.access_status)">Sign In</a> </td>
                                        <td> {{teacher.email}} </td>
                                        <td> {{teacher.mobileNo}} </td>
                                        <td> {{teacher.access_status}} </td>
                                        <td>
                                            <div class="dropdown show">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                        <a class="btn green btn-outline dropdownCustom" data-toggle="modal" href="#basic" @click="editTeacher(teacher)"> Edit </a>
                                                        <a class="btn red btn-outline dropdownCustom" @click="deleteTeacher(teacher.id)">Delete</a>
                                                    </div>
                                                </div>
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END GENERAL PORTLET-->
            </div>
        </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Teacher details</h4>
                    </div>
                    <div class="modal-body">  
                        
                        <form @submit.prevent="addTeacher()" id="form_sample_1" class="form-horizontal" > 
                            <div class="form-body">
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('name') }">
                                    <label class="control-label col-md-3">Name
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <!-- <input type="text" class="form-control" v-model="teacher.name" required>  "-->
                                        <input name="name" v-model="teacher.name" v-validate="'required|alpha_spaces'" class="form-control"  type="text" placeholder="">
                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('name')" ></i>
                                        <span v-show="errors.has('name')" class="required">{{ errors.first('name') }}</span>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('teacher_id') }">
                                    <label class="control-label col-md-3">Id
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input name="teacher_id" v-model="teacher.teacher_id" v-validate="'required|alpha_dash|uniqueId'" class="form-control"  type="text" placeholder="">
                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('teacher_id')" ></i>
                                        <span v-show="errors.has('teacher_id')" class="required">{{ errors.first('teacher_id') }}</span>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('email') }">
                                    <label class="control-label col-md-3">Email
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input name="email" v-model="teacher.email" v-validate="'required|email|uniqueEmail'" class="form-control"  type="email" placeholder="">
                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('email')" ></i>
                                        <span v-show="errors.has('email')" class="required">{{ errors.first('email') }}</span>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('mobileNo') }">
                                    <label class="control-label col-md-3">MobileNo.
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-group input-large margin-top-10">
                                            <span class="input-group-addon">
                                                +880
                                            </span>
                                            <input name="mobileNo" style="width:81%;" v-model="teacher.mobileNo" v-validate="'required|numeric'" class="form-control"  type="text" placeholder="">
                                        </div>
                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('mobileNo')" ></i>
                                        <span v-show="errors.has('mobileNo')" class="required">{{ errors.first('mobileNo') }}</span>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('access_status') }">
                                    <label class="control-label col-md-3">Select
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="access_status" v-model="teacher.access_status" v-validate="'required|numeric'" >
                                            <option value="">Select...</option>
                                            <option value="1">Head</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Teacher</option>
                                        </select>
                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('access_status')" ></i>
                                        <span v-show="errors.has('access_status')" class="required">{{ errors.first('access_status') }}</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input v-if="add"  type="submit" form="form_sample_1" class="btn green" />
                        <button v-if="edit" @click.prevent="updateTeacher(teacher.id)" class="btn green">Update</button>
                        <button class="btn yellow btn-outline" @click="clearForm()">Reset</button>
                        <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="login" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Teacher Log In</h4>
                    </div>
                    <div class="modal-body">  
                        
                        <form action="/superAdminTeacherLogin" target="_blank" method="post" id="form_sample_2" class="form-horizontal" > 
                            <div class="form-body">
                                <div class='form-group'>
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" v-model="login.user_id" name="user_id">
                                        <input type="hidden" v-model="login.access_status" name="access_status">
                                        <input name="password" v-model="login.password" class="form-control"  type="password" placeholder="Re-type password">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" form="form_sample_2" class="btn green" value="Log In" />
                        <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</template>
<style>
.table thead tr th {
    text-align: center;
} 

.table tbody tr td {
    text-align: center;
}

.dropdownCustom {
    width: 100%;
    display: block;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
}
</style>

    
<script>
import { Validator } from 'vee-validate';
import axios from 'axios';

    export default {
        mounted() {
            console.log('Component mounted.')
            console.log($('#user_id').val());
            
            const plugin = document.createElement("script");

            plugin.setAttribute(
            "src",
            "assets/pages/scripts/table-datatables-managed.min.js"
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

            const isUniqueId = (value) => {
                return axios.post('/validateTeacherId', { 
                        teacher_id: value
                    }).then((response) => {
                        return { valid: response.data.valid, data: { message: response.data.message} };
                    })
                    .catch(error => {
                        console.log('yoo error', error);
                    });
            };

            // The messages getter may also accept a third parameter that includes the data we returned earlier.
            Validator.extend('uniqueEmail',{
                validate: isUniqueEmail, getMessage: (field, params, data) => { return data.message; }
            });

            Validator.extend('uniqueId',{
                validate: isUniqueId, getMessage: (field, params, data) => { return data.message; }
            });
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                teachers: [],
                teacher: {
                    name: '',
                    teacher_id: '',
                    access_status: '',
                    email: '',
                    mobileNo: '',
                    password: ''
                },
                notice: {
                    notice_id: '',
                    receiver: '',
                    subject: '',
                    content: '',
                    date: '',
                    teacher_id: $('#user_id').val()
                },
                login: {
                    user_id: '',
                    password: '',
                    access_status:''
                },
                add: true,
                edit: false
            }
        },
        created(){
            this.viewTeachers();
        },
        methods: {
            viewTeachers(){
                fetch('api/teachers.showAll')
                .then(res => res.json())
                .then(res => {
                    this.teachers = res.data;
                })
                .catch(err => console.log(err));
            },
            superLoginLoad(id, a){
                this.login.password = '';
                this.login.user_id = id;
                this.login.access_status = a;
            },
            exportPdf(){
                // $('#sample_1').printThis({
                //     importCSS: true,
                //     importStyle: false,     // prefix to html
                //     pageTitle: "my page",
                //     footer: '<h1>yoo success</h1>', 
                //     header: "<h1>yoo success</h1>"
                // });
                printJS({
                    printable: this.teachers,
                    properties: [
                        { field: 'name', displayName: 'Teacher Name'},
                        { field: 'teacher_id', displayName: 'Teacher Id'},
                        { field: 'email', displayName: 'Teacher Email'},
                        { field: 'mobileNo', displayName: 'Teacher Mobile No.'},
                        { field: 'access_status', displayName: 'Access Status'},
                    ],
                    type: 'json',
                    gridHeaderStyle: 'color: black;  border: 2px solid #00acee;',
                    gridStyle: 'border: 2px solid #00acee; text-align:center;',
                    header: '<h2><table border="0"><tr><td><img src="assets/indexPage/img/aiub_logo.png" height="80" width="80"></td><td> Aiub CS Intern </td></tr></table></h2>'
                })
            },
            exportExcel(){
                var table = $("#sample_1");
                if(table && table.length){
                    var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                    $(table).table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "Teachers" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: preserveColors
                    });
                }
            },
            addTeacher(){
                this.validateBeforeSubmit();
                fetch('api/teachers',{
                    method: 'post',
                    body: JSON.stringify(this.teacher),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal('Success!', "Teacher details added.", 'success');
                    this.clearForm();
                    this.viewTeachers();
                })
                .catch(err => console.log(err))
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
                    alert('Notice sent');
                    this.clearForm();
                })
                .catch(err => console.log(err))
            },
            noticeTeacher(id){
                this.notice.receiver = id;
            },
            editTeacher(t){
                this.add = false;
                this.edit = true;
                this.teacher.id = t.id;
                this.teacher.name = t.name;
                this.teacher.teacher_id = t.teacher_id;
                this.teacher.email = t.email;
                this.teacher.mobileNo = t.mobileNo;
                this.teacher.access_status = t.access_status;
            },
            clearForm(){
                this.add = true;
                this.edit  = false;
                this.teacher.name = '';
                this.teacher.teacher_id = '';
                this.teacher.email = '';
                this.teacher.mobileNo = '';
                this.teacher.access_status = '';
                this.notice.subject = '';
                this.notice.content = '';
                this.$validator.reset();
            }, 
            updateTeacher(id){
                console.log(id);
                this.validateBeforeSubmit();
                fetch(`api/teachers/${id}`,{
                    method: 'put',
                    body: JSON.stringify(this.teacher),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(data => {
                    swal('Success!', "teacher details updated.", 'success');
                    this.add = true;
                    this.edit = false;
                    this.clearForm();
                    this.viewTeachers();
                })
                .catch(err => console.log(err))
            },
            deleteTeacher(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Teacher details will be removed.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/teachers/${id}`,{
                            method: 'delete'
                        })
                        .then(res => res.json())
                        .then(data => {
                            swal("Teacher details removed.", {
                                icon: "success",
                            });
                            this.viewTeachers();
                        })
                        .catch(err => console.log(err))
                    }
                });
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
