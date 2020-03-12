<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Student Without batch
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
                                <span class="caption-subject font-blue-sharp bold uppercase">Allow Enrollment</span>
                            </div>
                            <div class="actions">
                                <table border="0">
                                    <tr>
                                        <td>
                                            <select v-model="student.semester_id" @change="loadStudents(student.semester_id)">
                                                <option value="">Select..</option>
                                                <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id" >{{semester.semester_name}}</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="dropdown show " style="margin-left:3%;">
                                                <a class="btn green btn-outline dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Batch Controls
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:60px;">
                                                    <!-- <a @click.prevent="newBatch()"  style="width:100%;" class="btn blue btn-outline">Create Empty Batch</a> -->
                                                    <a @click.prevent="getStudentStatus()" data-toggle="modal" style="width:100%;" href="#basic" class="btn blue btn-outline">Create Batch with applied students</a>
                                                    <a  @click.prevent="checkedStudent()" data-toggle="modal" href="#selected" class="btn yellow btn-outline">Create Batch with selected students</a>
                                                    <a  @click.prevent="checkedStudent()" data-toggle="modal" href="#massAssign" style="width:100%;" class="btn purple btn-outline">Assign to a batch</a>
                                                </div>
                                            </div>    
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                    <tr>
                                        <th class="table-checkbox">
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th> ID </th>
                                        <th> Name </th>
                                        <th> Option </th>
                                        <!-- <th> Enrollment status </th>
                                        <th> Validation </th>
                                        <th> Select </th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX" v-for="student in students" v-bind:key="student.id">
                                        <td align="center">
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="checkboxes" :value="student.student_id" />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td align="center"> {{student.student_id}}</td>
                                        <td align="center"> {{student.name}} </td>
                                        <td align="center"> <a  @click.prevent="singleStudent(student.student_id)" data-toggle="modal" href="#singleAssign" class="btn purple btn-outline">Assign</a> </td>

                                        <!-- <td align="center"> 
                                            <span class="label label-sm label-info" v-if=" student.internship_status == 0"> Pending </span>
                                            <span class="label label-sm label-success" v-if=" student.internship_status == 1"> Allow </span>
                                            <span class="label label-sm label-warning" v-if=" student.internship_status == 3"> Running </span>
                                        </td>
                                        <td align="center"> 
                                            <button @click.prevent="validateStudent(student.student_id)" data-toggle="modal" href="#basic" class="btn green btn-outline">Validate</button>
                                        </td>
                                        <td align="center"> 
                                            <button @click.prevent="approveStudent(student.student_id)" v-if=" student.internship_status == 0 && student.semester_id != 0" class="btn sbold green">Allow</button>
                                            <button @click.prevent="revokeStudent(student.student_id)" v-if=" student.internship_status == 1 && student.semester_id != 0" class="btn red btn-outline">Disallow</button>
                                        </td> -->
                                        
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
            <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
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
                                    <tr><td><strong>Semester </strong> </td><td> {{semester}}</td></tr>
                                    <tr><td><strong>Total Student </strong> </td><td> {{totalStudent}}</td></tr>
                                    <tr><td><strong>Student per Batch</strong> </td><td> <input type="number" min="5" max="10" @keyup="batchNumber()" v-model="batchStudentLimit"></td></tr>
                                    <tr><td><strong>Number of Batch </strong> </td><td> {{numOfBatch}}</td></tr>
                                    <tr><td><strong> </strong> </td><td> <button type="button" @click.prevent="createBatch()" class="btn sbold green">Submit</button> </td></tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="selected" tabindex="-1" role="basic" aria-hidden="true">
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
                                    <tr><td><strong>Semester </strong> </td><td> {{semester}}</td></tr>
                                    <tr><td><strong>Student Ids </strong> </td><td> {{studentId}}</td></tr>
                                    <tr><td><strong>Total Student </strong> </td><td> {{totalStudent}}</td></tr>
                                    <tr><td><strong> </strong> </td><td> <button type="button" @click.prevent="checkedStudentBatch()" class="btn sbold green">Submit</button> </td></tr>

                                </tbody>
                            </table>
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
                            <h4 class="modal-title">Assign Students</h4>
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
                                    <tr><td><strong>Semester </strong> </td><td> {{semester}}</td></tr>
                                    <tr><td><strong>Student Ids </strong> </td><td> {{studentId}}</td></tr>
                                    <tr><td><strong>Total Student </strong> </td><td> {{totalStudent}}</td></tr>
                                    <tr><td>
                                            <strong>Batches </strong> 
                                        </td>
                                        <td>
                                            <select class="form-control" name="batch_id" v-model="student.batch_id">
                                                <option value="">Select..</option>
                                                <option v-for="batch in batches" :key="batch.batch_id" :value="batch.batch_id">{{batch.batch_id}} </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr><td><strong> </strong> </td><td> <button type="button" @click.prevent="checkedStudentAssignBatch(student.batch_id)" class="btn sbold green">Submit</button> </td></tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="singleAssign" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Assign Student</h4>
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
                                    <tr><td><strong>Semester </strong> </td><td> {{semester}}</td></tr>
                                    <tr><td><strong>Student Id </strong> </td><td> {{studentId}}</td></tr>
                                    <tr><td>
                                            <strong>Batches </strong> 
                                        </td>
                                        <td>
                                            <select class="form-control" name="batch_id" v-model="student.batch_id">
                                                <option value="">Select..</option>
                                                <option v-for="batch in batches" :key="batch.batch_id" :value="batch.batch_id">{{batch.batch_id}} </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr><td><strong> </strong> </td><td> <button type="button" @click.prevent="studentAssignBatch(student.batch_id)" class="btn sbold green">Submit</button> </td></tr>

                                </tbody>
                            </table>
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

<script>
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
        data(){
            return{
                students: [],
                semesters: [],
                studentGiven:'',
                student: {
                    semester_id:'',
                    batch_id: ''
                },
                semester: '',
                batches: [],
                totalStudent: '',
                batchStudentLimit: '',
                numOfBatch: '',
                studentId: '',
            }
        },
        created(){
            this.viewStudents();
            this.getSemesters();
            this.getStudentStatus();
            this.getBatches();
        },
        methods: {
            viewStudents(){
                fetch('api/students.withoutBatch')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.students = res.data;
                    this.student.semester_id = res.data[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            createBatch(){
                fetch(`api/batches.create/${this.batchStudentLimit}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    swal('Success!', "Automate batches creation was successfull.", 'success');
                })
                .catch(err => console.log(err));
            },
            newBatch(){
                fetch(`api/batches.newBatch`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    alert("Batch created succesfully");
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
            batchNumber(){
                this.numOfBatch = parseInt( this.totalStudent / this.batchStudentLimit);
            },
            getStudentStatus(){
                axios.get('/getStudentStatus')
                .then(res => {
                    //console.log(res);
                    this.semester = res.data.semester;
                    this.totalStudent = res.data.students;
                })
                .catch(err => {
                    console.log(err);
                })
            },
            loadStudents(id){
                //console.log(id);
                fetch(`api/student.withoutBatchLoad/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    this.students = res.data;
                    //this.student.semester_id = res.data[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            validateStudent(id){
                fetch(`api/students.studentGivenData/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    this.studentGiven = res;
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
            singleStudent(id){
                this.studentId = id;
            },
            studentAssignBatch(id){
                fetch(`api/batches.selectedAssign/${this.studentId},${id}`,{
                    method: 'get'
                })
                .catch(err => console.log(err))

                swal('Success!', "Student were assigned to the selected batch.", 'success');
                
                this.viewStudents();
                this.getStudentStatus();
            },
            checkedStudent(){
                var checkedValues = $("input:checkbox:checked", "#sample_1").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();
                this.studentId = checkedValues.join(',');

                this.totalStudent = checkedValues.length;
            },
            checkedStudentBatch(){
                var checkedValues = $("input:checkbox:checked", "#sample_1").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();

                $.each($(checkedValues), function(index, val){
                    //console.log(val);

                    fetch(`api/batches.selectedCreate/${val}`,{
                    method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                fetch('api/batches.selectedCreateBatch',{
                    method: 'get'
                    })
                    .catch(err => console.log(err))

                swal('Success!', "All selected students were assigned to the batch.", 'success');
                this.viewStudents();
            },
            checkedStudentAssignBatch(id){
                var checkedValues = $("input:checkbox:checked", "#sample_1").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();

                $.each($(checkedValues), function(index, val){
                    //console.log(val);

                    fetch(`api/batches.selectedAssign/${val},${id}`,{
                        method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                swal('Success!', "All selected students were assigned to the batch.", 'success');
                this.viewStudents();
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
        }
    }
</script>
