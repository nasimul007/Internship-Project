<template>

    <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Home
                            <small>student</small>
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Steps</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="mt-element-step">
                                        <div class="row step-line">
                                            <div :class="{'col-md-2 mt-step-col first ': student.semester_id == 0, 'col-md-2 mt-step-col first done': student.semester_id != 0 }">
                                                <div class="mt-step-number bg-white">1</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">Apply</div>
                                                <div class="mt-step-content font-grey-cascade">For internship</div>
                                            </div>
                                            <div :class="{'col-md-2 mt-step-col ': student.internship_status == 0, 'col-md-2 mt-step-col active': student.semester_id != 0, 'col-md-2 mt-step-col done': student.internship_status != 0 }" >
                                                <div class="mt-step-number bg-white">2</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">Admin</div>
                                                <div class="mt-step-content font-grey-cascade">Approve enrollment</div>
                                            </div>
                                            <div :class="{'col-md-2 mt-step-col ': student.batch_id == 0, 'col-md-2 mt-step-col active': student.internship_status != 0, 'col-md-2 mt-step-col done': student.batch_id != 0 }">
                                                <div class="mt-step-number bg-white">3</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">Admin</div>
                                                <div class="mt-step-content font-grey-cascade">Will assign to a batch</div>
                                            </div>
                                            <div :class="{'col-md-2 mt-step-col ': student.token_no != 'expired', 'col-md-2 mt-step-col active': student.batch_id != 0, 'col-md-2 mt-step-col done': student.token_no == 'expired' }">
                                                <div class="mt-step-number bg-white">4</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">Print out Token</div>
                                                <div class="mt-step-content font-grey-cascade">Take it to vues</div>
                                            </div>
                                            <div :class="{'col-md-2 mt-step-col ': student.company_id == 0, 'col-md-2 mt-step-col active': student.token_no == 'expired', 'col-md-2 mt-step-col done': student.company_id != 0 }">
                                                <div class="mt-step-number bg-white">5</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">Take internship</div>
                                                <div class="mt-step-content font-grey-cascade">Outside or in university as TA</div>
                                            </div>
                                            <div :class="{'col-md-2 mt-step-col last ': batch.req_to_complete != 2, 'col-md-2 mt-step-col active': student.company_id != 0, 'col-md-2 mt-step-col last done': batch.req_to_complete == 2 }">
                                                <div class="mt-step-number bg-white">6</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">Upload</div>
                                                <div class="mt-step-content font-grey-cascade">All required files</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <div>
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Steps Description</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li :class="{'active': student.semester_id == 0, '': student.semester_id != 0 }">
                                            <a href="#tab_1_1" data-toggle="tab">
                                                Step-1 <i v-if="student.semester_id != 0" class="fa fa-check-square-o" style='font-size:20px;color:green'></i>
                                            </a>
                                        </li>
                                        <li :class="{'active': student.internship_status == 0 && student.semester_id != 0, '': student.internship_status != 0 }">
                                           <a href="#tab_1_2"  data-toggle="tab">
                                                Step-2 <i v-if="student.internship_status != 0" class="fa fa-check-square-o" style='font-size:20px;color:green'></i>
                                            </a>
                                        </li>
                                        <li :class="{'active': student.batch_id == 0 && student.internship_status != 0, '': student.batch_id != 0 }">
                                           <a href="#tab_1_3"  data-toggle="tab">
                                                Step-3 <i v-if="student.batch_id != 0" class="fa fa-check-square-o" style='font-size:20px;color:green'></i>
                                            </a>
                                        </li>
                                        <li :class="{'active': student.token_no != 'expired' && student.batch_id != 0, '': student.token_no == 'expired' }">
                                           <a href="#tab_1_4"  data-toggle="tab">
                                                Step-4 <i v-if="student.token_no == 'expired'" class="fa fa-check-square-o" style='font-size:20px;color:green'></i>
                                            </a>
                                        </li>
                                        <li :class="{'active': student.company_id == 0 && student.token_no == 'expired', '': student.company_id != 0 }">
                                           <a href="#tab_1_5"  data-toggle="tab">
                                                Step-5 <i v-if="student.company_id != 0" class="fa fa-check-square-o" style='font-size:20px;color:green'></i>
                                            </a>
                                        </li>
                                        <li :class="{'active': batch.req_to_complete != 2 && student.company_id != 0, '': batch.req_to_complete == 2 }">
                                           <a href="#tab_1_6"  data-toggle="tab">
                                                Step-6 <i v-if=" batch.req_to_complete == 2" class="fa fa-check-square-o" style='font-size:20px;color:green'></i>
                                            </a>
                                        </li>
                                        <li :class="{'active': batch.req_to_complete == 2, '': batch.req_to_complete != 2 }">
                                           <a href="#tab_1_7"  data-toggle="tab">
                                                Step-7 <i v-if=" batch.req_to_complete == 2" class="fa fa-check-square-o" style='font-size:20px;color:green'></i>
                                            </a>
                                        </li>
                                    </ul>            
                                    <div class="tab-content">
                                        <!-- TAB-1 -->
                                        <div :class="{'tab-pane  active': student.semester_id == 0, 'tab-pane': student.semester_id != 0 }" id="tab_1_1">
                                            <li> Apply for intern in the semester openend by admin. </li>
                                            <li> While applying select Semester and insert Credit Left, Subject Left (with intern and thesis).</li>
                                            <li> Students must consult with admin if more then 6 credit (excluding Thesis and Intern) is left during Intern semester. </li>
                                        </div>
                                        <!-- END TAB-1 -->

                                        <!-- TAB-2 -->
                                        <div :class="{'tab-pane  active': student.internship_status == 0, 'tab-pane': student.internship_status != 0 }" id="tab_1_2">
                                            <li> You have already Applied for intern.</li>
                                            <li> Admin will approve your enrollment.</li>
                                        </div>
                                        <!-- END TAB-2 -->

                                        <!-- TAB-3 -->
                                        <div :class="{'tab-pane  active': student.batch_id == 0, 'tab-pane': student.batch_id != 0 }" id="tab_1_3">
                                            <li> Admin approved your enrollment. </li>
                                            <li> Admin will assign you to a batch. </li>
                                            <li> You will get a token in your home after admin assign you to a batch. </li>
                                        </div>
                                        <!-- END TAB-3 -->

                                        <!-- TAB-4 -->
                                        <div :class="{'tab-pane  active': student.token_no != 'expired', 'tab-pane': student.token_no == 'expired' }" id="tab_1_4">
                                            <li> You have been assigned to a batch. </li>
                                            <li> Please take the token printout to vues to complete your registration. </li>
                                        </div>
                                        <!-- END TAB-4 -->

                                        <!-- TAB-5 -->
                                        <div :class="{'tab-pane  active': student.company_id == 0, 'tab-pane': student.company_id != 0 }" id="tab_1_5">
                                            <li> Your registration was successfull.  </li>
                                            <li> If you want to do intern in  the university teachers will offer, you can see those in internship offer section. </li>
                                            <li> Click on a internship offer and apply, if teacher accept your request your company and supervisor details will be uploaded automatic. </li>
                                            <li> If your doing intern outside please add company and supervoisor details accordingly. </li>
                                            <li> For company you can select from existing companies, if you can not find your company you also have option for add new company. </li>
                                            <li> To add supervisor details you need to upload your cv and add your company details. </li>
                                        </div>
                                        <!-- END TAB-5 -->

                                        <!-- TAB-6 -->
                                        <div :class="{'tab-pane  active': batch.req_to_complete != 2, 'tab-pane': batch.req_to_complete == 2 }" id="tab_1_6">
                                            <li> Now you need to upload all the required files. </li>
                                            <li> University supervisor will contact you for intern defence. </li>
                                        </div>
                                        <!-- END TAB-6 -->

                                        <!-- TAB-7 -->
                                        <div :class="{'tab-pane  active': batch.req_to_complete == 2, 'tab-pane': batch.req_to_complete != 2 }" id="tab_1_7">
                                            
                                            <div class="alert alert-success" v-if=" batch.req_to_complete == 2">
                                                <strong>Success!</strong> You have successfully completed your internship.
                                            </div>
                                        </div>
                                        <!-- END TAB-7 -->
                                    </div>
                                </div>
                            </div>
                            <!-- BEGIN GENERAL PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-social-dribbble font-blue-sharp"></i>
                                        <span class="caption-subject font-blue-sharp bold uppercase">Intern Details</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <!-- Intern Start -->
                                            <strong v-if="student.internship_status == 0">Apply for Intern :</strong>
                                            <div class="alert alert-info" v-if="student.semester_id == 0">
                                                <strong>Select Semester : </strong>Please select the semester you want to do intern. <strong>( It will be approved by admin )</strong>

                                                <form @submit.prevent="changeSemester()" id="form_sample_1" class="form-horizontal" > 
                                                    <div class="form-body">
                                                        <div :class="{'form-group': true, 'form-group has-error': errors.has('semester_id') }">
                                                            <label class="control-label col-md-3">Semester
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <select class="form-control"   name="semester_id" v-model="semester.semester_id" v-validate="'required|numeric'" >
                                                                    <option value="0">Select..</option>
                                                                    <option v-for="s in semesters" :key="s.semester_id" :value="s.semester_id">{{s.semester_name}}</option>
                                                                </select>
                                                                <i class="fa fa-exclamation-triangle required" v-show="errors.has('semester_id')" ></i>
                                                                <span v-show="errors.has('semester_id')" class="required">{{ errors.first('semester_id') }}</span>
                                                                <span class="help-block"> Only active semester will show here </span>
                                                            </div>
                                                        </div>
                                                        <div :class="{'form-group': true, 'form-group has-error': errors.has('subjects_left') }">
                                                            <label class="control-label col-md-3">Subjects Left
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input class="form-control placeholder-no-fix" v-model="semester.subjects_left" v-validate="'required|numeric'"  type="number" min="1" max="4" placeholder="Subjects Left" name="subjects_left" />
                                                                <i class="fa fa-exclamation-triangle required" v-show="errors.has('subjects_left')" ></i>
                                                                <span v-show="errors.has('subjects_left')" class="required">{{ errors.first('subjects_left') }}</span>
                                                                <span class="help-block">Subjects Left After Current Semester</span>
                                                            </div>
                                                        </div>
                                                        <div :class="{'form-group': true, 'form-group has-error': errors.has('credits_left') }">
                                                            <label class="control-label col-md-3">Credits Left
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input class="form-control placeholder-no-fix" v-model="semester.credits_left" v-validate="'required|numeric'"  type="number" min="3" max="12" placeholder="Credits Left" name="credits_left" />
                                                                <i class="fa fa-exclamation-triangle required" v-show="errors.has('credits_left')" ></i>
                                                                <span v-show="errors.has('credits_left')" class="required">{{ errors.first('credits_left') }}</span>
                                                                <span class="help-block">Credits Left After Current Semester</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-12" >
                                                                <button type="submit" class="btn green">Apply</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="alert alert-warning" v-if="student.semester_id != 0 && student.internship_status == 0">
                                                You have already <strong>applied</strong> for internship, please wait for admin's approval.
                                            </div>
                                            <!-- Intern End -->

                                            <!-- Batch Start -->
                                            <strong v-if="student.internship_status != 0 && student.batch_id != '0'">Batch Details :</strong>

                                            <div class="alert alert-warning" v-if="student.internship_status != 0 && student.batch_id == '0'">
                                                <strong>Please wait </strong> admin will assign you to a batch.
                                            </div>

                                            <div class="alert alert-success" v-if="student.internship_status == 1 && student.batch_id != '0' && batch.approved == 1">
                                                <strong>Success! </strong>You have been assigned to a batch.<br><br>
                                                
                                                <table border="0">
                                                    <tr><td><strong>Batch Name  </strong> </td><td> : {{batch.batch_id}}</td></tr>
                                                    <tr><td><strong>Batch Teacher </strong> </td><td> : {{ batch.name}}</td></tr>
                                                </table>

                                                For more Teacher information check <strong>Supervisor details.</strong>
                                            </div>
                                            <!-- Batch End -->

                                            <!-- QR code Start -->
                                            <div class="alert alert-warning" v-if="student.internship_status != 0 && student.batch_id != '0' && student.token_no != 'expired'">
                                                <strong>You have successfully applied for intern,</strong> Please take Printout <button class="btn purple btn-outline" @click.prevent="printToken()"><i class="fa fa-print" ></i></button>
                                                <br><br>

                                                <table border="0" id="print">
                                                    <tr><td><strong>Student Name  </strong> </td><td> : {{student_name}}</td></tr>
                                                    <tr><td><strong>Student Id  </strong> </td><td> : {{semester.student_id}}</td></tr>
                                                    <tr><td><strong>Batch ID </strong> </td><td> : {{ student.batch_id}}</td></tr>
                                                    <tr><td><strong>Token No. </strong> </td><td> : {{ student.token_no}}</td></tr>

                                                    <tr>
                                                        <td></td> 
                                                        <td style="margin-left: 3px;">
                                                            <qr-code :text="' Name : '+student_name + '\n' + 
                                                                  ' ID : ' + semester.student_id +'\n'+
                                                                  ' Token No : ' +student.token_no " 
                                                                  color="#3388FF"  error-level="L">
                                                            </qr-code>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>Token QR CODE </strong></td>
                                                    </tr>

                                                </table>
                                            </div>
                                            <!-- QR code End -->
                                        </div>
                                        <div class="col-md-6" >

                                            <!-- Itern offer Start -->
                                            <strong v-if="student.internship_status != 0 && student.token_no == 'expired'">Inernship Offers (click for details) : </strong>

                                            <div v-if="student.internship_status != 0 && student.token_no == 'expired' && student.applied_TA == '0' && student.TA_confirmed == '0'">
                                                
                                                <div style="height:580px;overflow:auto;" >
                                                    <div class="alert alert-warning offer" v-for="t in teachers" :key="t.teacher_id" @click.prevent="TADetails(t)" data-toggle="modal" href="#basic">
                                                        <table>
                                                            <tr><td colspan="2"><strong><u>{{t.TA_position}}</u></strong></td></tr>
                                                            <tr><td><i class="fa fa-map-marker" ></i> </td><td> American International University-Bangladesh (AIUB)</td></tr>
                                                            <tr><td><i class="fa fa-graduation-cap" ></i> </td> Applied for internship.<td></td></tr>
                                                            <tr><td><i class="fa fa-user" ></i> </td><td> Teacher: {{t.name}}, ( {{t.email}} )</td></tr>
                                                            <tr><td><i class="fa fa-users" ></i> </td><td> Vacancy : <strong>{{t.TA_vacancy}}</strong></td></tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-warning" v-if="student.internship_status == 1 && student.applied_TA != '0' && student.TA_confirmed == '0'">
                                                <strong>Please wait </strong> for teacher approval. <a href="#" @click.prevent="removeTA()" class="btn red btn-outline">Remove apply</a>
                                            </div>

                                            <div class="alert alert-success" v-if="student.internship_status == 1 && student.applied_TA != '0' && student.TA_confirmed == '1'">
                                                <strong>Success </strong> Teacher has accepted your request.
                                            </div>
                                            <!-- Itern offer End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END GENERAL PORTLET-->
                        
                    </div>
                </div>
                <!-- END PAGE BASE CONTENT -->
                <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">TA Deatils</h4>
                            </div>
                            <div class="modal-body">  
                                <p>
                                    <b style="color:black;">Teacher Name : </b>{{details.teacher_name}}
                                </p>
                                <p>
                                    <b style="color:black;">Teacher email : </b>{{details.teacher_email}}
                                </p>
                                <p>
                                    <b style="color:black;">Offer Details : </b><br>{{details.teacher_content}}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn green" @click="applyTA()">Apply</button>
                                <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
    <!-- END CONTENT -->
</template>
<style >
.offer{
    background-color: rgb(190, 189, 189);
    cursor: pointer;
    color: white;
}

.offer:hover{
    background-color: rgba(0, 0, 0, 0.699);
    color: rgb(247, 232, 232);
}
</style>
<script>
import { Validator } from 'vee-validate';
import print from 'print-js';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                student: '',
                teachers: '',
                teacher:{
                    teacher_id: '',
                    student_id: $('#user_id').val(),
                },
                student_name: $('#user_name').val(),
                batch: '',
                semester:{
                    semester_id: '',
                    student_id: $('#user_id').val(),
                    subjects_left: '',
                    credits_left: '',
                },
                details:{
                    teacher_id:'',
                    teacher_name:'',
                    teacher_email:'',
                    teacher_content:'',
                },
                semesters: []
            }
        },
        created(){
            //console.log($('#user_id').val());
            this.student_id = $('#user_id').val();
            this.viewStudent(this.student_id);
            this.loadSemester();
            this.loadTATeacher();
        },
        methods: {
            viewStudent(id){
                //console.log(id)
                fetch(`api/student.profile/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.student = res;
                    this.semester.semester_id = res.semester_id;

                    if (res.batch_id != '0') {
                        fetch(`api/student.batchDetails/${res.batch_id}`)
                        .then(res => res.json())
                        .then(res => {
                            //console.log(res);
                            this.batch = res[0];
                        })
                        .catch(err => console.log(err));
                    }
                })
                .catch(err => console.log(err));
            },
            loadSemester(){
                fetch('api/student.loadSemester')
                .then(res => res.json())
                .then(res => {
                    this.semesters = res;
                })
                .catch(err => console.log(err));
            },
            loadTATeacher(){
                fetch('api/student.loadTATeacher')
                .then(res => res.json())
                .then(res => {
                    //console.log(res)
                    this.teachers = res;
                })
                .catch(err => console.log(err));
            },
            TADetails(t){
                this.details.teacher_id = t.teacher_id;
                this.details.teacher_name = t.name;
                this.details.teacher_email = t.email;
                this.details.teacher_content = t.TA_courses;
            },
            applyTA(){
                this.teacher.teacher_id =  this.details.teacher_id;
                fetch('api/student.applyTA',{
                    method: 'post',
                    body: JSON.stringify(this.teacher),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    console.log(res)
                    //this.teachers = res;
                    swal({
                        icon: "success",
                        title: "Success!",
                        text: "You have successfully applied for teacher assistance.",
                        type: "success"
                    }).then(function() {
                        window.location = "redirectURL";
                    });
                    location.reload();
                })
                .catch(err => console.log(err));
            },
            removeTA(){
                fetch('api/student.removeTA',{
                    method: 'post',
                    body: JSON.stringify(this.teacher),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    console.log(res)
                    //this.teachers = res;
                    alert('Details Updated');
                    location.reload();
                })
                .catch(err => console.log(err));
            },
            changeSemester(){
                swal({
                    title: "Are you sure?",
                    text: "Once applied you can not change semester.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.validateBeforeSubmit();
                        fetch('api/student.changeSemester',{
                            method: 'post',
                            body: JSON.stringify(this.semester),
                            headers: {
                                'content-type': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(res => {
                            swal({
                                icon: "success",
                                title: "Success!",
                                text: "You have successfully applied for intern.",
                                type: "success"
                            }).then(function() {
                                window.location = "redirectURL";
                            });
                        })
                        .catch(err => console.log(err)) 
                    }
                });
                
            },
            addToken(){
                //console.log(this.student_id);
                fetch(`api/student.token/${this.student_id}`,{
                method: 'get'
                })
                .then(res => res.json())
                .then(data => {
                    this.viewStudent();
                })
                .catch(err => console.log(err))
            },
            printToken(){
                console.log(this.student_id);
                

                printJS({printable: 'print', type: 'html', header: '<h2><table border="0"><tr><td><img src="assets/indexPage/img/aiub_logo.png" height="80" width="80"></td> <td> Aiub </td><td>CS</td><td> Intern  </td></tr></table></h2>'});
            

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
