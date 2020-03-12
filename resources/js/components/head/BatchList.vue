<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Batch List
                        <small>head</small>
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Manage</span>
                                </div>
                                <div class="actions">
                                    <tr>
                                        <td>
                                            <select v-model="batch.semester_id" @change="loadHeadBatches(batch.semester_id)" >
                                                <option value="">Select..</option>
                                                <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id" >{{semester.semester_name}}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button style="margin-left:3%;" class="btn red btn-outline" v-if="semester.status == 0">No active semester</button>
                                        </td>
                                        <td>
                                            <button style="margin-left:3%;" @click.prevent="checkedBatches()" class="btn purple btn-outline">Allow selected</button>
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
                                            <th> Details </th>
                                            <th> Teacher </th>
                                            <th> Status </th>
                                            <th> Select </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="batch in batches" v-bind:key="batch.batch_id">
                                            <td align="center">
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="checkboxes" :value="batch.batch_id" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td align="center"> {{batch.batch_id}}</td>
                                            <td align="center"> <a class="btn green btn-outline" @click="batchDetails(batch.batch_id)" data-toggle="modal" href="#batchStudents" > Details </a> </td>
                                            <td align="center"> {{batch.teacher_name}} </td>
                                            <td align="center">
                                                <span class="label label-sm label-info" v-if=" batch.approved == 0 && batch.req_to_complete == 0"> Pending </span>
                                                <span class="label label-sm label-success" v-if=" batch.approved == 1 && batch.req_to_complete == 0"> Approved </span><br>   
                                                <span class="label label-sm label-danger" v-if=" batch.req_to_complete == 2"> Completed </span>    
                                            </td>
                                            <td align="center"> 
                                                <!-- <a class="btn green btn-outline" data-toggle="modal" href="#basic" @click="editBatch(batch)"> Manage </a> -->
                                                <a class="btn green btn-outline" v-if=" batch.approved == 0" @click="approveBatch(batch.batch_id)"> Approve </a>
                                                <a class="btn red btn-outline" v-if=" batch.approved == 1" @click="revokeBatch(batch.batch_id)"> Revoke </a>
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
                            <h4 class="modal-title">Teacher details</h4>
                        </div>
                        <div class="modal-body">  
                            
                            <form @submit.prevent="updateBatch()" id="form_sample_1" class="form-horizontal" > 
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">batch_id
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input name="batch_id" v-model="batch.batch_id" v-validate="'required'" class="form-control"  type="text" disabled>
                                        </div>
                                    </div>
                                    <div :class="{'form-group': true, 'form-group has-error': errors.has('teacher_id') }">
                                        <label class="control-label col-md-3">Teacher
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="teacher_id" v-model="batch.teacher_id" v-validate="'required'" >
                                                <option value="">Select..</option>
                                                <option v-for="teacher in teachers" :key="teacher.teacher_id" :value="teacher.teacher_id">{{teacher.name}}</option>
                                            </select>
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('teacher_id')" ></i>
                                            <span v-show="errors.has('teacher_id')" class="required">{{ errors.first('teacher_id') }}</span>
                                        </div>
                                    </div>
                                    <div :class="{'form-group': true, 'form-group has-error': errors.has('semester_id') }">
                                        <label class="control-label col-md-3">Semester
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <select class="form-control"   name="semester_id" v-model="batch.semester_id" v-validate="'required|numeric'" >
                                                <option value="">Select..</option>
                                                <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id">{{semester.semester_name}}</option>
                                            </select>
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('semester_id')" ></i>
                                            <span v-show="errors.has('semester_id')" class="required">{{ errors.first('semester_id') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @click.prevent="updateBatch(batch.batch_id)" class="btn green">Update</button>
                            <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="batchStudents" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Batch students</h4>
                        </div>
                        <div class="modal-body">  
                            
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Name </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX" v-for="student in students" v-bind:key="student.student_id">
                                        <td align="center"> {{student.student_id}}</td>
                                        <td align="center"> {{student.name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
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
                batches: [],
                batch:{
                    batch_id: '',
                    teacher_id: '',
                    semester_id: ''
                },
                semesters: [],
                semester: '',
                teachers: [],
                students: ''
            }
        },
        created(){
            this.viewBatches();
            this.loadSemester();
            this.getSemesters();
        },
        methods: {
            viewBatches(){
                fetch('api/head.batches')
                .then(res => res.json())
                .then(res => {
                    this.batches = res.data;
                    this.batch.semester_id = res.data[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            batchDetails(id){
                fetch(`api/batches.batchDetails/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.students = res;
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
            loadHeadBatches(id){
                //console.log(id);
                fetch(`api/batches.loadHeadBatches/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.batches = res.data
                    this.batch.semester_id = res.data[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            loadSemester(){
                fetch('api/semesters.activeOrLatest')
                .then(res => res.json())
                .then(res => {
                    //console.log(res)
                    this.semester = res;
                })
                .catch(err => console.log(err));
            },
            approveBatch(id){
                //console.log(id);
                fetch(`api/head.approveBatch/${id}`,{
                method: 'get'
                })
                .then(res => res.json())
                .then(data => {
                    this.viewBatches();
                })
                .catch(err => console.log(err))
            },
            revokeBatch(id){
                console.log(id);
                fetch(`api/head.revokeBatch/${id}`,{
                method: 'get'
                })
                .then(res => res.json())
                .then(data => {
                    this.viewBatches();
                })
                .catch(err => console.log(err))
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
                    printable: this.batches,
                    properties: [
                        { field: 'batch_id', displayName: 'Batch Id'},
                        { field: 'teacher_name', displayName: 'Teacher Name'},
                        { field: 'semester_name', displayName: 'Semester name'},
                        { field: 'date', displayName: 'Date'},
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
            checkedBatches(){
                var checkedValues = $("input:checkbox:checked", "#sample_1").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();
                //alert(checkedValues.join(','));

                $.each($(checkedValues), function(index, val){
                    //console.log(index + " : " + val);

                    fetch(`api/head.approveBatch/${val}`,{
                    method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                swal('Success!', "All selected batches were allowed.", 'success');
                this.viewBatches();
            },
        }
    }
</script>
