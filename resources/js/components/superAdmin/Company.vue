<template>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Companies
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
                                    <span class="caption-subject font-blue-sharp bold uppercase">Compaines</span>
                                </div>
                                <div class="actions">
                                    <table border="0">
                                        <tr>
                                            <td>
                                                <a data-toggle="modal" href="#basic" class="btn green btn-outline" @click.prevent="clearForm()">Add New <i class="fa fa-plus"></i></a>
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
                                            <th> Company Name</th>
                                            <th> Company Type</th>
                                            <th> Company Contact</th>
                                            <th> Company Address</th>
                                            <th> Company Website</th>
                                            <th> Status </th>
                                            <th> Options </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX" v-for="c in companies" :key="c.company_id">
                                            
                                            <td style="display:none;"> </td>
                                            <td> {{c.company_name}} </td>
                                            <td> {{c.company_type}} </td>
                                            <td> {{c.company_contact}} </td>
                                            <td> {{c.company_address}} </td>
                                            <td> {{c.company_website}} </td>
                                            <td>
                                                <span class="label label-sm label-warning" v-if=" c.verified == 0"> Pending </span> 
                                                <span class="label label-sm label-success" v-if=" c.verified == 1"> Verified </span>
                                            </td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn sbold green dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Select
                                                        <i class="fa fa-chevron-down"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width:100px;">
                                                        <a  class="btn blue btn-outline dropdownCustom" v-if=" c.verified == 0" @click="verifyCompany(c.company_id)">Verify</a>
                                                        <a  class="btn red btn-outline dropdownCustom" v-if=" c.verified == 1" @click="disproveCompany(c.company_id)">Disprove</a>
                                                        <a  class="btn yellow btn-outline dropdownCustom" data-toggle="modal" href="#basic" @click="editCompany(c)">Edit</a>
                                                        <a  class="btn red btn-outline dropdownCustom"  @click="deleteCompany(c.company_id)">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Company details</h4>
                    </div>
                    <div class="modal-body">  
                        <form  @submit.prevent="addCompany()" id="form_sample_2" class="form-horizontal" >
                            <div class="form-group">
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_name') }">
                                    <label class="control-label col-md-3">Company Name
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" v-model="company.company_name" v-validate="'required|alpha_spaces'" name="company_name" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_name')" ></i>
                                            <span v-show="errors.has('company_name')" class="required">{{ errors.first('company_name') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_type') }">
                                    <label class="control-label col-md-3">Company Type
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" v-model="company.company_type" v-validate="'required|alpha_spaces'" name="company_type" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_type')" ></i>
                                            <span v-show="errors.has('company_type')" class="required">{{ errors.first('company_type') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_contact') }">
                                    <label class="control-label col-md-3">Mobile
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <div class="input-group input-large margin-top-10">
                                                <span class="input-group-addon">
                                                    +880
                                                </span>
                                                <input type="text" class="form-control" style="width:87%;" v-model="company.company_contact" v-validate="'required'"  name="company_contact" /> 
                                            </div>
                                            
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_contact')" ></i>
                                            <span v-show="errors.has('company_contact')" class="required">{{ errors.first('company_contact') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_address') }">
                                    <label class="control-label col-md-3">Address
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" v-model="company.company_address" v-validate="'required'"  name="company_address" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_address')" ></i>
                                            <span v-show="errors.has('company_address')" class="required">{{ errors.first('company_address') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div :class="{'form-group': true, 'form-group has-error': errors.has('company_website') }">
                                    <label class="control-label col-md-3">Website
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" v-model="company.company_website" v-validate="'required|url'" name="company_website" /> 
                                            <i class="fa fa-exclamation-triangle required" v-show="errors.has('company_website')" ></i>
                                            <span v-show="errors.has('company_website')" class="required">{{ errors.first('company_website') }}</span>    
                                        </div>
                                        <span class="help-block"> e.g: http://www.demo.com or http://demo.com </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-12" >
                                        <button v-if="add" type="submit" class="btn green">Submit</button>
                                        <button v-if="add" type="reset" class="btn default">Cancel</button>
                                        <button v-if="edit" @click.prevent="updateCompany(company.company_id)" class="btn green">Update</button>
                                        <button type="button" class="btn red btn-outline" id="closePop" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                companies: [],
                company: {
                    company_id: '',
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
            this.viewCompanies();
        },
        methods: {
            viewCompanies(){
                fetch('api/companies')
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.companies = res;
                })
                .catch(err => console.log(err));
            },
            verifyCompany(id){
                fetch(`api/teacher.verifyCompany/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.companies = res;
                })
                .catch(err => console.log(err));
            },
            disproveCompany(id){
                fetch(`api/teacher.disproveCompany/${id}`)
                .then(res => res.json())
                .then(res => {
                    //console.log(res);
                    this.companies = res;
                })
                .catch(err => console.log(err));
            },
            addCompany(){
                this.validateBeforeSubmit();
                fetch('api/companies',{
                    method: 'post',
                    body: JSON.stringify(this.company),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    swal('Success!', "Company details added.", 'success');
                    console.log(res)
                    this.companies = res;
                })
                .catch(err => console.log(err))
            },
            editCompany(c){
                this.add = false;
                this.edit = true;
                this.company.company_id = c.company_id;
                this.company.company_name = c.company_name;
                this.company.company_type = c.company_type;
                this.company.company_contact = c.company_contact;
                this.company.company_address = c.company_address;
                this.company.company_website = c.company_website;
            },
            updateCompany(id){
                //console.log(id);
                this.validateBeforeSubmit();
                fetch(`api/companies/${id}`,{
                    method: 'put',
                    body: JSON.stringify(this.company),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json()) 
                .then(res => {
                    swal('Success!', "Company details updated.", 'success');
                    this.add = true;
                    this.edit = false;
                    this.clearForm();
                    this.companies = res;
                })
                .catch(err => console.log(err))
            },
            deleteCompany(id){
                //console.log(id);
                swal({
                    title: "Are you sure?",
                    text: "Company details will be removed.",
                    icon: "warning",
                    dangerMode: true,
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`api/companies/${id}`,{
                            method: 'delete'
                        })
                        .then(res => res.json())
                        .then(res => {
                            swal("Company details removed.", {
                                icon: "success",
                            });
                            this.companies = res;
                        })
                        .catch(err => console.log(err))
                        
                    }
                });
            },
            clearForm(){
                this.add = true;
                this.edit  = false;
                this.company.company_name = '';
                this.company.company_type = '';
                this.company.company_address = '';
                this.company.company_contact = '';
                this.company.company_website = '';
                this.$validator.reset();
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
                    printable: this.companies,
                    properties: [
                        { field: 'company_name', displayName: 'Company Name '},
                        { field: 'company_type', displayName: 'Company Type '},
                        { field: 'company_contact', displayName: 'Company Contact '},
                        { field: 'company_address', displayName: 'Company Address'},
                        { field: 'company_website', displayName: 'company Website'},
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
