<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Approve Enrollment
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
                                        <td><button style="margin-left:3%;" @click.prevent="checkedStudent()" class="btn purple btn-outline">Allow selected</button></td>
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
                                        <th> Enrollment status </th>
                                        <th> Validation </th>
                                        <th> Select </th>
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
                                        <td align="center"> 
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
            <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Validation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
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
                                <div class="col-md-4">
                                    <div class="alert alert-warning">
                                        <table class="table table-bordered order-column">
                                            <thead>
                                                <tr><th> Portal given </th></tr>
                                            </thead>
                                            <tbody>
                                                <tr><td> {{studentGiven.student_id}}</td></tr>
                                                <tr><td> {{studentGiven.name}}</td></tr>
                                                <tr><td> {{studentGiven.credits_left}}</td></tr>
                                                <tr><td> {{studentGiven.subjects_left}}</td></tr>
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
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</template>

<script>
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
                    semester_id:''
                },
            }
        },
        created(){
            this.viewStudents();
            this.getSemesters();
        },
        methods: {
            viewStudents(){
                fetch('api/students.showEnrollment')
                .then(res => res.json())
                .then(res => {
                    this.students = res.data;
                    this.student.semester_id = res.data[0].semester_id;
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
                        { field: 'student_id', displayName: 'Student Id'},
                        { field: 'name', displayName: 'Name'},
                        { field: 'internship_status', displayName: 'Internship Status'}
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
            approveStudent(id){
                //console.log(id);
                fetch(`api/students.approveEn/${id}`,{
                method: 'get'
                })
                .then(res => res.json())
                .then(data => {
                    this.viewStudents();
                })
                .catch(err => console.log(err))
            },
            revokeStudent(id){
                console.log(id);
                fetch(`api/students.revokeEn/${id}`,{
                method: 'get'
                })
                .then(res => res.json())
                .then(data => {
                    this.viewStudents();
                })
                .catch(err => console.log(err))
            },
            checkedStudent(){
                var checkedValues = $("input:checkbox:checked", "#sample_1").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();
                //alert(checkedValues.join(','));

                $.each($(checkedValues), function(index, val){
                    //console.log(val);

                    fetch(`api/students.approveEn/${val}`,{
                    method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                swal('Success!', "All selected students were enrolled.", 'success');
                this.viewStudents();
            },
        }
    }
</script>
