<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Request To Complete
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Request To Complete</span>
                                </div>
                                <div class="actions">
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <select v-model="batch.semester_id" @change="loadBatches(batch.semester_id)" >
                                                    <option value="">Select..</option>
                                                    <option v-for="semester in semesters" :key="semester.semester_id" :value="semester.semester_id" >{{semester.semester_name}}</option>
                                                </select>
                                            </td>
                                            <td><button style="margin-left:3%;" @click.prevent="checkedBatches()" class="btn purple btn-outline">Allow selected</button></td>
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
                                            <th> Teacher </th>
                                            <th> View </th>
                                            <th> Grade report </th>
                                            <th> Req to complete </th>
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
                                            <td align="center"> {{batch.teacher_name}} </td>
                                            <td align="center"> <a class="btn green btn-outline" @click="batchDetails(batch.batch_id)" data-toggle="modal" href="#large" > Details </a> </td>
                                            <td>
                                                <button class="btn purple btn-outline" v-if=" batch.grade_report_title != 0" @click.prevent="downloadGR(batch.batch_id)" style="margin-left:1%;"> Download</button>
                                                <button class="btn red btn-outline" v-if=" batch.grade_report_title != 0" @click.prevent="deleteGR(batch.batch_id)" style="margin-left:1%;"> Delete</button>
                                                <span class="label label-sm label-success" v-if=" batch.grade_report_title == 0"> Pending </span> 
                                            </td>
                                            <td align="center">
                                                <span class="label label-sm label-success" v-if=" batch.req_to_complete == 0"> Pending </span>  
                                                <span class="label label-sm label-warning" v-if=" batch.req_to_complete == 1"> Requested </span> 
                                                <span class="label label-sm label-danger" v-if=" batch.req_to_complete == 2"> Completed </span> 
                                            </td>
                                            <td align="center"> 
                                                <div class="dropdown show " v-if=" batch.req_to_complete == 1 || batch.req_to_complete == 2" >
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:90px;">
                                                        <a class="btn green btn-outline dropdownCustom" @click="completeBatch(batch.batch_id)"> Complete </a>
                                                        <a class="btn red btn-outline dropdownCustom" @click="rejectBatch(batch.batch_id)"> Reject </a>
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
        <!-- END CONTENT BODY -->
        <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Batch Details</h4>
                    </div>
                    <div class="modal-body"> 

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> First Comment </th>
                                    <th> Final Comment </th>
                                    <th> Supervisor Comment </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX" v-for="student in students" v-bind:key="student.student_id">
                                    <td align="center"> {{student.student_id}}</td>
                                    <td align="center"> {{student.name}}</td>
                                    <td align="center"> {{student.first_comment}}</td>
                                    <td align="center"> {{student.final_comment}}</td>
                                    <td align="center"> 
                                        {{student.comment}}<br>
                                        <a class="btn green" v-if="student.comment != null" data-toggle="modal" href="#stack2" @click="loadEvaluation(student.student_id)">Details </a>
                                    </td>
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

        <div id="stack2" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Supervisor evaluation</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
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
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    </div>
                </div>
            </div>
        </div>
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
                students: [],
                batch:{
                    batch_id: '',
                    teacher_id: '',
                    semester_id: ''
                },
                semesters: [],
                teachers: [],
                evaluation: ''

            }
        },
        created(){
            this.viewBatches();
            this.getSemeters();
        },
        methods: {
            viewBatches(){
                fetch('api/batches.showAll')
                .then(res => res.json())
                .then(res => {
                    this.batch.semester_id = res.data[0].semester_id;
                    this.batches = res.data
                })
                .catch(err => console.log(err));
            },
            loadEvaluation(id){
                fetch(`api/evaluations/${id}`)
                .then(res => res.json())
                .then(res => {
                    this.evaluation = res;
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
            loadBatches(id){
                console.log(id);
                fetch(`api/batches.loadBatches/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.batch.semester_id = res.data[0].semester_id;
                    this.batches = res.data
                })
                .catch(err => console.log(err));
            },
            downloadGR(id){
                //console.log(id);
                window.open(`api/teacher.downloadGR/${id}`, '_blank');
            },
            deleteGR(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Grade report file will be deleted and batch request to complete will removed.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/teacher.deleteGR/${id}`,{
                            method: 'get'
                        })
                        .then(data => {
                            swal({
                                icon: "success",
                                title: "Success!",
                                text: "Grade report file successfully deleted.",
                                icon: "success"
                            });
                            this.viewBatches();
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
                    printable: this.batches,
                    properties: [
                        { field: 'batch_id', displayName: 'Batch Id'},
                        { field: 'date', displayName: 'Date'},
                        { field: 'req_to_complete', displayName: 'Request to complete'}
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
            completeBatch(id){
                //console.log(id);
                fetch(`api/batches.completeBatch/${id}`,{
                method: 'get'
                })
                .then(res => res.json())
                .then(data => {
                    this.viewBatches();
                })
                .catch(err => console.log(err))
            },
            rejectBatch(id){
                console.log(id);
                fetch(`api/batches.rejectBatch/${id}`,{
                method: 'get'
                })
                .then(res => res.json())
                .then(data => {
                    this.viewBatches();
                })
                .catch(err => console.log(err))
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
            checkedBatches(){
                var checkedValues = $("input:checkbox:checked", "#sample_1").map(function() {
                    if($(this).val() != 'on')
                        return $(this).val();
                }).get();
                //alert(checkedValues.join(','));

                $.each($(checkedValues), function(index, val){
                    //console.log(index + " : " + val);
                    fetch(`api/batches.completeBatch/${val}`,{
                    method: 'get'
                    })
                    .catch(err => console.log(err))
                });

                swal('Success!', "All selected batches status were changed to completed.", 'success');
                this.viewBatches();
            },
        }
    }
</script>
