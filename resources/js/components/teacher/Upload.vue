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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Students</span>
                                </div>
                                <div class="actions">
                                    <a href="" class="btn yellow btn-outline" @click.prevent="exportPdf()">Save as PDF <i class="fa fa-file-pdf-o"></i></a>
                                    <a href="" class="btn blue btn-outline" @click.prevent="exportExcel()">Export to Excel<i class="fa fa-file-excel-o"></i></a>
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
                                            <th> File </th>
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
                                                <a class="btn green btn-outline" data-toggle="modal" href="#upload" @click="manageUpload(student.student_id)"> Manage </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END GENERAL PORTLET-->
                    <div class="modal fade" id="upload" tabindex="-1" role="upload" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Student details</h4>
                                </div>
                                <div class="modal-body">  
                                    <form @submit.prevent="uploadFile()" id="form_sample_1" class="form-horizontal" >
                                        <div class="form-body">
                                            <div class="col-md-8">
                                                <input type="file" id="files" ref="files"  v-on:change="handleFileUpload()" multiple>
                                            </div>

                                            <div class="col-md-4">
                                                <input v-if="upload" type="submit" value="Upload" class="btn green" />
                                                <input v-else type="submit" value="Upload" class="btn green" disabled/>
                                            </div>
                                        </div>
                                    </form>
                                    <table class="table" style="margin-top:2%; overflow:auto;">
                                    <thead>
                                        <tr>
                                            <th> sl </th>
                                            <th > Name </th>
                                            <th> Date </th>
                                            <th> Select </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="file in files" :key="file.upload_id">
                                            
                                            <td> {{file.upload_id}}</td>
                                            <td > {{file.name}} </td>
                                            <td> {{file.date}} </td>
                                            <td>
                                                <a class="btn red btn-outline" data-toggle="modal" href="#upload" @click="deleteFile(file.upload_id)"> Delete </a>
                                            </td>
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

            var uploadField = document.getElementById("files");
            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                    alert("File is too big!");
                    this.value = "";
                };
            };
        },
        data() {
            return {
                students: [],
                files: [],
                f: {
                    upload_id: '',
                    name: '',
                    date: ''
                },
                student: {
                    name: '',
                    student_id: '',
                    department: '',
                    email: '',
                    credits_left: '',
                    semester_id:'',
                    mobileNo: '',
                    
                },
                teacher_id: $('#user_id').val(),
                file: '',
                add: true,
                edit: false,
                upload: false
            }
        },
        created(){
            this.viewStudents();
        },
        methods: {
            viewStudents(){
                fetch('api/student.showAll')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.students = res.data;
                })
                .catch(err => console.log(err));
            },
            viewFiles(id){
                fetch(`api/teacher.viewFiles/${id}`)
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    this.files = res;
                })
                .catch(err => console.log(err));
            },
            exportPdf(){
                // $("#sample_1").tableHTMLExport({
                //     ignoreColumns: 'sl',
                //     type:'pdf',
                //     filename: 'Teacher List.pdf',
                // });
                $('#sample_1').printThis({
                    importCSS: true,
                    importStyle: false,     // prefix to html
                    pageTitle: "my page",
                    footer: '<h1>yoo success</h1>', 
                    header: "<h1>yoo success</h1>"
                });
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
            manageUpload(id){
                this.teacher_id = $('#user_id').val();
                this.student_id = id;
                this.clearForm();
                this.viewFiles(id);
            },
            uploadFile(){
                let formData = new FormData();
                console.log('first'+this.file);
                for( var i = 0; i < this.file.length; i++ ){
                    let fi = this.file[i];
                    formData.append('files[' + i + ']', fi);
                }
                formData.append('teacher_id', this.teacher_id);
                formData.append('batch_id', this.student_id);

                console.log('second'+this.file);

                axios.post('api/teacher.uploadFile',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    console.log(res);
                    this.clearForm();
                    this.viewFiles(this.student_id);
                }).catch(error => {
                    console.log(error);
                })
            },
            deleteFile(id){
                console.log(id);
                if(confirm("Are you sure!")){
                    fetch(`api/teacher.deleteFile/${id}`,{
                    method: 'get'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('File removed');
                        this.viewStudents();
                    })
                    .catch(err => console.log(err))
                }
            },
            handleFileUpload(){
                this.file = this.$refs.files.files;
                console.log(this.file);
                this.upload = true;
            },
            clearForm(){
                this.add = true;
                this.upload = false;
                $('#files').val('');
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
