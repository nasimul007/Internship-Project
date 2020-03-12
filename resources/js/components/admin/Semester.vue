<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Semesters
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
                                <span class="caption-subject font-blue-sharp bold uppercase">Semesters</span>
                            </div>
                            <div class="actions">
                                <tr>
                                    <td>
                                        <a data-toggle="modal" href="#basic" class="btn blue btn-outline" >Add New <i class="fa fa-plus"></i></a>
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" border="1">
                                <thead>
                                    <tr>
                                        <th> sl </th>
                                        <th> Name </th>
                                        <th> Start Date </th>
                                        <th> End Date </th>
                                        <th> Created Date </th>
                                        <th> Status </th>
                                        <th> Options </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX" v-for="semester in semesters" :key="semester.semester_id">
                                        
                                        <td> {{semester.semester_id}}</td>
                                        <td> {{semester.semester_name}} </td>
                                        <td> {{semester.start_date}} </td>
                                        <td> {{semester.end_date}} </td>
                                        <td> {{semester.created_date}} </td>
                                        <td> 
                                            <span class="label label-sm label-warning" v-if=" semester.status == 0"> Inactive </span>
                                            <span class="label label-sm label-success" v-if=" semester.status == 1"> Active </span>
                                        </td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                                    Select
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                    <a  class="btn green btn-outline dropdownCustom" @click="activeSemester(semester.semester_id)">Active</a>
                                                    <a  class="btn yellow btn-outline dropdownCustom" @click="inactiveSemester(semester.semester_id)">Inactive</a>
                                                    <a  class="btn red btn-outline dropdownCustom" @click="deleteSemester(semester.semester_id)">Delete</a>
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
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Semester</h4>
                    </div>
                    <div class="modal-body">  
                        
                        <form @submit.prevent="addSemester()" id="form_sample_1" class="form-horizontal" > 
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <select class="form-control" name="year1" id="year1"></select> 
                                    </div>
                                    <div class="col-md-1">-</div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="year2" id="year2"></select> 
                                    </div>
                                    <div class="col-md-1">-</div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="season" id="season">
                                            <option value="">Select...</option>
                                            <option value="Fall">Fall</option>
                                            <option value="Spring">Spring</option>
                                            <option value="Summer">Summer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="semester" name="semester_name" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <input  type="submit" form="form_sample_1" value="Create" class="btn green" />
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
            console.log($('#user_id').val());
            
            const plugin = document.createElement("script");

            plugin.setAttribute(
            "src",
            "assets/pages/scripts/table-datatables-managed.min.js"
            );
                
            plugin.async = true;
            document.body.appendChild(plugin);

            $('#year1').each(function() {
                var year = (new Date()).getFullYear();
                var current = year;
                year -= 3;
                for (var i = 0; i < 6; i++) {
                    if ((year+i) == current)
                    $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
                    else
                    $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
                }
            })
            $('#year2').each(function() {
                var year = (new Date()).getFullYear();
                var current = year + 1;
                year -= 3;
                for (var i = 0; i < 6; i++) {
                    if ((year+i) == current)
                    $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
                    else
                    $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
                }
            })
        },
        data() {
            return {
                semesters: [],
                semester: {
                    semester_id: '',
                    semester_name: '',
                    start_date: '',
                    end_date: '',
                    created_date: '',
                    status: ''
                }
            }
        },
        created(){
            this.viewSemesters();
        },
        methods: {
            viewSemesters(){
                fetch('api/semesters')
                .then(res => res.json())
                .then(res => {
                    this.semesters = res.data;
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
                    printable: this.semesters,
                    properties: [
                        { field: 'semester_name', displayName: 'Semester Name'},
                        { field: 'start_date', displayName: 'StartcDate'},
                        { field: 'end_date', displayName: 'End Date'},
                        { field: 'created_date', displayName: 'Created Date'}
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
                        filename: "Teachers" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: preserveColors
                    });
                }
            },
            addSemester(){
                var s = $('#year1').val() + '-' + $('#year2').val() + ',' + $('#season').val();
                $('#semester').val(s);

                this.semester.semester_name = $('#semester').val();

                //console.log(this.semester.semester_name);

                fetch('api/semesters',{
                    method: 'post',
                    body: JSON.stringify(this.semester),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal('Success!', "New semester added.", 'success');
                    this.viewSemesters();
                })
                .catch(err => console.log(err))
            },
            activeSemester(id){
                $('#semesterOn').val(1);
                console.log(id);
                fetch(`api/semesters/${id}`,{
                    method: 'put',
                    body: JSON.stringify(this.semester),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(res => {
                    swal('Success!', "Semester activated successfully.", 'success');
                    this.semesters = res.data;
                })
                .catch(err => console.log(err))
            },
            inactiveSemester(id){
                $('#semesterOn').val(0);
                console.log(id);
                fetch(`api/semesters.inactive/${id}`,{
                    method: 'post',
                    body: JSON.stringify(this.semester),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(res => {
                    alert('Semester inactivated');
                    this.semesters = res.data;
                })
                .catch(err => console.log(err))
            },
            deleteSemester(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Semester will be removed.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/semesters/${id}`,{
                            method: 'delete'
                        })
                        .then(res => res.json())
                        .then(res => {
                            swal("Semester removed.", {
                                icon: "success",
                            });
                            this.semesters = res.data;
                        })
                        .catch(err => console.log(err))
                    }
                });
            }
        }
    }
</script>
