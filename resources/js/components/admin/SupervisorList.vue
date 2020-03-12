<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Supervisor List
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Company Supervisors</span>
                                </div>
                                <div class="actions">
                                    <table border="0">
                                        <tr>
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
                                            <th style="display:none;"> sl </th>
                                            <th> Name </th>
                                            <th> Designation </th>
                                            <th> Company Name </th>
                                            <th> Company Type </th>
                                            <th> Options </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="supervisor in supervisors" :key="supervisor.supervisor_id">
                                            
                                            <td style="display:none;"> </td>
                                            <td> {{supervisor.supervisor_name}} </td>
                                            <td> {{supervisor.supervisor_designation}} </td>
                                            <td> {{supervisor.company_name}} </td>
                                            <td> {{supervisor.company_type}} </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                        <a class="btn green btn-outline dropdownCustom" data-toggle="modal" href="#edit" @click="editSupervisor(supervisor)"> Edit </a>
                                                        <a  class="btn red btn-outline dropdownCustom" @click="deleteSupervisor(supervisor.supervisor_id)">Delete</a>
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
                    <div class="modal fade" id="edit" tabindex="-1" role="edit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Supervisor details</h4>
                                </div>
                                <div class="modal-body">  
                                    
                                    <form id="form_sample_1" class="form-horizontal" > 
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Company Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <input type="text" class="form-control" v-model="company.company_name" name="company_name" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Company Type
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <input type="text" class="form-control" v-model="company.company_type" name="company_type" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Company Mobile No.
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <input type="text" class="form-control" v-model="company.company_contact" name="company_contact" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Company Address
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <input type="text" class="form-control" v-model="company.company_address" name="company_address" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Company Website
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <input type="text" class="form-control" v-model="company.company_website" name="company_website" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_name') }">
                                                <label class="control-label col-md-3">Contact person Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" v-model="supervisor.supervisor_name" v-validate="'required|alpha_spaces'" name="supervisor_name" /> 
                                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_name')" ></i>
                                                        <span v-show="errors.has('supervisor_name')" class="required">{{ errors.first('supervisor_name') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_number') }">
                                                <label class="control-label col-md-3">Contact person Number
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" v-model="supervisor.supervisor_number" v-validate="'required|numeric'" name="supervisor_number" /> 
                                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_number')" ></i>
                                                        <span v-show="errors.has('supervisor_number')" class="required">{{ errors.first('supervisor_number') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_email') }">
                                                <label class="control-label col-md-3">Contact person Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="email" class="form-control" v-model="supervisor.supervisor_email" v-validate="'required'" name="supervisor_email" /> 
                                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_email')" ></i>
                                                        <span v-show="errors.has('supervisor_email')" class="required">{{ errors.first('supervisor_email') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div :class="{'form-group': true, 'form-group has-error': errors.has('supervisor_designation') }">
                                                <label class="control-label col-md-3">Contact person Designation
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="test" class="form-control" v-model="supervisor.supervisor_designation" v-validate="'required'" name="supervisor_designation" /> 
                                                        <i class="fa fa-exclamation-triangle required" v-show="errors.has('supervisor_designation')" ></i>
                                                        <span v-show="errors.has('supervisor_designation')" class="required">{{ errors.first('supervisor_designation') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <input v-if="add" id="addStudent" type="submit" form="form_sample_1" class="btn green" />
                                    <button v-if="edit" @click.prevent="updateSupervisor(supervisor.supervisor_id)" class="btn green">Update</button>
                                    <button class="btn yellow btn-outline" @click="clearForm()">Reset</button>
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
                supervisors: [],
                supervisor: {
                    supervisor_id: '',
                    supervisor_name: '',
                    supervisor_number: '',
                    supervisor_email: '',
                    supervisor_designation: '',
                    student_id: '',
                    assigned_date: ''
                },
                company:{
                    company_name: '',
                    company_type: '',
                    company_contact: '',
                    company_address: '',
                    company_website: ''
                },
                add: true,
                edit: false
            }
        },
        created(){
            this.viewSupervisors();
        },
        methods: {
            viewSupervisors(){
                fetch('api/supervisors')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.supervisors = res.data;
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
                    printable: this.supervisors,
                    properties: [
                        { field: 'supervisor_name', displayName: 'Supervisor Name'},
                        { field: 'supervisor_number', displayName: 'Supervisor Mobile No.'},
                        { field: 'supervisor_email', displayName: 'Supervisor Email'},
                        { field: 'supervisor_designation', displayName: 'Supervisor designation'},
                        { field: 'student_id', displayName: 'Student Id'},
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
            editSupervisor(s){
                this.add = false;
                this.edit = true;
                this.supervisor.supervisor_id = s.supervisor_id;
                this.supervisor.supervisor_name = s.supervisor_name;
                this.supervisor.supervisor_number = s.supervisor_number;
                this.supervisor.supervisor_email = s.supervisor_email;
                this.supervisor.supervisor_designation = s.supervisor_designation;
                this.company.company_name = s.company_name;
                this.company.company_type = s.company_type;
                this.company.company_contact = s.company_contact;
                this.company.company_address = s.company_address;
                this.company.company_website = s.company_website;
                this.supervisor.student_id = s.student_id;
            },
            updateSupervisor(id){
                this.validateBeforeSubmit();
                console.log(id);
                fetch(`api/supervisors/${id}`,{
                    method: 'put',
                    body: JSON.stringify(this.supervisor),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(data => {
                    swal('Success!', "Supervisor details updated.", 'success');
                    this.viewSupervisors();
                })
                .catch(err => console.log(err))
            },
            deleteSupervisor(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Supervisor details will be removed.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/supervisors/${id}`,{
                            method: 'delete'
                        })
                        .then(res => res.json())
                        .then(data => {
                            swal("Supervisor details removed.", {
                                icon: "success",
                            });
                            this.viewSupervisors();
                        })
                        .catch(err => console.log(err))
                    }
                });
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
