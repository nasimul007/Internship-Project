<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Teacher Assistant
                        <small>admin</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                <!-- BEGIN WELLS PORTLET-->
                    <div>
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Students</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Offer</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Students</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!--  -->
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1" >
                                        <button @click.prevent="checkedStudent()" class="btn purple btn-outline">Allow selected</button>
                                        <button @click.prevent="checkedStudentReject()" class="btn red btn-outline">Reject selected</button>
                                        <a v-if="requireTA"  class="btn green" data-toggle="modal" href="#TANotice" >Offer for Teacher assistant</a>
                                        <a v-if="requireTA == false"  class="btn red btn-outline" @click.prevent="terminateOfferTA(teacher_id)">Terminate Offer for Teacher assistant</a>
                                        <a  @click.prevent="checkedStudentCalc()" data-toggle="modal" href="#massAssign" class="btn blue btn-outline">Assign to a teacher</a>
                                        <br>
                                        <br>
                                        <h3><u> Applied Student List :</u> </h3>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2" border="1">
                                            <thead>
                                                <tr>
                                                    <th class="table-checkbox">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th> Student Id </th>
                                                    <th> Name </th>
                                                    <th> Details </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX" v-for="s in students" :key="s.student_id">
                                                    <td align="center">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="checkboxes" :value="s.student_id" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td> {{s.student_id}}</td>
                                                    <td> {{s.name}} </td>
                                                    <td> <button @click.prevent="validateStudent(s.student_id)" data-toggle="modal" href="#basic" class="btn green btn-outline">Details</button> </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <select v-model="semester_id" @change="loadStudents(semester_id)" >
                                            <option value="">Select..</option>
                                            <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id" >{{semester.semester_name}}</option>
                                            
                                        </select>
                                        <a href="#"  @click.prevent="checkedStudentRemove()" class="btn red btn-outline">Remove selected Students</a>
                                        <br>
                                        <br>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" border="1">
                                            <thead>
                                                <tr>
                                                    <th class="table-checkbox">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th> Student Id </th>
                                                    <th> Name </th>
                                                    <th> Details </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX" v-for="s in acceptedStudents" :key="s.student_id">
                                                    
                                                    <td align="center">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="checkboxes" :value="s.student_id" />
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td> {{s.student_id}}</td>
                                                    <td> {{s.name}} </td>
                                                    <td> <button @click.prevent="validateStudent(s.student_id)" data-toggle="modal" href="#basic" class="btn green btn-outline">Details</button> </td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END WELLS PORTLET-->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
            <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Validation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <table class="table table-bordered order-column">
                                            <thead>
                                                <tr>
                                                    <th> Criteria </th>
                                                    <th> Student given </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr><td><strong>Student Id: </strong> </td><td> {{studentGiven.student_id}}</td></tr>
                                                <tr><td><strong>Student Name: </strong> </td><td> {{studentGiven.name}}</td></tr>
                                                <tr><td><strong>Credit Left: </strong> </td><td> {{studentGiven.credits_left}}</td></tr>
                                                <tr><td><strong>Subject Left: </strong> </td><td> {{studentGiven.subjects_left}}</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                    <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="massAssign" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Create batch</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered order-column">
                                <thead>
                                    <tr>
                                        <th> Criteria </th>
                                        <th> Values </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td><strong>Semester </strong> </td><td> 
                                            <select v-model="semester_id" @change="loadStudents(semester_id)" disabled>
                                                <option value="">Select..</option>
                                                <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id" >{{semester.semester_name}}</option>
                                            </select>
                                        </td></tr>
                                    <tr><td><strong>Student Ids </strong> </td><td> {{studentId}}</td></tr>
                                    <tr><td><strong>Total Student </strong> </td><td> {{totalStudent}}</td></tr>
                                    <tr><td>
                                            <strong>Teachers </strong> 
                                        </td>
                                        <td>
                                            <!-- <select class="form-control" name="group_id" v-model="assignTeacher" >
                                                <option value="">Select..</option>
                                                <option v-for="t in teachers" :key="t.teacher_id" :value="t.teacher_id">{{t.name}} | {{t.teacher_id}}</option>
                                            </select> -->
                                            <input list="teachers" name="assignTeacherID" v-model="assignTeacherID" >
                                            <datalist id="teachers">
                                                <option value="">Select..</option>
                                                <option v-for="t in teachers" :key="t.teacher_id" :value="t.teacher_id">{{t.name}}</option>
                                            </datalist>
                                        </td>
                                    </tr>
                                    <tr><td><strong> </strong> </td><td> <button type="button" @click.prevent="checkedStudentAssign(assignTeacherID)" class="btn sbold green">Submit</button> </td></tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade bs-modal-lg" id="groupDeails" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Students</h4>
                        </div>
                        <div class="modal-body"> 

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> Student ID </th>
                                        <th> Student Name </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX" v-for="student in groupStudents" v-bind:key="student.student_id">
                                        <td align="center"> {{student.student_id}}</td>
                                        <td align="center"> {{student.name}}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="TANotice" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">TA Deatils</h4>
                        </div>
                        <div class="modal-body">  
                            <form  id="form_sample_1" class="form-horizontal" > 
                                <div class="form-body">
                                    <div class='form-group'>
                                        <label class="control-label col-md-3">Position
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" v-model="ta_content.position" width="100%" required>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="control-label col-md-3">Subjects
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea name="content" @keyup="checkText()" form="noticeAll" v-model="ta_content.courses" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @click.prevent="offerTA()" class="btn green" id="formSubmit" disabled>Submit</button>
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
</style>

<script>
import { Validator } from 'vee-validate';
import axios from 'axios';


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
                ta_content:{
                    teacher_id: $('#user_id').val(),
                    courses:'',
                    position:'',
                },
                students:[],
                groupStudents:[],
                acceptedStudents: '',
                studentGiven: '',
                semesters: [],
                teachers: [],
                assignTeacherID: '',
                semester: '',
                totalStudent: '',
                semester_id: '',
                teacher_id: $('#user_id').val(),
                requireTA: true,
                studentId: ''
            }
        },
        created(){
            //console.log(this.teacher_id);
            this.viewStudents(this.teacher_id);
            this.offerTAStatus(this.teacher_id);
            this.viewAcceptedStudents(this.teacher_id);
            this.getSemeters();
            this.getTeachers();
        },
        methods:{
            checkText(d){
                if (this.ta_content.content == '') {
                    $('#formSubmit').prop('disabled', true);
                }else if(this.ta_content.content != ''){
                    $('#formSubmit').prop('disabled', false);
                }
            },
            offerTAStatus(id){
                fetch(`api/teacher.offerTAStatus/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);

                    if (res == 1) {
                        this.requireTA = false;
                    }
                    else{
                        this.requireTA = true;
                    }
                })
                .catch(err => console.log(err));
            },
            offerTA(){
                fetch('api/teacher.offerTA',{
                    method: 'post',
                    body: JSON.stringify(this.ta_content),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal('Success!', "Teacher assistance offer for students were succesfully created.", 'success');
                    this.viewStudents(this.teacher_id);
                    this.viewGroups(this.teacher_id);
                    this.viewGroupStudents(this.teacher_id);
                    this.offerTAStatus(this.teacher_id);
                    this.requireTA = false;
                })
                .catch(err => console.log(err))
            },
            terminateOfferTA(id){
                fetch(`api/teacher.terminateOfferTA/${id}`)
                .then(res => {
                    //console.log(res);
                    this.offerTAStatus(this.teacher_id);
                })
                .catch(err => console.log(err));
            },
            viewStudents(id){
                fetch(`api/teacher.appliedTAStudents/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.students = res;
                })
                .catch(err => console.log(err));
            },
            viewAcceptedStudents(id){
                //console.log(id);
                fetch(`api/TA.acceptedStudents/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.acceptedStudents = res;
                    this.semester_id = res[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            validateStudent(id){
                fetch(`api/students.studentGivenData/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.studentGiven = res;
                })
                .catch(err => console.log(err));
            },
            checkedStudent(){
                var checkedValues = $("input:checkbox:checked", "#sample_2").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();
                //alert(checkedValues.join(','));
                var id = this.teacher_id;
                $.each($(checkedValues), function(index, val){
                    //console.log(val);

                    fetch(`api/TA.selectedAccept/${val},${id}`,{
                        method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                swal('Success!', "All selected students were accepted.", 'success');
                this.viewStudents(this.teacher_id);
                this.viewAcceptedStudents(this.teacher_id);
            },
            checkedStudentReject(){
                var checkedValues = $("input:checkbox:checked", "#sample_2").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();
                //alert(checkedValues.join(','));

                $.each($(checkedValues), function(index, val){
                    //console.log(val);

                    fetch(`api/TA.selectedReject/${val}`,{
                        method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                alert("All selected students were rejected");
                this.viewStudents(this.teacher_id);
            },
            checkedStudentCalc(){
                var checkedValues = $("input:checkbox:checked", "#sample_2").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();
                this.studentId = checkedValues.join(',');

                this.totalStudent = checkedValues.length;
            },
            checkedStudentAssign(id){
                var checkedValues = $("input:checkbox:checked", "#sample_2").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();

                //alert(id);

                $.each($(checkedValues), function(index, val){
                    //console.log(val);

                    fetch(`api/TA.selectedAssign/${val},${id}`,{
                        method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                swal('Success!', "All selected students were assigned to the Teacher.", 'success');
                this.viewStudents(this.teacher_id);
                this.viewAcceptedStudents(this.teacher_id);
            },
            checkedStudentRemove(){
                var checkedValues = $("input:checkbox:checked", "#sample_1").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();

                //alert(id);

                $.each($(checkedValues), function(index, val){
                    //console.log(val);

                    fetch(`api/TA.selectedRemove/${val}`,{
                        method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                alert("All selected students were removed");
                this.viewStudents(this.teacher_id);
                this.viewAcceptedStudents(this.teacher_id);
            },
            loadStudents(id){
                //console.log(id);
                fetch(`api/TA.acceptedSemesterStudents/${id},${this.teacher_id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.acceptedStudents = res;
                    this.semester_id = res[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            getSemeters(){
                axios.get('/getSemesters')
                .then(res => {
                    //console.log(res);
                    this.semesters = res.data.data;
                })
                .catch(err => {
                    console.log(err);
                })
            },
            getTeachers(){
                axios.get('/getTeachers')
                .then(res => {
                    //console.log(res.data);
                    this.teachers = res.data.data;
                })
                .catch(err => {
                    console.log(err);
                })
            },
        }
    }
</script>
