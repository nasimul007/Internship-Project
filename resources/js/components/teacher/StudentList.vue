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
                        <small>teacher</small>
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
                                <div class="actions" >
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <select v-model="student.semester_id" @change="loadStudents(student.semester_id)" >
                                                    <option value="">Select..</option>
                                                    <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id" >{{semester.semester_name}}</option>
                                                </select>
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
                                            <th style="display:none;"> </th>
                                            <th> Student Id </th>
                                            <th> Name </th>
                                            <th> Batch </th>
                                            <th> Supervisor </th>
                                            <th> CV </th>
                                            <th> A.L. </th>
                                            <th> B.R. </th>
                                            <th> Evaluation </th>
                                            <th> Options </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="student in students" :key="student.student_id">
                                            
                                            <td style="display:none;"> </td>
                                            <td> {{student.student_id}} </td>
                                            <td> {{student.name}} </td>
                                            <td> {{student.batch_id}} </td>
                                            <td> <a :class="{'btn green btn-outline': student.supervisor_name != null, 'btn red btn-outline': student.supervisor_name == null }" data-toggle="modal" href="#supervisor" @click="loadSupervisor(student.student_id)">Details</a> </td>
                                            <td> <i v-if="student.cv_title != null && student.cv_title != 'later'" class='fa fa-check-square-o' style='font-size:20px;color:green'></i></td>
                                            <td> <i v-if="student.appointment_letter_title != null && student.appointment_letter_title != 'later'" class='fa fa-check-square-o' style='font-size:20px;color:green'></i> </td>
                                            <td> <i v-if="student.book_report_title != null  && student.book_report_title != 'later'" class='fa fa-check-square-o' style='font-size:20px;color:green'></i> </td>
                                            <td> 
                                                <a  class="btn green btn-outline" v-if="student.evaluation == 0" @click="sendEvaluation(student.student_id)">Send</a>
                                                <span class="label label-sm label-warning" v-if="student.evaluation != 0 && student.evaluation != 2"> Pending </span> 
                                                <a  class="btn purple" v-if="student.evaluation == 2" data-toggle="modal" href="#evaluation" @click="loadEvaluation(student.student_id)">View</a>
                                            </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                        <a  class="btn blue btn-outline dropdownCustom" data-toggle="modal" href="#comment" @click="commentStudent(student.student_id)">Comment</a>
                                                        <a  class="btn purple btn-outline dropdownCustom" data-toggle="modal" href="#upload" @click="loadUploads(student.student_id)">Uploads</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="comment" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Compose</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="scroller" style="height:50%" data-always-visible="1" data-rail-visible1="1">
                                        <div class="form-group">
                                            <label class="control-label">Student ID
                                                <span class="required"> * </span>
                                            </label>
                                            <input type="text" name="receiver" v-model="student.student_id"  class="form-control" disabled>
                                        </div>
                                        <form @submit.prevent="addFirstComment(student.student_id, comment)" role="form" action="#" id="f1">
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('first_comment') }">
                                                <label class="control-label">First Comment
                                                    <span class="required"> * </span>
                                                </label>
                                                    <textarea name="first_comment" form="f1" v-model="comment.first_comment" v-validate="'required'" class="form-control" rows="3"></textarea>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('first_comment')" ></i>
                                                    <span v-show="errors.has('first_comment')" class="required">{{ errors.first('first_comment') }}</span>
                                            </div>
                                            <div class="margiv-top-10" align="right">
                                                <input v-if="addFirst" type="submit" value="Comment" class="btn green">
                                                <button v-if="editFirst" @click.prevent="updateComment(student.student_id, comment)" class="btn blue">Update</button>
                                                <input type="reset" value="Cancel" class="btn default">
                                            </div>
                                        </form>
                                        <form @submit.prevent="addFinalComment(student.student_id, comment)" role="form" action="#" id="f2">
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('final_comment') }">
                                                <label class="control-label">Final Comment
                                                    <span class="required"> * </span>
                                                </label>
                                                    <textarea name="final_comment" form="f2" v-model="comment.final_comment" v-validate="'required'" class="form-control" rows="3"></textarea>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('final_comment')" ></i>
                                                    <span v-show="errors.has('final_comment')" class="required">{{ errors.first('final_comment') }}</span>
                                            </div>
                                            <div class="margiv-top-10" align="right">
                                                <input v-if="addFinal" type="submit" value="Comment" class="btn green">
                                                <button v-if="editFinal" @click.prevent="updateComment(student.student_id, comment)" class="btn blue">Update</button>
                                                <input type="reset" value="Cancel" class="btn default">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="upload" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Student's Uploads</h4>
                                </div>
                                <div class="modal-body">
                                    <h4 class="block">CV</h4>
                                    <div class="alert alert-info">
                                        <strong>{{ viewFiles.cv_title }}</strong> 
                                            <button class="btn purple btn-outline" @click.prevent="downloadCv(student.student_id)" style="margin-left:1%;"> Download</button>
                                            <button class="btn red btn-outline" @click.prevent="deleteCv(student.student_id)" style="margin-left:1%;"> Delete</button>
                                    </div>
                                    <h4 class="block">Appointment Letter</h4>
                                    <div class="alert alert-info">
                                        <strong>{{ viewFiles.appointment_letter_title }}</strong> 
                                            <button class="btn purple btn-outline" @click.prevent="downloadAppointmentLetter(student.student_id)" style="margin-left:1%;"> Download</button>
                                            <button class="btn red btn-outline" @click.prevent="deleteAppointmentLetter(student.student_id)" style="margin-left:1%;"> Delete</button>
                                    </div>
                                    <h4 class="block">Book Report</h4>
                                    <div class="alert alert-info">
                                        <strong>{{ viewFiles.book_report_title }}</strong> 
                                            <button class="btn purple btn-outline" @click.prevent="downloadBookReport(student.student_id)" style="margin-left:1%;"> Download</button>
                                            <button class="btn red btn-outline" @click.prevent="deleteBookReport(student.student_id)" style="margin-left:1%;"> Delete</button>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="supervisor" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Supervisor Details</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" v-if="upSuper == false">
                                        <strong>Error! No supervisor information delivered</strong> </div>

                                    <div class="alert alert-success" v-if="upSuper">
                                        <table class="table table-bordered order-column">
                                            <tbody>
                                                <tr><td><strong>Supervisor Id : </strong> </td><td> {{supervisor.supervisor_id}}</td></tr>
                                                <tr><td><strong>Supervisor Name : </strong> </td><td> {{supervisor.supervisor_name}}</td></tr>
                                                <tr><td><strong>Supervisor Designation : </strong> </td><td> {{supervisor.supervisor_designation}}</td></tr>
                                                <tr><td><strong>Supervisor Email : </strong> </td><td> {{supervisor.supervisor_email}}</td></tr>
                                                <tr><td><strong>Supervisor Number : </strong> </td><td>+880{{supervisor.supervisor_number}}</td></tr>
                                                <tr><td><strong>Assigned Date : </strong> </td><td> {{supervisor.assigned_date}}</td></tr>
                                                <tr><td><strong>Company Name : </strong> </td><td> {{supervisor.company_name}}</td></tr>
                                                <tr><td><strong>Company Type : </strong> </td><td> {{supervisor.company_type}}</td></tr>
                                                <tr><td><strong>Company Address : </strong> </td><td> {{supervisor.company_address}}</td></tr>
                                                <tr><td><strong>Company Website : </strong> </td><td> {{supervisor.company_website}}</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="evaluation" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Supervisor Evaluation</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" v-if="upEva == false">
                                        <strong>Error! supervisor did not submit evaluation</strong> </div>

                                    <div class="alert alert-success" v-if="upEva">
                                        <table class="table table-bordered order-column" >
                                            <thead>
                                                <tr>
                                                    <th>Questions</th>
                                                    <th>Answer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td> Final comment </td><td> <strong>{{evaluation.comment}}</strong></td></tr>
                                                <tr><td>1. Evaluate the Intern's development and progress in technical skills such as drafting, sketching, field reports, delineation, etc. </td><td> <strong>{{evaluation.question_1}}</strong></td></tr>
                                                <tr><td>2. Intern's verbal communications expressing his thoughts and understanding thoughts of others. </td><td> <strong>{{evaluation.question_2}}</strong></td></tr>
                                                <tr><td>3. Neatness of Intern's work and efforts for the office. </td><td> <strong>{{evaluation.question_3}}</strong></td></tr>
                                                <tr><td>4. Thoughtness of Intern's work and efforts for the office. </td><td> <strong>{{evaluation.question_4}}</strong></td></tr>
                                                <tr><td>5. Intern's willingness in performing assigned tasks. </td><td> <strong>{{evaluation.question_5}}</strong></td></tr>
                                                <tr><td>6. Intern's general attitude to the entire employment in the office. </td><td> <strong>{{evaluation.question_6}}</strong></td></tr>
                                                <tr><td>7. Ability of intern to take on assigned responsibilities to the best of intern's capability. </td><td> <strong>{{evaluation.question_7}}</strong></td></tr>
                                                <tr><td>8. Intern's professional curiosity in asking questions about officce techniques and procedures. </td><td> <strong>{{evaluation.question_8}}</strong></td></tr>
                                                <tr><td>9. Was intern a help to the office? </td><td> <strong>{{evaluation.question_9}}</strong></td></tr>
                                                <tr><td>10. Evaluation of intern's overall performance. </td><td> <strong>{{evaluation.question_10}}</strong></td></tr>
                                            </tbody>
                                        </table>
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
        },
        data() {
            return {
                sl: 0,
                students: [],
                viewFiles: '',
                supervisor: '',
                semesters: [],
                evaluation: '',
                notice: {
                    notice_id: '',
                    receiver: '',
                    subject: '',
                    content: '',
                    date: '',
                    teacher_id: $('#user_id').val()
                },
                student: {
                    student_id: '',
                    teacher_id: $('#user_id').val(),
                    semester_id: ''
                },
                comment: {
                    first_comment: '',
                    final_comment: '',
                    teacher_id: $('#user_id').val()
                },
                addFirst: true,
                addFinal: false,
                editFirst: false,
                editFinal: false,
                upSuper: true,
                upEva: true,
            }
        },
        created(){
            this.teacher_id = $('#user_id').val();
            this.viewStudents(this.teacher_id);
            this.getSemesters();
        },
        methods: {
            viewStudents(id){
                fetch(`api/teacher.teacherStudents/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    this.students = res;
                    this.student.semester_id = res[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            loadStudents(semester_id){
                //console.log(id);
                fetch(`api/teacher.loadSemesterStudents/${this.student.teacher_id},${semester_id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.students = res;
                    this.student.semester_id = res[0].semester_id;
                })
                .catch(err => console.log(err));
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
            loadUploads(id){
                this.student.student_id = id;
                fetch(`api/student.loadUploads/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.viewFiles = res;
                })
                .catch(err => console.log(err));

                //console.log(this.upCv);
            },
            loadSupervisor(id){
                fetch(`api/supervisors/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    if (res.valid == false || res[0].company_name == null || res[0].supervisor_name == null) {
                        this.upSuper = false;
                    }else{
                        this.upSuper = true;
                        this.supervisor = res[0];
                    }
                })
                .catch(err => console.log(err));
            },
            sendEvaluation(id){
                fetch(`api/evaluations.sendEvaluationLink/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    if (res.success == false) {
                        alert('Mail not sent');
                    }else if(res.success == true){
                        swal('Success!', "Mail with evaluation link sent successfully.", 'success');
                        this.viewStudents($('#user_id').val());
                    }
                })
                .catch(err => console.log(err));
            },
            loadEvaluation(id){
                fetch(`api/evaluations/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    if (res.valid == false) {
                        this.upEva = false;
                    }else{
                        this.upEva = true;
                        this.evaluation = res;
                    }
                })
                .catch(err => console.log(err));
            },
            downloadCv(id){
                console.log(id);
                window.open(`api/student.downloadCv/${id}`, '_blank');
            },
            downloadAppointmentLetter(id){
                console.log(id);
                window.open(`api/student.downloadAppointmentLetter/${id}`, '_blank');
            },
            downloadBookReport(id){
                console.log(id);
                window.open(`api/student.downloadBookReport/${id}`, '_blank');
            },
            deleteCv(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Once applied you can not change semester.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/teacher.deleteCv/${id}`,{
                            method: 'get'
                        })
                        .then(data => {
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
            deleteAppointmentLetter(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Once applied you can not change semester.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/teacher.deleteAppointmentLetter/${id}`,{
                            method: 'get'
                        })
                        .then(data => {
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
            deleteBookReport(id){
                console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Once applied you can not change semester.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/student.deleteBookReport/${$('#user_id').val()}`,{
                            method: 'get'
                        })
                        .then(data => {
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
            noticeStudent(id){
                this.notice.receiver = id;
            },
            commentStudent(id){
                this.clearForm();
                this.student.student_id = id;
                this.addFirst = true,
                this.addFinal = false,
                this.editFirst = false,
                this.editFinal = false,
                fetch(`api/teacher.showComment/${id}`)
                .then(res => res.json())
                .then(res => {
                   console.log(res.first_comment );
                   if (res.first_comment != null && res.final_comment == 'later') {
                        this.addFirst = false;
                        this.addFinal = true;
                        this.editFirst = true;
                        this.comment.first_comment = res.first_comment;
                   }
                   if(res.first_comment != null && res.final_comment != 'later'){
                        this.addFirst = false;
                        this.addFinal = false;
                        this.editFirst = true;
                        this.editFinal = true;
                       this.comment.first_comment = res.first_comment;
                       this.comment.final_comment = res.final_comment;
                   }
                })
                .catch(err => console.log(err))
            },
            addFirstComment(id, c){
                this.validateBeforeSubmit();
                fetch(`api/teacher.addFirstComment/${id}`,{
                    method: 'post',
                    body: JSON.stringify(c),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => {
                    swal('Success!', "Comment added successfully.", 'success');
                    this.commentStudent(id);
                })
                .catch(err => console.log(err))
            },
            addFinalComment(id, c){
                fetch(`api/teacher.addFinalComment/${id}`,{
                    method: 'post',
                    body: JSON.stringify(c),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => {
                    alert('Comment Added');
                    swal('Success!', "Comment added successfully.", 'success');
                    this.commentStudent(id);
                })
                .catch(err => console.log(err))
            },
            updateComment(id, c){
                fetch(`api/teacher.updateComment/${id}`,{
                    method: 'post',
                    body: JSON.stringify(c),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => {
                    swal('Success!', "Comment updated successfully.", 'success');
                    $("body").trigger("click");
                })
                .catch(err => console.log(err))
            },
            clearForm(){
                this.notice.subject = '';
                this.notice.content = '';
                this.comment.first_comment = '';
                this.comment.final_comment = '';
                this.$validator.reset();
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
