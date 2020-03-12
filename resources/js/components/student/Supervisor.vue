<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Supervisor Details
                        <small>student</small>
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Supervisors</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="alert alert-danger" v-if="student.semester_id == 0">
                                            You <strong> did not applied</strong> for internship.
                                        </div>
                                        <div class="alert alert-warning" v-if="student.semester_id != 0 && student.internship_status == 0">
                                            You already <strong>applied</strong> for internship, please wait for admin's approval.
                                        </div>

                                        <div class="alert alert-danger" v-if="upCv == false || upCom == false">
                                            <strong>Error! Please upload your CV and Company details first to add supervisor details</strong>
                                        </div>

                                        <div class="alert alert-success" v-if="upCv && superAc">
                                            <strong>Company Supervisor Details</strong><br><br> 
                                            
                                            <table border="0">
                                                <tr><td><strong>Supervisor Id  </strong> </td><td>: {{supervisor.supervisor_id}}</td></tr>
                                                <tr><td><strong>Supervisor Name  </strong> </td><td>: {{supervisor.supervisor_name}}</td></tr>
                                                <tr><td><strong>Supervisor Designation  </strong> </td><td>: {{supervisor.supervisor_designation}}</td></tr>
                                                <tr><td><strong>Supervisor Email </strong> </td><td>: {{supervisor.supervisor_email}}</td></tr>
                                                <tr><td><strong>Supervisor Number  </strong> </td><td>: +880{{supervisor.supervisor_number}}</td></tr>
                                                <tr><td><strong>Assigned Date  </strong> </td><td>: {{supervisor.assigned_date}}</td></tr>
                                            </table>
                                        </div>

                                        <form v-if="upCv && upCom && superAc == false" @submit.prevent="addSupervisor()" id="form_sample_2" class="form-horizontal" >
                                            <div class="form-group">
                                                <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_name') }">
                                                    <label class="control-label col-md-5">Contact person Name
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-icon right">
                                                            <input type="text" class="form-control" v-model="supervisor.supervisor_name" v-validate="'required|alpha_spaces'" name="supervisor_name" /> 
                                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_name')" ></i>
                                                            <span v-show="errors.has('supervisor_name')" class="required">{{ errors.first('supervisor_name') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_number') }">
                                                    <label class="control-label col-md-5">Contact person Number
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-icon right">
                                                            <div class="input-group input-large margin-top-10">
                                                                <span class="input-group-addon">
                                                                    +880
                                                                </span>
                                                                <input type="text" class="form-control" style="width:76%;" v-model="supervisor.supervisor_number" v-validate="'required|numeric|length:10'" name="supervisor_number" />  
                                                            </div>
                                                                            
                                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_number')" ></i>
                                                            <span v-show="errors.has('supervisor_number')" class="required">{{ errors.first('supervisor_number') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_email') }">
                                                    <label class="control-label col-md-5">Contact person Email
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-icon right">
                                                            <input type="email" class="form-control" v-model="supervisor.supervisor_email" v-validate="'required|email'" name="supervisor_email" /> 
                                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_email')" ></i>
                                                            <span v-show="errors.has('supervisor_email')" class="required">{{ errors.first('supervisor_email') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_designation') }">
                                                    <label class="control-label col-md-5">Contact person Designation
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-icon right">
                                                            <input type="test" class="form-control" v-model="supervisor.supervisor_designation" v-validate="'required'" name="supervisor_designation" /> 
                                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_designation')" ></i>
                                                            <span v-show="errors.has('supervisor_designation')" class="required">{{ errors.first('supervisor_designation') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-7 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <button type="reset" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="alert alert-warning" v-if="supervisor.teacher_id == null">
                                            <strong>Wait </strong> You are not in a batch yet.
                                        </div>

                                        <div class="alert alert-warning" v-if="supervisor.teacher_id != null">
                                            <strong>University Supervisor Details</strong><br><br> 
                                            
                                            <table border="0">
                                                <tr><td><strong>Teacher Id  </strong> </td><td>: {{supervisor.teacher_id}}</td></tr>
                                                <tr><td><strong>Teacher Name  </strong> </td><td>: {{supervisor.name}}</td></tr>
                                                <tr><td><strong>Teacher Email  </strong> </td><td>: {{supervisor.email}}</td></tr>
                                                <tr><td><strong>Teacher Number  </strong> </td><td>: +880{{supervisor.mobileNo}}</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
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

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                file:'',
                student_id: $('#user_id').val(),
                upCv: true,
                upCom: true,
                superAc: true,
                viewFiles: '',
                supervisor: {
                    supervisor_id: '',
                    supervisor_name: '',
                    supervisor_number: '',
                    supervisor_email: '',
                    supervisor_designation: '',
                    student_id: $('#user_id').val(),
                    assigned_date: ''
                },
                teacher: '',
                student: ''
            }
        },
        created(){
            console.log(this.supervisor.student_id);
            this.loadUploads(this.student_id);
            this.loadSupervisor(this.student_id);
            this.loadCompany(this.student_id);
            this.viewStudent(this.student_id);
        },
        methods: {
            viewStudent(id){
                console.log(id)
                fetch(`api/student.profile/${id}`)
                .then(res => res.json())
                .then(res => {
                    this.student = res;
                })
                .catch(err => console.log(err));
            },
            loadUploads(id){
                fetch(`api/student.loadUploads/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.viewFiles = res;
                    if (res.valid == false || res.cv_title == 'later') {
                        this.upCv = false;
                    }
                })
                .catch(err => console.log(err));
            },
            loadCompany(id){
                fetch(`api/companies/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);

                    if (res.valid == false || res[0].company_name == null) {
                        this.upCom = false;
                    }
                })
                .catch(err => console.log(err));
            },
            loadSupervisor(id){
                fetch(`api/supervisors/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    if (res.valid == false || res[0].supervisor_name == null ) {
                        this.superAc = false;

                        if (res[0].teacher_id != null ) {
                            console.log(res[0]);
                            this.supervisor = res[0];
                        }
                    }else{
                        this.supervisor = res[0];
                    }
                })
                .catch(err => console.log(err));
            },
            addSupervisor(){
                this.supervisor.student_id = this.student_id;
                this.validateBeforeSubmit();
                fetch('api/supervisors',{
                    method: 'post',
                    body: JSON.stringify(this.supervisor),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: "Supervisor details added.",
                        type: "success"
                    }).then(function() {
                        window.location = "redirectURL";
                    });
                })
                .catch(err => console.log(err))
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
