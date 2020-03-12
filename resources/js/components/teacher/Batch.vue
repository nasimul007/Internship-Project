<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Batches
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Batches</span>
                                </div>
                                <div class="actions">
                                    <!-- <a href="" class="btn yellow btn-outline" @click.prevent="exportPdf()">Save as PDF <i class="fa fa-file-pdf-o"></i></a>
                                    <a href="" class="btn blue btn-outline" @click.prevent="exportExcel()">Export to Excel<i class="fa fa-file-excel-o"></i></a> -->
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <select v-model="semester.semester_id" @change="loadBatches(semester.semester_id)" >
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
                                            <th> Batch Id </th>
                                            <th> Date </th>
                                            <th> Grade Report </th>
                                            <th> Req to complete </th>
                                            <th> Options </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="batch in batches" :key="batch.batch_id">
                                            
                                            <td style="display:none;"> </td>
                                            <td> {{batch.batch_id}} </td>
                                            <td> {{batch.date}} </td>
                                            <td> 
                                                <button class="btn purple btn-outline" v-if=" batch.grade_report_title != 0" @click.prevent="downloadGR(batch.batch_id)" style="margin-left:1%;"> Download</button>
                                                <button class="btn red btn-outline" v-if=" batch.grade_report_title != 0" @click.prevent="deleteGR(batch.batch_id)" style="margin-left:1%;"> Delete</button>
                                                <span class="label label-sm label-success" v-if=" batch.grade_report_title == 0"> Pending </span> 
                                            </td>
                                            <td>
                                                <span class="label label-sm label-success" v-if=" batch.req_to_complete == 0"> Pending </span>  
                                                <span class="label label-sm label-warning" v-if=" batch.req_to_complete == 1"> Requested </span> 
                                                <span class="label label-sm label-danger" v-if=" batch.req_to_complete == 2"> Completed </span> 
                                            </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                        <a  class="btn green btn-outline dropdownCustom" data-toggle="modal" href="#students" @click="batchStudents(batch.batch_id)">Students</a>
                                                        <a  class="btn purple btn-outline dropdownCustom" data-toggle="modal" href="#reqToComplete" v-if=" batch.req_to_complete == 0" @click="reqCompleteLoad(batch.batch_id)">Request to<br>complete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="notice" tabindex="-1" role="notice" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Notice</h4>
                                </div>
                                <div class="modal-body">  
                                    
                                    <form @submit.prevent="addNotice()" id="form_sample_2" class="form-horizontal" > 
                                        <div class="form-body">
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('receiver') }">
                                                <label class="control-label col-md-3">Receiver
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="receiver" v-model="notice.receiver" v-validate="'required'" class="form-control" disabled>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('receiver')" ></i>
                                                    <span v-show="errors.has('receiver')" class="required">{{ errors.first('receiver') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('subject') }">
                                                <label class="control-label col-md-3">Subject
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="subject" v-model="notice.subject" v-validate="'required'" class="form-control">
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('subject')" ></i>
                                                    <span v-show="errors.has('subject')" class="required">{{ errors.first('subject') }}</span>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('content') }">
                                                <label class="control-label col-md-3">Content
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <textarea name="content" form="noticeAll" v-model="notice.content" v-validate="'required'" class="form-control" rows="3"></textarea>
                                                    <i class="fa fa-exclamation-triangle required" v-show="errors.has('content')" ></i>
                                                    <span v-show="errors.has('content')" class="required">{{ errors.first('content') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Send" form="form_sample_2" class="btn green" />
                                    <button class="btn yellow btn-outline" @click="clearForm()">Reset</button>
                                    <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade" id="students" tabindex="-1" role="notice" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Notice</h4>
                                </div>
                                <div class="modal-body">  
                                    <table class="table table-bordered order-column">
                                        <thead>
                                            <tr >
                                                <th><strong> Student Name </strong></th>
                                                <th><strong> Student Id </strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="student in students" :key="student.student_id">
                                                <td> {{ student.student_name }} </td>
                                                <td> {{ student.student_id }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade" id="reqToComplete" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Request to complete batch</h4>
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
                                            <tr><td><strong>Batch </strong> </td><td> {{batch_id}}</td></tr>
                                            <tr><td>
                                                    <strong>Grade report </strong> 
                                                </td>
                                                <td>
                                                    <input type="file" name="file" class="form-control" id="file" ref="file"  v-on:change="handleFileUpload()" />
                                                </td>
                                            </tr>
                                            <tr><td><strong> </strong> </td><td> <button type="button" @click.prevent="reqComplete(batch_id)" class="btn sbold green">Submit</button> </td></tr>

                                        </tbody>
                                    </table>
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
import print from 'print-js';


    export default {
        mounted() {
            //console.log('Component mounted.')
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
                batches: [],
                students: [],
                semesters: [],
                batch_id: '',
                file: '',
                semester: {
                    semester_id: '',
                    teacher_id: $('#user_id').val()
                },
                notice: {
                    notice_id: '',
                    receiver: '',
                    subject: '',
                    content: '',
                    date: '',
                    teacher_id: $('#user_id').val()
                }
            }
        },
        created(){
            this.viewBatches(this.notice.teacher_id);
            this.getSemesters();
        },
        methods: {
            viewBatches(id){
                fetch(`api/teacher.batches/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.batches = res;
                    this.semester.semester_id = res[0].semester_id;
                })
                .catch(err => console.log(err));
            },
            loadBatches(semester_id){
                //console.log(id);
                fetch(`api/teacher.loadSemesterBatches/${this.semester.teacher_id},${semester_id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.batches = res;
                    this.semester.semester_id = res[0].semester_id;
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
            batchStudents(id){
                fetch(`api/teacher.batchStudents/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.students = res.data;
                })
                .catch(err => console.log(err));
            },
            reqCompleteLoad(id){
                this.batch_id = id;
            },
            reqComplete(id){
                let formData = new FormData();
                console.log(this.file);

                formData.append('file', this.file);
                formData.append('batch_id', this.batch_id);

                axios.post(`api/teacher.reqComplete`,formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    console.log(res);
                    swal('Success!','Request successfull with grade report upload.','success');
                    this.viewBatches(this.notice.teacher_id);
                    //location.reload();
                }).catch(error => {
                    console.log(error);
                })
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
                            this.viewBatches(this.notice.teacher_id);
                        })
                        .catch(err => console.log(err))
                    }
                });

                
            },
            handleFileUpload(){
                this.file = '';
                this.file = this.$refs.file.files[0];
                console.log(this.file);
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
            noticeBatch(id){
                this.notice.receiver = id;
            },
            clearForm(){
                this.notice.subject = '';
                this.notice.content = '';
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
