<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Student List
                        <small>admin</small>
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Students</span>
                                </div>
                                <div class="actions">
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <select v-model="student.semester_id" @change="loadStudents(student.semester_id)">
                                                    <option value="">Select..</option>
                                                    <option :value="0">students without semester</option>
                                                    <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id" >{{semester.semester_name}}</option>
                                                </select>
                                            </td>
                                            <!-- <td><a data-toggle="modal" href="#edit" style="margin-left:3%;" class="btn blue btn-outline" @click.prevent="clearForm()">Add New <i class="fa fa-plus"></i></a></td> -->
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
                                            <th> Credits Left </th>
                                            <th> Registraion Status </th>
                                            <th> Internship Status </th>
                                            <th> Options </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="student in students" :key="student.id">
                                            
                                            <td> {{student.id}}</td>
                                            <td> {{student.name}} </td>
                                            <td> {{student.student_id}} </td>
                                            <td> {{student.credits_left}} </td>
                                            <td> 
                                                <span class="label label-sm label-info" v-if=" student.registration_status == 0"> Pending </span>
                                                <span class="label label-sm label-success" v-if=" student.registration_status == 1"> Approved </span>
                                            </td>
                                            <td> 
                                                <span class="label label-sm label-info" v-if=" student.internship_status == 0"> Pending </span>
                                                <span class="label label-sm label-success" v-if=" student.internship_status == 1"> Approved </span>
                                                <span class="label label-sm label-warning" v-if=" student.internship_status == 3"> Running </span>
                                            </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                        <a class="btn green btn-outline dropdownCustom" data-toggle="modal" href="#edit" @click="editStudent(student)"> Edit </a>
                                                        <a  class="btn red btn-outline dropdownCustom" @click="deleteStudent(student.student_id)">Delete</a>
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
                    <div class="modal fade" id="edit" tabindex="-1" role="edit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Student details</h4>
                                </div>
                                <div class="modal-body">  
                                    
                                    <form @submit.prevent="addStudent()" id="form_sample_1" class="form-horizontal" > 
                                        <div class="form-body">
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('name') }">
                                                <label class="control-label col-md-3">Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <!-- <input type="text" class="form-control" v-model="teacher.name" required>  "-->
                                                    <input name="name" v-model="student.name" v-validate="'required'" class="form-control"  type="text" placeholder="">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('name')" ></i>
                                                    <span v-show="errors.has('name')" class="required">{{ errors.first('name') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('student_id') }">
                                                <label class="control-label col-md-3">Id
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input name="student_id" v-model="student.student_id" v-validate="'required|alpha_dash|uniqueId'" class="form-control"  type="text" placeholder="">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('student_id')" ></i>
                                                    <span v-show="errors.has('student_id')" class="required">{{ errors.first('student_id') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('credits_left') }">
                                                <label class="control-label col-md-3">Credit Left
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input name="credits_left" v-model="student.credits_left" v-validate="'required|numeric'" class="form-control"  type="text" placeholder="">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('credits_left')" ></i>
                                                    <span v-show="errors.has('credits_left')" class="required">{{ errors.first('credits_left') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('subjects_left') }">
                                                <label class="control-label col-md-3">Subject Left
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input name="subjects_left" v-model="student.subjects_left" v-validate="'required|numeric'" class="form-control"  type="text" placeholder="">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('subjects_left')" ></i>
                                                    <span v-show="errors.has('subjects_left')" class="required">{{ errors.first('subjects_left') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('batch_id') }">
                                                <label class="control-label col-md-3">Batch
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="batch_id" v-model="student.batch_id" v-validate="'required'" >
                                                        <option value="">Select..</option>
                                                        <option v-for="batch in batches" :key="batch.batch_id" :value="batch.batch_id">{{batch.batch_id}}</option>
                                                    </select>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('batch_id')" ></i>
                                                    <span v-show="errors.has('batch_id')" class="required">{{ errors.first('batch_id') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('semester_id') }">
                                                <label class="control-label col-md-3">Semesters
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select class="form-control"   name="semester_id" v-model="student.semester_id" v-validate="'required|numeric'" >
                                                        <option value="">Select..</option>
                                                        <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id">{{semester.semester_name}}</option>
                                                    </select>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('semester_id')" ></i>
                                                    <span v-show="errors.has('semester_id')" class="required">{{ errors.first('semester_id') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('department') }">
                                                <label class="control-label col-md-3">Department
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <!-- <input name="department" v-model="student.department" v-validate="'required|alpha'" class="form-control"  type="text" placeholder=""> -->
                                                    <select name="department" v-model="student.department" v-validate="'required|alpha'" class="form-control " placeholder="Department">
                                                        <option value="">Select Department</option>
                                                        <option value="CSE">CSE</option>
                                                        <option value="CSSE">CSSE</option>
                                                        <option value="SE">SE</option>
                                                        <option value="CS">CS</option>
                                                        <option value="CIE">CIE</option>
                                                    </select>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('department')" ></i>
                                                    <span v-show="errors.has('department')" class="required">{{ errors.first('department') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('email') }">
                                                <label class="control-label col-md-3">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input name="email" v-model="student.email" v-validate="'required|email|uniqueEmail'" class="form-control"  type="email" placeholder="">
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
                                                        <input name="mobileNo" v-model="student.mobileNo" style="width:81%;" v-validate="'required|numeric'" class="form-control"  type="text" placeholder="">
                                                    </div>
                                                    
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('mobileNo')" ></i>
                                                    <span v-show="errors.has('mobileNo')" class="required">{{ errors.first('mobileNo') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <input v-if="add" id="addStudent" type="submit" form="form_sample_1" class="btn green" />
                                    <button v-if="edit" @click.prevent="updateStudent(student.student_id)" class="btn green">Update</button>
                                    <button class="btn yellow btn-outline" @click="clearForm()">Reset</button>
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
            const plugin = document.createElement("script");

            plugin.setAttribute(
            "src",
            "assets/pages/scripts/table-datatables-managed.min.js"
            );
                
            plugin.async = true;
            document.body.appendChild(plugin);

            const isUniqueEmail = (value) => {
                return axios.post('/validateStudentEmail', { 
                        email: value
                    }).then((response) => {
                        return { valid: response.data.valid, data: { message: response.data.message} };
                    })
                    .catch(error => {
                        console.log('yoo error', error);
                    });
            };

            const isUniqueId = (value) => {
                return axios.post('/validateStudentId', { 
                        student_id: value
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
                students: [],
                semesters: [],
                batches: [],
                groups: [],
                student: {
                    name: '',
                    student_id: '',
                    department: '',
                    email: '',
                    credits_left: '',
                    subjects_left: '',
                    semester_id:'',
                    mobileNo: '',
                    batch_id: '',
                },
                notice: {
                    notice_id: '',
                    receiver: '',
                    subject: '',
                    content: '',
                    date: '',
                    teacher_id: $('#user_id').val()
                },
                add: true,
                edit: false
            }
        },
        created(){
            this.viewStudents();
            this.getBatches();
            this.getSemesters();
        },
        methods: {
            viewStudents(){
                fetch('api/student.showAll')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.students = res.data;
                    this.student.semester_id = res.data[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            loadStudents(id){
                console.log(id);
                fetch(`api/student.loadStudents/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    this.students = res.data;
                    //this.student.semester_id = res.data[0].semester_id;
                })
                .catch(err => console.log(err));
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
                    printable: this.students,
                    properties: [
                        { field: 'name', displayName: 'Student Name'},
                        { field: 'student_id', displayName: 'Student Id'},
                        { field: 'credits_left', displayName: 'Credits Left'},
                        { field: 'semester_id', displayName: 'Semester Id Left'},
                        { field: 'internship_status', displayName: 'Internship Status'},
                        { field: 'registration_status', displayName: 'Registration Status'},
                        { field: 'enrollment_date', displayName: 'Enrollment Date'},
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
                        filename: "Students" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: preserveColors
                    });
                }
            },
            addStudent(){
                this.validateBeforeSubmit();
                fetch('api/students',{
                    method: 'post',
                    body: JSON.stringify(this.student),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal('Success!', "Student detalis added.", 'success');
                    this.clearForm();
                    this.viewStudents();
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
            editStudent(t){
                this.add = false;
                this.edit = true;
                this.student.id = t.id;
                this.student.name = t.name;
                this.student.student_id = t.student_id;
                this.student.credits_left = t.credits_left;
                this.student.subjects_left = t.subjects_left;
                this.student.email = t.email;
                this.student.mobileNo = t.mobileNo;
                this.student.department = t.department;
                this.student.semester_id = t.semester_id;
                this.student.batch_id = t.batch_id;
                this.student.group_id = t.group_id;
            },
            noticeStudent(id){
                this.notice.receiver = id;
            },
            clearForm(){
                this.add = true;
                this.edit  = false;
                this.student.name = '';
                this.student.student_id = '';
                this.student.credits_left = '';
                this.student.semester_id = '';
                this.student.email = '';
                this.student.mobileNo = '';
                this.student.department = '';
                this.student.batch_id = '';
                this.student.group_id = '';

                this.notice.subject = '';
                this.notice.content = '';

                this.$validator.reset();
            }, 
            updateStudent(id){
                this.validateBeforeSubmit();
                //console.log(id);
                fetch(`api/students/${id}`,{
                    method: 'put',
                    body: JSON.stringify(this.student),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(data => {
                    swal('Success!', "Student details updated.", 'success');
                    this.add = true;
                    this.edit = false;
                    this.clearForm();
                    this.viewStudents();
                })
                .catch(err => console.log(err))
            },
            deleteStudent(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Students details will be removed.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/students/${id}`,{
                            method: 'delete'
                        })
                        .then(res => res.json())
                        .then(data => {
                            swal("Students details removed.", {
                                icon: "success",
                            });
                            this.viewStudents();
                        })
                        .catch(err => console.log(err))
                    }
                });
            },
            getBatches(){
                axios.get('/getBatches')
                .then(res => {
                    //console.log(res);
                    this.batches = res.data.data;
                })
                .catch(err => {
                    console.log(err);
                })
            },
            getSemesters(){
                axios.get('/getSemesters')
                .then(res => {
                    //console.log(res);
                    this.semesters = res.data.data;
                })
                .catch(err => {
                    console.log(err);
                })
            },
            validateBeforeSubmit(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        // eslint-disable-next-line
                        //alert('Form Submitted!');
                        console.log('if');
                        return ;
                    }
                    else{
                        console.log('else');
                        return ;
                    }
                });
            }
        }
    }
</script>
